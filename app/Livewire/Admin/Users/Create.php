<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use App\Services\UserService;
use App\Traits\Pages\PageTrait;
use Livewire\Attributes\Validate;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Create extends Component
{
    use PageTrait, Interactions;

    #[Validate('boolean')]
    public bool $send_confirmation_email = false;

    public string $first_name = '';

    public string $last_name = '';

    public string $username = '';

    public string $email = '';

    public string $gender = '';

    public ?string $password = null;

    public ?string $password_confirmation = null;

    /**
     * Page
     * @param mixed $model
     * @return \App\Builders\Page\Page
     */
    static function page(mixed $model = null): \App\Builders\Page\Page
    {
        return new \App\Builders\Page\Page(
            'Novo usuário',
            \App\Builders\Page\Breadcrumb
                ::make('admin.overview')
                ->add('Usuários', ['name' => 'admin.users.index'])
                ->add('Criar', ['name' => 'admin.users.create'])
        );
    }

    /**
     * Mount
     * @return void
     */
    public function mount()
    {
        //
    }

    /**
     * Render
     * @return mixed
     */
    public function render()
    {
        $this->authorize('create', User::class);

        return view('livewire..admin.users.create')
            ->layout('components.layouts.admin', [
                'page' => self::page()
            ]);
    }

    /**
     * Save user
     * @return void
     */
    public function save()
    {
        $this->authorize('create', User::class);

        $created = UserService::create(
            $this->validate(UserService::rules()::creationRules()),
            [
                'send_verification_link' => $this->send_confirmation_email
            ]
        );

        if (!$created) {
            $this->toast()
                ->error('Usuário não criado!', 'Houve um erro inesperado ao registrar usuário.')
                ->send();
            return;
        }

        $this->toast()
            ->success('Registrado!', 'Um novo usuário foi registrado com sucesso.')
            ->flash()
            ->send();

        return $this->redirect(route('admin.users.edit', ['user' => $created->id]));
    }
}
