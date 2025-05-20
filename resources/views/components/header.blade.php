<header class="bg-blue-900 p-4 text-white" x-data="{ open: false }">
    <div class="container mx-auto flex items-center justify-between">
        <h1 class="text-3xl font-semibold">
            <a href="{{ url('/') }}">Workopia</a>
        </h1>
        <nav class="hidden items-center space-x-4 md:flex">

            @auth
                <div class="item-center mr-2 flex space-x-3">
                    <a href="{{ route('dashboard') }}">
                        @if (Auth::user()->avatar)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}"
                                class="h-10 w-10 rounded-full">
                        @else
                            <img src="{{ asset('storage/avatars/default-avatar.png') }}" alt="{{ Auth::user()->name }}"
                                class="h-10 w-10 rounded-full">
                        @endif
                    </a>
                </div>
            @endauth

            <x-nav-link url="/" :active="request()->is('/')">Home</x-nav-link>
            <x-nav-link url="/jobs" :active="request()->is('jobs')"> All Jobs </x-nav-link>
            @auth
                <x-nav-link url="/bookmarks" :active="request()->is('bookmarks')">Saved Jobs</x-nav-link>
                <x-logout-button />

                <x-button-link url="/jobs/create" icon="edit">
                    Create Job
                </x-button-link>
            @else
                <x-nav-link url="/login" :active="request()->is('login')">Login</x-nav-link>
                <x-nav-link url="/register" :active="request()->is('register')">Register</x-nav-link>
            @endauth
        </nav>
        <button @click="open = !open" id="hamburger" class="flex items-center text-white md:hidden">
            <i class="fa fa-bars text-2xl"></i>
        </button>
    </div>
    <!-- Mobile Menu -->
    <nav x-show="open" @click.away="open = false" id="mobile-menu"
        class="mt-5 space-y-2 bg-blue-900 pb-4 text-white md:hidden">
        <x-nav-link url="/jobs" :active="request()->is('jobs')" :mobile="true"> All Jobs </x-nav-link>
        @auth
            <x-nav-link url="/bookmarks" :active="request()->is('bookmarks')" :mobile="true">Saved Jobs</x-nav-link>
            <x-nav-link url="/dashboard" :active="request()->is('dashboard')" icon="gauge" :mobile="true">Dashboard</x-nav-link>
            <x-logout-button />
            <div class="pt-2"></div>
            <x-button-link url="/jobs/create" icon="edit" :block="true">
                Create Job
            </x-button-link>
        @else
            <x-nav-link url="/login" :active="request()->is('login')" :mobile="true">Login</x-nav-link>
            <x-nav-link url="/register" :active="request()->is('register')" :mobile="true">Register</x-nav-link>
        @endauth
    </nav>

</header>
