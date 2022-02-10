<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl text-gray-100 leading-tight">
            Collections
        </h2>
    </x-slot>

    <div class="pt-0 px-3 pb-4 ">
        
        <div class="flex max-w-5xl mx-auto pt-2 pl-4 bg-white rounded-t-lg text-left py-1 border-b">

          <!-- Title-->
          <div class="flex flex-col flex-grow font-normal text-2xl text-gray-400 capitlize">
            
            {{$collection->title}}

          </div> 

          <!-- Menu-->

            <div class="flex pr-3 mt-1">
                
                 <x-jet-dropdown align="right" width="48">
                          <x-slot name="trigger">
                         <x-feathericon-menu class="w-5 h-5 hover:text-red-500 text-gray-400"/>
                          <button class="flex transition duration-150 ease-in-out" tabIndex="-2">
                          </button>
                         
                          </x-slot>
                          <x-slot name="content">
                              
                              <x-jet-dropdown-link 
                              href="{{route('edit-collection', $collection)}}" class="opacity-100 hover:opacity-75">Edit Collection
                              </x-jet-dropdown-link>

                             <x-jet-dropdown-link 
                             href="{{route('show-public-collection', $collection->id)}}" class="opacity-100 hover:opacity-75">View Public Link</x-jet-dropdown-link>
                              
                              <x-jet-dropdown-link 
                              href="{{route('add-curator', $collection)}}" class="opacity-100 hover:opacity-75">Add Curators
                              </x-jet-dropdown-link>

                              {{-- <x-jet-dropdown-link 
                              href="{{route('remove-curator', $collection)}}" class="opacity-100 hover:opacity-75">Remove Curators
                              </x-jet-dropdown-link> --}}

                              <x-jet-dropdown-link>
                              <form id="delete_collection" method="POST" action="{{ route('delete-collection', $collection) }}">
                              {{ csrf_field() }}
                              <input type="hidden" name="_method" value="DELETE"><button type="submit" onclick="return confirm('Are you sure you want to delete this?')">Delete Collection</button>
                              </form>
                              </x-jet-dropdown-link>

                          </x-slot>
                    </x-jet-dropdown>
        </div>
        </div>

        <!-- Begin Collections -->

        <div class="max-w-5xl mx-auto grid mx-4 p-4 grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 bg-gray-100 flex items-start">  
        
        <!-- Show  Artifacts -->
        
        @foreach ($collection->artifacts as $artifact) 

              <!-- Artifact Card -->
              <div id="ArtifactCard" x-data="{open: false}" class="w-full rounded">

              <!-- Artifact Image -->
              <div class="flex">
                    
                    <!-- Begiin Collection Image --> 
                  
                            <a class="" href="{{route('show-artifact', $artifact->id)}}">
                            <img  class="object-contain opacity-100 hover:opacity-75" src="https://s3.amazonaws.com/artifacts-0.3/{{$artifact->artifact_path}}">
                            </a>

                            </div>
                            <div class="flex mt-2">
                           <div class="flex flex-grow mb-0">

                              <ul class="leading-tight pr-1 text-sm text-gray-500">      

                                  @if($collection->showArtist == 1)
                                  <li class="font-semibold">
                                  @if ($artifact->pivot->artist == 'Unattributed')
                                  {{$artifact->user->fullName}}
                                  @else
                                  {{$artifact->pivot->artist}}
                                  @endif
                                  </li>
                                  @else
                                  @endif
                                  
                                  @if($collection->showTitle == 1)<li class="italic">        {{$artifact->pivot->title}}</li>
                                  @else
                                  @endif

                                  @if($collection->showMedium == 1)
                                  <li>{{$artifact->pivot->medium}}</li>
                                  @else
                                  @endif

                                  @if($collection->showYear == 1)
                                  <li>{{$artifact->pivot->year}}</li>
                                  @else
                                  @endif

                                  @if($collection->showDimensions == 1)
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

                                   @else
                                   @endif
                                   
                                   @if($collection->showLabel == 1)
                                   @if (is_null($artifact->pivot->label_text))
                                   @else
                                   <li class="my-4 w-full bg-cool-gray-50 rounded-lg">{{$artifact->pivot->label_text}}</li>
                                   @endif
                                   @else
                                   @endif

                                   </ul>
        <!-- End Label -->  

                              </div>


                            <div class="flex pr-0">
 <!-- Artifact Menu Trigger -->
                  <x-jet-dropdown align="right" width="48">
                    
                         <x-slot name="trigger">
                         <x-feathericon-more-horizontal class="w-5 h-5 hover:text-red-500 text-gray-400"/>
                         <button class="flex transition duration-150 ease-in-out" tabIndex="-1">
                         </button>
                         
                          </x-slot>
                         
                          <x-slot name="content">
                              
                              <x-jet-dropdown-link>
                                  
                                 <form class="p-0 m-0" id="edit_label" method="get" action="{{
                                  route('edit-label',['collection' => $collection->id , 'artifact' => $artifact->id ]) }}">
                                  {{ csrf_field() }}
                                  <input type="hidden" name="position" value="{{$artifact->pivot->position}}">
                                  <input type="hidden" name="artist" value="{{$artifact->pivot->artist}}">
                                  <input type="hidden" name="title" value="{{$artifact->pivot->title}}">
                                  <input type="hidden" name="medium" value="{{$artifact->pivot->medium}}">
                                  <input type="hidden" name="year" value="{{$artifact->pivot->year}}">
                                  <input type="hidden" name="dimensions_height" value="{{$artifact->pivot->dimensions_height}}">
                                  <input type="hidden" name="dimensions_width" value="{{$artifact->pivot->dimensions_width}}">
                                  <input type="hidden" name="dimensions_depth" value="{{$artifact->pivot->dimensions_depth}}">
                                  <input type="hidden" name="dimensions_units" value="{{$artifact->pivot->dimensions_units}}">
                                  <input type="hidden" name="label_text" value="{{$artifact->pivot->label_text}}">
                                                
                                  <button type="submit">Edit Label</button>
                                         
                                  </form>
                              </x-jet-dropdown-link>

                              <x-jet-dropdown-link 
                              href="{{ route('remove-artifact-from-collection', ['collection' => $collection, 'artifact' => $artifact]) }}" onclick="return confirm('Are you sure you want to remove this?')">Remove
                              </x-jet-dropdown-link>

                            </x-slot>
                      </x-jet-dropdown>
                            </div>
                            
                
                </div>
   
</div>
      

      @endforeach

    </div>

              <div class="bg-white text-gray-500 text-sm rounded-b-lg py-2 px-2 border-t">Curated by 
            @foreach ($collection->curators as $curator)
            
              <!-- AND Check for more than 1 curator and not last loop -->
              @if ($loop->count > 1 && $loop->last)

                  and 
                  <span class="font-semibold">
                  {{$curator->fullName}}
                  </span>
             
              <!-- COMMA Check for loop count > 2 and not last-->
              @elseif ($loop->count > 2 && $loop->index != 0),
              <span class="font-semibold">
              {{$curator->fullName}}
              </span>

              @else

              <span class="font-semibold">
              {{$curator->fullName}}
              </span>

              @endif
                  

            
            @endforeach
            <br/>
            {{-- Containing artworks by:

             @foreach ($collection->artifacts as $artifact)
          
              @if ($loop->count > 1 && $loop->last)

                  and 
                  <span class="font-semibold">
                  {{$artifact->pivot->artist}}
                  </span>
             
              <!-- COMMA Check for loop count > 2 and not last-->
              @elseif ($loop->count > 2 && $loop->index != 0),
              <span class="font-semibold">
              {{$artifact->pivot->artist}}
              </span>

              @else

              <span class="font-semibold">
              {{$artifact->pivot->artist}}
              </span>

              @endif

             @endforeach --}}

                  
          </div>


</x-app-layout>
