@props(['name','height'])

{{-- Alpine Layer --}}

   <div x-data="{ show: false }" 
        x-show="show"
        class=""
        @hashchange.window="
        show = (location.hash === '#{{ $name }}');
        ">

        {{-- Overlay --}}

       <a href="#">
       <div class="fixed inset-0 bg-white opacity-100 z-20"></div>
       </a>        
        
        {{-- Modal --}}
        
        <div class="w-full h-full fixed inset-0 flex items-center z-30"
        x-show="show"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-0"
        x-transition:leave-end="opacity-100">   

        <div class="flex w-auto h-full items-center">{{ $arrowleft }}</div>

        <div class="relative py-4 w-full h-full flex justify-center max-w-full max-h-full object-scale-down">
        <div class=""></div>
    
        {{ $body }}
        </div>

        <div class="flex w-auto h-full items-center">{{ $arrowright }}</div>

        <div class="fixed top-0 right-0">{{ $exit }}</div>
        
        
     {{-- End Alpine Layer --}}

    </div>

</div>







  