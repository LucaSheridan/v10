<x-guest-layout>
    <x-slot name="header">
        <h2 class="text-2xl text-gray-100 leading-tight">
            Artifact
        </h2>
    </x-slot>

<div id="wrapper" class="flex h-screen w-screen items-center justify-center p-10 bg-white">

   <!--  <div class="absolute top-0 right-0 p-2 z-10">

    <a href="{{route('show-artifact', $artifact)}}">
        <x-feathericon-x class="w-8 h-8 hover:text-red-400 text-gray-400"/>
    </a>

    </div>
 -->
    <!-- <div class="object-scale-down"> -->
      
<div class="h-full w-full flex items-center justify-center bg-white">

<img class="max-w-full max-h-full object-scale-down" src="https://s3.amazonaws.com/artifacts-0.3/{{$artifact->artifact_path}}">
       <!--  <ul class="pl-10 pt-4 sm:pl-20 leading-tight text-sm">
        <li>{{$artifact->artist}}</li>
        <li class="italic">{{$artifact->title}}</li>
        <li>{{$artifact->medium}}</li>
        <li>{{$artifact->year}}</li>
        </ul>
        
        <ul class="pl-10 pt-4 sm:pl-20 leading-tight text-sm">
        <li>{{$artifact->annotation}}</li>
        </ul>-->

    </div>

</div>

<!-- end wrapper -->
                    
</x-guest-layout>