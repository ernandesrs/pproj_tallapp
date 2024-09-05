<?php

namespace App\Livewire\Admin\Traits;
use Livewire\Attributes\Url;

trait Filter
{
    /**
     * Limit of list
     * @var int
     */
    #[Url()]
    public int $quantity = 15;

    /**
     * Search term
     * @var null|string
     */
    #[Url(except: '', nullable: false)]
    public null|string $search = null;

    #[Url(except: '', nullable: false)]
    public array $selects = [];

    #[Url()]
    public array $betweenDates = [];

    abstract static public function filterSelects(): array;

    abstract static public function filterBetweenDates(): array;
}
