<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl text-gray-100 leading-tight">
            Artifacts
        </h2>
    </x-slot>

    <div class="pt-4 px-3">
        
            <div class="flex max-w-5xl mx-auto pt-3 pl-4 bg-gray-100 rounded-t-lg text-left py-1 border-b">

                <!-- Contnet Menu Bar-->
                <div class="flex flex-grow pb-1 items-center font-semibold text-gray-500">
                Your Collections
                </div>

                <!-- Contnet Menu Bar-->
                <div class="flex pr-3">
                   <x-jet-dropdown align="right" width="48">
                            <x-slot name="trigger">
                            
                            <button class="flex transition duration-150 ease-in-out" tabIndex="-2">
                            <x-feathericon-menu class="w-5 h-5 hover:text-red-500 text-gray-400"/>
                            </button>
                           
                            </x-slot>
                            <x-slot name="content">
                                
                                <x-jet-dropdown-link 
                                href="{{action('App\Http\Controllers\CollectionController@create')}}">
                                Create New Collection
                                </x-jet-dropdown-link>

                            </x-slot>
                  </x-jet-dropdown>
                </div>
            </div>


   <div class="max-w-5xl mx-auto">

    <!-- <div class="grid px-3 mx-0 pt-2 pb-3 grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 bg-cool-gray-500 rounded-b-lg">  
    -->
    <div class="flex flex-wrap px-3 pt-3 pb-3 bg-white rounded-b-lg">  
    
    <!-- Check for Collections -->
    @if ($collections->count() > 0)

        <!-- Show Users Collections -->
        @foreach ($collections as $collection) 

        <div id="CollectionCard" class="w-full hover:bg-gray-100 sm:w-1/2 md:w-1/2 lg:w-1/2 p-2 min-w-48 rounded-lg">

         @if ($collection->artifacts->count() > 0) 

                <div class="justify-center items-center text-sm text-gray-500">
                    
                    <!-- Title -->

                    <div class="font-semibold text-gray-400 text-xl">

                    <a class="" href="{{route('show-collection', $collection->id)}}">
                    {{$collection->title}}</a>

                    <x-feathericon-plus class="mb-1 p-1 ml-1 inline-flex h-6 w-6 rounded-full bg-cool-gray-200 hover:bg-cool-gray-300 hover:text-red-500 text-gray-400"/>


                    </div>
                    
                    <div class="flex py-1 text-xs">
                    @if ($collection->artifacts->count() > 0)
                    <a class="" href="{{route('show-collection', $collection->id)}}">
                    {{$collection->artifacts->count()}} Artifacts
                    </a>
                    @endif
                     </div>

             <!-- End Collection Header -->
               </div>

            <div class="flex flex-wrap max-h-48 overflow-hidden opacity-100 hover:opacity-75">          

                    @foreach ($collection->artifacts as $artifact)

                            <!-- Adjust number for different effects -->
                            @if ($loop->index < 1 ) 

                  
                            <a class="" href="{{route('show-collection', $collection->id)}}">
                            <img class="object-cover w-24 h-24 flex rounded-lg" src="https://s3.amazonaws.com/artifacts-0.3/{{$artifact->artifact_path}}">
                            </a>

                            @else
                            @endif


                
               <!--  @if ($loop->count = 3)
                <div>empty</div>
                @endif -->

                @endforeach
                
               <!--  <div class=" w-24 h-24 flex rounded-lg bg-gray-100 justify-center items-center">
                <x-feathericon-plus class="border-2 p-2 h-10 w-10 rounded-full bg-cool-gray-200 hover:bg-cool-gray-300 hover:text-red-500 text-gray-400"/>
                </div> -->

                @if ( $collection->artifacts->count() === 2 )

                <div class=" w-24 h-24  flex  rounded-lg justify-center items-center"></div>

                @elseif ( $collection->artifacts->count() === 1 )

                <div class=" w-24 h-24 flex  rounded-lg justify-center items-center"></div>
                <div class=" w-24 h-24 flex  rounded-lg justify-center items-center"></div>

                @elseif ( $collection->artifacts->count() === 0 )

                <div class=" w-24 h-24 flex  rounded-lg justify-center items-center"></div>
                <div class=" w-24 h-24  flex  rounded-lg justify-center items-center"></div>
                <div class=" w-24 h-24 flex border rounded-lg justify-center items-center"></div>


                @endif

            </div>

            @else

                 <div class="pr-2 relative justify-center text-sm text-gray-500 pt-1 pb-6">
                    
                    <!-- Title -->
                    <div class="font-semibold textgray-400">
                    <a class="" href="{{route('show-collection', $collection->id)}}">
                    {{$collection->title}}
                    </a>
                    </div>
                    
                    <div class="text-xs">
                    @if ($collection->artifacts->count() > 0)
                    <a class="" href="{{route('show-collection', $collection->id)}}">
                    {{$collection->artifacts->count()}} Artifacts
                    </a>
                    @endif
                    </div>

             <!-- End Collection Header -->
               </div>

               <div class=" w-24 h-24 flex rounded-lg bg-gray-100 justify-center items-center">
                <x-feathericon-plus class="border-2 p-2 h-10 w-10 rounded-full bg-cool-gray-200 hover:bg-cool-gray-300 hover:text-red-500 text-gray-400"/>
                </div>
             <!--  <div class="flex items-center bg-green-200 justify-center border-gray-200 bg-gray-100 w-48 h-48 text-lg rounded-lg">Add Artifacts</div>
 -->
          @endif

            </div>



        @endforeach

       @else                    
      @endif
    

<!-- End Collections -->
</div>

</x-app-layout>
