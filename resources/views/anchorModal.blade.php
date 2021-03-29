<x-app-layout>

{{-- Basic Page --}}

    <div class="max-w-xl mx-auto bg-gray-300">
    <header class="bg-yellow-200 p-2">header</header>
    
    <main>
    <ul class="p-2">
    <li><a class="text-blue-400 underline hover:text-blue-500" href="#image1">Image 1</a></li>
    <li><a class="text-blue-400 underline hover:text-blue-500" href="#image2">Image 2</a></li>
    <li><a class="text-blue-400 underline hover:text-blue-500" href="#image3">Image 3</a></li>
    </ul>

    </main>

    <footer class="bg-yellow-200 p-2">footer</footer>
    </div>

  <x-v10_confirmation-modal name="image1">
        
        <x-slot name="title">
        Image 1
        </x-slot>

        <x-slot name="body">
            The first image
        </x-slot>
        
        <x-slot name="footer">
            <a href="#image2" class="text-xs uppercase py-2 px-4 rounded-md text-white hover:bg-gray-500 transition-all duration-200 bg-gray-400 hover:bg-gray-500">Next
            </a>
            <!-- <x-v10_button class="bg-blue-400 hover:bg-blue-500">Continue</x-button> -->
        </x-slot>
         
    </x-v10_confirmation-modal>

    <x-v10_confirmation-modal name="image2">
        
        <x-slot name="title">
        Image 2        
        </x-slot>

        <x-slot name="body">
            The second image
        </x-slot>
        
        <x-slot name="footer">
            <a href="#image1" class="text-xs uppercase py-2 px-4 rounded-md text-white hover:bg-gray-500 transition-all duration-200 bg-gray-400 hover:bg-gray-500">Back
            </a>
             <a href="#image3" class="text-xs uppercase py-2 px-4 rounded-md text-white hover:bg-gray-500 transition-all duration-200 bg-gray-400 hover:bg-gray-500">Next
            </a>
<!--             <x-v10_button class="bg-blue-400 hover:bg-blue-500">Continue</x-button>
 -->        </x-slot>
         
    </x-v10_confirmation-modal>

       <x-v10_confirmation-modal name="image3">
        
        <x-slot name="title">
        Image 3        
        </x-slot>

        <x-slot name="body">
            The third image
        </x-slot>
        
        <x-slot name="footer">
            <a href="#image2" class="text-xs uppercase py-2 px-4 rounded-md text-white hover:bg-gray-500 transition-all duration-200 bg-gray-400 hover:bg-gray-500">Back
            </a>
           <!--  <x-v10_button class="bg-blue-400 hover:bg-blue-500">Continue</x-button> -->
        </x-slot>
         
    </x-v10_confirmation-modal>

</x-app-layout>
