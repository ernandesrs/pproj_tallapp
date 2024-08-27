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
     * Mount
     * @return void
     */
    public function mount()
    {
        $this->user = \Auth::user();
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
     * Avatar uplaod
     * @return void
     */
    public function saveAvatar()
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
