<?php

use Illuminate\Database\Seeder;

class TransferTableSeeder extends Seeder
{

    protected const API_URL = 'https://api.wheelpro.ru/';

    // transfer app
    protected const CLIENT_ID = '52417984002376536820';
    protected const CLIENT_SECRET = '1MQZnkYBLsc2MUjz79Fm06iogHVESgeAAdOwq1WEPIaPtH3ONG6lixfC8uSCecnR';

    protected $guzzle;

    /**
     * @var string
     */
    protected $token = '25ac31ca9bad062c841e42f7716e71d00a71da82';

    /**
     * TransferTableSeeder constructor.
     */
    public function __construct()
    {
        $this->token OR $this->client_credentials();
    }

    /**
     * @param string $url
     * @param array $query
     * @return array
     */
    protected function lazyLoad(string $url, array $query)
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->token,
            'Accept' => 'application/json',
        ];

        $response = $this->guzzle()->get($url, [
            'query' => $query,
            'headers' => $headers,
        ]);

        return \json_decode(
            $response->getBody()->getContents(),
            true
        );
    }

    protected function image(string $name, array $data)
    {
        // download + send to cdn

        $image = new \App\Models\Image();
        $image->uuid = $data['hash'];
//        $image->save();

        return $image;
    }

    protected function brand(array $data)
    {
        $brand = new \App\Models\Brand();
        $brand->name = $data['name'];
        $brand->enabled = (bool)$data['active'];
//        $brand->save();

        $image = $this->image(__FUNCTION__, $data['image']);
        $image->imageable()->associate($brand);

        // collections
        foreach ($data['collections'] as $collection) {
            var_dump($collection['name']);
        }

        // addresses
        foreach ($data['addresses'] as $address) {
            var_dump($address['country']);
        }

        // social
        $lazyData = $this->lazyLoad(
            \sprintf('soc/brand/%d/social', $data['id']),
            ['limit' => 200]
        );

        $socials = $lazyData['data'];
        foreach ($socials as $social) {
            var_dump($social['url']);
        }

        die;

    }

    /**
     * @param \Illuminate\Console\OutputStyle $output
     */
    protected function brands(\Illuminate\Console\OutputStyle $output)
    {
        $query = [
            'page' => 1,
            'sort' => ['id' => 'asc'],
            'preload' => ['image', 'addresses', 'collections']
        ];

        $body = $this->lazyLoad('soc/brand', $query);

        $progressBar = $output->createProgressBar($body['itemCount']);

        for (; $body['currentPage'] <= $body['pageCount'];) {

            foreach ($body['data'] as $datum) {
                $this->brand($datum);
                $progressBar->advance();
                \usleep(10);
            }

            if ($body['currentPage'] === $body['pageCount']) {
                break;
            }

            $query['page']++;
            $body = $this->lazyLoad('soc/brand', $query);
        }

        $output->newLine();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $output = $this->command->getOutput();
        $this->brands($output);
    }

    /**
     * @return \GuzzleHttp\Client
     */
    protected function guzzle()
    {
        if (!$this->guzzle) {
            $this->guzzle = new GuzzleHttp\Client(['base_uri' => self::API_URL]);
        }

        return $this->guzzle;
    }

    /**
     * @return void
     */
    protected function client_credentials()
    {
        $response = $this->guzzle()->post('auth/token', [
            'form_params' => [
                'grant_type' => __FUNCTION__,
                'client_id' => self::CLIENT_ID,
                'client_secret' => self::CLIENT_SECRET,
            ]
        ]);

        $this->token = \json_decode($response->getBody())
            ->access_token;
    }

}
