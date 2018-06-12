<?php

namespace App\Models\Social;

trait Subscriptable
{
    abstract public function subscribe();
    abstract public function unsubscribe();
}
