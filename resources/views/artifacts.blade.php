<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl text-gray-100 leading-tight">
            Artifacts
        </h2>
    </x-slot>

    <div class="pt-0 px-3">
        
         <!-- Header -->
         <div class="flex max-w-5xl mx-auto pl-3 rounded-t-lg bg-white text-gray-400 aliased">

                <!-- Pagination -->
                <div class="h-7 flex flex-grow items-center">
                      {{ $artifacts->links() }}
                </div>
            
               <!-- Menu  -->

                <div class="flex items-center pr-2">

                <a href="#create-artifact">
                <x-feathericon-camera class="w-5 h-5 hover:text-red-500 "/>
                </a>

                <!-- Create Modal-->

                    <x-v10_confirmation-modal name="create-artifact" height="h-60" >
              
                      <x-slot name="title">
                      Create New Artifact
                      </x-slot>

                      <x-slot name="body">
                      <form action="{{route('save-artifact')}}" role="form" method="POST" enctype="multipart/form-data" class="">

                      {!! csrf_field() !!}
      
                      <input name="file" type="file" style="display:none" value="{{ old('file') }}" id="file" >

                      {{-- Pass Artifact if variable is set --}}

                       <input type="hidden" name="user_id" value="{{ Auth::User()->id }}">
                     
                          {{-- 
                          <input type="hidden" name="section_id" value="{{$section->id}}">
                          <input type="hidden" name="assignment_id" value="{{$assignment->id}}">
                          <input type="hidden" name="component_id" value="{{$komponent->id}}">
                           --}}

                       <label for="file" class="block mx-auto text-gray-600 mt-2 text-center p-2 rounded">
                       
                       <div class="relative flex items-center justify-center text-gray-600">
                          <div class="p-2 bg-cool-gray-400 text-white hover:bg-gray-500 hover:text-gray-100 rounded-full">
                          <x-feathericon-camera class="h-8 w-8" />
                          </div>
                       </div>

                      </label>
                        
                      <div class="w-full text-center mb-2 p-1 rounded" id="filename"></div>

                @if ($errors->has('file'))
                <div class="help-block mb-4 text-red-500">
                {{ $errors->first('file') }}
                </div>
                @endif

            </x-slot>

            <x-slot name="footer">

                        <div x-data="{ clicked: false }" class="block">

                              <x-jet-button id="fileSubmitButton" class="" type="submit"  @click="clicked = true">
                              <span>{{ __('Upload') }}</span>
                              </x-jet-button>

                             <!--  <div class="flex bg-gray-300 items-center justify-center" x-show="clicked">
                              
                              <p>Processing</p>
                              <x-feathericon-refresh-cw class="rounded-full bg-green-300 animate-spin text-gray-900"/>
                              </div> -->

                        </div>

                        </form>

                         <a class="text-xs" href="#create-artifact-from-url"> Click here to upload from URL
                         </a>

                      </x-slot>
            
            </x-v10_confirmation-modal>

<!--End Create Modal  -->

<!-- Create from URL Modal-->

<x-v10_confirmation-modal name="create-artifact-from-url" height="h-60" >
              
                      <x-slot name="title">
                      Create New Artifact from URL
                      </x-slot>

                      <x-slot name="body">
                      
                      <form action="{{route('save-artifact-from-url')}}" role="form" method="POST" enctype="multipart/form-data">

                      {!! csrf_field() !!}

                      <div class="flex flex-col text-center justify-center">

                      <p class="text-center text-sm p-2 mx-2">Type or paste the location of an image on the internet in order to save a copy as an artifact.</p>
                    
                      <input type="text" name="url" class="mx-6 bg-white p-2 rounded" value="{{ old('url') }}" id="url" placeholder="http://www.site.com/image.jpg">
            
                      <input type="hidden" name="user_id" value="{{ Auth::User()->id }}">
                     
                      @if ($errors->has('url'))
                      <div class="help-block mb-4 text-red-500">
                      {{ $errors->first('url') }}
                      </div>
                      @endif

                      </div>
    
                      </x-slot>

                      <x-slot name="footer">

                        <div id="urlSubmitButton"  x-data="{ clicked: false }" class="block">

                              <x-jet-button type="submit"  @click="clicked = true">
                              <span>{{ __('Upload') }}</span>
                              </x-jet-button>

                              <div class="flex bg-gray-300 items-center justify-center" x-show="clicked">
                              <p>Processing</p>
                              <x-feathericon-refresh-cw class="rounded-full bg-green-300 animate-spin text-gray-900"/>
                              </div>

                        </div>

                        </form>

                      </x-slot>
            
            </x-v10_confirmation-modal>


<!-- End Create from URL Modal -->

                <!-- <x-jet-dropdown align="right" width="48">
                              
                              <x-slot name="trigger">
                                <button class="flex transition items-center duration-150 ease-in-out pl-1">
                                <x-feathericon-camera class="flex w-5 h-5 hover:text-red-500 "/>
                                </button>
                              </x-slot>
                              
                              <x-slot name="content">
                                  <x-jet-dropdown-link 
                                  href="{{action('App\Http\Controllers\ArtifactController@create')}}">
                                  Create New Artifact
                                  </x-jet-dropdown-link>
                              </x-slot>
                      </x-jet-dropdown> -->
                  </div>
        </div>


<div class="max-w-5xl mx-auto bg-gray-400">

<div class="p-3 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3 bg-gray-100 rounded-b-lg shadow-inner"> 
    
<!-- Check for Artifacts -->
    @if ($artifacts->count() > 0)

        <!-- Show Artifacts -->
        @foreach ($artifacts as $artifact) 

        <x-lightbox-modal name="{{ $loop->index }}" >
        
        <x-slot name="title">
        {{$loop->index}}
        </x-slot>

        <x-slot name="body">
                          
            <div class="flex flex-col">
            
            <div class="flex pb-2">
            <img class="object-scale-down" src="https://s3.amazonaws.com/artifacts-0.3/{{$artifact->artifact_path}}">
            </div>
            
            <div class="flex justify-center space-x-1 text-gray-600 text-sm">
            <span class="font-semibold">{{$artifact->artist}}</span>
            <span class="italic"> {{$artifact->title}}</span>
            <span class="">{{$artifact->year}}</span>
            </div>

            </div>
                           
        </x-slot>

        <x-slot name="caption">
        {{$artifact}} 
        </x-slot>  
        
        <x-slot name="arrowleft">
            
            @if (!$loop->first)
            <a href="#{{$loop->index-1}}" class="block hover:text-white transition-all duration-200">
            <x-feathericon-chevron-left class="w-10 h-10 m-4 bg-white rounded-full text-gray-400 hover:text-gray-500" /></a>
            @else
            <x-feathericon-chevron-left class="w-10 h-10 m-4 bg-white rounded-full text-white" />
            @endif

        </x-slot>
        
        <x-slot name="arrowright">
   
            @if (!$loop->last)
            <a href="#{{$loop->index+1}}" class="block hover:text-white transition-all duration-200">
            <x-feathericon-chevron-right class="w-10 h-10 m-4 bg-white rounded-full text-gray-400 hover:text-gray-500" /></a>
            @else
            <x-feathericon-chevron-right class="w-10 h-10 m-4 bg-white rounded-full text-white" />
            @endif

            </x-slot>

                <x-slot name="counter">
                
                {{$loop->index+1}} of {{$loop->count}}
                
                </x-slot>

                <x-slot name="exit">
                
                <a href="#">
                <x-feathericon-x class="w-6 h-6 m-4 bg-white rounded-full text-gray-400" />
                </a>

                </x-slot>

        </x-lightbox-modal>

     <div id="ArtifactCard" class="px-2 pt-2 pb-1 bg-white rounded-lg w-full shadow-xl">
        
           <!-- Begiin Artifact Image --> 

                <!-- <a class="" href="#{{$loop->index}}"> -->
                <a class="" href="{{route('show-artifact', $artifact)}}">
                  
                  <img  class="object-cover h-48 w-full opacity-100 hover:opacity-75 rounded-lg" src="https://s3.amazonaws.com/artifacts-0.3/{{$artifact->artifact_path}}">
                </a>

               <!--  <a class="" href="{{route('show-artifact', $artifact->id)}}">
                  <img  class="object-cover h-48 w-full opacity-100 hover:opacity-75 rounded-lg" src="https://s3.amazonaws.com/artifacts-0.3/{{$artifact->artifact_path}}">
                </a> -->
                          
           <!-- Begin Artifact Footer -->
                <div class="flex relative rounded-t-lg items-center text-xs text-gray-500 pt-1">

                <!-- Comments -->
                      <!-- <div class="flex items-center ">
                          @if (!$artifact->comments->isEmpty())
                          <a href="{{route('show-artifact', $artifact->id)}}">
                          <x-feathericon-message-square class="w-3 h-3 mx-1" />
                          </a>
                          @endif
                      </div> -->

                <!-- Time -->
                      <div class="flex-grow">
                          {{$artifact->created_at->diffForHumans()}}
                      </div>
<!-- Menu -->
                        <div class="flex">
                        
                        <x-jet-dropdown align="right" width="48">
                          <x-slot name="trigger">
                          
                          <button class="flex transition duration-150 ease-in-out" tabIndex="-2">
                          <x-feathericon-more-horizontal class="w-5 h-5 hover:text-red-500 text-gray-400"/>
                          </button>
                         
                          </x-slot>
                          <x-slot name="content">
                              
                              

                                <x-jet-dropdown-link 
                                href="{{route('edit-artifact', ['artifact' => $artifact->id, 'degrees' => -90])}}">Edit Info
                                </x-jet-dropdown-link>

                                <hr class="my-1"/>

                                 <x-jet-dropdown-link href="{{route('select-collection', $artifact)}}">Add to Collection
                                </x-jet-dropdown-link>

                                <x-jet-dropdown-link href="{{route('create-collection', $artifact)}}">Start a New Collection
                                </x-jet-dropdown-link>
                               
                                <hr class="my-1"/>


                                <x-jet-dropdown-link 
                                href="{{route('rotate-artifact', ['artifact' => $artifact->id, 'degrees' => -90])}}">
                                <x-feathericon-rotate-cw class="inline-block w-5 h-5 mr-1 hover:text-red-500 text-gray-400"/>
                                Rotate
                                </x-jet-dropdown-link>

                                <x-jet-dropdown-link 
                                href="{{route('rotate-artifact', ['artifact' => $artifact->id, 'degrees' => 90])}}">
                                <x-feathericon-rotate-ccw class="inline-block w-5 h-5 mr-1 hover:text-red-500 text-gray-400"/>
                                Rotate 
                                </x-jet-dropdown-link>
                                <hr class="my-1"/>
                                <x-jet-dropdown-link>
                                <form id="delete_artifact" method="POST" action="{{ route('destroy-artifact', $artifact) }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this?')">Delete Artifact</button>
                                 </form>
                                </x-jet-dropdown-link>

                          </x-slot>
                          
                          </x-jet-dropdown>                   

</div>
                

                </div>
            <!-- End Artifact Footer -->
      </div>   

      @endforeach

      @else   
      <div class="text-center bg-red-200 text-gray-500 m-2 rounded text-lg px-3 py-2">
        <img src=""/>
      Upload images of your work as <b>Artifacts</b> to begin documenting your artistic journey!<br>>></div>

<div class="text-center bg-purple-200 text-gray-500 m-2 rounded text-lg px-3 py-2">
        <img src=""/>
      Organize <b>Collections</b> of images to build personal portfolios!<br>>></div>

<div class="text-center bg-teal-200 text-gray-500 m-2 rounded text-lg px-3 py-2">
        <img src=""/>
      Join <b>Courses</b> receive assignemnts, submit work, and get feedback on your work.<br>>></div>


      @endif
        
  </div>
  </div>

</x-app-layout>
