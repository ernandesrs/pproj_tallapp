<div

    x-on:resize.window="windowResize"

    x-data="{
        DESKTOP_MIN_WIDTH: 1024, // Tailwind CSS Breakpoint

        inMobile: true,
        windowWidth: window.innerWidth,

        init() {
            $nextTick(() => {
                this.inMobileCheck()

                if (this.inMobile) {
                    this.mobileOn()
                } else {
                    this.mobileOff()
                }
            })
        },

        inMobileCheck() {
            if (this.windowWidth < this.DESKTOP_MIN_WIDTH && !this.inMobile) {
                this.mobileOn()
            } else if (this.windowWidth >= this.DESKTOP_MIN_WIDTH && this.inMobile) {
                this.mobileOff()
            }
        },

        mobileOn() {
            this.inMobile = true
            $dispatch('mobile_on')
        },

        mobileOff() {
            this.inMobile = false
            $dispatch('mobile_off')
        },

        windowResize() {
            this.windowWidth = window.innerWidth

            this.inMobileCheck()
        }
    }"

    class="flex w-full min-h-screen overflow-x-hidden">
    {{ $slot }}
</div>
