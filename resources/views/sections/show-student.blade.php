
    


<!-- Show Content -->

                 <div class="max-w-5xl mx-auto grid grid-cols-1 gap-y-4 sm:grid-cols-3 sm:gap-4 bg-cool-gray-400 text-sm text-gray-500" x-data="{ view: 'list' }" >
                  
              <!-- Assignments-->

                <div class="bg-gray-100 rounded-lg">

                <div class="flex bg-white rounded-t-lg items-center py-1">
                  
                    <div class="flex flex-grow pl-3">ASSIGNMENTS</div>
                    <div class="flex pr-2">

                      <x-jet-dropdown align="right" width="48">
                            
                            <x-slot name="trigger">
                            <button class="flex transition duration-150 ease-in-out" tabIndex="-2">
                             <x-feathericon-menu class="w-5 h-5 hover:text-red-500 text-gray-400"/>
                            </button>
                            </x-slot>
                            
                            <x-slot name="content">
                                
                                <x-jet-dropdown-link href="{{route('student-progress', ['section' => $currentSection, 'user' => Auth::User() ]) }}">Progress Report
                                </x-jet-dropdown-link> 

                            </x-slot>
                            
                      </x-jet-dropdown>
                  </div>
                  </div>
                
                <div class="mb-2 p-2 shadow-inner">
                 
                  @if ($sectionAssignments->count() > 0)

                    @foreach ($sectionAssignments as $assignment)

                      @if ($loop->first)
                      <div x-data="{ open: true }" class="w-full mt-0 mb-1 rounded-lg transition">
                      @else
                       <div x-data="{ open: false }" class="w-full mb-1 rounded-lg transition">
                      @endif
                            
                    <a href="{{route('show-assignment', ['assignment' => $assignment->id , 'section' => $currentSection->id])}}" class="w-full text-gray-500 no-underline font-semibold text-sm hover:text-red-500">{{$assignment->title}}</a>     
                    </div>    

                    <!-- Components -->
                  
                  @endforeach
                    

                    <!-- If no assignments -->
                    @else
   
                        <div class="text-gray-600 bg-gray-100 p-2 no-underline rounded-lg text-sm">Nothing assigned. Stay tuned...
                        </div>

                    @endif

                  </div>
                </div>

                 
                    <!-- STUDENTS -->

                    <div class="bg-white rounded-lg px-2 col-span-2">

                      <div class="flex items-center py-1">Class Blog</div>
                      <hr/ class="mb-2">
                      
                      <!-- Begin Assignment--> 

                      <div class="bg-white mb-2" >
                  
                        <div class="">
                 
                      a

                          </div>                         

                          <!-- Components -->
                        

                  </div>

             </div>
             </div>

       <!-- Assignments Content -->
            
           <!--  <div x-show="tab === 'feedback'" class="-mt-px p-4 text-sm">

                <ul>
                  @foreach ($feedback as $comment)
                                   <img class="w-20 h-20" src="https://s3.amazonaws.com/artifacts-0.3/{{$comment->artifact->artifact_thumb}}">

                 <li>{{$comment->body}}</li>
                 <li>{{$comment->user->fullname}}</li>
                 <li>{{$comment->created_at}}</li>
                 @endforeach
                </ul>
            </div>

      </div> -->
      <!-- End Wrapper -->
     
     </div>

      <!-- End Content -->
  </div>
</div>
