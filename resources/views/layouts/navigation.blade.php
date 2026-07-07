<nav x-data="{ open: false }"
    class="sticky top-0 z-50 bg-gradient-to-r from-green-100 via-white to-green-100 backdrop-blur-md shadow-lg border-b border-green-100">

    <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-6">

        <div class="flex items-center justify-between h-20">

            <!-- LOGO -->
            <div class="flex items-center gap-3 shrink-0 hover:scale-105 duration-300 transition">
                <img src="{{ asset('asset/bumi_only.png') }}"
                    class="h-10 w-auto object-contain"
                    alt="Logo">

                <span
                    class="font-bold text-2xl lg:text-3xl bg-gradient-to-r from-green-500 to-blue-500 bg-clip-text text-transparent pb-1">
                    econscious
                </span>
            </div>

            <!-- DESKTOP MENU -->
            <div class="hidden lg:flex flex-1 justify-center">
                <div class="flex items-center gap-5 text-[15px] font-semibold text-green-800">

                    <!-- DASHBOARD -->
                    <a href="{{ route('dashboard') }}"
                        class="relative px-1 py-2 transition duration-300 {{ request()->routeIs('dashboard') ? 'text-green-700' : 'hover:text-green-600' }}">
                        Dashboard
                        <span
                            class="absolute left-0 -bottom-1 h-1 bg-green-600 rounded-full {{ request()->routeIs('dashboard') ? 'w-full' : 'w-0' }}">
                        </span>
                    </a>

                    <!-- USERS -->
                    <a href="{{ route('users.index') }}"
                        class="relative px-1 py-2 transition duration-300 {{ request()->routeIs('users.*') ? 'text-green-700' : 'hover:text-green-600' }}">
                        Users
                        <span
                            class="absolute left-0 -bottom-1 h-1 bg-green-600 rounded-full {{ request()->routeIs('users.*') ? 'w-full' : 'w-0' }}">
                        </span>
                    </a>

                    <!-- PRODUCTS -->
                    <a href="{{ route('products.index') }}"
                        class="relative px-1 py-2 transition duration-300 {{ request()->routeIs('products.*') ? 'text-green-700' : 'hover:text-green-600' }}">
                        Products
                        <span
                            class="absolute left-0 -bottom-1 h-1 bg-green-600 rounded-full {{ request()->routeIs('products.*') ? 'w-full' : 'w-0' }}">
                        </span>
                    </a>

                    <!-- RECIPES -->
                    <a href="{{ route('recipes.index') }}"
                        class="relative px-1 py-2 transition duration-300 {{ request()->routeIs('recipes.*') ? 'text-green-700' : 'hover:text-green-600' }}">
                        Recipes
                        <span
                            class="absolute left-0 -bottom-1 h-1 bg-green-600 rounded-full {{ request()->routeIs('recipes.*') ? 'w-full' : 'w-0' }}">
                        </span>
                    </a>

                    <!-- PURCHASE -->
                    <a href="{{ route('purchases.index') }}"
                        class="relative px-1 py-2 transition duration-300 {{ request()->routeIs('purchases.*') ? 'text-green-700' : 'hover:text-green-600' }}">
                        Purchases
                        <span
                            class="absolute left-0 -bottom-1 h-1 bg-green-600 rounded-full {{ request()->routeIs('purchases.*') ? 'w-full' : 'w-0' }}">
                        </span>
                    </a>

                    <!-- DONATIONS -->
                    <a href="{{ route('donations.index') }}"
                        class="relative px-1 py-2 transition duration-300 {{ request()->routeIs('donations.*') ? 'text-green-700' : 'hover:text-green-600' }}">
                        Donations
                        <span
                            class="absolute left-0 -bottom-1 h-1 bg-green-600 rounded-full {{ request()->routeIs('donations.*') ? 'w-full' : 'w-0' }}">
                        </span>
                    </a>

                    <!-- PRODUCTIONS -->
                    <a href="{{ route('productions.index') }}"
                        class="relative px-1 py-2 transition duration-300 {{ request()->routeIs('productions.*') ? 'text-green-700' : 'hover:text-green-600' }}">
                        Productions
                        <span
                            class="absolute left-0 -bottom-1 h-1 bg-green-600 rounded-full {{ request()->routeIs('productions.*') ? 'w-full' : 'w-0' }}">
                        </span>
                    </a>

                    <!-- SALES -->
                    <a href="{{ route('sales.index') }}"
                        class="relative px-1 py-2 transition duration-300 {{ request()->routeIs('sales.*') ? 'text-green-700' : 'hover:text-green-600' }}">
                        Sales
                        <span
                            class="absolute left-0 -bottom-1 h-1 bg-green-600 rounded-full {{ request()->routeIs('sales.*') ? 'w-full' : 'w-0' }}">
                        </span>
                    </a>

                    <!-- STOCK -->
                    <a href="{{ route('stocks.index') }}"
                        class="relative px-1 py-2 transition duration-300 {{ request()->routeIs('stocks.*') ? 'text-green-700' : 'hover:text-green-600' }}">
                        Stocks
                        <span
                            class="absolute left-0 -bottom-1 h-1 bg-green-600 rounded-full {{ request()->routeIs('stocks.*') ? 'w-full' : 'w-0' }}">
                        </span>
                    </a>

                </div>
            </div>

            <!-- DESKTOP USER -->
            <div class="hidden lg:flex items-center gap-3">

                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">

                        <button
                            class="bg-gradient-to-r from-green-400 to-blue-400 text-white font-bold px-4 py-2 rounded-full shadow-md flex items-center gap-2 hover:scale-105 transition">

                            {{ Auth::user()->name }}

                            <svg class="h-4 w-4"
                                fill="currentColor"
                                viewBox="0 0 20 20">

                                <path
                                    d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.51a.75.75 0 01-1.08 0l-4.25-4.51a.75.75 0 01.02-1.06z" />

                            </svg>

                        </button>

                    </x-slot>

                    <x-slot name="content">

                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>

                        <form method="POST"
                            action="{{ route('logout') }}">

                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Logout
                            </x-dropdown-link>

                        </form>

                    </x-slot>

                </x-dropdown>

            </div>

            <!-- MOBILE BUTTON -->
            <div class="lg:hidden">

                <button
                    @click="open=!open"
                    class="p-2 rounded-lg hover:bg-green-100 transition">

                    <svg x-show="!open"
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-7 h-7 text-green-700"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />

                    </svg>

                    <svg x-show="open"
                        x-cloak
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-7 h-7 text-green-700"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />

                    </svg>

                </button>

            </div>

        </div>

    </div>

    <!-- MOBILE MENU -->
    <div
        x-show="open"
        x-transition
        x-cloak
        class="lg:hidden bg-white border-t shadow-lg">

        <div class="px-5 py-4 space-y-2 text-green-800 font-medium">

            <a href="{{ route('dashboard') }}" class="block py-2 hover:text-green-600">Dashboard</a>

            <a href="{{ route('users.index') }}" class="block py-2 hover:text-green-600">Users</a>

            <a href="{{ route('products.index') }}" class="block py-2 hover:text-green-600">Products</a>

            <a href="{{ route('recipes.index') }}" class="block py-2 hover:text-green-600">Recipes</a>

            <a href="{{ route('purchases.index') }}" class="block py-2 hover:text-green-600">Purchases</a>

            <a href="{{ route('donations.index') }}" class="block py-2 hover:text-green-600">Donations</a>

            <a href="{{ route('productions.index') }}" class="block py-2 hover:text-green-600">Productions</a>

            <a href="{{ route('sales.index') }}" class="block py-2 hover:text-green-600">Sales</a>

            <a href="{{ route('stocks.index') }}" class="block py-2 hover:text-green-600">Stocks</a>

            <hr class="my-3">

            <div class="text-sm text-gray-500">
                Login sebagai
            </div>

            <div class="font-bold text-green-700">
                {{ Auth::user()->name }}
            </div>

            <a href="{{ route('profile.edit') }}"
                class="block py-2 hover:text-green-600">
                Profile
            </a>

            <form method="POST"
                action="{{ route('logout') }}">

                @csrf

                <button
                    type="submit"
                    class="w-full text-left py-2 text-red-600 hover:text-red-700">

                    Logout

                </button>

            </form>

        </div>

    </div>

</nav>