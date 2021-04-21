

<div class="pt-0 px-3 mb-2">

<div class="flex rounded-lg bg-gray-50 text-gray-400 mb-3">

<div class="hidden sm:block flex flex-grow flex-wrap pl-1 mb-1">

    {{-- Start our Class Selection on larger displays --}}

                                @if (Auth::User()->activeSections()->count() > 0)

                                @foreach ( Auth::User()->activeSections as $section)  

                              <!--  <span class="inline-flex items-center mt-1 px-3 py-0.5 rounded-full text-sm font-medium bg-cool-gray-200 text-gray-800"> -->
  
  <a class="inline-flex items-center mt-1 px-2 py-1 bg-cool-gray-200 rounded-lg hover:text-gray-700 text-sm {{active_check('sections/'.$section->id.'*')}}"
                                href="{{route('show-section', $section->id)}}">

                                {{ $section->title}}</a>

                                @endforeach

                              @else
                              <p>You currently have no classes.</p>
                    @endif


    {{-- End Class Selection on larger displays --}}

</div>


  {{-- Begin Class Dropdown on small displays --}}

<div class="sm:hidden flex flex-grow items-center">                
                        
                        <div class="px-0 py-0 flex flex-wrap w-full">
                    
                            <select class="pl-2 py-1 my-1 ml-1 pr-8 m-0 form-select w-full bg-cool-gray-200 border-none text-sm text-red-500

                            " onchange="location = this.value;">
      
                                 <option class="" value="{{route('show-section', $currentSection->id) }}">{{$currentSection->title}}</option>
                
                                    @foreach ( Auth::User()->activeSections as $section)                         
                                                   
                                        @if ( $section->id == $currentSection->id ) 
                                        @else
                                            <option value="{{route('show-section', $section->id) }}">{{ $section->title}}</option>
                                        @endif
                                    
                                    @endforeach

                            </select>

                        </div> 

                    </div>
                    
                    {{-- End Class Dropdown on small displays --}}

<div class="flex bg-white rounded-r-lg items-start mt-2 ml-2">
  
<!-- Content Menu -->

                <div class="flex pr-2">
                      
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
                          
                          <form action="{{route('destroy-section', $section)}}" method="POST">
                          {{ csrf_field() }}
                          <input type="hidden" name="_method" value="DELETE">

                          <button onclick="return confirm('Are you sure you want to delete this?')">Delete Class</button>
                                     
                          </form>

                          </x-jet-dropdown-link>

                          <x-jet-dropdown-link href="#">Email Class</a>
                          </x-jet-dropdown-link> 

                           <x-jet-dropdown-link href="{{route('create-section')}}">
                          Create New Class
                          </x-jet-dropdown-link>
                          
                          <x-jet-dropdown-link href="{{route('show-all-sections')}}">
                          See All Classes
                          </x-jet-dropdown-link>

                          @else
                          <x-jet-dropdown-link href="{{route('select-class')}}">
                          Join a class
                          </x-jet-dropdown-link>
                          @endhasrole

                      </x-slot>

                </x-jet-dropdown>
                <a href="{{route('select-class')}}"></a>
                </div>



                </div>
                
                
            </div>