
<!DOCTYPE html>


<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{$collection->title}}</title>

        <!-- Fonts -->
       <!--  <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css2?family=Homemade+Apple&display=swap" rel="stylesheet">
 -->
<!--         <link href="https://unpkg.com/tailwindcss@^1.7/dist/tailwind.min.css" rel="stylesheet">
 -->

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        @livewireStyles

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.6.0/dist/alpine.js" defer></script>
    </head>
   
    <body class="relative font-sans antialiased">
    
       <div class=" min-h-screen bg-cool-gray-400">
                
       <nav class="bg-cool-gray-100 border-b-0 border-red-500">
                
        <!-- HEADER / TITLE / MESSAGES  -->
        
        <div class="max-w-5xl mx-auto">

        <div class="flex justify-center h-16 ">
    
                          <div class="h-12 flex items-center text-4xl font-thin text-center text-gray-600 bg-opacity-50 border-cool-gray px-3 pt-3 rounded-lg">
                            
                          <a href="/artifacts" class="outline-none" tabIndex="-1">                               
                          <span class="bg-clip-text text-transparent bg-gradient-to-r from-teal-400 to-blue-500 uppercase pl-0">ARTIFACTS</span>
                          </a>
                                             
                          </div>

            
                    </div>
                </div>
            </nav>


    <div class="p-4">
        
        <div class="flex max-w-5xl mx-auto pt-0 rounded-lg bg-white border-b">

            <div class="bg-white w-1/2 sm:w-1/3 lg:w-1/4 rounded-l-lg text-gray-400">
            
            <div class="mt-3 mx-3 py-1 text-white border-blue-300 font-semibold bg-red-200 text-gray-500 px-2 leading-tight leading-none md:text-2xl">
            {{$collection->title}}</div>
            <div class="">
            
            <span class="mx-3 bg-blue-200 px-2 text-sm font-regular py-1 block leading-5">
            {{$collection->subtitle}}</span>


            <span class="mx-3 bg-yellow-200 px-2 text-sm font-regular py-1 block leading-5"> 
            @foreach ($collection->curators as $curator)
            
              <!-- AND Check for more than 1 curator and not last loop -->
              @if ($loop->count > 1 && $loop->last)

                  and {{$curator->fullName}}
              <!-- COMMA Check for loop count > 2 and not last-->
              @elseif ($loop->count > 2 && $loop->index != 0), {{$curator->fullName}}

              @else

              {{$curator->fullName}}

              @endif
            
            @endforeach</span>

            </div>

            <div class="text-gray-500 text-sm py-3 px-4">
            {{$collection->description}}
            </div>


            </div> 

            <div class="flex">
                
               
        </div>

        <div class="w-1/2 sm:w-2/3 md:w-3/4 mx-auto grid mx-4 p-4 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 bg-gray-100 rounded-r-lg flex items-start">  
        
        <!-- Show  Artifacts -->
        
           <!-- Show  Artifacts -->
        
        @foreach ($collection->artifacts as $artifact) 

        <x-lightbox-modal name="{{ $loop->index }}" >
        
        <x-slot name="title">
        {{$loop->index}}
        </x-slot>

        <x-slot name="body">
                          
            <img class="object-scale-down" src="https://s3.amazonaws.com/artifacts-0.3/{{$artifact->artifact_path}}">
                           
        </x-slot>

        <x-slot name="caption">
        {{$artifact}} 
        </x-slot>  
        
        <x-slot name="arrowleft">
            
            @if (!$loop->first)
            <a href="#{{$loop->index-1}}" class="block hover:text-white transition-all duration-200">
            <x-feathericon-chevron-left class="w-10 h-10 m-4 bg-white rounded-full text-gray-400 hover:text-gray-500" /></a>
            @else
            <x-feathericon-chevron-left class="w-10 h-10 m-4 bg-white rounded-full text-white" />
            @endif

        </x-slot>
        
        <x-slot name="arrowright">
   
            @if (!$loop->last)
            <a href="#{{$loop->index+1}}" class="block hover:text-white transition-all duration-200">
            <x-feathericon-chevron-right class="w-10 h-10 m-4 bg-white rounded-full text-gray-400 hover:text-gray-500" /></a>
            @else
            <x-feathericon-chevron-right class="w-10 h-10 m-4 bg-white rounded-full text-white" />
            @endif

            </x-slot>

                <x-slot name="counter">
                
                {{$loop->index+1}} of {{$loop->count}}
                
                </x-slot>

                <x-slot name="exit">
                
                <a href="#">
                <x-feathericon-x class="w-6 h-6 m-4 bg-white rounded-full text-gray-400" />
                </a>

                </x-slot>

        </x-lightbox-modal>

         <!-- Artifact Card -->
              <div id="ArtifactCard" x-data="{open: false}" class="rounded-lg w-full p-2 bg-white rounded-lg shadow-lg">

              <!-- Artifact Image -->
              <div class="flex">
                    
                    <!-- Begiin Collection Image --> 
                  
                            <!-- <a class="" href="{{route('zoom-artifact', $artifact->id)}}">
 -->
                            <!-- <a class="" href="{{route('zoom-artifact', $artifact->id)}}"> -->
                            <a href="#{{$loop->index}}">

                            <img  class="object-contain opacity-100 hover:opacity-75" src="https://s3.amazonaws.com/artifacts-0.3/{{$artifact->artifact_path}}">
                            </a>

                            </div>
                            <div class="flex mt-2">
                           <div class="flex flex-grow mb-0">

                              <ul class="leading-tight text-sm text-gray-600 w-full">      

                                  <li class="font-semibold">
                                  @if ($artifact->pivot->artist == 'Unattributed')
                                  {{$artifact->user->fullName}}
                                  @else
                                  {{$artifact->pivot->artist}}
                                  @endif
                                  </li>
                                  <li class="italic">{{$artifact->pivot->title}}</li>
                                  <li>{{$artifact->pivot->medium}}</li>
                                  <li>{{$artifact->pivot->year}}</li>
                                  <li>

                                   {{$artifact->pivot->dimensions_height}}
                                   
                                   @if(is_null($artifact->pivot->dimensions_width))
                                   @else
                                   x {{$artifact->pivot->dimensions_width}}
                                   @endif

                                   @if (is_null($artifact->pivot->dimensions_depth))
                                   @else
                                   x {{$artifact->pivot->dimensions_depth}}
                                   @endif
                                   {{$artifact->pivot->dimensions_units}}
                                   </li>
                                   
                                   @if (is_null($artifact->pivot->label_text))
                                   @else
                                   <li class="mt-2 w-full rounded-lg">{{$artifact->pivot->label_text}}</li>
                                   @endif
                                   </ul>
        <!-- End Label -->  

                              </div>


                            <div class="flex pr-0">
 <!-- Artifact Menu Trigger -->
                  
                            </div>
                            
                
                </div>
   
</div>
      

      @endforeach
