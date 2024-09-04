<?php

namespace App\Livewire\Admin\Traits;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Livewire\WithPagination;

trait ListTrait
{
    use WithPagination, Filter;

    /**
     * Simple list: using table and system filter from TallstackUI
     * @var bool
     */
    public bool $simpleList = false;

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
     * Delete item
     * @param int $id
     * @return void
     */
    abstract public function deleteItem(int $id): void;

    /**
     * Get items
     * @return mixed
     */
    function getItems()
    {
        $model = self::model()->query();

        if (count($this->selects)) {
            foreach ($this->selects as $key => $select) {
                if (!empty($select)) {
                    $model = $model->where($key, $select);
                }
            }
        }

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
