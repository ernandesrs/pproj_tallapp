<?php

namespace App\Traits\Pages;
use App\Builders\Page\Page;

trait PageTrait
{
    /**
     * Page
     * @param mixed $model
     * @return \App\Builders\Page\Page
     */
    abstract static function page(mixed $model = null): Page;
}
