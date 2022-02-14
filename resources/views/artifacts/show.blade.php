<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl text-gray-100 leading-tight">
            Artifact
        </h2>
    </x-slot>

<div id="wrapper" class="max-w-5xl mx-auto py-b w-full bg-cool-gray-400 lg:rounded-lg">


<div class="max-w-5xl mx-auto flex items-stretch flex-wrap w-full bg-white lg:rounded-lg px-4 pb-4">
    
<!-- Landscape / Portrait Logic for Column 1-->

    @if (isset($artifact->dimensions_height_pixels))
    

        @if ($artifact->dimensions_height_pixels > $artifact->dimensions_width_pixels) 
        <div id="column1" class="bg-white flex flex-col w-full sm:w-1/2 rounded-l-lg">
        @else
        <div id="column1" class="bg-white flex flex-col w-full sm:w-1/2 md:w-2/3 rounded-l-lg">
        @endif

    @else


        <div id="column1" class="bg-white flex flex-col w-full sm:w-1/2 rounded-l-lg">

    @endif
    
    <div id="artifactTitleMenu" x-data="{open: false}" class="flex items-center relative">

    <span class="text-gray-500 text-sm">{{strToUpper($artifact->title)}}</span>
    <!-- Artifact Title --><!-- Artifact Menu Trigger -->
    
    <div class="pb-1.5 pt-1.5 flex flex-grow justify-end">
         <x-jet-dropdown align="right" width="48">
                            
                            <x-slot name="trigger">
                            
                            <button class="flex transition duration-150 ease-in-out" tabIndex="-2">
                            <x-feathericon-menu class="w-5 h-5 hover:text-red-500 text-gray-400"/>
                            </button>
                           
                            </x-slot>
                            <x-slot name="content">
                           
                                <x-jet-dropdown-link 
                                href="{{route('zoom-artifact', $artifact)}}">
                                <x-feathericon-zoom-in class="inline-block w-5 h-5 mr-1 hover:text-red-500 text-gray-400"/>
                                Zoom
                                </x-jet-dropdown-link>

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
    
<!-- Image container --> 

    <div class="flex justify-center">

                <a class="cursor-zoom-in" tabindex="0" href="{{route('zoom-artifact', ['artifact' => $artifact->id])}}">
                <img class="object border" src="https://s3.amazonaws.com/artifacts-0.3/{{$artifact->artifact_path}}">
                </a> 
    </div>

<!-- End Column 1 -->

    </div>

<!-- Column 2: Wrapper -->

    <!-- Landscape / Portrait Logic for Column 2-->
    @if (isset($artifact->dimensions_height_pixels))
    
        @if ($artifact->dimensions_height_pixels < $artifact->dimensions_width_pixels) 
        <div class="flex flex-col w-full sm:w-1/2 md:w-1/3 pl-0 mt-4 sm:mt-0">
        @else
        <div class="flex flex-col w-full sm:w-1/2  pl-0  mt-4 sm:mt-0">
        @endif

    @else

        <div class="flex flex-col w-full sm:w-1/2  pl-0  mt-4 sm:mt-0">

    @endif

    <!-- End Logic -->
    
    <div id="column2" class="flex flex-col sm:pl-4 pb-2 rounded-r-lg">
   
    <!-- Level 2 - Section Heading -->

        <div id="infoTitleMenu" x-data="{open: false}" class="flex relative bg-white">
        
            <!-- Section Title -->
            <div class="py-1 flex flex-row flex-grow text-gray-500 text-sm">INFO</div>

            <div class="flex pt-1.5 ">

                <x-jet-dropdown align="right" width="48">
                            
                            <x-slot name="trigger">
                            
                            <button class="flex transition duration-150 ease-in-out" tabIndex="-2">
                            <x-feathericon-menu class="w-5 h-5 hover:text-red-500 text-gray-400"/>
                            </button>
                           
                            </x-slot>
                            <x-slot name="content">
                                
                                <x-jet-dropdown-link 
                                href="{{route('edit-artifact', ['artifact' => $artifact->id, 'degrees' => -90])}}">Edit Info
                                </x-jet-dropdown-link>
                            </x-slot>
                </x-jet-dropdown>
</div>
    
        </div>

    <!-- Level 2 - Begin Info Content  -->

<!--             <div class="pt-1 text-gray-800 text-xs md:text-sm border rounded-lg ">
 -->            <div class="text-gray-500 text-xs bg-white mt-1 border rounded-lg p-4 mb-2">

                <ul class=" ">
                    <li>
                        <!-- Artist: -->
                        @if ($artifact->artist == "")
                        Unattributed
                        @elseif ( !is_null($artifact->artist))
                        {{ $artifact->artist }}
                        @else 
                        {{ $artifact->user->fullName }}
                        @endif
                    </li>
                   
                    <li>
                        <!-- Title -->
                        @if (is_null($artifact->title))
                        @else
                        <!-- Title: -->
                        <span class="italic">{{ $artifact->title }}</span>
                        @endif
                    </li>
                    
                    <li><!-- Medium -->
                        @if (is_null($artifact->medium))
                        @else {{ $artifact->medium }}
                        @endif
                    </li>

                    <li> <!-- Year -->
                        @if (is_null($artifact->year))
                        @else  <!-- Year: -->  {{ $artifact->year }}
                        @endif
                    </li>
                      
                    <li> <!-- Dimensions -->
                        @if (is_null($artifact->dimensions_width))
                        @else 
                        <!-- Dimensions: --> {{$artifact->dimensions_height}} x 
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
                    <!-- Notes: --> {{$artifact->annotation}}
                    </li>
                    @endif
                    

                </ul>

                

                {{-- Check if artifact is attributed to a class --}}

                @if (is_null($artifact->section))
                @else

                 <ul class="pt-3 list-none">
                                
                        <li><!-- Section -->
                            @if (is_null($artifact->section))
                            @else     
                            Class:
                            {{$artifact->section->title}}
                            @endif
                        </li>
           
                        <li><!-- Assignment -->
                            @if (is_null($artifact->assignment))
                            @else     
                            Assignment:
                            <a class="hover:text-red-500" href="{{route('show-assignment', ['section' => $artifact->section_id, 'assignment' => $artifact->assignment_id])}}">
                           {{ $artifact->assignment->title }}</a>
                           @endif
                        </li>
                        
                        <li><!-- Component -->
                           @if (is_null($artifact->component))
                           @else     
                           Component:
                           @role('teacher')
                           <a class="hover:text-red-500" href="{{route('show-component-gallery', ['section' => $artifact->section_id, 'assignment' => $artifact->assignment_id, 'component' => $artifact->component_id])}}">
                           @endrole
                           {{ $artifact->component->title }}</a>
                           @endif
                        </li>
                </ul>
                
                @endif

                </div>

           <div class="" x-data="{openCommentForm: true}">

               <div class="flex items-center pb-2 ">
            
                    <!-- Comment Title -->
                    <div class="flex flex-grow text-gray-500 text-sm">
                    COMMENTS
                    </div>

                    <div class="flex">

                        <!-- Comment Trigger -->
                        <button x-show="openCommentForm" @click="openCommentForm = false"><
                        x-feathericon-x-circle class="w-5 h-5 hover:text-red-500 text-gray-400"/> 
                        </button>

                        <!-- Comment Trigger -->
                        <button class="inline-flex items-center" x-show="!openCommentForm" @click="openCommentForm = true">
                        <span class="hover:text-red-500 text-gray-500 mr-1 text-sm"></span><
                        x-feathericon-plus-circle class="w-5 h-5 hover:text-red-500 text-gray-400"/> 
                        </button>

                        <div x-show="openCommentForm === 'false'">true</div>
        
                    </div>
                </div>
                    
                <div x-show="openCommentForm" class="mb-2">

                    <form id="create_comment" method="POST" action="
                    {{ route('save-comment', ['artifact' => $artifact->id]) }}">
        
                    {{ csrf_field() }}
        
                    <div class="flex flex-1 mt-0 bg-white border rounded-l-lg rounded-r pl-1">

                    <!-- Begin Create Comment Form Input-->
                            <input id="body" class="w-full resize-y px-1 py-1 rounded outline-none border-none text-gray-500 text-sm leading-snug text-sm {{ $errors->has('body') ? 'border-red-500' : 'border' }}" name="body" placeholder="Add Comment"
                            value="{{ old('body') }}" autofocus>{{ old('body') }}</input>
                            
                            {!! $errors->first('body', '<span class="text-red-500 text-sm mt-2">:message</span>') !!}


                            <!-- User ID Input -->
                                    <input id="user_id" type="hidden" name="user_id" value="{{Auth::User()->id}}">

                            <!-- Artifact ID Input -->
                                    <input id="artifact_id" type="hidden" name="artifact_id" value="{{$artifact->id}}">
               
                                    <div class="flex-1 flex-end">
                                    
                                    <button type="submit" class="ml-2 px-3 py-1 rounded-r bg-gray-100 hover:bg-gray-200 items-center flex-end text-sm">Post
                                    </button>
                            
                                    </div>
                </div>
                
                </form>
            </div>

                        </div> 


                    @if ($artifact->comments)

                    <div class="text-left  space-y-1 mt-0 text-sm rounded-lg">

                        @foreach ($artifact->comments as $comment)
            
                            <!-- Begin comment -->

                            <div class="p-0 border-b border-gray-200 flex flex-col bg-yellow-100">
                                
                            <!-- Begin User/Role/Timestamp -->

                            <div class="flex w-full ml-0 pt-1 mx-0 text-sm text-gray-500">
                            
                                
                                <div class="flex-grow pl-2 mb-1">
                                        <span class="font-medium text-gray-500">{{$comment->user->fullName}}</span> - 
                                       <!--  <span class="font-medium text-gray-500 capitalize">{{$comment->user->roles->first()->name}}</span> -  -->

                                        <span class="text-gray-500 text-xs">{{$comment->created_at->diffForHumans()}}</span>
                                    </div>

                                    <div class="flex pr-2">
                                    
                                            <x-jet-dropdown align="right" width="48">
                                    
                                                <x-slot name="trigger">
                                                
                                                    <button class="flex transition duration-150 ease-in-out" tabIndex="-2">
                                                    <x-feathericon-more-horizontal class="w-5 h-5 hover:text-red-500 text-gray-400"/>
                                                    </button>
                                               
                                                </x-slot>
                                               
                                                <x-slot name="content">
                                                    
                                                    <x-jet-dropdown-link 
                                                    href="{{route('edit-comment', $comment->id)}}">Edit Comment
                                                    </x-jet-dropdown-link>

                                                </x-slot>
                                            </x-jet-dropdown>
                                    </div>
                                                                </div>

                            <div class="mr-6 text-sm md:text-xs pl-2 pb-2 leading-tight text-gray-500">{{$comment->body}}</div></div>
                                        

                    @endforeach
                    @else
                    @endif

                    </div>


                    <!-- Level 2 - Section Heading -->

        <div id="infoTitleMenu" x-data="{open: false}" class="flex relative mt-1">
        
            <!-- Section Title -->
            <div class="py-1 flex flex-row flex-grow text-gray-500 text-sm">COLLECTIONS</div>
        
            <!-- Section Menu Trigger -->

            <div class="flex pt-1.5 ">

                <x-jet-dropdown align="right" width="48">
                            
                            <x-slot name="trigger">
                            
                            <button class="flex transition duration-150 ease-in-out" tabIndex="-2">
                            <x-feathericon-menu class="w-5 h-5 hover:text-red-500 text-gray-400"/>
                            </button>
                           
                            </x-slot>
                            <x-slot name="content">
                                
                                 <x-jet-dropdown-link href="{{route('select-collection', $artifact)}}">Add to Collection
                                </x-jet-dropdown-link>

                                <x-jet-dropdown-link href="{{route('create-collection', $artifact)}}">Start a New Collection
                                </x-jet-dropdown-link>
                            </x-slot>
                </x-jet-dropdown>
</div>
           
        </div>

    <!-- Level 2 - Begin Section Content  -->

        <div class="mt-1 py-1 border rounded-lg"> 
            
            @if ($artifact->collections->count() === 0)
                <div class="flex items-center justify-between px-2 py-0 font-medium text-gray-500 text-sm">
                    This artifact is not featured in a collection
                </div>
            @else    
                
                @foreach ($artifact->collections as $collection)

                    <div class="flex items-center justify-between px-2 py-0 font-medium text-gray-500 text-sm">
                    <a  href="{{route('show-collection', $collection)}}" class="hover:text-red-500" >{{ $collection->title }}</a>
                    <a href="{{ route('remove-from-collection', ['artifact' => $artifact, 'collection' => $collection ]) }}" onclick="return confirm('Are you sure you want this removed from the collection?')"><x-feathericon-x class="w-4 h-4 hover:text-red-500 text-gray-400"/></a>
                    </div>

                @endforeach
            
            @endif

        </div>

        </div>

    </div>
</div><!-- end wrapper -->
                    
</x-app-layout>