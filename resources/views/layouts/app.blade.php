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

        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
        
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        @livewireStyles

        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.6.0/dist/alpine.js" defer></script>

        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.6.0/dist/alpine.js" defer></script>

        <style>

          [x-cloak] {
            display: none;
          }

        </style>

<!--         @bukStyles
 -->
    </head>
   
    <body x-data="{ showModal : false } x-cloak" class="font-sans antialiased">
     
    <div class="relative min-h-screen bg-cool-gray-400">

      <!-- Begin Alerts -->

                            <div  x-data="{ alertOpen: true }" class="absolute space-y-2 top-3 left-3 z-10 text-left">
                    
                            <x-alert x-show="alertOpen" id="message" class="bg-green-50 text-green-900 border-l-2 border-green-400 px-2 py-1 shadow-lg"

                            x-transition:enter="opacity-0 transition transform ease-in duration-1000 origin-right scale-y-0"
                            x-transition:enter-start="transition ease-in transform opacity-100 scale-100 duration-1000"
                            x-transition:enter-end="transition ease-in transform opacity-100 scale-100 duration-1000 top-10"
                            
                            x-transition:leave="transition ease-in transform transition duration-300"
                            x-transition:leave-start="opacity-100 transform transition"
                            x-transition:leave-end="opacity-0 transform transition"
                            type="success" @click="alertOpen = false"

                            >
                            <div class="flex items-center">
                            
                            <div class="flex-grow pr-1">
                            {{ $component->message() }}
                            </div>

                            <div class="flex">
<!--                             <x-feathericon-x-circle class="float-right h-4 w-4" />
 -->                        </div></div>
   
                            </x-alert>
                            
                            <x-alert x-show.transition.duration.1000="alertOpen" type="warning" @click="alertOpen = false" class="bg-yellow-400 text-yellow-100 px-2 py-1 z-30" />

                            <x-alert x-show.transition.duration.1000="alertOpen" type="danger" @click="alertOpen = false" class="bg-red-400 text-red-100 px-2 py-1 z-30" />
                      
                            </div>

                        <!-- End Alerts -->
                
       <nav class="bg-cool-gray-100">
                
        <!-- HEADER / TITLE / MESSAGES  -->
        <div class="max-w-5xl mx-auto flex text-gray-600 bg-gray-100 relative">
        
        <div class="flex w-16"></div>
        
        <div class="flex flex-grow justify-center items-center text-4xl font-thin">
          
            <a href="/artifacts" class="outline-none">
            <span class="bg-clip-text text-transparent bg-gradient-to-r from-teal-400 to-blue-500 uppercase pl-1">ARTIFACTS</span>
            </a>

        </div>

        <div class="flex w-16 justify-end items-center bg-red-400 pr-3">

            <x-jet-dropdown align="right" width="48" class="flex align-start">
                     
                     <x-slot name="trigger">
          
                         <button class="flex transition duration-150 ease-in-out">

                            @if ( !empty(Auth::User()->profile_photo_path))

                               <img src="{{ Auth::User()->profile_photo_path }}" class="rounded-full h-10 w-10 border border-cool-gray-200">
                                           
                             @else
                                            
                                <!-- TailwindUI Avatar -->
                                <span class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-cool-gray-200">
                                <span class="text-sm sm:text-md font-medium leading-none text-gray-500">{{ Auth::User()->initials }}
                                </span>
                                </span>
                                
                               @endif

                            </button>
                            
                        </x-slot>
                       
                        <x-slot name="content">
                                
                                    <x-jet-dropdown-link href="/user/profile">
                                    View Profile
                                    </x-jet-dropdown-link>

                                    @role('teacher')
                                    {{-- hidden for teachers--}}
                                    @else
                                    <x-jet-dropdown-link href="{{route('select-class')}}">
                                    Join New Class
                                    </x-jet-dropdown-link>
                                    @endrole

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
        </div>      
        
        
            </nav>
    
    <!-- Begin Menu-->

<!-- New Navigation -->

                            <div class="max-w-5xl mx-auto">
                                
                                <div class="relative max-w-5xl mx-auto flex  pl-2">
                            
                                <div class="flex">
                                    <x-jet-nav-link href="{{route('sections')}}" :active="request()->is('sections*')" tabIndex="-3">
                                    @if (Auth::User()->activeSections->count() != 1) Classes
                                    @else
                                    Class
                                    @endif
                                    </x-jet-nav-link>
                                    <x-jet-nav-link href="{{route('collections', Auth::User())}}" :active="request()->is('collections*')" tabIndex="-2">Collections</x-jet-nav-link>
                                     
                                     <x-jet-nav-link href="{{route('artifacts')}}" :active="request()->is('artifacts*')" tabIndex="-1">Artifacts</x-jet-nav-link>

                                </div>
                                
                            </div>

                            <!-- End New Navigation -->

                            <div class="w-full bg-cool-gray-400">
           
             <main>
                {{ $slot }}
            </main>
            
        @livewireScripts
        
        {{--  close flash message div after 3 seconds --}}
        
            <script type="text/javascript">
            window.setTimeout("hideMessage();", 2000);

            function hideMessage(){
            document.getElementById("message").style.display="none";
            }

            </script>

         {{--  show uploaded file name before submission --}}

            <script type="text/javascript">
            // show selected file when selected for file upload
            document.getElementById('file').onchange = uploadOnChange;

            function uploadOnChange() {
              var filename = this.value;
              var lastIndex = filename.lastIndexOf("\\");
              if (lastIndex >= 0) {
                filename = filename.substring(lastIndex + 1);
              }
              document.getElementById('filename').innerHTML = filename;
              }

             </script>

<!--              @bukScripts
 -->    
    </body>
</html>
