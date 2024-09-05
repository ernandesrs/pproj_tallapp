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
    public array $periods = [];

    abstract static public function filterSelects(): array;

    abstract static public function filterPeriods(): array;

    /**
     * Check if is filtring
     * @return bool
     */
    public function isFiltering()
    {
        return count($this->selects) || count($this->periods) ? true : false;
    }

    /**
     * Clear filters
     * @return void
     */
    public function clearFilters()
    {
        $this->selects = [];
        $this->periods = [];
    }
}
