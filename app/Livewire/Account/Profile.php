<?php

namespace App\Livewire\Account;

use App\Services\UserService;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Http\UploadedFile;
use TallStackUi\Traits\Interactions;

class Profile extends Component
{
    use WithFileUploads, Interactions;

    /**
     * Auth user instance
     * @var \App\Models\User
     */
    #[Locked]
    public \App\Models\User $user;

    /**
     * Avatar
     * @var null|\Livewire\Features\SupportFileUploads\TemporaryUploadedFile
     */
    public null|\Livewire\Features\SupportFileUploads\TemporaryUploadedFile $avatar = null;

    public string $first_name = '';

    public string $last_name = '';

    public string $username = '';

    public string $email = '';

    public string $gender = '';

    public ?string $password = null;

    public ?string $password_confirmation = null;

    /**
     * Mount
     * @return void
     */
    public function mount()
    {
        $this->user = \Auth::user();
        $this->fill($this->user->only([
            'first_name',
            'last_name',
            'username',
            'email',
            'gender'
        ]));
    }

    /**
     * Render view
     * @return mixed
     */
    public function render()
    {
        return view('livewire..account.profile')
            ->layout('components.layouts.admin', [
                'seo' => (object) [
                    'title' => 'Meu perfil'
                ]
            ]);
    }

    /**
     * Update profile data
     * @return void
     */
    public function updateProfile()
    {
        UserService::update($this->validate(UserService::rules()::updateRules($this->user)), $this->user, []);

        $this->toast()
            ->success('Atualizado!', 'Dados de perfil atualizados com sucesso!')
            ->send();
    }

    /**
     * Delete account: show dialog confirmation
     * @return void
     */
    public function deleteAccount()
    {
        $this->dialog()
            ->warning('Quer realmente excluir sua conta?')
            ->confirm('Sim, quero', 'deletionConfirmed')
            ->cancel('Cancelar')
            ->send();
    }

    /**
     * Finalyy delete user account
     * @return void
     */
    public function deletionConfirmed()
    {
        if (!UserService::delete($this->user)) {
            $this->toast()->error('Houve um erro ao tentar excluir conta!')->send();
            return;
        }

        $this->dialog()
            ->warning('Inativada!', 'Sua conta foi inativada, você tem X dias para tentar recuperá-la, após isso ela será permanentemente excluída.')
            ->hook([
                'ok' => [
                    'method' => 'deletionConfirmedRedirect',
                    'params' => []
                ]
            ])
            ->send();
    }

    /**
     * Redirect user after account deletion
     * @return void
     */
    public function deletionConfirmedRedirect()
    {
        return $this->redirect(route('front.home'));
    }

    /**
     * Avatar uplaod
     * @return void
     */
    public function updateAvatar()
    {
        UserService::updateAvatar($this->validate(UserService::rules()::avatarUpdateRules()), $this->user);

        $this->toast()
            ->success('Atualizada!', 'Sua foto foi atualizada com sucesso!')
            ->send();
    }

    /**
     * Delete temporary uploaded avatar
     * @param array $content
     * @return void
     */
    public function deleteAvatar(array $content)
    {
        /* the $content contains:
            [
                'temporary_name',
                'real_name',
                'extension',
                'size',
                'path',
                'url',
            ]
        */

        if (!$this->avatar) {
            return;
        }

        $files = \Illuminate\Support\Arr::wrap($this->avatar);

        /** @var UploadedFile $file */
        $file = collect($files)->filter(fn(UploadedFile $item) => $item->getFilename() === $content['temporary_name'])->first();

        // 1. Here we delete the file. Even if we have a error here, we simply
        // ignore it because as long as the file is not persisted, it is
        // temporary and will be deleted at some point if there is a failure here.
        rescue(fn() => $file->delete(), report: false);

        $collect = collect($files)->filter(fn(UploadedFile $item) => $item->getFilename() !== $content['temporary_name']);

        // 2. We guarantee restore of remaining files regardless of upload
        // type, whether you are dealing with multiple or single uploads
        $this->avatar = is_array($this->avatar) ? $collect->toArray() : $collect->first();
    }
}
