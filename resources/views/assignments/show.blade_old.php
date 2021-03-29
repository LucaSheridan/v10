<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl text-gray-100 leading-tight">
            Assignment
        </h2>
    </x-slot>
      
 <!-- Class Nav -->
        
        <div class="flex max-w-5xl mx-auto mt-4 px-3 text-sm no-underline items-center items-stretch">

    <!-- Class Pills -->

            <div class="flex-grow py-3 bg-white px-1 text-gray-500 aliased rounded-l-lg space-x-1">
                 
                 @if (Auth::User()->activeSections()->count() > 0)

                    @foreach ( Auth::User()->activeSections as $section)  

                         <a class="p-2 my-1 ml-1 rounded-lg bg-gray-200 hover:bg-gray-300 hover:text-gray-700 text-md {{active_check('sections/'.$section->id.'/*')}}"
                         href="{{route('show-section', $section->id)}}">
                         {{ $section->title}}</a>

                    @endforeach

                    @else
                    <p>You are currently have no classes.</p>
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
                          
                          @hasrole('teacher')
                          <x-jet-dropdown-link href="{{route('edit-section', $currentSection)}}">
                          Edit Class
                          </x-jet-dropdown-link>
                          <x-jet-dropdown-link>
                          <form action="{{route('destroy-section', $currentSection)}}" method="POST">
                          {{ csrf_field() }}
                          <input type="hidden" name="_method" value="DELETE">

                          <button onclick="return confirm('Are you sure you want to delete this?')">Delete Class</button>
                                            
                          </form>
                          </x-jet-dropdown-link>
                           <x-jet-dropdown-link href="{{route('create-section')}}">
                          Create Class
                          </x-jet-dropdown-link>
                          @else
                          <x-jet-dropdown-link>
                          Join a New Class
                          </x-jet-dropdown-link>
                          @endhasrole

                      </x-slot>
                </x-jet-dropdown>
           </div>
        </div>

        <!-- End Class Options -->

   {{-- Start Assignment Row --}}



   <div class="flex p-0 flex-wrap px-4  mt-4 max-w-5xl mx-auto">
         
         {{-- Start Assignment Column One --}}

            <div class="w-full md:w-2/5 border-cool-gray-400 mb-4 sm:mb-0 sm:border-r-8 ">
             
          
            {{--  Assignment Header  --}}

            <div class="flex items-center mt-0 mb-1">
           
            {{-- Assignments Title --}}
       
            <div class="flex-grow mb-0 px-2 text-left text-2xl rounded-br-lg text-gray-200">
            {{$activeAssignment->title}}</div>
        
            {{-- Assignment Menu --}}

                   <div class="flex relative text-left">
                    
                    <x-jet-dropdown align="right" width="48">
                          <x-slot name="trigger">
                          
                          <button class="flex transition duration-150 ease-in-out" tabIndex="-2">
                          <x-feathericon-menu class="w-5 h-5 hover:text-red-500 text-gray-100"/>
                          </button>
                         
                          </x-slot>
                          <x-slot name="content">
                              
                              <x-jet-dropdown-link 
                              href="{{action('App\Http\Controllers\AssignmentController@edit', ['section' => $currentSection , 'assignment' => $activeAssignment])}}">
                              Edit Assignment
                              </x-jet-dropdown-link>

                              <x-jet-dropdown-link>
                              <form id="delete_assignment" method="POST" action="{{ route('destroy-assignment', ['section' => $section, 'assignment' => $activeAssignment ]) }}">
                              {{ csrf_field() }}
                              <input type="hidden" name="_method" value="DELETE">
                              <button type="submit" onclick="return confirm('Are you sure you want to delete this?')">Delete</button>
                              </form>
                              </x-jet-dropdown-link>

                          </x-slot>
                    </x-jet-dropdown>




               
            </div>

        </div>

           <div class="bg-gray-100 p-1 rounded-l-lg rounded-br-lg mb-2 sm:mb-2">

            

        <div class="p-2 text-sm leading-tight text-gray-600">
        <div class="font-semibold mb-1 text-gray-500"></div>{{ $activeAssignment->description}}</div>

        {{-- End Assignment Content for Mobile --}}

        </div>

        {{-- End Assignment Wrapper --}}

        </div>

        {{-- close column 1 yellow --}}   


{{-- START Column 2 --------------------------------------------------------------------------------------------}}

 <div class="w-full md:w-3/5 border-red-500 mb-4">
             
           {{--  Assignment Header  --}}

            <div class="flex items-center mt-0 mb-1">
           
            {{-- Assignments Title --}}
       
            <div class="flex-grow mb-0 px-2 text-left text-2xl rounded-br-lg text-gray-200">
                COMPONENTS                    
            </div>
        
            {{-- Assignment Menu --}}

                   <div class="flex relative text-left">
                                        
                    <x-jet-dropdown align="right" width="48">
                          <x-slot name="trigger">
                          
                          <button class="flex transition duration-150 ease-in-out" tabIndex="-2">
                          <x-feathericon-menu class="w-5 h-5 hover:text-red-500 text-gray-100"/>
                          </button>
                         
                          </x-slot>
                          <x-slot name="content">
                              
                              <x-jet-dropdown-link 
                              href="{{action('App\Http\Controllers\ComponentController@create', ['section' => $currentSection , 'assignment' => $activeAssignment])}}">Create Component
                              </x-jet-dropdown-link>

                              

                          </x-slot>
                    </x-jet-dropdown>
                                           
                
            </div>

        </div>
           {{-- Start Component Content --}}

           <!-- Check if Assignments exist -->

            <div class="bg-gray-100 p-1 rounded-l-lg rounded-br-lg mb-2 sm:mb-2">

                 @if ($sectionAssignments->count() > 0)

                        <!-- If they do, loop through the assignments -->    
                
                        @if ($activeAssignment->components->count() < 2)

                                <div class="block body text-gray-600 text-sm mt-0 mb-0">
                                                                                          
                                    @foreach ( $activeAssignment->components as $component )

                                    {{-- Components --}}

                                    <div class="p-1">
                            
                                        <a href="{{route('show-component-gallery', ['section' => $activeAssignment->section_id , 'assignment' => $component->assignment_id , 'component' => $component->id ])}}" class="p-0 m-0 hover:text-red-400 hover:rounded no-underline text-sm">
                                        {{ $component->title}}</a>
                                        
                                        {{-- <a href="{{action('ComponentController@edit', ['section' => $assignment->section_id , 'assignment' => $component->assignment_id , 'component' => $component->id ]) }}" class="p-0 m-0 hover:text-red-400 no-underline text-sm"> --}}
                                        
                                        <span class="float-right">
                                        @if (is_null($component->date_due))
                                        N/A
                                        @else
                                        {{ Carbon\Carbon::parse($component->date_due)->format('m/j/y') }}
                                        </a>
                                        @endif
                                        </span>
                                    
                                    </div>
                    
                                @endforeach

                                </div>                                    

                        @else

                            {{-- Multi Component --}}

                                    <div class="text-gray-600 text-sm">
                                                                                          
                                        @foreach ( $activeAssignment->components as $component )

                                        {{-- Components --}}

                                            <div class="flex items-center leading-tight">
                            
                                            <div class="flex flex-grow pl-2">
                                                
                                                
                                                 <a href="{{route('show-component-gallery', ['section' => $activeAssignment->section_id , 'assignment' => $activeAssignment->id , 'component' => $component->id ])}}" class="p-0 m-0 hover:text-red-400 hover:rounded no-underline text-sm">
                                                {{ $component->title}}</a>

                                            </div>

                                            <div class="flex mr-2">
                                                {{-- <a href="{{action('ComponentController@edit', ['section' => $assignment->section_id , 'assignment' => $component->assignment_id , 'component' => $component->id ]) }}" class="hover:text-red-400 no-underline text-sm">  --}}    
                                                    @if (is_null($component->date_due))
                                                    N/A
                                                    @else
                                                    Due {{ Carbon\Carbon::parse($component->date_due)->format('m/j') }}
                                                     @endif
                                              <!--   </a> -->
                                            </div>
                                            
                                            <div class="flex mr-1 relative">
    
                    <x-feathericon-menu class="w-5 h-5 hover:text-red-500 text-gray-100"/>

                    <div class="z-10 absolute top-0 right-0 shadow-2xl bg-gray-700 text-gray-400 rounded py-1 list-none text-left leading-normal whitespace-no-wrap">

                        {{-- <a href="{{action('ComponentController@edit', ['section' => $assignment->section_id , 'assignment' => $component->assignment_id , 'component' => $component->id ]) }}" class="hover:text-gray-200 no-underline text-sm"> --}}
                                         
                       <!--  <div class="flex items-center">
                        <div class="pr-2 text-gray-500">
                        @icon('edit', ['class' => 'w-5 h-5 hover:text-gray-200'])</div>
                         <div>Edit</div>
                        </div>
                        </a> --}}
-->

                       <!--  <li class="hover:text-gray-300 px-3">
                        {{-- <a class="" href="{{action('ComponentController@delete', ['section' => $currentSection , 'assignment' => $activeAssignment, 'component' => $component])}}"> 
                        <div class="flex items-center">
                        <div class="pr-2 text-gray-500">
                        @icon('x-circle', ['class' => 'w-5 h-5 hover:text-gray-200'])</div>
                         <div>Delete</div>
                        </div>
                        </a> --}}
                        </li> -->
               
                    </div>
                    
                    </div>



                                            </div>
                    
                                    @endforeach

                            </div>                                            

                        @endif
        
                    </div>                                            
                     </accordion>

                            @else
           
                                <div class="text-gray-600 bg-gray-100 p-2 no-underline text-sm">No assignments
                                </div>            
                            
                            @endif
            </div>
            </div>
            </div>

    </body>

    

</x-app-layout>

