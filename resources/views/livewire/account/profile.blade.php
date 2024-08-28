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

            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 sm:col-span-6">
                    <x-input wire:model='data.first_name' label="Nome *" />
                </div>

                <div class="col-span-12 sm:col-span-6">
                    <x-input wire:model='data.last_name' label="Sobrenome *" />
                </div>

                <div class="col-span-12 sm:col-span-6">
                    <x-input wire:model='data.username' label="Usuário *" />
                </div>

                <div class="col-span-12 sm:col-span-6">
                    <x-select.styled
                        wire:model='data.gender'
                        :options="[
                            ['label' => 'Não definir', 'value' => 'n'],
                            ['label' => 'Feminino', 'value' => 'f'],
                            ['label' => 'Masculino', 'value' => 'm'],
                        ]" select="label:label|value:value" label="Gênero *"
                        placeholder='Selecione' />
                </div>

                <div class="col-span-12 sm:col-span-6">
                    <x-password wire:model='data.password' label="Senha" />
                </div>

                <div class="col-span-12 sm:col-span-6">
                    <x-password wire:model='data.password_confirmation' label="Confirmar senha" />
                </div>

                <div class="col-span-12 flex justify-center">
                    <x-button wire:click="updateProfile" text="Atualizar" icon="check" loading />
                </div>
            </div>
        </x-admin.content-card>
    </div>

</x-admin.page>
