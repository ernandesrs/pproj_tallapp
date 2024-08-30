<?php

namespace App\Livewire\Admin\Traits;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Livewire\WithPagination;

trait ListTrait
{
    use WithPagination;

    /**
     * Limit of list
     * @var int
     */
    public int $quantity = 15;

    /**
     * Search term
     * @var null|string
     */
    public null|string $search = null;

    /**
     * Model
     * @return \Illuminate\Database\Eloquent\Model
     */
    abstract static function model(): Model;

    /**
     * Searchable fields
     * @return null|string all searchable fields(full text index required), separated with ','.
     */
    abstract static function searchables(): null|string;

    /**
     * Get items
     * @return mixed
     */
    function getItems()
    {
        $model = self::model()->query();

        if (self::searchables()) {
            $model = $model->when($this->search, function (Builder $query) {
                return $query->whereRaw('MATCH(' . self::searchables() . ') AGAINST(? IN BOOLEAN MODE)', $this->search);
            });
        }

        return $model
            ->paginate($this->quantity)
            ->withQueryString();
    }
}
