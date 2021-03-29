  

         <table class="border">

                       @foreach ($checklist as $checklistItem)
          <tr>

                  <!-- Image -->
                  <td class="border w-16 py-2 pl-1">
                   @if (!$checklistItem->artifactCreatedAt)
                          empty
                   @else
                       <a href="{{ route('show-artifact', $checklistItem->artifactID)}}">
                          <img class="flex flex-shrink-0 w-16 h-16 border-4 border-white rounded-lg" src="https://s3.amazonaws.com/artifacts-0.3/{{$checklistItem->artifactPath}}" title="Submitted: {{Carbon\Carbon::parse($checklistItem->artifactCreatedAt)->timezone('America/New_York')->format('m/d g:i A')}}">
                        </a>
                  </td>

                  <!-- Check/Title-->

                  <td class="w-56 text-gray-600 py-2 pl-2 ">
                  
                  @if (!$checklistItem->artifactCreatedAt)
                  
                      @role('student')
                      <a href="{{action('App\Http\Controllers\ArtifactController@create', ['section' => $currentSection , 'assignment' => $checklistItem->assignmentID , 'komponent' => $checklistItem->componentID ])}}">
                      <x-feathericon-plus-circle class="w-5 h-5 text-gray-800 hover:text-red-400"/>
                      </a>

                      @else
                      <x-feathericon-circle class="w-5 h-5 m-2 text-gray-400"/>

                      @endrole

                  @else
                  
                      <!-- Convert due date data? Not sure why anymore. Omit? -->
                      @php
                      $duedate = Carbon\Carbon::parse($checklistItem->componentDateDue) 
                      @endphp
                                            
                      @if ($checklistItem->artifactCreatedAt <= $duedate)
                      <!-- Display Green Check -->
                      <x-feathericon-check-circle class="w-5 h-5 m-2 text-green-500"/>
                      @else 
                      <!-- Display Yellow Check -->
                      <x-feathericon-check-circle class="w-5 h-5 m-2 text-yellow-400"/>
                       @endif

                   @endif

                  </td>

                  <td class="w-4 text-gray-600 py-2">Due</td>
                  <td class="w-4 text-gray-600 p-2 text-center">Options</td>

              </tr>

              </table> 

                    @foreach ($checklist as $checklistItem)
                                      
              <tr class="border-t-2">
                  
                  <!-- Thumbnail Column -->
                  <td class="h-16 w-16 border">

                        @if (!$checklistItem->artifactCreatedAt)
                        
                       <div class="flex items-center justify-center text-sm h-12">
                          <a href="{{action('App\Http\Controllers\ArtifactController@create', ['section' => $currentSection , 'assignment' => $checklistItem->assignmentID , 'komponent' => $checklistItem->componentID ])}}">

                          <x-feathericon-plus-circle class="w-5 h-5 text-gray-800 hover:text-red-400"/>

                          </a>
                          </div>

                         @else

                          <div class="flex items-center justify-center text-sm ">
                              <a href="{{ route('show-artifact', $checklistItem->artifactID)}}">
                              <img class="flex flex-shrink-0 w-16 h-16 border-4 border-white rounded-lg" src="https://s3.amazonaws.com/artifacts-0.3/{{$checklistItem->artifactPath}}" title="Submitted: {{Carbon\Carbon::parse($checklistItem->artifactCreatedAt)->timezone('America/New_York')->format('m/d g:i A')}}">
                            </a>
                          </div>

                       @endif
                  </td>

                              <!-- Status Column -->
                              <td class="text-center">

                                  <div class=
                                  "flex justify-center items-center">
                                  
                                            @if (!$checklistItem->artifactCreatedAt)

                                                    <!-- Display Empty Circle -->
<!--                                                     <x-feathericon-circle class="w-8 h-8 m-2 text-gray-400"/>
 -->                                        @else
                                                    
                                                    <!-- Convert due date data? Not sure why anymore. Omit? -->
                                                    @php
                                                    $duedate = Carbon\Carbon::parse($checklistItem->componentDateDue) 
                                                    @endphp
                                            
                                                    @if ($checklistItem->artifactCreatedAt <= $duedate)
                                                        <!-- Display Green Check -->
                                                        <x-feathericon-check-circle class="w-8 h-8 m-2 text-green-500"/>
                                                    @else 
                                                        <!-- Display Yellow Check -->
                                                        <x-feathericon-check-circle class="w-8 h-8 m-2 text-yellow-400"/>
                                                    @endif
                                            @endif

                                    </div> 
                              </td>

    
                               <!-- Component Text Column -->
    <!-- Begin Component -->
    
    <td class="p-2 font-bold">
    
    <div class="flex">
        
        <div>
        <!-- Start upload link for students -->
        @role('student')
        <a href="{{action('App\Http\Controllers\ArtifactController@create', ['section' => $currentSection , 'assignment' => $checklistItem->assignmentID , 'komponent' => $checklistItem->componentID ])}}">
        <x-feathericon-circle class="w-5 h-5 text-gray-500 mr-2"/></a>
        @else
        <x-feathericon-circle class="w-5 h-5 text-gray-500 mr-2"/>
        @endrole
        <!-- End upload link for students -->

        </div>
        <div>
        {{ $checklistItem->componentTitle }}<br/>
        </div>
      </div>
    <!-- Due Date -->
    
    <!-- <span class="text-gray-600 text-xs border-b border-gray-600 w-16 ">
        Due {{Carbon\Carbon::parse($checklistItem->componentDateDue)->format('m/d g:i A ')}}
    </span> -->

<!--     <br/>
 -->    
   <!--  <span class="text-gray-600 text-xs w-16 ">
        @if(!$checklistItem->artifactCreatedAt)
        @else
        Submitted: {{Carbon\Carbon::parse($checklistItem->artifactCreatedAt)->timezone('America/New_York')->format('m/d g:i A')}}
        @endif
    </span> -->
    <!-- {{ Carbon\Carbon::parse($checklistItem->componentDateDue)->format('D n/j g:i a') }}-->
    </td>

    <td class="text-left text-sm w-64">
    {{Carbon\Carbon::parse($checklistItem->componentDateDue)->format('M jS g:i a')}}
    </td>
   
    <td class="text-center w-16">

        <div class="flex justify-center items-center">
       
                 <x-jet-dropdown align="right" width="48">
                        
                         <x-slot name="trigger">
                         <x-feathericon-more-horizontal class="w-5 h-5 hover:text-red-500 text-gray-400"/>
                          <button class="flex transition duration-150 ease-in-out">
                          </button>
                         
                          </x-slot>
                          <x-slot name="content">
                              
                              @role('teacher')
                              {{-- <x-jet-dropdown-link 
                              href="{{route('edit-component', [
                              'section' => $checklistItem->sectionID, 
                              'assignment' => $checklistItem->assignmentID,
                              'component' => $checklistItem->componentID ])}}" class="opacity-100 hover:opacity-75">Edit Component
                              </x-jet-dropdown-link>

                              <x-jet-dropdown-link 
                              href="{{route('delete-component', [
                              'section' => $checklistItem->sectionID, 
                              'assignment' => $checklistItem->assignmentID,
                              'component' => $checklistItem->componentID ])}}" class="opacity-100 hover:opacity-75">- Delete Component
                              </x-jet-dropdown-link> --}}
                              @endrole

                              @role('student')

                               @if ($checklistItem->artifactID)
                
                                 <x-jet-dropdown-link 
                                <form id="delete_artifact" method="POST" action="{{ route('destroy-artifact', $checklistItem->artifactID) }}">
                                 {{ csrf_field() }}
                                 <input type="hidden" name="_method" value="DELETE">
                                 <button type="submit" onclick="return confirm('Are you sure you want to delete this?')">
                                 Delete Artifact
                                 </button>
                                 </form>
                                 </x-jet-dropdown-link>


                                @else
                                @endif

                              @endrole

  
                          </x-slot>
                    </x-jet-dropdown>

        <a href="{{action('App\Http\Controllers\ArtifactController@create', ['section' => $currentSection , 'assignment' => $checklistItem->assignmentID , 'komponent' => $checklistItem->componentID ])}}" class="opacity-100 hover:opacity-75">
        </a>
        
      

      </div>
      </td>


</tr>

@endforeach