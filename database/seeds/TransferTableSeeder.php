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
     *
     * /{bucket}/{name}/default.png
     */
    protected $oldCdn = 'https://cdn.wheelpro.ru/%s/%s/default.png';

    /**
     * @var string
     *
     * /{bucket}/{uuid}.png
     */
    protected $newCdn = 'https://cdn.babichev.net/%s/%s.png';

    /**
     * @var string
     */
    protected $token = '25ac31ca9bad062c841e42f7716e71d00a71da82';

    /**
     * @var array
     */
    protected $brands = [];

    /**
     * @var array
     */
    protected $collections = [];

    /**
     * @var array
     */
    protected $styles = [];

    /**
     * @var array
     */
    protected $users = [];

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
    protected function lazyLoad(string $url, array $query): array
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

    /**
     * @param array $data
     * @return \App\Models\Style
     */
    protected function style(array $data): \App\Models\Style
    {
        $style = \App\Models\Style::firstOrCreate([
            'type' => $data['type'],
            'tuple' => $data['number'] === 'Simple' ? 'Single' : $data['number'],
            'spoke' => $data['spoke'],
            'rotated' => (bool)$data['isTurned'],
        ]);

        $this->styles[$data['id']] = $style->id;
        return $style;
    }

    protected function image(string $name, array $data): \App\Models\Image
    {
        // todo: download + send to cdn

        return \App\Models\Image::firstOrCreate([
            'uuid' => $data['hash']
        ]);
    }

    protected function brand(array $data): void
    {
        $brand = \App\Models\Brand::firstOrCreate([
            'name' => \trim($data['name'])
        ], [
            'enabled' => (bool)$data['active']
        ]);

        // loading brand
        $this->brands[$data['id']] = $brand->id;

        if (!$brand->image_id && $data['image']) {
            $image = $this->image('brand', $data['image']);
            $brand->image_id = $image->id;
            $brand->save();
        }

        // collections
        foreach ($data['collections'] as $collection) {
            $model = \App\Models\Collection::firstOrCreate([
                'brand_id' => $brand->id,
                'name' => trim($collection['name']),
            ], [
                'enabled' => $collection['active'] && $brand->enabled,
            ]);

            $this->collections[$collection['id']] = $model->id;
            $model->brand()->associate($brand);
            $model->save();
        }

        // addresses
        foreach ($data['addresses'] as $address) {
            $brand->addresses()->firstOrCreate([
                'latitude' => $address['latitude'],
                'longitude' => $address['longitude'],
            ], [
                'label' => trim($address['description']),
                'given_name' => $brand->name,
                'family_name' => $brand->name,
                'organization' => $brand->name,
                'street' => trim($address['street']),
                'state' => trim($address['state']),
                'city' => trim($address['city']),
                'postal_code' => trim($address['zipCode']),
                'is_primary' => false,
                'is_billing' => false,
                'is_shipping' => false,
            ]);
        }

        // links
        $lazyData = $this->lazyLoad(
            \sprintf('soc/brand/%d/social', $data['id']),
            ['limit' => 200]
        );

        $links = $lazyData['data'];
        foreach ($links as $link) {
            try {
                $brand->links()->firstOrCreate([
                    'url' => trim($link['url'])
                ], [
                    'enabled' => true
                ]);
            } catch (\Throwable $throwable) {

            }
        }
    }

    /**
     * @param \Illuminate\Console\OutputStyle $output
     */
    protected function styles(\Illuminate\Console\OutputStyle $output): void
    {
        $query = [
            'page' => 1,
            'sort' => ['id' => 'asc']
        ];

        $body = $this->lazyLoad('sow/style', $query);
        $progressBar = $output->createProgressBar($body['itemCount']);

        foreach (range($body['currentPage'], $body['pageCount']) as $page) {

            foreach ($body['data'] as $datum) {
                $this->style($datum);
                $progressBar->advance();
            }

            if ($body['currentPage'] === $body['pageCount']) {
                break;
            }

            $query['page'] = $page + 1;
            $body = $this->lazyLoad('sow/style', $query);
        }

        $output->newLine();
    }

    /**
     * @param \Illuminate\Console\OutputStyle $output
     */
    protected function brands(\Illuminate\Console\OutputStyle $output): void
    {
        $query = [
            'page' => 1,
            'sort' => ['id' => 'asc'],
            'preload' => ['image', 'addresses', 'collections']
        ];

        $body = $this->lazyLoad('soc/brand', $query);

        $progressBar = $output->createProgressBar($body['itemCount']);

        foreach (range($body['currentPage'], $body['pageCount']) as $page) {

            foreach ($body['data'] as $datum) {
                $this->brand($datum);
                $progressBar->advance();
                \usleep(10);
            }

            if ($body['currentPage'] === $body['pageCount']) {
                break;
            }

            $query['page'] = $page + 1;
            $body = $this->lazyLoad('soc/brand', $query);
        }

        $output->newLine();
    }

    /**
     * @param \Illuminate\Console\OutputStyle $output
     */
    protected function users(\Illuminate\Console\OutputStyle $output): void
    {
        $query = [
            'page' => 1,
            'sort' => ['id' => 'asc'],
            'preload' => ['image']
        ];

        $body = $this->lazyLoad('sou/user', $query);

        $progressBar = $output->createProgressBar($body['itemCount']);

        foreach (range($body['currentPage'], $body['pageCount']) as $page) {

            foreach ($body['data'] as $datum) {

                $user = \App\Models\User::firstOrCreate([
                    'email' => $datum['email']
                ], [
                    'login' => $datum['login'],
                    'name' => !empty($datum['lastname']) ?
                        trim(trim($datum['lastname']) . ' ' . $datum['name']) :
                        trim($datum['name']),

                    'passwordHash' => $datum['passwordHash'],
                    'enabled' => $datum['active'],
                    'email_verified_at' => $datum['roleId'] !== 3 ?
                        \Carbon\Carbon::now() : null,
                ]);

                $this->users[$datum['id']] = $user->id;

                if ($datum['roleId'] === 1) {
                    $user->assignRole(3); // developer
                }

                if (!$user->image_id && $datum['image']) {
                    $image = $this->image('avatar', $datum['image']);
                    $user->image_id = $image->id;
                    $user->save();
                }

                $progressBar->advance();
                \usleep(10);
            }

            if ($body['currentPage'] === $body['pageCount']) {
                break;
            }

            $query['page'] = $page + 1;
            $body = $this->lazyLoad('sou/user', $query);
        }

        $output->newLine();
    }

    /**
     * @param \Illuminate\Console\OutputStyle $output
     */
    protected function wheels(\Illuminate\Console\OutputStyle $output): void
    {
        $query = [
            'page' => 1,
            'transfer' => 1,
            'sort' => ['id' => 'asc'],
            'preload' => ['image', 'likes', 'favourites']
        ];

        $body = $this->lazyLoad('sow/wheel', $query);

        $progressBar = $output->createProgressBar($body['itemCount']);

        foreach (range($body['currentPage'], $body['pageCount']) as $page) {

            foreach ($body['data'] as $datum) {

                $wheel = \App\Models\Wheel::firstOrCreate([
                    'name' => trim($datum['name']),
                    'brand_id' => $this->brands[$datum['brandId']],
                    'collection_id' => $datum['collectionId'] ?
                        $this->collections[$datum['collectionId']] : null,

                    'customized' => $datum['isCustom'],
                    'retired' => $datum['isRetired'],
                ], [
                    'enabled' => $datum['active'] && \App\Models\Brand::whereEnabled(true)
                        ->find($this->brands[$datum['brandId']]),

                    'popular' => \round($datum['popular'] * 10000),

                    'style_id' => $datum['styleId'] ?
                        $this->styles[$datum['styleId']] : null,
                ]);

                if (!$wheel->image_id && $datum['image']) {
                    $image = $this->image('wheel', $datum['image']);
                    $wheel->image_id = $image->id;
                    $wheel->save();
                }

                foreach ($datum['likes'] as $data) {
                    \App\Models\User::find($this->users[$data['id']])
                        ->like($wheel);
                }

                foreach ($datum['favourites'] as $data) {
                    \App\Models\User::find($this->users[$data['id']])
                        ->follow($wheel);
                }

                // todo images, videos, comments

                $progressBar->advance();
                \usleep(10);
            }

            if ($body['currentPage'] === $body['pageCount']) {
                break;
            }

            $query['page'] = $page + 1;
            $body = $this->lazyLoad('sow/wheel', $query);
        }

        $output->newLine();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $output = $this->command->getOutput();
        $this->users($output);
        $this->styles($output);
        $this->brands($output);
        $this->wheels($output);
    }

    /**
     * @return \GuzzleHttp\Client
     */
    protected function guzzle(): GuzzleHttp\Client
    {
        if (!$this->guzzle) {
            $this->guzzle = new GuzzleHttp\Client(['base_uri' => self::API_URL]);
        }

        return $this->guzzle;
    }

    /**
     * @return void
     */
    protected function client_credentials(): void
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
