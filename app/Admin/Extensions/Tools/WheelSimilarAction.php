<?php

namespace App\Admin\Extensions\Tools;

use App\Models\Wheel;
use Encore\Admin\Grid\Tools\AbstractTool;

class WheelSimilarAction extends AbstractTool
{

    /**
     * @var int
     */
    protected $styleId;

    /**
     * WheelSimilarButton constructor.
     * @param Wheel $wheel
     */
    public function __construct(Wheel $wheel)
    {
        $this->styleId = $wheel->style_id;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        $route = route('cpold.wheels.index') . '?style_id=' . $this->styleId;

        return <<<button
<a href="$route">
    <i class="fa fa-clone"></i>
</a>
button;

    }

}
