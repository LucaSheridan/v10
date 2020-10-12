

<!DOCTYPE html>


<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css2?family=Homemade+Apple&display=swap" rel="stylesheet">

<!--         <link href="https://unpkg.com/tailwindcss@^1.7/dist/tailwind.min.css" rel="stylesheet">
 -->

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        @livewireStyles

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.6.0/dist/alpine.js" defer></script>
    </head>
   
    <body class="font-sans antialiased">

        <!-- Background -->
        <div class="min-h-screen bg-cool-gray-400">
        
        <nav x-data="{ open: false }" class="bg-cool-gray-200 border-b-0 border-red-500">
                
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-3 py-1">
                    <div class="flex justify-between h-16">
                            <div class='flex items-center pl-0'>
                                
        
        <a href="{{action('App\Http\Controllers\ArtifactController@create')}}" class="opacity-100 hover:opacity-75" tabIndex="-1">


        <span class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-cool-gray-400">
                                    <span class="inline-flex text-xl leading-none text-white">
                                <x-feathericon-camera/>
                                    
                                    </span>
        </a>


                            </div>

                        <div class="flex ml-1.5">
                            
                            <!-- Logo -->
                            
                            <div class="flex-shrink-0 h-12 flex items-center text-5xl font-thin text-center text-gray-600 bg-opacity-50 border-cool-gray px-3 pt-3 rounded-lg">

                            <a href="/artifacts" class="outline-none" tabIndex="-1">
                                
                            <span class="bg-clip-text text-transparent bg-gradient-to-r from-teal-400 to-blue-500">
                            ARTIFACTS  </span>

                            </a>
                            </div>

                        </div>

                        <!-- Settings Dropdown -->
                        <div class="hidden sm:flex sm:items-center sm:ml-0">
                            
                             <x-jet-dropdown align="right" width="48">
                                <x-slot name="trigger">
                      
                                    <button class="flex transition duration-150 ease-in-out" tabIndex="-2">

                                            <!-- TailwindUI Avatar -->
                                            <span class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-cool-gray-400">
                                            <span class="text-sm font-medium leading-none text-white">{{ Auth::User()->initials }}</span>
                                            </span>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    
                                    <x-jet-dropdown-link href="/user/profile">
                                    View Profile
                                    </x-jet-dropdown-link>
                                    
                                    <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                     <x-jet-dropdown-link href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                         this.closest('form').submit();">
                                    Logout
                                    </x-jet-dropdown-link>
                                    </form>

                                </x-slot>
                            </x-jet-dropdown>

                        </div>



                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
                   
                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="flex items-center px-4">
                            <div class="flex-shrink-0">
                                
                                <!-- JetStream Avatar 
                                <img class="h-10 w-10 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="" /> -->

                                <!-- TailwindUI Avatar -->
                                <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-cool-gray-400">
                                <span class="text-sm font-medium leading-none text-white">{{ Auth::User()->initials }}</span>
                                </span>
                            
                            </div>

                            <div class="ml-3">
                                <div class="font-medium text-base text-gray-800">{{ Auth::user()->fullName }}</div>
                                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                                <!-- <div class="font-medium text-sm text-gray-500">
                                @foreach ( Auth::User()->sites as $site )
                                {{ $site->name }}
                                @endforeach</div> -->
                            </div>
                            
                        </div>

                        <div class="mt-3 space-y-1">
                            <!-- Account Management -->
                            <x-jet-responsive-nav-link href="/user/profile" :active="request()->routeIs('profile.show')">
                                Profile
                            </x-jet-responsive-nav-link>

                           <!--  @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-jet-responsive-nav-link href="/user/api-tokens" :active="request()->routeIs('api-tokens.index')">
                                    API Tokens
                                </x-jet-responsive-nav-link>
                            @endif -->

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                         this.closest('form').submit();">
                                    Logout
                                </x-jet-responsive-nav-link>
                            </form>

                        </div>
                    </div>
                </div>
            </nav>

    
    <!-- Begin Menu-->

<div class="bg-gray-100 w-full">
<div class="max-w-5xl mx-auto pt-2 pb-0 space-x-1 sm:-my-px flex justify-center uppercase bg-gray-100">
    
 <!-- <div class="pt-6 pt-2 pb-1 space-x-1 sm:-my-px flex justify-center uppercase bg-cool-gray-400"> -->
                            
                                

                                <x-jet-nav-link href="{{route('artifacts')}}" :active="request()->is('artifacts*')" tabIndex="-1">
                                    Artifacts
                                </x-jet-nav-link>

                                 <x-jet-nav-link href="{{route('collections', Auth::User())}}" :active="request()->is('collections*')" tabIndex="-2">
                                    Collections
                                </x-jet-nav-link>

                                 <x-jet-nav-link href="{{route('sections')}}" :active="request()->is('sections*')" tabIndex="-3">
                                @if (Auth::User()->activeSections->count() != 1) Classes
                                @else
                                Class
                                @endif
                                </x-jet-nav-link>


                               
                            </div>
                        </div>
           
           <!-- Page Heading -->
           <!--  <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-2 px-4 lg:px-8 bg-cool-gray-400 text-gray-100 uppercase">
                    {{ $header }}
                </div>
            </header> -->

            <!-- Page Content -->

            <main class="bg-cool-gray-400">
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
