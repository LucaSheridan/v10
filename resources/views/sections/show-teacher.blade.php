<!-- Show Content -->

          <div class="max-w-5xl mx-auto grid grid-cols-1 gap-y-3 sm:grid-cols-3 sm:gap-3 bg-cool-gray-400 text-sm text-gray-500 mb-2" x-data="{ view: 'list' }" >
                  
              <!-- Assignments-->

                <div class="bg-gray-100 rounded-lg ">

                <div class="flex items-center justify-between py-1 pl-3 pr-2 bg-white rounded-t-lg">
                  
                ASSIGNMENTS
                
                    @hasrole('teacher')

                      <x-jet-dropdown align="right" width="48">
                            
                            <x-slot name="trigger">
                            <button class="flex transition duration-150 ease-in-out" tabIndex="-2">
                             <x-feathericon-menu class="w-5 h-5 hover:text-red-500 text-gray-400"/>
                            </button>
                            </x-slot>
                            
                            <x-slot name="content">
                                
                                <x-jet-dropdown-link href="{{route('create-assignment', $currentSection)}}"> Create Assignment
                                </x-jet-dropdown-link> 
                            
                             </x-slot>
                            
                      </x-jet-dropdown>

                    @endhasrole

                  </div>
                
                <div class="py-3 pl-3 pr-1 shadow-inner space-y-1 text-xs">
                 
                  @if ($sectionAssignments->count() > 0)

                    @foreach ($sectionAssignments as $assignment)

                      @if ($loop->first)
                      <div x-data="{ open: true }" class="w-full px-1 transition">
                      @else
                       <div x-data="{ open: false }" class="w-full px-1 transition">
                       @endif
                     
                       <span class="inline-flex items-center">

                        <a href="{{route('show-assignment', ['assignment' =>  $assignment->id , 'section' => $currentSection->id])}}" class="inline-flex text-gray-500 no-underline text-sm font-semibold hover:text-red-500">{{$assignment->title}}</a>
                         
                        <x-feathericon-chevron-right x-show="!open" @click="open = ! open" class="inline-block h-4 w-4 text-gray-300"/>
                         
                        <x-feathericon-chevron-down x-show="open" @click="open = ! open" class="inline-block h-4 w-4 text-gray-400"/>
                        
                        </span> 

                      <!--  <span class="float-right">
                      
                                      <x-jet-dropdown align="right" width="48">
                                            
                                            <x-slot name="trigger">
                                            <button class="flex transition duration-150 ease-in-out">
                                            <x-feathericon-more-horizontal class="h-5 w-5 text-gray-300" />
                                            </button>
                                            </x-slot>
                                            
                                            <x-slot name="content">
                                                
                                                @hasrole('teacher')
                                            
                                                  <x-jet-dropdown-link href="{{ route('edit-assignment', ['section' => $currentSection, 'assignment' => $assignment ])}}">
                                                Edit Assignment
                                                </x-jet-dropdown-link> 

                                                <x-jet-dropdown-link href="{{ route('create-component', ['section' => $currentSection, 'assignment' => $assignment ])}}">
                                                Add Component
                                                </x-jet-dropdown-link> 
                                                @endhasrole

                                            </x-slot>
                                            
                                      </x-jet-dropdown>

                               </span>  -->


 <div x-show="open" class="flex flex-col pl-0 pr-1.5 py-2 text-gray-500 space-y-0" @click="open = ! open">
                                                                                          
                                @foreach ( $assignment->components as $component )
                
                                        <div class="flex w-full flex-row leading-tight pt-0 pl-2 border-l-2 border-gray-200">

                                    <div class="flex flex-grow">
                                                        
                                      <a href="{{route('show-component-gallery', ['section' => $assignment->section_id , 'assignment' => $component->assignment_id , 'component' => $component->id ])}}" class="pb-1 m-0 hover:text-red-400 hover:rounded no-underline {{active_check('sections/'.$currentSection->id.'/assignment/'.$assignment->id.'/component/'.$component->id.'/*')}} pr-4">{{ $component->title}}</a>                    
                                    </div>


                                <!-- <div class="flex w-full flex-row leading-tight pl-3 border-l-0 border-gray-200">

                                              <div class="flex flex-grow">
                                                <a href="{{route('show-component-gallery', ['section' => $assignment->section_id , 'assignment' => $component->assignment_id , 'component' => $component->id ])}}" class="pb-1 m-0 hover:text-red-400 hover:rounded no-underline">{{ $component->title}}</a>
                                              </div> -->


                                              <div class="text-gray-500 -mr-1">
                 
   <a href="{{route('edit-component', ['section' => $assignment->section_id , 'assignment' => $component->assignment_id , 'component' => $component->id ])}}">

                                              {{ Carbon\Carbon::parse($component->date_due)->format('n/j') }}</a>
                                              
                                              </div>

                                              <!-- <div class="pl-2 -mr-1">
                                             
                                                  <a href="{{route('edit-component', ['section' => $assignment->section_id , 'assignment' => $component->assignment_id , 'component' => $component->id ]) }}" class="p-0 m-0 hover:text-red-400 no-underline text-sm">
                                                <x-feathericon-more-horizontal class="w-4 h-4 hover:text-red-500 text-gray-400"/>
                                              </a>
                                              </div> -->

                                        </div>



                              @endforeach

                    </div>           

                    </div>    

                    <!-- Components -->
                  
                  @endforeach


                    <!-- If no assignments -->
                    @else
   
                        <div class="text-gray-600 bg-gray-100 p-2 no-underline text-sm rounded-lg">No assignments
                        </div>

                    @endif

                  </div>

                </div>

                 
                    <!-- STUDENTS -->

                    <div class=" col-span-2 bg-gray-100 px-0 shadow-xl rounded-lg">

                        <div class="flex justify-between items-center py-1 pl-2 bg-white rounded-lg">
                        
                          STUDENTS ({{$currentSection->students->count()}})
                          
                         
                          <span x-show="view === 'list'" @click="view = 'gallery'">View <x-feathericon-grid class="inline-flex w-5 h-5 mr-0 hover:text-red-500 text-gray-400 mr-2"/>
                          </span>

                          <span x-show="view === 'gallery'" @click="view = 'list'">View <x-feathericon-list class="inline-flex w-5 h-5 mr-0 hover:text-red-500 text-gray-400 mr-2"/>
                          </span> 
                         
                          </div>

<!-- BEGIN GALLERY-->

                <div id="roster-gallery" x-show="view === 'gallery'" class="p-2 bg-gray-100 mb-2 shadow-inner" >
                
                <ul class="grid grid-cols-3 sm:grid-cols-3 lg:grid-cols-4 gap-2 ">

                    @foreach ($currentSection->students as $student)

                            
             <li class="col-span-1 bg-white rounded-lg shadow-xl">
    
    <div class="flex p-1 rounded-lg">
       
        <div class="flex-shrink-0">

                  @if ( !empty($student->profile_photo_path))

                      <!-- JetStream Profile Photo -->
                      <img src="{{  $student->profile_photo_path }}" class="rounded-full w-10 h-10 sm:w-16 sm:h-16 border border-cool-gray-200">

                  @else
                      
                      <!-- TailwindUI Avatar -->
                      <span class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-cool-gray-200">
                      <span class="text-sm sm:text-md font-medium leading-none text-gray-500">
                      {{ $student->initials }}
                      </span>
                      </span>
            
                  @endif

          <!--   <img class="w-8 sm:w-10 h-8 sm:h-10 bg-gray-300 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=256&amp;h=256&amp;q=60" alt=""> -->
        </div>
      
        <div class="flex px-1 items-start leading-tight">
        <span class="text-gray-500 text-xs sm:text-sm font-medium">
        <a href="{{route('student-progress', ['section' => $currentSection, 'user' => $student ])}}">{{$student->fullName}}</a></span>
          </div>
    </div>
    
    <div class="">
      
      <div class="flex px-1 space-x-1 mb-1 text-xs">
        
            

       <!--  <div class="flex items-center bg-gray-100 rounded-lg px-2">
                         
                    <div>
                    <x-feathericon-image class="w-4 h-4 text-gray-400"/>
                    </div>
                    
                    <div class="ml-1">{{$student->artifacts->count()}}
                    </div>
        </div> -->

       <!--  <div class="flex items-center bg-gray-100 rounded-lg px-2">
                         
                    <div>
                    <x-feathericon-briefcase class="w-4 h-4 hover:text-red-500 text-gray-400"/>
                    </div>

                    <div class="ml-1">{{$student->collections->count()}}
                    </div>
        </div>
 -->
      

        <!-- Space Filler -->
       <!--  <div class="flex flex-grow"></div>
        --> 
        <!-- Email-->
       <!--  <div class="flex rounded-full w-6 h-6 bg-gray-100 items-center justify-center">
           
        <a href="mailto:{{$student->email}}">
        <x-feathericon-mail class="h-4 w-4"/>
        </a>
                            
        </div> -->
      

      </div>
    </div>

                          @endforeach

                      </ul>
                   </div>


<!-- Begin List--> 

                    <div id="roster-list" x-show="view === 'list'" class="bg-gray-100 mb-2 shadow-inner" >
                                   
                       
                      <div class="rounded-br-lg no-underline text-sm shadow-inner p-2" >

 @if ($currentSection->students->count() > 0)

                                   <!-- <ul class="grid grid-cols-3 sm:grid-cols-3 lg:grid-cols-4 rounded-lg gap-2"> -->

<ul class="grid rounded-lg grid-cols-3 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 xl:text-xs rounded-lg gap-2 mt-3">

                                    
                                    @foreach ($currentSection->students as $student)                                    
                                   
                                    <a href="{{route('student-progress', ['section'=> $currentSection, 'user' => $student])}}">

                                    
                                    
                                    <li class="mx-1 rounded-sm text-gray-600 text-sm hover:text-red-500">
                                    {{ $student->fullName}}</li>
                                   

                                    </a>
                                    
                                    @endforeach
                                    </ul>


                        @else
           
                                No students are currently enrolled in this class.
                            
                        @endif
                      </div>


                  </div>

             </div>
             </div>
     
     </div>


     

      <!-- End Content -->
  </div>
</div>


                        
