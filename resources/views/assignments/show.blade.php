<x-app-layout>
    
    <x-slot name="header">
        <h2 class="text-2xl text-gray-100 leading-tight">
            Show Assignment
        </h2>
    </x-slot>

<!-- Section Menu -->

@include('partials.sectionNav') 

<!-- Begin Page Content -->

             <div class="max-w-5xl mx-auto grid grid-cols-1 gap-y-4 sm:grid-cols-3 sm:gap-3 bg-cool-gray-400 text-sm text-gray-500" >
                            
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
                
                <div class="py-3 px-1 shadow-inner space-y-0 text-xs">
                 
                  @if ($sectionAssignments->count() > 0)

                    @foreach ($sectionAssignments as $assignment)

                      @if ($loop->first)
                      <div x-data="{ open: true }" class="w-full py-0 px-1 transition">
                      @else
                       <div x-data="{ open: false }" class="w-full pt-0 px-1 transition">
                       @endif
                     
                            <!-- Dropdown and Editing Components -->
                         
                         <span class="" @click="open = ! open"><x-feathericon-chevron-right x-show="!open" class="inline-block h-4 w-4 text-gray-300"/></span>

                          <span class="" @click="open = ! open">
                          <x-feathericon-chevron-down x-show="open" class="inline-block h-4 w-4 text-gray-400"/></span> 

                              <a href="{{route('show-assignment', ['assignment' => $assignment->id , 'section' => $currentSection->id])}}" class="text-gray-500 no-underline text-sm font-semibold hover:text-red-500">{{$assignment->title}}</a>          

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
                 
<!-- Begin Assignment Content -->
                  
                  <div class="col-span-2 bg-white rounded-lg  p-2">

                   <div class="flex bg-gray-100 rounded-t-lg">
                        
                      <!-- Assignment Title -->
                      <div class="flex flex-grow text-2xl px-2 text-gray-500">
                      {{$activeAssignment->title}}
                      </div>
                      
                      <!-- Assignment Menu -->
                      @role('teacher')
                      
                      <div class="flex pt-2 pr-2">
                       <x-jet-dropdown align="right" width="48">
                                    
                              <x-slot name="trigger">
                              <x-feathericon-menu class="w-5 h-5 hover:text-red-500 text-gray-400"/>
                              </x-slot>
                                    
                              <x-slot name="content">
                                  
                                   <x-jet-dropdown-link href="{{route('edit-assignment', ['section' => $currentSection, 'assignment' => $activeAssignment ]) }}">Edit Assignment
                                   </x-jet-dropdown-link> 

                                   <x-jet-dropdown-link>
                                      <form id="delete_assignment" method="POST" action="{{ route('destroy-assignment', ['section' => $assignment->section_id, 'assignment' => $assignment->id ]) }}">
                                      {{ csrf_field() }}
                                      <input type="hidden" name="_method" value="DELETE">
                                      <button type="submit" onclick="return confirm('Are you sure you want to delete this assignment?')">Delete Assignment</button>
                                       </form>
                                    </x-jet-dropdown-link> 
                                    <hr class="mt-2 mb-1" />
                                    <x-jet-dropdown-link href="{{ route('create-component', ['section' => $currentSection, 'assignment' => $assignment ])}}">
                                       Add Component
                                    </x-jet-dropdown-link> 
                                    
                                    </x-slot>
                                    
                              </x-jet-dropdown>
                              </div>                      
                            @endrole 
                      </div>
                      
        <div class="bg-gray-100 px-2 pb-3 rounded-b-lg mb-2 text-sm pr-10">
        {{$activeAssignment->description}}

        </div>

<!-- Begin Assignment Components List  -->

         <div class="bg-gray-100 p-2 rounded-lg">
  
         <div class="bg-white rounded-lg p-2">
                          
<!--  Student Table Begins -->
    @role('student')
    <table class="w-full">
          <tr class="text-gray-600">
          <td class="text-center"></td>
          <td class="">Component</td>
          <td class="py-2">Due Date</td>
          <td class="text-center">Options</td>
          <td></td>
          </tr>

          @foreach ($checklist as $checklistItem)
          <tr class="border-t-2">
          <td> 

            @php
              
              $duedate = Carbon\Carbon::parse($checklistItem->componentDateDue);
              $submitted = Carbon\Carbon::parse($checklistItem->artifactCreatedAt)->subHours(5);                   
              @endphp


              @if (!$checklistItem->artifactCreatedAt)
              @else
              <a href="{{ route('show-artifact', $checklistItem->artifactID) }}">
                <img class="flex flex-shrink-0 w-12 h-12 border-4 border-white rounded-lg" src="https://s3.amazonaws.com/artifacts-0.3/{{$checklistItem->artifactPath}}" 

                title="Due: {{$duedate->format('m/d g:i A')}} - Submitted: {{$submitted->format('m/d g:i A') }}">
              </a>
              @endif
          </td>
          <td class="">
          <div class="flex">
            <div class="flex">
          
                @if (!$checklistItem->artifactCreatedAt)

                <a href="{{action('App\Http\Controllers\ArtifactController@create', ['section' => $currentSection , 'assignment' => $checklistItem->assignmentID , 'komponent' => $checklistItem->componentID ])}}">
                <x-feathericon-plus-circle class="w-5 h-5 text-gray-500 mr-2"/></a>
                
                
                <a href="#create-artifact">
                <x-feathericon-camera class="w-5 h-5 hover:text-red-500 "/>
                </a>

                <!-- Create Modal-->

                    <x-v10_confirmation-modal name="create-artifact" height="h-60" >
              
                      <x-slot name="title">
                      Create New Artifact
                      </x-slot>

                      <x-slot name="body">
                      
                      <form action="{{route('save-artifact')}}" role="form" method="POST" enctype="multipart/form-data"class="">

                      {!! csrf_field() !!}

                      <input type="hidden" name="user_id" value="{{ Auth::User()->id }}"><br/>

                       {{-- Pass Artifact if variable is set --}}
                     
                      <input type="hidden" name="section_id" value="{{$checklistItem->sectionID}}">
                      <input type="hidden" name="assignment_id" value="{{$checklistItem->assignmentID}}">
                      <input type="hidden" name="component_id" value="{{$checklistItem->componentID}}">
                      
                      <label for="file" class="block mx-auto text-gray-600 mt-2 text-center p-2 rounded">
                       
                       <div class="relative flex items-center justify-center text-gray-600">
                          <div class="p-2 bg-cool-gray-400 text-white hover:bg-gray-500 hover:text-gray-100 rounded-full">
                          <x-feathericon-camera class="h-8 w-8" />
                          </div>
                       </div>

                      </label>

                      <input name="file" type="file" value="{{ old('file') }}" id="file" >
                        
                      <div class="w-full text-center mb-2 p-1 rounded" id="filename"></div>

                @if ($errors->has('file'))
                <div class="help-block mb-4 text-red-500">
                {{ $errors->first('file') }}
                </div>
                @endif

            </x-slot>

            <x-slot name="footer">

                        <div id="fileSubmitButton"  x-data="{ clicked: false }" class="block">

                              <x-jet-button type="submit"  @click="clicked = true">
                              <span>{{ __('Upload') }}</span>
                              </x-jet-button>

                              <div class="flex bg-gray-300 items-center justify-center" x-show="clicked">
                              
                              <p>Processing</p>
                              <x-feathericon-refresh-cw class="rounded-full bg-green-300 animate-spin text-gray-900"/>
                              </div>

                        </div>

                        </form>

                        <hr/>
                         <a class=
                         "text-xs" href="#create-artifact-from-url"> Click here to upload from URL
                         </a>

                      </x-slot>
            
            </x-v10_confirmation-modal>

<!--End Create Modal  -->

                @else

                   <!-- ue: {{ $duedate }}<br/>
                   pos: {{ $submitted }} -->
        
                    @if ($submitted <= $duedate)
                        <!-- Display Green Check -->
                        <x-feathericon-check-circle class="w-5 h-5 text-green-500 mr-2"/>

                    @else 
                        <!-- Display Yellow Check -->
                        <x-feathericon-check-circle class="w-5 h-5 text-yellow-400 mr-2"/>
                    @endif
                @endif
          
            </div>
            <div class="flex flex-grow">
            {{ $checklistItem->componentTitle }}
            </div>
          </div>
          </td>

          <!-- Due Date -->
          <td class="py-2">
              @if (is_null($checklistItem->componentDateDue))
                <div class="ml-3">
                -
                <div>
              @else
                <div class="hidden md:block">{{ Carbon\Carbon::parse($checklistItem->componentDateDue)->format('D, M jS @ g:ia')}}</div>
                <div class="md:hidden">{{ Carbon\Carbon::parse($checklistItem->componentDateDue)->format(' n/j/y @ g:ia')}}</div>
              @endif
          </td>
          
          <!-- Options-->
          <td class="text-center">

          <div class="flex justify-center items-center">
       
                 <x-jet-dropdown align="right" width="48">
                        
                         <x-slot name="trigger">
                         <x-feathericon-more-horizontal class="w-5 h-5 hover:text-red-500 text-gray-400"/>
                          <button class="flex transition duration-150 ease-in-out">
                          </button>
                         
                          </x-slot>
                          <x-slot name="content">
                              
                               <x-jet-dropdown-link href="{{action('App\Http\Controllers\ArtifactController@create', ['section' => $currentSection , 'assignment' => $checklistItem->assignmentID , 'komponent' => $checklistItem->componentID ])}}" class="text-left">
                                  Add Artifact
                                 </x-jet-dropdown-link>

                                 @if ($checklistItem->componentClassViewable == 1 ) 

                                 <x-jet-dropdown-link href="{{route('show-component-gallery', 

                                 ['section' => $currentSection , 'assignment' => $activeAssignment , 'component' => $checklistItem->componentID ])}}" class="text-left">
                                 View classmates work
                                 </x-jet-dropdown-link>

                                 @endif

                                 @if ($checklistItem->artifactID)                   

                                 <x-jet-dropdown-link href="{{route('unsubmit-artifact', $checklistItem->artifactID)}}" class="text-left" onclick="return confirm('Are you sure you want to unsubmit this artifact?')">
                                    Unsubmit
                                 
                                 </x-jet-dropdown-link> 

                                 <x-jet-dropdown-link  class="text-left">
                                 <form id="delete_artifact" method="POST" action="{{ route('destroy-artifact', $checklistItem->artifactID) }}">
                                 {{ csrf_field() }}
                                 <input type="hidden" name="_method" value="DELETE">
                                 <button type="submit" onclick="return confirm('Are you sure you want to delete this artifact?')">
                                 Delete
                                 </button>
                                 </form>
                                 </x-jet-dropdown-link> 
                                 
                                @else
                                @endif
  
                          </x-slot>
                    </x-jet-dropdown>
        
          </div>
            





          </td>
          
          <td>
            @if ($checklistItem->componentClassViewable == true)
            <a href="{{route('show-component-gallery', ['section' => $currentSection , 'assignment' => $activeAssignment , 'component' => $checklistItem->componentID ])}}" class="text-left">
            <x-feathericon-eye class="inline-block w-5 h-5 hover:text-red-500 text-green-400"/>
            </a>
            @else
            @endif          
          </td>
          
          </tr>
          @endforeach

          </table>
          @endrole

       <!-- Student Table ends -->
        <!--  Teacher Table Begins -->
        @role('teacher')
       </div>
        <!-- Begin Table -->
        <div class="flex flex-col w-full">

        <!-- Begin Table Headder -->
        <div class="flex flex-row text-gray-600 py-2 font-semibold space-x-2 w-full rounded-lg ">

            <div class="flex flex-grow ">Component</div>
            <div class="flex w-28">Due</div>
            <div class="flex">Options</div>
            <div class="flex"></div>

        </div>

        @foreach ( $activeAssignment->components as $komponent )

        <div  x-data="{ open: false }" class="flex flex-col border-t">
        
        <div class="w-full text-gray-600 flex items-center">

            <div class="flex py-2 flex-grow items-center">

                 <a href="{{route('show-component-gallery', ['section' => $currentSection , 'assignment' => $activeAssignment , 'component' => $komponent])}}" class="text-xs m-0 hover:text-red-400 hover:rounded no-underline {{active_check('sections/'.$currentSection->id.'/assignment/'.$assignment->id.'/component/'.$komponent->id.'/*')}}">{{ $komponent->title}}</a>                          
                    <!-- Instructions Dropdown  -->
                   
                    <span class="inline-flex" @click="open = ! open"><x-feathericon-chevron-right x-show="!open" class="inline-block h-4 w-4 text-gray-400"/></span>

                    <span class="" @click="open = ! open">
                    <x-feathericon-chevron-down x-show="open" class="inline-block h-4 w-4 text-gray-400"/></span>
            
            </div>
           
            <div class="flex w-36">
             @if (is_null($komponent->date_due))
                        <div class="">
                        -
                        </div>
                        @else
                          <div class="hidden md:block text-xs">{{ Carbon\Carbon::parse($komponent->date_due)->format('D, M jS @ g:ia')}}</div>
                          <div class="md:hidden text-xs">{{ Carbon\Carbon::parse($komponent->date_due)->format(' n/j/y @ g:ia')}}</div>
                        @endif  
            </div>


            <div class="flex items-center justify-center w-16 ">
                              <x-jet-dropdown align="right" width="48">
                               <x-slot name="trigger">
                                   <x-feathericon-more-horizontal class="w-5 h-5 hover:text-red-500 text-gray-400 "/>
                               </x-slot>
                               <x-slot name="content">
                                  <x-jet-dropdown-link href="{{{route('edit-component', [ 
                                  'section' => $currentSection , 
                                  'assignment' => $activeAssignment,
                                  'component' => $komponent]) }}}" class="p-0 m-0 hover:text-red-400 no-underline text-sm">
                                  Edit Component
                                  </x-jet-dropdown-link> 
                               
                                  <x-jet-dropdown-link>
                                   <form id="delete_component" method="POST" action="{{ route('destroy-component', [
                                   'section' => $currentSection, 
                                   'assignment' => $activeAssignment,
                                   'component' => $komponent]) }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this component?')">Delete Component</button>
                                    </form>
                                   </x-jet-dropdown-link>

                                </x-slot>
                              </x-jet-dropdown>  

                            </div>

            <div class="table-cell"></div>

      </div>



    <div x-show="open" class="flex bg-white rounded px-2 py-1 m-1 text-xs">{{ $komponent->description}}</div>
      </div> 

     

                              @endforeach

      </div>
        <!-- End Table -->   


        </div>

        <table class="w-full">
          
          <!-- Teacher Table Column Headers -->
          <tr class="text-gray-600">
          <td class="">Component</td>
          <td class="py-2">Due</td>
          <td class="text-center">Options</td>
          <td class="text-center"></td>
          </tr>
        
                                                  
                @foreach ( $activeAssignment->components as $komponent )

                    <tr class="border-t" x-data="{ open: false }">
                         <td class="py-2" class="transition">
                          
                          <a href="{{route('show-component-gallery', ['section' => $currentSection , 'assignment' => $activeAssignment , 'component' => $komponent])}}" class="text-xs pb-1 m-0 hover:text-red-400 hover:rounded no-underline {{active_check('sections/'.$currentSection->id.'/assignment/'.$assignment->id.'/component/'.$komponent->id.'/*')}}">{{ $komponent->title}}</a>                          
                          <!-- Instructions Dropdown  -->
                         
                          <span class="" @click="open = ! open"><x-feathericon-chevron-right x-show="!open" class="inline-block h-4 w-4 text-gray-300"/></span>

                          <span class="" @click="open = ! open">
                          <x-feathericon-chevron-down x-show="open" class="inline-block h-4 w-4 text-gray-400"/></span>

                          <span x-show="open" colspan="4" class="bg-gray-100 rounded my-2 mr-2 p-1 pr-2 text-xs">{{ $komponent->description}}</span>

                         </td>

                         <td class="">
                        
                        @if (is_null($komponent->date_due))
                        <div class="">
                        -
                        </div>
                        @else
                          <div class="hidden md:block text-xs">{{ Carbon\Carbon::parse($komponent->date_due)->format('D, M jS @ g:ia')}}</div>
                          <div class="md:hidden text-xs">{{ Carbon\Carbon::parse($komponent->date_due)->format(' n/j/y @ g:ia')}}</div>
                        @endif

                        </td>
                        
                        <!-- Teacher Options Column -->
                        <td class="">
                             
                             <div class="flex items-center justify-center">
                              <x-jet-dropdown align="right" width="48">
                               <x-slot name="trigger">
                                   <x-feathericon-more-horizontal class="w-5 h-5 hover:text-red-500 text-gray-400 "/>
                               </x-slot>
                               <x-slot name="content">
                                  <x-jet-dropdown-link href="{{{route('edit-component', [ 
                                  'section' => $currentSection , 
                                  'assignment' => $activeAssignment,
                                  'component' => $komponent]) }}}" class="p-0 m-0 hover:text-red-400 no-underline text-sm">
                                  Edit Component
                                  </x-jet-dropdown-link> 
                               
                                  <x-jet-dropdown-link>
                                   <form id="delete_component" method="POST" action="{{ route('destroy-component', [
                                   'section' => $currentSection, 
                                   'assignment' => $activeAssignment,
                                   'component' => $komponent]) }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this component?')">Delete Component</button>
                                    </form>
                                   </x-jet-dropdown-link>

                                </x-slot>
                              </x-jet-dropdown>  

                            </div>
                         </td>

                         <td class="w-6 text-center">
                          @if ($komponent->class_viewable == true)
                          <a href="{{route('show-component-gallery', ['section' => $currentSection , 'assignment' => $activeAssignment , 'component' => $komponent])}}" class="text-xs pb-1 m-0 hover:text-red-400 hover:rounded no-underline {{active_check('sections/'.$currentSection->id.'/assignment/'.$assignment->id.'/component/'.$komponent->id.'/*')}}">
                          <x-feathericon-eye class="inline-block w-5 h-5 text-green-300"/>
                          </a>
                          
                          @endif          
                        </td>
                          
                      @endforeach
                    </tr>

          </table>
          @endrole
  
   <!-- end assignment --></div>
   <!-- end deal --></div>


                  
     
</x-app-layout>

