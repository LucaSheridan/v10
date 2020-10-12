<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl text-gray-100 leading-tight">
            Artifact
        </h2>
    </x-slot>

<div id="wrapper"class="max-w-5xl mx-auto flex flex-wrap w-full bg-cool-gray-400 p-4">
    
<div id="column1" class="flex flex-col w-full sm:w-1/2 bg-white px-4 rounded-lg">
    
    <div id="artifactTitleMenu" x-data="{open: false}" class="flex relative">
        
        <!-- Artifact Title --><!-- Artifact Menu Trigger -->
        <div class="pb-1.5 pt-1.5 flex flex-grow justify-end">
        <x-feathericon-menu @click="open = true" class="w-5 h-5 hover:text-red-500 text-gray-500"/>
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
        class="flex absolute right-3 top-14  text-sm z-10 pb-0 text-gray-700 bg-gray-50 bg-gray-200 bg-opacity-100 shadow-2xl rounded-md">
            
            <!-- Option Menu Links -->
            <ul class="flex-grow leading-loose pt-1 pb-2">
                
               
                <li class="hover:bg-gray-100 hover:text-red-500 mt-1 px-3"><a href="">Submit for Class</a></li>


                <!-- <button type="submit" class="mb-1 md:mb-0 bg-gray-400 hover:bg-green-500 text-gray-700 hover:text-green-100 px-4 py-2 text-sm uppercase tracking-wide font-semibold rounded">Yes</button> -->
       


                <hr class="my-2"/>
                
                <li class="hover:bg-gray-100 hover:text-red-500 px-3"><a href="{{route('rotate-artifact', ['artifact' => $artifact->id, 'degrees' => -90])}}">Rotate CW</a></li>
                <li class="hover:bg-gray-100 hover:text-red-500 px-3"><a href="{{route('rotate-artifact', ['artifact' => $artifact->id, 'degrees' => 90])}}">Rotate CCW</a></li>

                <hr class="my-2"/>

                <li class="hover:bg-gray-100 hover:text-red-500 px-3">
                
                    <form id="delete_artifact" method="POST" action="{{ route('destroy-artifact', $artifact) }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this?')">Delete</button>
                     </form>
                </li>

            </ul>
            
            <!-- Option Menu Close -->
            <!-- <div class="flex-1 my-2 bg-gray-100"><x-feathericon-x-circle @click="open = false" class="w-5 h-5 bg-gray-50 hover:text-red-500 text-gray-500"/></div>
            -->

        </div>

    </div>

    <!-- End Column 1 -->

                <a class="cursor-zoom-in" tabindex="0" href="https://s3.amazonaws.com/artifacts-0.3/{{$artifact->artifact_path}}">
                <img class="pt-0 pb-4 border-gray-500" src="https://s3.amazonaws.com/artifacts-0.3/{{$artifact->artifact_path}}">
                </a> 


</div>

<!-- Column 2: Wrapper -->
<div class="flex flex-col w-full sm:w-1/2  pl-0 sm:pl-4 mt-4 sm:mt-0">
    
    <div id="column2" class="bg-white px-4 pb-2 rounded-lg">
   
    <!-- Level 2 - Section Heading -->

        <div id="infoTitleMenu" x-data="{open: false}" class="flex relative bg-white border-red-500">
        
            <!-- Section Title -->
            <div class="py-1 flex flex-row flex-grow capitalize font-semibold text-gray-400">INFO</div>
        
            <!-- Section Menu Trigger -->
            <div class="pt-1.5 flex">
            <x-feathericon-edit @click="open = true" class="w-5 h-5 hover:text-red-500 text-gray-500" />
            </div>
        
            <!-- Section Option Menu -->
            <div x-show="open" @click.away="open = false" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-10"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-90"
            
            class="flex absolute right-3 top-10  text-sm z-10 pb-0 text-gray-700 bg-gray-50 bg-gray-200 bg-opacity-100 shadow-2xl rounded-md">
            
            <!-- Info Option Menu Links -->
            <ul class="flex-grow leading-loose pt-1 pb-2">
                
                <li class="hover:bg-gray-100 hover:text-red-500 mt-1 px-3">
                    <a href="{{route('edit-artifact', $artifact)}}">Edit Info</a>
                </li>
            </ul>
            </div>
        </div>

    <!-- Level 2 - Begin Info Content  -->

            <div class="pt-1 text-gray-800 text-xs md:text-sm border rounded-lg ">
                
                <ul class="mb-2 pl-2">
                    <li><!-- Artist -->
                        @if ($artifact->from_URL)
                            <span class="text-gray-800 font-semibold">Artist:</span>
                            {{ $artifact->artist }}
                        @else
                            <span class="text-gray-800 font-semibold">Artist:</span>
                            {{ $artifact->user->fullName }}
                        @endif
                    </li>
                   
                    <li><!-- Title -->
                        @if (is_null($artifact->title))
                        @else <span class="text-gray-800 font-semibold">Title:</span>
                        <span class="italic">{{ $artifact->title }}</span>
                        @endif
                    </li>
                    
                    <li><!-- Medium -->
                        @if (is_null($artifact->medium))
                        @else <span class="text-gray-800 font-semibold">Medium:</span>  {{ $artifact->medium }}
                        @endif
                    </li>

                    <li> <!-- Year -->
                        @if (is_null($artifact->year))
                        @else   <span class="text-gray-800 font-semibold">Year:</span>  {{ $artifact->year }}
                        @endif
                    </li>
                      
                    <li> <!-- Dimensions -->
                        @if (is_null($artifact->dimensions_width))
                        @else 
                        <span class="text-gray-800 font-semibold">Dimensions:</span> {{$artifact->dimensions_height}} x 
                        {{$artifact->dimensions_width}}
                            @if (is_null($artifact->dimensions_depth))
                            @else 
                            x
                            {{$artifact->dimensions_depth}}
                            @endif {{$artifact->dimensions_units}}
                        @endif
                    </li>

                    @if (is_null($artifact->annotation))
                    @else 
                    <li class="my-2 pr-2">
                    <span class="text-gray-800 font-semibold">Annotation:</span> {{$artifact->annotation}}
                    </li>
                    @endif
                    

                </ul>




            {{-- Check if artifact is attributed to a class --}}

                @if (is_null($artifact->section))
                @else

                 <ul class="list-none mt-2 mb-4 p-2 bg-gray-50 rounded border">
                                
                        <li><!-- Section -->
                            @if (is_null($artifact->section))
                            @else     
                            <span class="text-gray-800 font-semibold">Class:</span>
                            {{$artifact->section->title}}
                            @endif
                        </li>
           
                        <li><!-- Assignment -->
                            @if (is_null($artifact->assignment))
                            @else     
                            <span class="text-gray-800 font-semibold">Assignment:</span>
                            {{ $artifact->assignment->title }}
                            @endif
                        </li>
                        
                        <li><!-- Component -->
                            @if (is_null($artifact->component))
                            @else     
                           <span class="font-semibold text-gray-800">Component:</span>
                              {{ $artifact->component->title }}
                            @endif
                        </li>
                </ul>
                
                @endif

                </div>

  

            <div class="pt-2 flex flex-row flex-grow capitalize font-semibold text-gray-400">FEEDBACK</div>
            <!-- Section Menu Trigger -->
            <div class="pt-1 flex">
            <!--             
                <x-feathericon-menu @click="open = true" class="w-5 h-5 hover:text-red-500 text-gray-500"/>
            -->            
        
            <!-- Section Option Menu -->
            <div x-show="open" 
                 @click.away="open = false" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-10"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-90"
            class="flex absolute right-3 top-10 text-sm z-10 pb-0 text-gray-700 bg-gray-50 bg-gray-200 bg-opacity-100 shadow-2xl rounded-md">
            
            <!-- Option Menu Links -->
            <!-- <ul class="flex-grow leading-loose pt-1 pb-2">
                <li class="hover:bg-gray-100 hover:text-red-500 mt-1 px-3"><a href="">Add Comment</a></li>
            </ul> -->
            </div>
        </div>
    
    <!-- Level 2 - Begin Section Content  -->

        <form id="create_comment" method="POST" action="
        {{ route('save-comment', ['artifact' => $artifact->id]) }}">
        

        {{ csrf_field() }}
        
        <div class="flex pb-2 bg-white rounded-lg">

                    <!-- Begin Create Comment Form Input-->
                            <textarea id="body" class="w-full p-2 rounded border text-gray-600 text-sm leading-snug {{ $errors->has('body') ? 'border-red-500' : 'border' }}" name="body" value="{{ old('body') }}" tabindex="1">{{ old('body') }}</textarea>
                            
                            {!! $errors->first('body', '<span class="text-red-500 text-sm mt-2">:message</span>') !!}


                    <!-- User ID Input -->
                            <input id="user_id" type="hidden" name="user_id" value="{{Auth::User()->id}}">

                    <!-- Artifact ID Input -->
                            <input id="artifact_id" type="hidden" name="artifact_id" value="{{$artifact->id}}">
       
                            <div class="flex-1 flex-end">
                                <button type="submit" class="ml-2 px-2 rounded bg-gray-100 hover:bg-gray-200 hover:shadow border items-center flex-end text-sm" tabindex="2">
                                Post
                            </button>
                            
                            </div>
                    </div>
                
                </form>

                    @if ($artifact->comments)
            
                    @foreach ($artifact->comments as $comment)
            
                        <div class="flex text-left space-y-1">
                        
                            <div class="flex-1 pt-2">
                                  <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-cool-gray-400">
                                  <span class="text-sm font-medium leading-none text-white">{{$comment->user->initials}}</span>
                                  </span>
                            </div>
                        
                        <div class="w-full ml-2  py-1 px-2 leading-snug text-sm border-l border-t border-b">
                        
                        <span class="font-semibold">{{$comment->user->fullName}}</span>
                        <span class="text-gray-500">{{$comment->created_at->diffForHumans()}}</span>                         
                        {{$comment->body}}</div>
                       

                        <div class="flex pt-3 border-t border-r border-b rounded"></div>

                                                </div>

        
                    @endforeach
                    @else
                    @endif


                    <!-- Level 2 - Section Heading -->

        <div id="infoTitleMenu" x-data="{open: false}" class="flex relative mt-2">
        
            <!-- Section Title -->
            <div class="py-1 flex flex-row flex-grow capitalize font-semibold text-gray-400">COLLECTIONS</div>
        
            <!-- Section Menu Trigger -->
            <div class="pt-1.5 flex ">
            <x-feathericon-menu @click="open = true" class="w-5 h-5 hover:text-red-500 text-gray-500"/>
            </div>
        
            <!-- Section Option Menu -->
            <div x-show="open" 
                 @click.away="open = false" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-10"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-90"
            class="flex absolute right-3 top-10  text-sm z-10 pb-0 text-gray-700 bg-gray-50 bg-gray-200 bg-opacity-100 shadow-2xl rounded-md">
            
            <!-- Option Menu Links -->
            <ul class="flex-grow leading-loose pt-1 pb-2">
                
                 <li class="hover:bg-gray-100 hover:text-red-500 mt-1 px-3"><a href="{{route('select-collection', $artifact)}}">Add to Collection</a>
                 </li>

                <li class="hover:bg-gray-100 hover:text-red-500 mt-1 px-3">

                 <a href="{{route('create-collection', $artifact)}}">
                
                 Create New Collection</a>
                
                </li>

            </ul>
            </div>
        </div>

    <!-- Level 2 - Begin Section Content  -->

        <ul class="mt-0"> 

            @foreach ($artifact->collections as $collection)

                <li class="bg-gray-50 rounded-lg border py-1 px-2 mb-2 rounded-lg hover:bg-gray-200 hover:text-red-500">
                
                    <div class="flex">
                
                        <div class="flex-grow text-xs md:text-sm">
                            <a href="{{route('show-collection', $collection)}}" tabIndex="-1">{{$collection->title}}</a>
                        </div>
                        <div class="flex items-center">
                            <a href="{{ route('remove-from-collection', ['collection' => $collection, 'artifact' => $artifact->id ]) }}" tabIndex="-1" onclick="return confirm('Are you sure?')"><x-feathericon-x class="w-3 h-3 hover:text-red-500 text-gray-500" /></a>
                        </div>
                </li>

            @endforeach

        </ul>

    </div><!-- end wrapper -->
                    
</x-app-layout>