<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl text-gray-100 leading-tight">
            Classes
        </h2>
    </x-slot>

    <!-- Class Nav -->
        
        <div class="flex max-w-5xl mx-auto mt-4 px-2 text-sm no-underline items-center items-stretch">

    <!-- Class Pills -->

            <div class="flex-grow py-3 bg-white px-1 text-gray-500 aliased rounded-l-lg space-x-1">
                 
                 @if (Auth::User()->activeSections()->count() > 0)

                    @foreach ( Auth::User()->activeSections as $section)  

                    <a class="p-2 my-1 ml-1 rounded-lg bg-gray-200 hover:bg-gray-300 hover:text-gray-700 text-md" href="{{route('show-section', $section->id )}}">
                         {{ $section->title}}</a>

                    @endforeach

                    @else
                    <p>You are currently have no assigned classes.</p>
                    @endif

            </div>

    <!-- End Class Pills -->

    <!-- Class Options -->

            <div class="flex bg-white rounded-r-lg items-center px-3">
                <x-jet-dropdown align="right" width="48">
                      <x-slot name="trigger">
                      
                      <button class="flex transition duration-150 ease-in-out" tabIndex="-2">
                      <x-feathericon-menu class="w-5 h-5 hover:text-red-500 text-gray-400"/>
                      </button>
                     
                      </x-slot>
                      <x-slot name="content">
                          
                          <x-jet-dropdown-link href="{{route('create-section')}}">
                          Create Class
                          </x-jet-dropdown-link>

                      </x-slot>
                </x-jet-dropdown>
           </div>
        </div>
        
        <!-- Begin Content -->


        </div>
    </div>
</x-app-layout>
