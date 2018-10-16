<?php

namespace App\Admin\Extensions\Tools;

use App\Models\Wheel;
use Encore\Admin\Grid\Tools\AbstractTool;

class WheelSimilarTool extends WheelSimilarAction
{

    /**
     * @return string
     */
    public function render(): string
    {
        $route = route('cp.wheels.index') . '?style_id=' . $this->styleId;

        return <<<button
<div class="btn-group pull-right" style="margin-right: 5px">
    <a href="$route" class="btn btn-sm btn-info" title="List">
        <i class="fa fa-clone"></i><span class="hidden-xs"> Similar</span>
    </a>
</div>
button;

    }

}
