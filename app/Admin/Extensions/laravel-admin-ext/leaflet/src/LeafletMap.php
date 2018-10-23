<?php

namespace Encore\Leaflet;

use Encore\Admin\Form\Field;
use Illuminate\Support\Str;

class LeafletMap extends Field
{

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

        parent::__construct($column, $arguments);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function render()
    {
        $uuid = Str::uuid();
        $this->variables['uuid'] = $uuid;

        $this->script = <<<script
    var latEl = document.getElementById('{$uuid}{$this->id['lat']}');
    var lngEl = document.getElementById('{$uuid}{$this->id['lng']}');
    var lat = latEl.value;
    var lng = lngEl.value;
    var map = L.map('$uuid').setView([lat, lng], 4);
    var marker = L.marker([lat, lng]).addTo(map);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://osm.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
    
    var provider = new GeoSearch.OpenStreetMapProvider();
    
    var searchControl = new GeoSearch.GeoSearchControl({
      provider: provider,
    });

    map.addControl(searchControl);
    map.on('geosearch/showlocation', function (e) {
        latEl.value = e.location.x;
        lngEl.value = e.location.y;
    });
script;

        return parent::render();
    }

}
