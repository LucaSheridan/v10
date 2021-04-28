<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl text-gray-100 leading-tight">
            Component Gallery
        </h2>
    </x-slot>

<!-- Section Menu -->

@include('partials.sectionNav') 

<!-- Begin Content -->

     <div class="max-w-5xl mx-auto grid grid-cols-1 gap-y-4 sm:grid-cols-3 sm:gap-3 bg-cool-gray-400 text-sm text-gray-500" x-data="{ tab: 'assignments' }" >
                            
              <!-- Assignments -->


                @role('teacher')
                
                <div class="bg-gray-100 rounded-lg">

                    <div class="flex items-center py-1 pl-3 bg-white rounded-t-lg">
                      <div class="flex flex-grow"><a href="{{route('show-section', $currentSection)}}">ASSIGNMENTS</a>
                      </div>
                    </div>
                                  
                             <div class="py-3 pl-3 pr-1 shadow-inner space-y-1 text-xs">
                 
                  @if ($sectionAssignments->count() > 0)

                    @foreach ($sectionAssignments as $assignment)

                       @if ( $assignment->id == $activeAssignment->id)
                      <div x-data="{ open: true }" class="w-full px-1 transition">
                      @else
                       <div x-data="{ open: false }" class="w-full px-1 transition">
                      @endif


                     
                       <span class="inline-flex items-center">

                        <a href="{{route('show-assignment', ['assignment' =>  $assignment->id , 'section' => $currentSection->id])}}" class="inline-flex text-gray-500 no-underline text-sm font-semibold hover:text-red-500">{{$assignment->title}}</a>
                         
                        <x-feathericon-chevron-right x-show="!open" @click="open = ! open" class="inline-block h-4 w-4 text-gray-300"/>
                         
                        <x-feathericon-chevron-down x-show="open" @click="open = ! open" class="inline-block h-4 w-4 text-gray-400"/>
                        
                        </span> 

                        <div x-show="open" class="flex flex-col pl-0 pr-1.5 py-2 text-gray-500 space-y-0" @click="open = ! open">
                                                                                          
                                @foreach ( $assignment->components as $component )
                
                                    <div class="flex w-full flex-row leading-tight pt-0 pl-2 border-l-2 border-gray-200">

                                    <div class="flex flex-grow">
                                                        
                                      <a href="{{route('show-component-gallery', ['section' => $assignment->section_id , 'assignment' => $component->assignment_id , 'component' => $component->id ])}}" class="pb-1 m-0 hover:text-red-400 hover:rounded no-underline {{active_check('sections/'.$currentSection->id.'/assignment/'.$assignment->id.'/component/'.$component->id.'/*')}} pr-4">{{ $component->title}}</a>                    
                                    </div>

                                    <div class="text-gray-500 -mr-1">
                 
                                    <a href="{{route('edit-component', ['section' => $assignment->section_id , 'assignment' => $component->assignment_id , 'component' => $component->id ])}}">

                                    {{ Carbon\Carbon::parse($component->date_due)->format('n/j') }}</a>
                                              
                                    </div>

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

                 @endrole

                 
 <!-- STUDENTS -->

                    @role('teacher')
                    <div class="col-span-2 bg-gray-100 rounded-lg px-0 pb-2">
                    @else
                    <div class="col-span-3 bg-gray-100 rounded-lg px-0 pb-2">
                    @endrole

                      <div class="flex bg-white rounded-t-lg items-center py-1">
                        
                          @role('teacher')
                          <div class="flex flex-grow pl-2">STUDENT GALLERY: </div>
                          @else
                          <div class="flex flex-grow text-2xl text-red-500">{{ $activeAssignment->title}} / {{$activeComponent->title}}</div>
                          @endrole
                          
                          <!-- hide menu -->
                          <div class="flex pr-2">
                         
                              <x-jet-dropdown align="right" width="48">
                                    
                                    <x-slot name="trigger">
                                    <button class="flex transition duration-150 ease-in-out" tabIndex="-2">
                                     <x-feathericon-menu class="w-5 h-5 hover:text-red-500 text-gray-400"/>
                                    </button>
                                    </x-slot>
                                    
                                    <x-slot name="content">
                                        
                                       
                                        <x-jet-dropdown-link href="#">Email Class</a>

                                        </x-jet-dropdown-link> 

                                        <x-jet-dropdown-link href="#">Invite Students</a>
                                        </x-jet-dropdown-link>
                                        

                                    </x-slot>
                                    
                              </x-jet-dropdown>
                               </div>

                        </div>

                  <div class="shadow-inner">
                    
                    <ul class="p-2 grid grid-cols-3 sm:grid-cols-3 gap-3 rounded-b-lg">

   @foreach ($students as $student)

        <li class="col-span-1 bg-white rounded-lg shadow">
  
             <div class="flex p-1 rounded-lg">
                 <!-- <div class="flex-shrink-0">
                 
                  <img class="w-8 sm:w-10 h-8 sm:h-10 bg-gray-300 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=256&amp;h=256&amp;q=60" alt="">
                  
                  </div> -->
            
                  <div class="flex px-1 items-start leading-tight">
                  <span class="text-gray-900 text-sm">
                  <a href="{{route('student-progress', ['section' => $currentSection, 'user' => $student ])}}">{{$student->fullName}}</a>
                   </span>
                   </div>
              </div>

              <div class="flex rounded-lg m-1 bg-white pb-3">
      
             @if ($student->artifacts->count() < 1)

              <div class="flex inline-flex items-center">...</div>
              @else

                  @foreach ($student->artifacts as $artifact) 
                  

                     <div x-data="{ modalOpen: false }">
                                               
        <button @click="modalOpen = true">                                               
        <img class="flex" src="https://s3.amazonaws.com/artifacts-0.3/{{$artifact->artifact_path}}">
         </button>
   
        <div class="absolute inset-0 h-full w-full rounded bg-black flex justify-center items-center z-10 p-10" x-show="modalOpen" @click="modalOpen = false">
        <img class="flex object-scale-down" src="https://s3.amazonaws.com/artifacts-0.3/{{$artifact->artifact_path}}">
        </div>

    
        </div>

                  
                  @endforeach   
              @endif
              
              </div>
        
         </li>
            
            @endforeach   
     </ul>

      </div>
  
  

</div>
     
</x-app-layout>




