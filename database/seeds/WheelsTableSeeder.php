<?php

use Illuminate\Database\Seeder;

class WheelsTableSeeder extends Seeder
{

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     *
     * @return \App\Models\Image
     */
    protected function image(\Illuminate\Database\Eloquent\Model $model, $uuid): \App\Models\Image
    {
        $image = \App\Models\Image::query()
            ->where('imageable_type', get_class($model))
            ->where('imageable_id', $model->id)
            ->where('uuid', $uuid)
            ->first();

        if (!$image) {
            $image = new \App\Models\Image();
            $image->imageable_type = get_class($model);
            $image->imageable_id = $model->id;
            $image->uuid = $uuid;
            $image->save();
        }

        return $image;
    }

    /**
     * @param array $data
     * @return \App\Models\Style
     */
    protected function style(?array $data): ?\App\Models\Style
    {
        if ($data) {
            $style = \App\Models\Style::query()
                ->where('type', $data['type'])
                ->where('number', $data['number'])
                ->where('spoke', $data['spoke'])
                ->where('rotated', $data['isTurned'])
                ->first();

            if (!$style) {
                $style = new \App\Models\Style();
                $style->type = $data['type'];
                $style->number = $data['number'];
                $style->spoke = $data['spoke'];
                $style->rotated = $data['isTurned'];
                $style->save();
            }

            return $style;
        }

        return null;
    }

    /**
     * @param array $data
     * @return \App\Models\Brand
     */
    protected function brand(array $data): \App\Models\Brand
    {
        $brand = \App\Models\Brand::query()
            ->where('name', $data['name'])
            ->first();

        if (!$brand) {
            $brand = new \App\Models\Brand();
//            $brand->parent_id = $data['parentId'];
            $brand->name = $data['name'];
            $brand->save();

            if ($data['imageId']) {
                $image = $this->image($brand, $data['image']['hash']);
                $brand->image_id = $image->id;
                $brand->save();
            }
        }

        return $brand;
    }

    /**
     * @param \App\Models\Brand $brand
     * @param array $data
     * @return \App\Models\Collection
     */
    protected function collection(\App\Models\Brand $brand, ?array $data): ?\App\Models\Collection
    {
        if ($data) {
            $collection = \App\Models\Collection::query()
                ->where('brand_id', $brand->id)
                ->where('name', $data['name'])
                ->first();

            if (!$collection) {
                $collection = new \App\Models\Collection();
                $collection->brand_id = $brand->id;
                $collection->name = $data['name'];
                $collection->save();
            }

            return $collection;
        }

        return null;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = resource_path('data/wheels.json');
        $wheels = \json_decode(\file_get_contents($path), true);

        $output = $this->command->getOutput();
        $progressBar = $output->createProgressBar(
            \count($wheels)
        );

        foreach ($wheels as $wheelData) {

            $style = $this->style($wheelData['style']);
            $brand = $this->brand($wheelData['brand']);
            $collection = $this->collection(
                $brand,
                $wheelData['collection']
            );

            $wheel = \App\Models\Wheel::query()
                ->where('brand_id', $brand->id)
                ->where('name', $wheelData['name']);

            if ($collection) {
                $wheel->where('collection_id', $collection->id);
            }

            if ($style) {
                $wheel->where('style_id', $style->id);
            }

            if (!$wheel->first()) {
                $wheel = new \App\Models\Wheel();
                $wheel->style_id = $style ? $style->id : null;
                $wheel->collection_id = $collection ? $collection->id : null;
                $wheel->brand_id = $brand->id;
                $wheel->name = $wheelData['name'];
                $wheel->save();

                if ($wheelData['imageId']) {
                    $image = $this->image($brand, $wheelData['image']['hash']);
                    $wheel->image_id = $image->id;
                    $wheel->save();
                }
            }

            $progressBar->advance();
        }

        $output->newLine();
    }

}
