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
                                  
                    <div class="px-2 pt-3 mb-2 shadow-inner">

                    @foreach ($sectionAssignments as $assignment)

                      @if ( $assignment->id == $activeAssignment->id)
                      <div x-data="{ open: true }" class="w-full mb-0 rounded-lg transition">
                      @else
                       <div x-data="{ open: false }" class="w-full mb-0 rounded-lg transition">
                      @endif
                            
                      <span class="" @click="open = ! open">
                      <x-feathericon-chevron-right x-show="!open" class="inline-block h-4 w-4 text-gray-300"/></span>

                      <span class="" @click="open = ! open"><x-feathericon-chevron-down x-show="open" class="inline-block h-4 w-4 text-gray-400"/></span>

                      <a href="{{route('show-assignment', ['assignment' => $assignment->id , 'section' => $currentSection->id])}}" class="text-gray-500 font-semibold no-underline hover:text-red-500 pl-0">
                                                           
                      {{$assignment->title}}
                      
                      </a>
                            
                      <div x-show="open" class="flex flex-col pl-6 pr-1.5 py-2 text-gray-500 text-xs space-y-0">
                                                                                          
                                @foreach ( $assignment->components as $component )
                
                                        <div class="flex w-full flex-row leading-tight pl-2 border-l-2 border-gray-200 ">

                                              <div class="flex flex-grow max-w-10">
                                              
    <a href="{{route('show-component-gallery', ['section' => $assignment->section_id , 'assignment' => $component->assignment_id , 'component' => $component->id ])}}" class="pb-1 m-0 hover:text-red-400 hover:rounded no-underline {{active_check('sections/'.$currentSection->id.'/assignment/'.$assignment->id.'/component/'.$component->id.'/*')}}">

                                              {{ $component->title}}</a>
                                              
                                              </div>

                                              <div class="px-2 -mr-1">
                                             
                                                 <a href="{{route('edit-component', ['section' => $assignment->section_id , 'assignment' => $component->assignment_id , 'component' => $component->id ]) }}" class="p-0 m-0 hover:text-red-400 no-underline">
                                                
                                                 {{ Carbon\Carbon::parse($component->date_due)->format('n/j') }}
                                              </a>
                                              </div>

                                        </div>



                              @endforeach

                    </div>                         
                    </div>    

                    <!-- Components -->
                  
                  @endforeach
                  
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
                  <span class="text-gray-900 text-sm font-medium">
                  <a href="{{route('student-progress', ['section' => $currentSection, 'user' => $student ])}}">{{$student->fullName}}</a>
                   </span>
                   </div>
              </div>

              <div class="flex rounded-lg m-1 bg-gray-100">
      
             @if ($student->artifacts->count() < 1)

              <div class="flex inline-flex items-center justify-center">...</div>

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




