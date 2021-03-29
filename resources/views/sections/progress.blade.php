<x-app-layout>
    
    <x-slot name="header">
        <h2 class="text-2xl text-gray-100 leading-tight">
            Student Progress 
        </h2>
    </x-slot>

<!-- Section Menu -->

@include('partials.sectionNav') 

<!-- Begin Page Content -->

<div class="max-w-5xl mx-auto grid grid-cols-1 gap-y-4 sm:grid-cols-3 sm:gap-3 bg-cool-gray-400 text-sm text-gray-500" >
    
    {{--  Begin Student Header  --}}

                    <div class="bg-white rounded-lg">
                         <div class="flex items-center pl-3 py-1 ">
                              <div class="flex flex-grow text-sm text-gray-500">STUDENTS ({{$currentSection->students->count()}})</div>
                              <div class="flex">
                              <!--  <x-feathericon-menu class="w-5 h-5 hover:text-red-500"/> -->
                          </div>
                    </div>
                    <div class="py-2 pl-1 bg-gray-100 rounded-b-lg shadow-inner">


    {{-- End Students Header --}}

                
       @if ($currentSection->students->count() > 0)

                                    <ul class="leading-snug text-sm no-underline text-gray-700  ">
                                    
                                    @foreach ($currentSection->students as $student)                                    
                                   
                                    <a href="{{route('student-progress', ['section'=> $currentSection, 'user' => $student])}}">

                                    @if ($user->id == $student->id)
                                    
                                    <li class="pl-2 rounded-sm text-red-500 text-sm bg-gray-100 hover:bg-gray-200 hover:text-red-500">
                                    {{ $student->fullName}}</li>
                                    
                                    @else
                                    
                                    <li class="pl-2 rounded-sm text-gray-600 text-sm bg-gray-100 hover:bg-gray-200 hover:text-red-500">
                                    {{ $student->fullName}}</li>
                                   
                                    @endif

                                    </a>
                                    
                                    @endforeach
                                    </ul>

                                </div>

                        @else
           
                                <div class="text-gray-600 rounded-l-lg rounded-br-lg bg-gray-100 p-3 no-underline text-sm">

                                No students are currently enrolled in this class.
                                </div>            
                            
                        @endif

                </div>

          <!-- Begin Page Content -->

          <div class=" col-span-2 bg-white rounded-lg px-2 pb-2">
                         <div class="flex items-center p-1">
                              <div class="flex flex-grow text-sm text-gray-500">PROGRESS VIEW</div>
                              <div class="flex">
                              <!--  <x-feathericon-menu class="w-5 h-5 hover:text-red-500"/> -->
                          </div>
                        </div>

           {{-- End Students Header --}}

          {{--  Student Info --}}
          
                  <div class="flex bg-gray-100 rounded-lg mb-2">
                      
                      <div class="flex-shrink-0 py-2 pl-2">

                      @if ( !empty($user->profile_photo_path))

                      <!-- JetStream Profile Photo -->
                      <img src="{{  $user->profile_photo_path }}" class="rounded-full w-8 h-8 sm:w-16 sm:h-16 border border-cool-gray-200">

                      @else
                      
                      <!-- TailwindUI Avatar -->
                      <span class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-cool-gray-200">
                      <span class="text-sm sm:text-md font-medium leading-none text-gray-500">
                      {{ $user->initials }}
                      </span>
                      </span>
            
                      @endif

                      </div> 
                      
                      <!-- Assignment Title -->
                      <div class="flex flex-grow flex-col text-2xl px-2 text-gray-500">
                      {{$user->fullName}}
                      <span class="leading-none text-xs">
                      @foreach ($user->activeSections as $section)
                      <a class ="mr-2 border-b border-gray-400" href="{{route('student-progress', ['user' => $user,'section' => $section ])}}">{{$section->title}}</a>
                      @endforeach
                      </span>
                      </div>
                      
                      <!-- Menu -->
                      @role('teacher')   
                      <div class="flex pt-2 pr-2">
                       <x-jet-dropdown align="right" width="48">
                                    
                              <x-slot name="trigger">
                              <x-feathericon-mail class="w-5 h-5 hover:text-red-500 text-gray-400"/>
                              </x-slot>
                                    
                              <x-slot name="content">
                                  
                                   <x-jet-dropdown-link href="mailto:{{$user->fullName}}">Email
                                   </x-jet-dropdown-link>
                                    </x-slot>
                                    
                              </x-jet-dropdown>
                      </div>                      
                      @endrole 
                      
                </div>
                                   
{{-- Start Collections --}}

                              <div class="text-sm">COLLECTIONS</div>                              
                               @if ($user->collections->count() < 1)

                               <div class="bg-gray-100 rounded-lg mb-2 w-full leading-tight px-2 pt-1 pb-1 text-gray-400 text-sm">

                               <p>No collections</p>
                                
                               </div>

                               @else

                               <div class="bg-gray-100 rounded-lg mb-2 w-full leading-tight px-2 pt-2 pb-1 text-gray-400 text-sm">
                                  
                                          @foreach ( $user->collections as $collection )
                                          
                                           <!-- Class Pills -->
                                                                       
                                            
                                            <a  href="{{route('show-collection', $collection)}}" class="inline-flex items-center space-x-2 px-2 py-1 space-x-1 mb-1 rounded-lg bg-white hover:text-red-400 shadow" >

                                                                          <x-feathericon-briefcase class="w-5 h-5 hover:text-red-500 text-gray-400"/>


                                            <span>{{ $collection->title }}</span></a>

                                            @endforeach                
                                
                                  </div>

                                  @endif



{{-- Student Progress --}}
     <div class="text-sm">PROGRESS</div>
     
     <div class="bg-gray-100 rounded-lg flex w-full mb-3 px-2 pb-2">

     <div class="rounded-lg w-full">

          @if($checklist->isEmpty())
          <div class="mt-2 px-2 pt-2 bg-white rounded-lg text-gray-400 text-sm">No work assigned
          @else
          @endif
 
          @foreach ($checklist as $checklistItem)


{{-- Look for unset/not matching current assignent variable --}}

                @if (empty($current_assignment) or ($current_assignment != $checklistItem->assignment_id))

    {{-- New Assignment Header--}}

                    {{-- Gross Table Hack --}}
                    </table>
                    @unless ($loop->index === 0) 
                    <div class="rounded-b-lg bg-white text-md font-semibold text-gray-400 px-2 py-1">
                    </div>
                    @endunless

                    <div class="rounded-t-lg bg-white text-md  text-gray-400 px-2 py-1 mt-2">
                    
                    {{-- Preferred method, but thisn work around is ncessary for older components records which didn't always have section_id attached. 
                    <a href="{{route('show-assignment', ['assignment' => $checklistItem->assignment_id , 'section' => $checklistItem->sectionID])}}" class="no-underline hover:text-red-400"> --}}

                    <a href="{{route('show-assignment', ['assignment' => $checklistItem->assignment_id , 'section' => $checklistItem->assignment->section_id])}}" class="no-underline hover:text-red-400">
                    {{ $checklistItem->assignment->title }}</a> 
                    </div>

                    <table class="w-full bg-white">
                
                    <tr class="text-gray-600">
                    <td class="text-center w-28"></td>
                    <td class=""><!-- Component --></td>
                    <td class=""><!-- Due --></td>
                    </tr>

                  @php
                  $current_assignment = $checklistItem->assignment_id;
                  @endphp

                  @else

                  @endif  

          <tr class="border-t">
          <td class="p-2"> 

            @php
              
              $duedate = Carbon\Carbon::parse($checklistItem->componentDateDue);
              $submitted = Carbon\Carbon::parse($checklistItem->artifactCreatedAt)->subHours(5);                   
              @endphp


              @if ($checklistItem->artifactCreatedAt)
                
                <a href="{{ route('show-artifact', $checklistItem->artifactID) }}">

                <img class="flex flex-shrink-0 w-24 h-24 rounded-lg" 
                     src="https://s3.amazonaws.com/artifacts-0.3/{{$checklistItem->artifactPath}}" 
                     title="Due: {{$duedate->format('m/d g:i A')}} - Submitted: {{$submitted->format('m/d g:i A') }}">
              </a>
             
              @endif
          </td>

    <td class="align-top">
    
    <div class="">
        
        {{-- Component Title --}}

        <div class="flex pl-1 text-gray-700 text-sm">
          {{ $checklistItem->componentTitle }}
        </div>
        
        {{-- Submitted --}}

            @if ($checklistItem->artifactThumb)

                        @php
                        $duedate = Carbon\Carbon::parse($checklistItem->componentDue) 
                        @endphp
                
                        @if ($checklistItem->artifact_created <= $duedate)

                                <div class="flex mt-0 bg-green-100 rounded-lg p-1">
                                <x-feathericon-check-circle class="w-5 h-5 text-green-500 mr-2"/>

                        @else 

                                <div class="flex mt-0 bg-yellow-200 rounded-lg p-1">
                                <x-feathericon-check-circle class="w-5 h-5 text-yellow-300 mr-2"/>
                                       
                        @endif

                                Submitted: {{$submitted->format('m/d g:i A')}}

             @endif

            @if ($checklistItem->artifactThumb)

    </div>

    @else

                <div class="flex mb-1 bg-gray-200 rounded-lg p-1 text-sm">

                <div class="flex">
                  <x-feathericon-clock class="w-5 h-5 text-gray-500 mr-2"/>
                </div>

                <div class="flex">
                Due {{Carbon\Carbon::parse($duedate)->format('m/d g:i A')}}
                </div>

               </div>
    @endif
                        
    </td>

          </tr>
          @endforeach

         </table>

         <div class="rounded-b-lg bg-white px-2 py-1">
         </div>

          

        {{-- END SUPER TABLE--}}

        {{-- End Progress Content --}}

        </div>
        
        {{-- End Student Progress --}}


    </div>

    </x-app-layout>

