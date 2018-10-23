<?php

namespace Encore\Leaflet;

use Encore\Admin\Form\Field;
use Encore\Leaflet\Tiles\Sputnik;
use Encore\Leaflet\Tiles\Tile;
use Illuminate\Support\Str;

class LeafletMap extends Field
{

    /**
     * @var Tile
     */
    protected $tile;

    /**
     * @var string
     */
    protected $view = 'laravel-admin-leaflet::leaflet';

    /**
     * @var array
     */
    protected static $css = [
        'https://unpkg.com/leaflet@1.3.4/dist/leaflet.css',
        'https://unpkg.com/leaflet-geosearch@2.7.0/assets/css/leaflet.css',
    ];

    /**
     * @var array
     */
    protected static $js = [
        'https://unpkg.com/leaflet@1.3.4/dist/leaflet.js',
        'https://unpkg.com/leaflet-geosearch@2.7.0/dist/bundle.min.js',
    ];

    /**
     * LeafletMap constructor.
     * @param $column
     * @param array $arguments
     */
    public function __construct($column, array $arguments)
    {
        $column = [
            'lat' => $column,
            'lng' => \array_shift($arguments),
        ];

        if (empty($arguments)) {
            $arguments = ['Leaflet'];
        }

        $this->options((array)\config('admin.extensions.leaflet.config'));
        parent::__construct($column, $arguments);
    }

    /**
     * @return Tile
     */
    protected function getTile(): Tile
    {
        if (!$this->tile) {
            $this->tile = $this->options['tile'] ?? new Sputnik();
        }

        return $this->tile;
    }

    /**
     * @return string
     */
    protected function tileOptions(): string
    {
        return \json_encode([
            'attribution' => $this->getTile()->attribution(),
            'maxZoom' => $this->getTile()->maxZoom(),
        ]);
    }

    /**
     * @return int
     */
    protected function zoom(): int
    {
        return $this->options['zoom'] ?? 13;
    }

    /**
     * @return string
     */
    protected function style(): string
    {
        return $this->options['style'] ?? 'bar';
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function render()
    {
        $uuid = Str::uuid();
        $this->variables['uuid'] = $uuid;

        $this->script = <<<script
    var latitude = document.getElementById('{$uuid}{$this->id['lat']}');
    var longitude = document.getElementById('{$uuid}{$this->id['lng']}');
    var map = L.map('$uuid').setView([latitude.value, longitude.value], {$this->zoom()});
    var marker = L.marker([latitude.value, longitude.value]).addTo(map);

    L.tileLayer('{$this->getTile()->layer()}', {$this->tileOptions()}).addTo(map);

    var searchControl = new GeoSearch.GeoSearchControl({
      provider: new GeoSearch.OpenStreetMapProvider(),
      style: '{$this->style()}',
    });

    map.addControl(searchControl);
    map.on('geosearch/showlocation', function (e) {
        latitude.value = e.location.x;
        longitude.value = e.location.y;
    });
script;

        return parent::render();
    }

}
