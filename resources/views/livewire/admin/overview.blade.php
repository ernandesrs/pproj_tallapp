<div class="flex-1 grid grid-cols-12 gap-5">
    <div class="col-span-12 sm:col-span-6 lg:col-span-4">
        <x-card>
            <x-slot:header>
                TallStackUi
            </x-slot:header>
            TallStackUi
            <x-slot:footer>
                TallStackUi
            </x-slot:footer>
        </x-card>
    </div>

    <div class="col-span-12 sm:col-span-6 lg:col-span-4">
        <x-card>
            <x-slot:header>
                TallStackUi
            </x-slot:header>
            <div
                x-on:aside_mini_on.window="miniOn=true"
                x-on:aside_mini_off.window="miniOn=false"
                x-on:aside_visible.window="sidebarVisible=true"
                x-on:aside_invisible.window="sidebarVisible=false"
                x-on:mobile_on.window="mobileOn=true"
                x-on:mobile_off.window="mobileOn=false"

                x-data="{ mobileOn: false, miniOn: false, sidebarVisible: false }"

                class="text-zinc-300 flex flex-col">
                <span x-show="miniOn">MINI ON</span>
                <span x-show="!miniOn">MINI OFF</span>
                <span x-show="sidebarVisible">Sidebar visible</span>
                <span x-show="!sidebarVisible">Sidebar invisible</span>
                <span x-show="mobileOn">Mobile On</span>
                <span x-show="!mobileOn">Mobile Off</span>
            </div>
            <x-slot:footer>
                TallStackUi
            </x-slot:footer>
        </x-card>
    </div>

    <div class="col-span-12 sm:col-span-12 lg:col-span-4">
        <x-card>
            <x-slot:header>
                TallStackUi
            </x-slot:header>
            TallStackUi
            <x-slot:footer>
                TallStackUi
            </x-slot:footer>
        </x-card>
    </div>
</div>
