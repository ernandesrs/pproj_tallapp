<div class="border border-zinc-800 p-6">

    <div class="flex-1 flex flex-wrap justify-center items-start gap-5">
        @guest
            <x-front.clickable href="{{ route('auth.login') }}">
                Login
            </x-front.clickable>
            <x-front.clickable href="{{ route('auth.register') }}">
                Register
            </x-front.clickable>
        @else
            <x-front.clickable href="{{ route('admin.overview') }}">
                Administrative
            </x-front.clickable>

            <x-front.clickable>
                Customer
            </x-front.clickable>
            <x-front.clickable href="{{ route('auth.logout') }}">
                Logout
            </x-front.clickable>
        @endguest
    </div>

    <hr class="border-zinc-800 my-5">

    <small>
        {{ config('app.name') }} &copy; {{ date('Y') }} by <a
            class="text-indigo-700 hover:text-indigo-600 duration-300"
            href="https://github.com/ernandesrs"
            title="Github profile" target="_blank">
            Ernandes R Souza
        </a>
    </small>

</div>
