<?php

namespace App\Observers;

use App\Models\Style;

class StyleObserver
{

    /**
     * @param Style $style
     *
     * @return string
     */
    protected function buildName(Style $style): string
    {
        return \sprintf(
            '%s %s %s%s',
            $style->type,
            $style->tuple,
            $style->spoke,
            $style->rotated ? ' Rotated' : ''
        );
    }

    /**
     * Handle the style "created" event.
     *
     * @param  \App\Models\Style $style
     * @return void
     */
    public function saving(Style $style): void
    {
        $style->name = $this->buildName($style);
    }

}
