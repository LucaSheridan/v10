<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl text-gray-100 leading-tight">
            Classes
        </h2>
    </x-slot>

    <!-- Class Nav -->
        
        <div class="flex max-w-5xl mx-auto mt-4 px-3 text-sm no-underline items-center items-stretch">

    <!-- Class Pills -->

            <div class="flex-grow py-3 bg-white px-1 text-gray-500 aliased rounded-l-lg space-x-1">
                 
                 @if (Auth::User()->activeSections()->count() > 0)

                    @foreach ( Auth::User()->activeSections as $section)  

                         <a class="p-2 my-1 ml-1 rounded-lg bg-gray-200 hover:bg-gray-300 hover:text-gray-700 text-md {{active_check('sections/'.$section->id)}}"
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
        
        <!-- Begin Content -->

        <div class="max-w-5xl mx-auto mt-4 w-full px-3">
            
            <!-- Roster -->
            
            
                    <div id='Roster'>

            <div class="p-2 overflow-hidden shadow-xl bg-white rounded-lg">

            <ul class="grid grid-cols-3 gap-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 xl:grid-cols-6">

             @foreach ($currentSection->students as $student)

    
                <li class="col-span-1 flex flex-col text-left bg-gray-200 rounded-lg shadow">
                
                    <div class="flex-1 flex flex-col pt-2">
                    
                          <!-- <img class="w-20 h-20 border-2 border-red-400 flex-shrink-0 mx-auto bg-black rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=256&amp;h=256&amp;q=60" alt="">
 -->
                          <!-- TailwindUI Avatar -->
                          <div class="flex items-center justify-center w-20 h-20 border-2 border-red-400 flex-shrink-0 mx-auto text-center rounded-full bg-cool-gray-400 text-4xl font-medium leading-none uppercase text-white">
                          {{ $student->initials }}
                          </div>
                         
                          <h3 class="my-2 text-gray-900 text-center text-sm leading-5 font-medium">{{$student->fullName}}</h3>
                   
                    </div>
              </li>

            @endforeach

          </ul>
        </div>

        Middle

        <div id='Assignemnts'>

      <!-- End Roster -->

      <!-- Start Assignments -->
      <div class="p-2 mt-4 overflow-hidden shadow-xl bg-white rounded-lg">

      Assignments

      {{-- Start Assignment Content for Desktop --}}

        <div id="accordion" class="border-0 p-0"> 

                @if ($sectionAssignments->count() > 0)

                    @foreach ($sectionAssignments as $assignment)

                        <accordion class="block bg-gray-100 m-0 p-2 hover:bg-gray-300 rounded-lg">
            
                        <div slot="header">
                    

                        <a href="{{route('show-assignment', ['assignment' => $assignment->id , 'section' => $currentSection->id])}}" class="text-gray-600 no-underline font-bold text-sm hover:text-red-500">

                        {{$assignment->title}}
                        </a>

                        {{-- Add Due Date to Header if a Single Component Assignment --}}

                            @if ($assignment->components->count() < 2 )
                                <span class="float-right text-sm text-gray-600">
                                
                                @foreach ( $assignment->components as $component )
                                
                                    @if (is_null($component->date_due))
                                    N/A
                                    @else
                                    {{ Carbon\Carbon::parse($component->date_due)->format('m/j/y') }}
                                    @endif
                                
                                @endforeach
                                
                                </span>
                            @else
                                {{-- No due date next to the assignment title --}}
                            @endif
                
                        @if ($assignment->components->count() < 2)

                        </accordion>

                        @else

                            <div class="block body text-gray-600 text-sm mt-2">
                                                                                          
                                @foreach ( $assignment->components as $component )
                
                                    <div class="pl-2 mt-1 leading-tight">
                            
                                        {{--<a href="{{action('ComponentController@gallery', ['section' => $assignment->section_id , 'assignment' => $component->assignment_id , 'component' => $component->id ])}}" class="p-0 m-0 hover:text-red-400 hover:rounded no-underline text-sm">--}}
                                        {{ $component->title}}</a>

                                        <span class="float-right">
                                        {{--<a href="{{action('ComponentController@edit', ['section' => $assignment->section_id , 'assignment' => $component->assignment_id , 'component' => $component->id ]) }}" class="p-0 m-0 hover:text-red-400 no-underline text-sm">--}}
                                        {{ Carbon\Carbon::parse($component->date_due)->format('m/j/y') }}</a>
                                        </span>
                                    
                                    </div>
                    
                            @endforeach

                            </div>                                           

                        @endif
        
                    </div>                                            
                     </accordion>

                  @endforeach

                            @else
           
                                <div class="text-gray-600 bg-gray-100 p-2 no-underline text-sm">No assignments
                                </div>            
                            
                            @endif

                    </div>

                    {{-- End Assignment Wrapper --}}


      </div>end
      <!-- End Assignments -->
      <!-- End Wrapper -->
      </div>

      <!-- End Content -->
                        
        </x-app-layout>
