{{--

    Description: aside wrapper.

    Dispatch events:
    - aside_mini_on
    - aside_mini_off
    - aside_visible
    - aside_invisible

    Wait for events:
    - toggle_aside
    - mobile_on
    - mobile_off

--}}

@props([
    'mini' => false,
])

<div
    x-on:toggle_aside.window="toggleAside"
    x-on:mobile_on.window="mobileModeOn"
    x-on:mobile_off.window="mobileModeOff"

    x-transition:enter="duration-300 ease-in-out"
    x-transition:enter-start="-translate-x-full"
    x-transition:enter-end="-translate-x-0"

    x-transition:leave="duration-100 ease-in"
    x-transition:leave-start="-translate-x-0"
    x-transition:leave-end="-translate-x-full"

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

    class="flex flex-col w-full h-screen max-w-[88vw] fixed left-0 top-0 z-40 overflow-y-auto lg:relative duration-200 ease-linear overflow-clip"
    :class="{
        'sm:max-w-[300px]': !state.miniMode,
        'sm:max-w-[100px]': state.miniMode,
    }">
    {{ $slot }}
</div>
