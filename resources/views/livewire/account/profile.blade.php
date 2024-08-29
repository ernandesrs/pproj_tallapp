<x-admin.page
    title="Meu perfil">

    <div class="col-span-12 md:col-span-4 grid gap-6">
        <x-admin.content-card
            icon="user-circle"
            title="Seu avatar"
            class="col-span-12">
            <div class="flex flex-col gap-y-3">
                <div class="flex-1 flex items-center gap-5">
                    @if (!empty($user->avatar))
                        <x-avatar
                            :image="\Str::startsWith($user->avatar, ['http://', 'https://'])
                                ? $user->avatar
                                : \Storage::url($user->avatar)" lg />
                    @else
                        <x-avatar text="{{ $user->username[0] }}" lg />
                    @endif

                    <div class="flex-1">
                        <x-upload wire:model="avatar" delete delete-method="deleteAvatar"
                            accept="image/*" placeholder="Novo avatar" tip="Arraste e solte sua foto aqui">
                            <x-slot:footer when-uploaded>
                                <div class="w-full flex justify-center">
                                    <x-button wire:target="updateAvatar" wire:click='updateAvatar' text="Atualizar" />
                                </div>
                            </x-slot:footer>
                        </x-upload>
                    </div>
                </div>
            </div>
        </x-admin.content-card>

        <x-admin.content-card
            icon="list-letters"
            title="Detalhes"
            class="col-span-12">
            Some account details
        </x-admin.content-card>

        @if (!\Auth::user()->hasRole(\App\Enums\Roles\RoleEnum::SUPER))
            {{-- Super users cannot delete their accounts --}}
            <x-admin.content-card
                class="col-span-12">
                <div class="text-red-600 flex flex-col gap-3">
                    <h4 class="font-semibold">
                        Exclusão de conta.
                    </h4>
                    <div>
                        <x-button wire:click="deleteAccount" icon="exclamation-mark" localtion="left"
                            text="Quero excluir minha conta" color="rose" outline sm />
                    </div>
                </div>
            </x-admin.content-card>
        @endif
    </div>

    <div class="col-span-12 md:col-span-8 grid gap-6">
        <x-admin.content-card
            icon="id"
            title="Dados de perfil"
            class="col-span-12">

            <div class="grid grid-cols-12 gap-6">
                @include('livewire.admin.users.partials.basic-data-fields', ['edit' => true])

                <div class="col-span-12 flex justify-center">
                    <x-button wire:target="updateProfile" wire:click="updateProfile" text="Atualizar" icon="user-check"
                        loading />
                </div>
            </div>
        </x-admin.content-card>
    </div>

</x-admin.page>
