<x-admin.page
    title="Meu perfil">

    <div class="col-span-12 md:col-span-4 grid gap-6">
        <x-admin.content-card
            icon="user-circle"
            title="Seu avatar"
            class="col-span-12">
            <div class="flex flex-col gap-y-3">
                <div class="flex-1 flex gap-5">
                    @if (!empty(\Auth::user()->avatar))
                        <x-avatar
                            :image="\Str::startsWith(\Auth::user()->avatar, ['http://', 'https://'])
                                ? \Auth::user()->avatar
                                : \Storage::url(\Auth::user()->avatar)" lg />
                    @else
                        <x-avatar text="{{ \Auth::user()->username[0] }}" lg />
                    @endif

                    <div class="flex-1">
                        <x-upload wire:model="avatar" label="Novo avatar" delete delete-method="deleteAvatar"
                            accept="image/*" />
                    </div>
                </div>

                @if ($this->avatar)
                    <div class="flex-1 flex justify-center">
                        <x-button wire:click='updateAvatar' text="Atualizar" />
                    </div>
                @endif
            </div>
        </x-admin.content-card>

        <x-admin.content-card
            icon="list-letters"
            title="Detalhes"
            class="col-span-12">
            Some account details
        </x-admin.content-card>
    </div>

    <div class="col-span-12 md:col-span-8 grid gap-6">
        <x-admin.content-card
            icon="id"
            title="Profile data"
            class="col-span-12">
            <p>
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Excepturi rerum laborum saepe cum consequuntur
                eligendi accusamus perferendis explicabo commodi non quibusdam maiores, nobis, mollitia expedita ipsa
                dolorem ut dolores quae?
            </p>
        </x-admin.content-card>
    </div>

</x-admin.page>
