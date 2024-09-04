<?php

namespace App\Livewire\Admin\Traits;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use League\CommonMark\Node\Inline\AbstractInline;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

trait ListTrait
{
    use WithPagination;

    /**
     * Simple list: using table and system filter from TallstackUI
     * @var bool
     */
    public bool $simpleList = false;

    /**
     * Limit of list
     * @var int
     */
    #[Url(as: 'qtd', nullable: false)]
    public int $quantity = 15;

    /**
     * Search term
     * @var null|string
     */
    #[Url(as: 's', nullable: false)]
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
