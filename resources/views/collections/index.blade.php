<x-app-layout>
    
    <x-slot name="header">
        <h2 class="text-2xl text-gray-100 leading-tight">
            Collections
        </h2>
    </x-slot>

    <!-- Section Menu -->

 <div class="pt-0 px-3">
        
         <!-- Header -->
         <div class="flex max-w-5xl mx-auto pl-3 rounded-t-lg bg-white text-gray-400 aliased">

                <!-- Pagination -->
                <div class="h-7 flex flex-grow items-center">
                      {{ $collections->links() }}
                </div>
            
                <!-- Menu  -->
                <div class="flex items-center pr-2 ">
                      
                <x-jet-dropdown align="right" width="48">
                      
                      <x-slot name="trigger">
                      <button class="flex transition duration-150 ease-in-out">
                          <x-feathericon-menu class="w-5 h-5 hover:text-red-500 text-gray-400"/>
                      </button>
                      </x-slot>
                      
                      <x-slot name="content">
                          
                          @hasrole('teacher|student')
                          
                                <x-jet-dropdown-link 
                                href="{{action('App\Http\Controllers\CollectionController@create')}}">
                                Create New Collection
                                </x-jet-dropdown-link>

                          @endrole
                      </x-slot>

                </x-jet-dropdown>
                </div>
            </div>

      


   <div class="max-w-5xl bg-white px-0 pb-0 rounded-b-lg mx-auto">  
   
  <div class="p-3 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 bg-gray-100 rounded-b-lg shadow-inner"> 

    
    <!-- Check for Collections -->
    @if ($collections->count() > 0)

        <!-- Show Users Collections -->
        @foreach ($collections as $collection) 
      
        <div id="CollectionCard" class="bg-white px-2 pt-2 rounded-lg shadow-xl relative">

        <a href="{{route('show-collection', $collection->id)}}">   

        <div class="flex items-center relative overflow-hidden h-48 bg-gray-100 rounded-lg opacity-75 hover:opacity-100">  

        <!-- Collection Title -->
        <div class="flex absolute bottom-0 left-0 w-full bg-white bg-opacity-80 text-gray-600 py-1 pl-1 z-10 text-sm">

        <div class="flex flex-grow">{{$collection->title}}</div></a>

        <div class="flex z-50">
                        
                        <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                          
                          <button class="flex transition duration-150 ease-in-out" tabIndex="">
                          <x-feathericon-more-horizontal class="w-5 h-5 hover:text-red-500 text-gray-400"/>
                          </button>
                         
                          </x-slot>
                          <x-slot name="content">
                              
                                <x-jet-dropdown-link 
                                href="{{route('edit-collection', $collection)}}">Edit Collection
                                </x-jet-dropdown-link>


                                {{-- <x-jet-dropdown-link>
                                <form id="delete_collection" method="POST" action="{{ route('delete-collection', $collection) }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this?')">Delete Collection</button>
                                 </form>
                                </x-jet-dropdown-link> --}}

                          </x-slot>
                          
                          </x-jet-dropdown>                   

        </div>
        </div>
      
          <!-- Empty Collection Check  --> 
          @if ($collection->artifacts->isNotEmpty())
                            
                @foreach ($collection->artifacts as $artifact)

                            @if ($loop->first ) 
                            
                             <a href="{{route('show-collection', $collection->id)}}">   
                              <img  class="object-cover h-48 w-full opacity-100 hover:opacity-75 rounded-lg" src="https://s3.amazonaws.com/artifacts-0.3/{{$artifact->artifact_path}}">

                            </a>

                            @endif

                @endforeach
             
          @else      
          @endif

          </div>

          </div>




        @endforeach


       @else                    
      @endif
    

<!-- End Collections -->
</div>

</x-app-layout>
