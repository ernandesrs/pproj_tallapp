<?php

namespace App\Livewire\Admin\Roles;

use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;
use TallStackUi\Traits\Interactions;

class Index extends Component
{
    use WithPagination, Interactions;

    public ?int $quantity = 15;

    public ?string $search = null;

    public ?int $page = 1;

    /**
     * Render view
     * @return mixed
     */
    public function render()
    {
        return view('livewire..admin.roles.index', [
            'headers' => [
                ['index' => 'id', 'label' => 'ID'],
                ['index' => 'name', 'label' => 'Nome'],
                ['index' => 'guard_name', 'label' => 'Guard'],
                ['index' => 'created_at', 'label' => 'Criado em'],
                ['index' => 'action', 'label' => 'Ações'],
            ],
            'rows' => Role::query()->when($this->search, function (Builder $query) {
                return $query->whereRaw('MATCH(name) AGAINST(? IN BOOLEAN MODE)', $this->search);
            })->offset($this->page)->paginate($this->quantity)
                ->withQueryString(),
        ])
            ->layout('components.layouts.admin', [
                'seo' => (object) [
                    'title' => 'Cargos'
                ]
            ]);
    }
}
