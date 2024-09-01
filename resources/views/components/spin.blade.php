@props([
    'verificationText' => 'Verificando',
    'intervalInMs' => 250,
])

<div
    x-data="{
        interval: {{ $intervalInMs }},
        dots: '',
        init() {
            setInterval(() => {
                if (this.dots.length >= 3) {
                    this.dots = ''
                } else {
                    this.dots += '.'
                }
            }, this.interval)
        },
    }"
    class="flex flex-col justify-center items-center">
    <div class="w-10 h-10 border-4 border-zinc-200 border-t-indigo-600 rounded-full animate-spin"></div>
    <div class="animate-pulse mt-2">
        {{ $verificationText }} <span x-text="dots"></span>
    </div>
</div>
