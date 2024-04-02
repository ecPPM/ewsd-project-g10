<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="bg-base-100 border-b border-base-content/10 sticky top-0 left-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="w-full px-6 sm:px-10 lg:px-12 xl:px-16 2xl:px-36">
        <div class="flex justify-between h-20">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('login') }}" wire:navigate>
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-6 sm:-my-px sm:ms-10 sm:flex">
                    @if (auth()->user()->role->name == 'tutor' || auth()->user()->role->name == 'student')
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                            {{ __('Dashboard') }}
                        </x-nav-link>

                        <x-nav-link :href="route('meetings')" :active="request()->routeIs('meetings')" wire:navigate>
                            {{ __('Scheduling') }}
                        </x-nav-link>

                        <x-nav-link :href="route('blog')" :active="request()->routeIs('blog')" wire:navigate>
                            {{ __('Chats') }}
                        </x-nav-link>
                    @endif

                    {{-- ADMIN ROUTES --}}
                    @if (auth()->user()->role->name == 'admin')
                        {{--<x-nav-link :href="route('allocation')" :active="request()->routeIs('allocation')"--}}
                        {{--            wire:navigate>--}}
                        {{--    {{ __('Allocation') }}--}}
                        {{--</x-nav-link>--}}
                        <x-nav-link :href="route('dashboard')"
                                    :active="request()->routeIs('dashboard')"
                                    wire:navigate>
                            {{ __('Dashboard') }}
                        </x-nav-link>

                        <x-nav-link :href="route('students')"
                                    :active="request()->routeIs('students') || request()->routeIs('students-details')"
                                    wire:navigate>
                            {{ __('Students') }}
                        </x-nav-link>

                        <x-nav-link :href="route('tutors')"
                                    :active="request()->routeIs('tutors') || request()->routeIs('tutor-details')"
                                    wire:navigate>
                            {{ __('Tutors') }}
                        </x-nav-link>
                    @endif
                    {{-- ADMIN ROUTES END --}}
                </div>
            </div>

            <div class="flex items-center">
                <!-- User and Logout -->
                <div class="flex items-center gap-2">
                    <p class="uppercase text-gray-600 m-0 p-0 font-semibold">{{auth()->user()->name}}</p>
                    <button title="Logout" class="btn btn-ghost btn-sm" wire:click="logout">
                        <div class="w-3 h-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path
                                    fill="#4b5563"
                                    d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z" />
                            </svg>
                        </div>
                    </button>
                </div>

                <!-- Hamburger -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                                  stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                                  stroke-linecap="round"
                                  stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if (auth()->user()->role->name == 'tutor' || auth()->user()->role->name == 'student')
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                                       wire:navigate>
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('meetings')" :active="request()->routeIs('meetings')"
                                       wire:navigate>
                    {{ __('Scheduling') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('blog')" :active="request()->routeIs('meetings')"
                                       wire:navigate>
                    {{ __('Chats') }}
                </x-responsive-nav-link>
            @endif

            @if (auth()->user()->role->name === 'admin')
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                                       wire:navigate>
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                
                <x-responsive-nav-link :href="route('students')" :active="request()->routeIs('students')"
                                       wire:navigate>
                    {{ __('Students') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('tutors')" :active="request()->routeIs('tutors')"
                                       wire:navigate>
                    {{ __('Tutors') }}
                </x-responsive-nav-link>
            @endif
        </div>
    </div>
</nav>
