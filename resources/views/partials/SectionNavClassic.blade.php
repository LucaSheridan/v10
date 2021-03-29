<!-- Section Menu -->

    <div class="pt-0 px-3">

            <div class="flex max-w-5xl mx-auto mb-3 pl-1 bg-red-100 rounded-lg text-left py-2 ">

                <!-- Content Menu Bar-->
                <div class="flex flex-grow items-center text-gray-500">

                      <!-- Class Pills -->
                      <div class="flex-grow text-gray-400 aliased space-x-0">
                               
                             @if (Auth::User()->activeSections()->count() > 0)

                                @foreach ( Auth::User()->activeSections as $section)  

                                <a class="px-2 py-2 rounded-lg bg-gray-200 hover:text-gray-700 text-sm {{active_check('sections/'.$section->id.'*')}}"
                                href="{{route('show-section', $section->id)}}">

                                {{ $section->title}}</a>

                                @endforeach

                              @else
                              <p>You are currently have no classes.</p>
                              @endif

                      </div>
                      <!-- End Class Pills -->

                </div>
                <!-- Content Menu Bar-->


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
                          
                          <form action="{{route('destroy-section', $currentSection)}}" method="POST">
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