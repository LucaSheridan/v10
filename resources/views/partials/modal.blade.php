<!-- TailwindUI MOdal -->

<div x-show="showModal" x-cloak class="fixed z-10 inset-0 overflow-y-auto">

  <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0" >

        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

<div @click.away="showModal = false" class="inline-block align-bottom bg-red-200 rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-sm sm:w-full sm:p-6" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
      <div>
        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
          <!-- Heroicon name: outline/check -->
          <x-feathericon-camera/>
        </div>
        <div class="mt-3 text-center sm:mt-5">
          <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
            Choose a File...
          </h3>
          <div class="mt-2">
            <p class="text-sm text-gray-500">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur amet labore.
            </p>
          </div>
        </div>
      </div>
      <div class="mt-5 sm:mt-6">
        <button type="button" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">
          Go back to dashboard
        </button>
     




      </div>

<!-- Begin Frankenstein Create -->

    <div class="flex flex-col items-center text-center p-4 pt-10 md:p-10">

    <div class="bg-gray-200 border-2 border-gray-500 w-3/4 md:w-1/2 lg:w-1/3  p-2 pt-4 mb-4 sm:mb-4 rounded-lg">
    Select a file...

    <form action="{{route('save-artifact')}}" role="form" method="POST" enctype="multipart/form-data" class="">

            {!! csrf_field() !!}
      
            <input type="file" style="display:none" name="file" value="{{ old('file') }}" id="file">

 {{-- Pass Artifact if variable is set --}}

               <input type="hidden" name="user_id" value="{{ Auth::User()->id }}">
              
               @if (!isset($section))
               @else
               <input type="hidden" name="section_id" value="
               {{$section->id}}">
               @endif
               
               @if (!isset($assignment))
               @else
               <input type="hidden" name="assignment_id" value="{{$assignment->id}}">
               @endif
               
               @if (!isset($komponent))
               @else
               <input type="hidden" name="component_id" value="{{$komponent->id}}"> 
               @endif

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

                <x-jet-button class="" @click="clicked = true">
                {{ __('Upload') }}
                </x-jet-button>

                <div x-show.transition.duration.1000="clicked">
                <x-feathericon-refresh-cw x-show.transition.duration.1000="clicked" class="animate-spin" />
                </div>
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

<!-- End Frankenstein Create -->


    </div>
  </div>
</div>