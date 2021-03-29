<div class="flex absolute right-3 xl:right-0 z-10">
                                
                                <x-jet-dropdown align="right" width="48" class="flex align-start">
                                <x-slot name="trigger">
                      
                                    <button class="flex transition duration-150 ease-in-out" tabIndex="-2">

                                            <!-- TailwindUI Avatar -->
                                            <span class="inline-flex items-center justify-center h-7 w-7 rounded-full bg-cool-gray-300">
                                            <span class="text-xs sm:text-sm font-medium leading-none text-gray-500">
                                            
<!--                                             <x-feathericon-user/>
 -->                                        {{ Auth::User()->initials }}
                                            </span>
                                            </span>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    
                                    <x-jet-dropdown-link href="/user/profile">
                                    View Profile
                                    </x-jet-dropdown-link>
                                    
                                    <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                     <x-jet-dropdown-link href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                         this.closest('form').submit();">
                                    Logout
                                    </x-jet-dropdown-link>
                                    </form>

                                </x-slot>
                            </x-jet-dropdown>
                                </div>