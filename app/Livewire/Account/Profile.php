<?php

namespace App\Livewire\Account;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Http\UploadedFile;

class Profile extends Component
{
    use WithFileUploads;

    /**
     * Auth user instance
     * @var \App\Models\User
     */
    public \App\Models\User $user;

    /**
     * Avatar
     * @var null|\Livewire\Features\SupportFileUploads\TemporaryUploadedFile
     */
    public null|\Livewire\Features\SupportFileUploads\TemporaryUploadedFile $avatar = null;

    /**
     * Profile data
     * @var array
     */
    public array $data = [];

    /**
     * Mount
     * @return void
     */
    public function mount()
    {
        $this->user = \Auth::user();
        $this->data = $this->user->toArray();
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
        $validated = $this->validate([
            'data.first_name' => ['required', 'string', 'max:25'],
            'data.last_name' => ['required', 'string', 'max:50'],
            'data.username' => ['required', 'string', 'max:25', 'unique:users,username,' . $this->user->id],
            'data.gender' => ['required', 'string', \Illuminate\Validation\Rule::in(['n', 'f', 'm'])],
            'data.password' => ['nullable', 'string', 'confirmed'],
        ]);

        $this->user->update($validated['data']);
    }

    /**
     * Avatar uplaod
     * @return void
     */
    public function updateAvatar()
    {
        $validated = $this->validate([
            'avatar' => ['required', 'mimes:png,jpg,jpeg', 'max:1024']
        ]);

        $avatar = $validated['avatar'];
        $path = $avatar->store('avatars', ['disk' => 'public']);
        if ($path) {
            $this->user->avatar = $path;
            $this->user->save();
        }
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
