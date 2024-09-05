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
        $validData = $this->validateFilters();

        $selects = $validData['selects'] ?? [];
        $periods = $validData['periods'] ?? [];
        $search = $validData['search'] ?? null;
        $quantity = $validData['quantity'] ?? 10;

        $model = self::model()->query();

        // Apply selects filter
        if (count($selects)) {
            $selects = $validData['selects'];

            foreach ($selects as $key => $select) {
                if (!empty($select)) {
                    $model = $model->where($key, $select);
                }
            }
        }

        // Apply perios filters
        if (count($periods)) {
            foreach ($periods as $key => $period) {
                if (!empty($period['start']) && !empty($period['end'])) {
                    $model = $model->orWhereBetween($key, [$period['start'], $period['end']]);
                }
            }
        }

        if (self::searchables()) {
            $model = $model->when($search, function (Builder $query) use ($search) {
                return $query->whereRaw('MATCH(' . self::searchables() . ') AGAINST(? IN BOOLEAN MODE)', $search);
            });
        }

        return $model
            ->paginate($quantity)
            ->withQueryString();
    }
}
