@props([
    'mini' => false,
])

<div
    x-on:toggle_aside.window="toggleAside"
    x-on:mobile_on.window="mobileModeOn"
    x-on:mobile_off.window="mobileModeOff"

    x-data="{
        mini: {{ $mini ? 1 : 0 }},
        inMobile: true,
        state: {
            visible: false,
            miniMode: false,
        },

        init() {
            $nextTick(() => {
                //
            })
        },

        mobileModeOn() {
            this.inMobile = true
            this.asideInvisible()
        },

        mobileModeOff() {
            this.inMobile = false
            this.asideVisible()
        },

        toggleAside() {
            if (!this.inMobile && this.mini) {
                this.toggleMiniMode()
            } else {
                this.toggleSidebarVisibility()
            }
        },

        toggleMiniMode() {
            this.asideVisible()

            if (this.state.miniMode) {
                this.miniModeOff();
            } else {
                this.miniModeOn();
            }
        },

        miniModeOn() {
            this.state.miniMode = true
            $dispatch('aside_mini_on')
        },

        miniModeOff() {
            this.state.miniMode = false
            $dispatch('aside_mini_off')
        },

        toggleSidebarVisibility() {
            this.miniModeOff();

            if (this.state.visible) {
                this.asideInvisible()
            } else {
                this.asideVisible()
            }
        },

        asideVisible() {
            this.state.visible = true
            $dispatch('aside_visible')
        },

        asideInvisible() {
            this.state.visible = false
            $dispatch('aside_invisible')
        }
    }"

    x-show="state.visible"

    class="flex flex-col w-full h-screen max-w-[88vw] fixed left-0 top-0 z-40 overflow-y-auto lg:relative"
    :class="{
        'sm:max-w-[300px]': !state.miniMode,
        'sm:max-w-[100px]': state.miniMode,
    }">
    {{ $slot }}
</div>
