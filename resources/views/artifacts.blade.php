<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl text-gray-100 leading-tight">
            Artifacts
        </h2>
    </x-slot>

    <div class="pt-4 px-3">
        
        <div class="flex max-w-5xl mx-auto pt-3 pl-4 bg-gray-100 rounded-t-lg text-left py-1 border-b">

            <div class="flex flex-grow items-center pb-1 font-semibold text-gray-500">
            
            Your Artifacts {{-- <span class="pl-3">{{ $artifacts->links() }}
            --}}

            </span></div>

            <div class="flex pr-3">
                
                 <x-jet-dropdown align="right" width="48">
                          <x-slot name="trigger">
                          
                          <button class="flex transition duration-150 ease-in-out" tabIndex="-2">
                          <x-feathericon-menu class="w-5 h-5 hover:text-red-500 text-gray-400"/>
                          </button>
                         
                          </x-slot>
                          <x-slot name="content">
                              
                              <x-jet-dropdown-link 
                              href="{{action('App\Http\Controllers\ArtifactController@create')}}" class="opacity-100 hover:opacity-75" tabIndex="-1">
                              Create New Artifact
                              </x-jet-dropdown-link>

                          </x-slot>
                    </x-jet-dropdown>
        </div>
        </div>


<div class="max-w-5xl mx-auto bg-gray-400 pb-3">

    <!-- <div class="grid px-3 mx-0 pt-2 pb-3 grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 bg-cool-gray-500 rounded-b-lg">  
 -->
    <div class="flex flex-wrap p-3 bg-white rounded-b-md">  
    
    <!-- Check for Artifacts -->
    @if ($artifacts->count() > 0)

        <!-- Show Users Collections -->
        @foreach ($artifacts as $artifact) 

        <!-- PASTE -->

        <!-- <div id="ArtifactCard" class="rounded bg-gray-100 shadow-lg px-2 pt-4 pb-1 bg-gradient-to-b from-gray-100 via-gray-100 to-gray-300">
         -->

        <div id="ArtifactCard" class="p-2 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/5">
        
           <!-- Begiin Artifact Image --> 

                <a class="" href="{{route('show-artifact', $artifact->id)}}">
                  <img  class="object-cover h-48 w-full opacity-100 hover:opacity-75 rounded-lg" src="https://s3.amazonaws.com/artifacts-0.3/{{$artifact->artifact_path}}">
                </a>
                          
           <!-- Begin Artifact Footer -->
                <div class="flex relative rounded-t-lg items-center text-xs text-gray-500 pt-1">

                <!-- Time -->
                      <div class="flex-grow">
                      {{$artifact->created_at->diffForHumans()}}</div>
                <!-- Comments -->
                      <div class="flex">
                      @if ($artifact->comments->count() > 0)
                      <a class="" href="{{route('show-artifact', $artifact->id)}}">
                      <x-feathericon-message-square class="w-3 h-3 mr-1" />
                      </a>
                      @endif
                      
          </div>

                </div>
                
                <!--  Artifact Menu Trigger -->
                      <div class="pt-1 pr-1 flex">
                                
                                <!-- <x-jet-dropdown align="right" width="48" class="">
                                <x-slot name="trigger">
                                    <button class="flex transition duration-150 ease-in-out" tabIndex="-2">
                                    <x-feathericon-more-horizontal class="w-5 h-5 hover:text-red-500 text-gray-400"/>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-jet-dropdown-link href="">
                                    Edit Artifact
                                    </x-jet-dropdown-link>
                                    <x-jet-dropdown-link href="">
                                    Delete Artifact
                                    </x-jet-dropdown-link>
                                    
                                </x-slot>
                                </x-jet-dropdown> -->
                      
                      </div>
                </div>        
<!--         </div>
 -->


                      @endforeach

                    @else                    
          @endif
        
  </div>

 
    </div>
</x-app-layout>
