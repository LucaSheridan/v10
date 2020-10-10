<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl text-gray-100 leading-tight">
            Collections
        </h2>
    </x-slot>

    <div class="pt-4 px-3">
        
        <div class="flex max-w-5xl mx-auto pt-2 pl-4 bg-gray-100 rounded-t-lg text-left py-1 border-b">

            <div class="flex flex-grow items-center font-normal text-5xl text-red-400 capitlize">
            
            {{$collection->title}}

            </div> 

            <div class="flex pr-3 mt-1">
                
                 <x-jet-dropdown align="right" width="48">
                          <x-slot name="trigger">
                          
                          <button class="flex transition duration-150 ease-in-out" tabIndex="-2">
                          <x-feathericon-menu class="w-5 h-5 hover:text-red-500 text-gray-400"/>
                          </button>
                         
                          </x-slot>
                          <x-slot name="content">
                              
                              <x-jet-dropdown-link 
                              href="{{route('edit-collection', $collection)}}" class="opacity-100 hover:opacity-75" tabIndex="-1">
                              Edit Collection
                              </x-jet-dropdown-link>

                              <form id="delete_collection" method="POST" action="{{ route('delete-collection', $collection) }}">
                              {{ csrf_field() }}
                              <input type="hidden" name="_method" value="DELETE">
                              <x-jet-dropdown-link>
                              <button type="submit" onclick="return confirm('Are you sure you want to delete this?')">Delete Collection
                              </x-jet-dropdown-link>
                              </form>

                          </x-slot>
                    </x-jet-dropdown>
        </div>
        </div>

  <div class="max-w-5xl mx-auto grid mx-4 p-4 grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 bg-white">  


        <!-- Show  Artifacts -->
        
        @foreach ($collection->artifacts as $artifact) 

              <!-- Artifact Card -->
              <div id="ArtifactCard" x-data="{open: false}" class="rounded-lg w-full">
        
              <!-- Begin Artifact Header -->
                <div class="flex relative">

                <!-- Artifact ID -->
                    <div class="py-2 pl-1 text-xs text-gray-500 flex-grow">
                        <a class="" href="{{route('show-artifact', $artifact)}}">
                        {{$loop->index+1}}/{{$loop->count}}
                        </a>
                    </div>
                
                  <!-- Artifact Menu Trigger -->
                    <div class="pt-2 pr-1 flex">
                        <x-feathericon-more-horizontal @click="open = true" class="w-5 h-5 hover:text-red-500 text-gray-400"/>
                    </div>
                
                  <!-- Artifact Option Menu -->
                    <div x-show="open" 
                         @click.away="open = false" 
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-10"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-90"
                    class="flex absolute right-3 top-6 text-sm z-10 pb-0 bg-gray-200 bg-opacity-100 shadow-2xl rounded-md">
                    
                  <!-- Artifact Option Menu Links -->
                    <ul class="flex-grow leading-loose pt-1 pb-2">
                      <li class="hover:bg-gray-100 hover:text-red-500 mt-1 px-3">
                          <a href="{{ route('edit-collection', $artifact) }}">Edit Label</a>
                      </li>
                      <li class="hover:bg-gray-100 hover:text-red-500 mt-1 px-3">
                          <a href="{{ route('remove-artifact-from-collection', ['collection' => $collection, 'artifact' => $artifact]) }}">Remove</a>
                      </li>
                    </ul>

                    </div>        
              </div>

              <!-- End Artifact Header -->

              <!-- Artifact Image -->
                    <div class="">
                    
                    <!-- Begiin Collection Image --> 
                  
                            <a class="" href="{{route('show-artifact', $artifact->id)}}">
                            <img  class="object-contain opacity-100 hover:opacity-75" src="https://s3.amazonaws.com/artifacts-0.3/{{$artifact->artifact_path}}">
                            </a>

               
                           <div class="mb-2">

                              <ul class="leading-tight text-xs p-2 mb-1 w-11/12">      

                                  <li class="font-semibold">{{$artifact->pivot->artist}}</li>
                                  <li class="italic">{{$artifact->pivot->title}}</li>
                                  <li>{{$artifact->pivot->medium}}</li>
                                  <li>{{$artifact->pivot->year}}</li>
                                  <li>

                                   {{$artifact->pivot->dimensions_height}}
                                   
                                   @if(is_null($artifact->pivot->dimensions_width))
                                   @else
                                   x {{$artifact->pivot->dimensions_width}}
                                   @endif

                                   @if (is_null($artifact->pivot->dimensions_depth))
                                   @else
                                   x {{$artifact->pivot->dimensions_depth}}
                                   @endif
                                   {{$artifact->pivot->dimensions_units}}
                                   </li>
                                   
                                   <!-- @if (is_null($artifact->pivot->label_text))
                                   @else
                                   <li class="my-4 bg-cool-gray-400 border rounded-lg p-3">{{$artifact->pivot->label_text}}</li>
                                   @endif -->
                                   </ul>
        <!-- End Label -->  

                            </div>
                            
                
        </div>
        </div>


      @endforeach
</x-app-layout>
