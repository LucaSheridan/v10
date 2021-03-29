<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl text-gray-100 leading-tight">
            Classes
        </h2>
    </x-slot>

    <div class="flex flex-col items-center text-center p-4 pt-10 md:p-10">

    <div class="bg-gray-200 border-2 border-gray-500 w-3/4 md:w-1/2 lg:w-1/3  p-2 pt-4 mb-4 sm:mb-4 rounded-lg">
    Select a file...

    <form action="{{route('save-artifact')}}" role="form" method="POST" enctype="multipart/form-data" class="">

            {!! csrf_field() !!}
      
            <input type="file" style="display:none" name="file" value="{{ old('file') }}" id="file">

 {{-- Pass Artifact if variable is set --}}

               <input type="hidden" name="user_id" value="{{ Auth::User()->id }}">
               <input type="hidden" name="section_id" value="{{$section->id}}">
               <input type="hidden" name="assignment_id" value="{{$assignment->id}}">
               <input type="hidden" name="component_id" value="{{$komponent->id}}">

                <label for="file" class="block mx-auto text-gray-600 mt-2 text-center p-2 rounded">
               
                    <div class="relative flex items-center justify-center text-gray-600">
                        <div class="p-2 bg-gray-100 hover:bg-gray-500 hover:text-gray-100 rounded-full">
                        <x-feathericon-camera/>
                        </div>
                     </div>

                </label>
                        
                <div class="mb-2 p-1 rounded" id="filename"></div>

                @if ($errors->has('file'))
                <div class="help-block mb-4 text-red-500">
                {{ $errors->first('file') }}
                </div>
                @endif
            
                <div x-data="{ clicked: false }">
            
               <input class="inline-block btn-gray" type="submit" value="submit" @click="clicked = true">

                <div  id="fileSubmitButton"><x-jet-button class="" @click="clicked = true">
                {{ __('Upload') }}
                </x-jet-button>
                </div>

                <!-- <div x-show.transition.duration.1000="clicked">
                <x-feathericon-refresh-cw x-show.transition.duration.1000="clicked" class="animate-spin" />
                </div> -->
            </div>

                </form>

        </div>

         <div class="w-10 bg-gray-600 inline-block sm:flex-grow-0 border-2 rounded-full text-gray-100 mx-2 p-2">
        or
        </div>

    
    <!-- <div class="bg-gray-300 flex-1 items-center sm:self-stretch border-2 rounded-lg pt-4 border-gray-500 sm:border-gray-500 p-2 mt-4 sm:mt-4"> -->

    <div class="bg-gray-200 border-2 border-gray-500 w-3/4 md:w-1/2 lg:w-1/3  p-2 pt-4  mt-4 rounded-lg">

    Create from URL

     <form action="{{ route('save-artifact-from-url') }}" role="form" method="POST" enctype="multipart/form-data">

            {!! csrf_field() !!}
      
            <input type="text" name="url" class="block mx-auto my-4 w-3/4 bg-white p-2 rounded" value="{{ old('url') }}" id="url" placeholder="http://www.website.com/.artwork.jpg">
            
            <input type="hidden" name="user_id" value="{{ Auth::User()->id }}">
            {{-- <input type="hidden" name="section_id" value="{{$section->id}}"> --}}
            {{-- <input type="hidden" name="assignment_id" value="{{$assignment->id}}"> --}}
            {{-- <input type="hidden" name="component_id" value="{{$component->id}}"> --}}

            @if ($errors->has('url'))
            <div class="help-block mb-4 text-red-500">
            {{ $errors->first('url') }}
            </div>
            @endif

            <div x-data="{ clicked: false }">
            
               <input class="inline-block btn-gray" type="submit" value="submit" @click="clicked = true">

                <x-jet-button class=""  @click="clicked = true">
                {{ __('Upload') }}
                </x-jet-button>

                <div x-show.transition.duration.1000="clicked">
                <x-feathericon-refresh-cw x-show.transition.duration.1000="clicked" class="animate-spin" />
                </div>
            </div>
            
            </form>

    </div>


</div>
 
</div>
</div>         
</div>   

</x-app-layout>