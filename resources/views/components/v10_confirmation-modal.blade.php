@props(['name','height'])

{{-- Alpine Layer --}}

        <div x-data="{ show: false }" 
        x-show="show"
        class=""
        @hashchange.window="
        show = (location.hash === '#{{ $name }}');
        "
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">

        {{-- Overlay --}}

        <a href=""><div class="fixed inset-0 bg-gray-900 opacity-75 z-10"></div></a>
        
        {{-- Modal --}}
        
        <div class="bg-white py-2 shadow-md max-w-sm {{ $height }} m-auto rounded-lg fixed inset-0 z-20">
        
            <div class="flex flex-col h-full justify-between">
        
                <header>
                    <h3 class="font-semibold text-center pb-2">
                        {{ $title }}
                    </h3>

                </header>

                <main class="flex flex-grow justify-center items-center bg-gray-100 shadow-inner">
                        {{ $body }}
                </main>

                <footer class="space-x-1 pt-2 text-center">
                        {{ $footer }}
                </footer>   
            
            </div>

        </div>

     {{-- End Alpine Layer --}}

    </div>


 