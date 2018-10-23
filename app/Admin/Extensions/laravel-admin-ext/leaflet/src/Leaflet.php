<?php

namespace Encore\Leaflet;

use Encore\Admin\Extension;

class Leaflet extends Extension
{
    /**
     * @var string
     */
    public $name = 'leaflet';

    /**
     * @var string
     */
    public $views = __DIR__ . '/../resources/views';

    /**
     * @var string
     */
    public $assets = __DIR__ . '/../resources/assets';
}
