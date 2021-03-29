<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl text-gray-100 leading-tight">
            Artifact
        </h2>
    </x-slot>

    <div class="container mx-auto ">
        <div class="flex flex-wrap justify-center mx-3">
            <div class="w-full max-w-xl ">
                
                <div class="flex flex-col break-words bg-white rounded-lg shadow-md mt-8">

                    <div class="font-semibold text-gray-700 py-3 px-4 mb-0 rounded-t-lg bg-gray-100 border-b">
                        Add/Edit Artifact Info
                    </div>

                    <div class="px-4 py-3 w-full flex flex-wrap">
                    
                    <!-- Start Artifact Info Column -->
                        <div class="w-1/2 pr-4 text-sm">

                        {{-- Begin Form --}} 

                        <form id="edit_artifact" method="POST" action="{{ route('update-artifact', ['artifact' => $artifact->id]) }}">
                        
                        {{ csrf_field() }}
                        
                        <input type="hidden" name="_method" value="PATCH">

                
                       {{-- Begin Artist Input--}}
                
                        <div class="mb-2">

                            <label for="artist" class="w-full md:mb-0 font-semibold text-gray-400 text-sm pt-2 pr-3 align-middle">Artist</label>

                            <input id="artist" type="text" class="w-full mt-2 rounded h-8 py-1 px-2 border text-gray-600 text-sm {{ $errors->has('artist') ? 'border-red-500' : 'border' }}" name="artist" value="{{ $artifact->artist}}" tabIndex="1">
                            {!! $errors->first('artist', '<span class="text-red-500 text-sm mt-2">:message</span>') !!}

                        </div>

                        {{-- Begin Title Input--}}
                
                        <div class="mb-2">

                            <label for="title" class="w-full md:mb-0 font-semibold text-gray-400 pt-2 pr-3 align-middle">Title</label>

                            <input id="title" type="text" class="w-full mt-2 rounded h-8 py-1 px-2 border text-gray-600 text-sm {{ $errors->has('title') ? 'border-red-500' : 'border' }}" name="title" value="{{ $artifact->title}}" autofocus tabIndex="2">

                            {!! $errors->first('title', '<span class="text-red-500 text-sm mt-2">:message</span>') !!}

                        </div>

                    {{-- Begin Medium Input--}}
                
                        <div class="mb-2">

                            <label for="medium" class="w-full md:mb-0 font-semibold text-gray-400 text-sm pt-2 pr-3 align-middle">Medium</label>

                            <input id="medium" type="text" class="w-full mt-2 rounded h-8 py-1 px-2 border text-gray-600 text-sm {{ $errors->has('medium') ? 'border-red-500' : 'border' }}" name="medium" value="{{ $artifact->medium }}" tabIndex="3">
                            {!! $errors->first('medium', '<span class="text-red-500 text-sm mt-2">:message</span>') !!}

                        </div>

                     {{-- Begin Year Input--}}
                
                        <div class="mb-2">

                            <label for="year" class="w-full md:mb-0 font-semibold text-gray-400 text-sm pt-2 pr-3 align-middle">Year</label>

                            <input id="year" type="text" class="w-full mt-2 rounded h-8 py-1 px-2 border text-gray-600 text-sm {{ $errors->has('year') ? 'border-red-500' : 'border' }}" name="year" value="{{ $artifact->year}}" tabIndex="4">
                            {!! $errors->first('year', '<span class="text-red-500 text-sm mt-2">:message</span>') !!}

                        </div>

                <div class="mt-5 grid gap-y-6 gap-x-1 grid-cols-10"> 
                
                    {{-- Dimensions Height Input--}}
                    <div class="col-span-2">    
                    <label for="dimensions_height" class="block font-medium leading-5 text-gray-400">
                          Height
                        </label>
                        <div class="mt-1 rounded-md shadow-sm">
                          <input id="dimensions_height"  type="text" class="form-input block w-full transition duration-150 ease-in-out text-sm text-gray-600 py-1 px-2 sm:leading-5 {{ $errors->has('dimensions_height') ? 'border-red-500' : 'border' }}"  name="dimensions_height" value="{{ $artifact->dimensions_height}}" tabIndex="5">
                        </div>
                    </div>

                    {{-- Dimensions Width Input--}}
                    <div class="col-span-2">
                        <label for="dimensions_width" class="block text-sm font-medium leading-5 text-gray-400">
                          Width
                        </label>
                        <div class="mt-1 rounded-md shadow-sm">
                          <input id="dimensions_width"  type="text" class="form-input block w-full transition duration-150 py-1 px-2 text-sm text-gray-600 ease-in-out sm:leading-5 {{ $errors->has('dimensions_width') ? 'border-red-500' : 'border' }}" name="dimensions_width" value="{{ $artifact->dimensions_width}}" tabIndex="6">
                        </div>
                    </div>

                    {{-- Dimensions Depth Input--}}
                   <div class="col-span-2">
                        <label for="dimensions_depth" class="block font-medium leading-5 text-gray-400">
                          Depth
                        </label>
                        <div class="mt-1 rounded-md shadow-sm">
                          <input id="dimensions_depth"  type="text" class="form-input block w-full transition duration-150 ease-in-out py-1 px-2 text-sm text-gray-600 sm:leading-5 {{ $errors->has('dimensions_depth') ? 'border-red-500' : 'border' }} " name="dimensions_depth" value="{{ $artifact->dimensions_depth}}" tabIndex="7">
                        </div>
                    </div>

                    {{-- Dimension Measuring Units --}}
               <!--     <div class="col-span-2">
                        <label for="dimensions_units" class="block font-medium leading-5 text-gray-400">
                        Units
                        </label>
                        <div class="mt-1 rounded-md shadow-sm">
                          <input id="dimensions_units"  type="text" class="form-input block w-full transition duration-150 ease-in-out py-1 px-2  text-sm text-gray-600 sm:leading-5 {{ $errors->has('dimensions_units') ? 'border-red-500' : 'border' }} " name="dimensions_units" value="{{ $artifact->dimensions_units}}" tabIndex="8">
                        </div>
                    </div> -->

                    <div class="col-span-4 mt-0 rounded-md shadow-sm">
                      
                      <label for="dimensions_units" class="text-sm font-medium text-gray-400">Units</label>
                     
                      <select id="dimensions_units" name="dimensions_units" form="edit_artifact" class="form-select block w-full transition duration-150 ease-in-out mt-1 py-1 px-2 text-sm text-gray-600 sm:leading-5 $errors->has('dimensions_units') ? 'border-red-500' : 'border' }}" name="dimensions_units" tabIndex="8" type="select" value="{{$artifact->dimensions_units}}">

                      <option value="inches"
                      @if ($artifact->dimensions_units  == "inches")
                      {{'selected="selected"'}}
                      @endif
                      >
                      inches</option>

                      <option value="cm"
                      @if ($artifact->dimensions_units  == "cm")
                      {{'selected="selected"'}}
                      @endif
                      >
                      cm
                  </option>

                      <option value=""
                      @if ($artifact->dimensions_units  == "")
                      {{'selected="selected"'}}
                      @endif
                      >none</option>
                      
                     </select>

                        <!--  <select id="location" name="location" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        <option selected>inches</option>
                        <option>cm</option>
                    </select> -->

                    </div>

                   
                </div>

                 <!-- End Artifact Info Column -->

                 </div>

                <!-- End Annotation Column -->

                <div class="w-1/2">

                 {{-- Annotation Input--}}
            
                        <label for="description" class="w-full font-semibold text-gray-400 text-sm pt-2 pr-3 align-middle">Annotation</label>

                        <!-- Alpine.js character counter soyrced from
                             https://ryangjchandler.co.uk/articles/build-a-remaining-character-count-component-with-alpinejs -->

                         <div x-data="{ annotation: $el.dataset.annotation,
                                        limit: $el.dataset.limit,
                                        get remaining() {
                                            return this.limit - this.annotation.length}
                                        }"
                               data-limit="500" 
                               data-annotation="{{$artifact->annotation }}">

                        <textarea id="annotation" x-model="annotation" class="w-full h-80 mt-2 rounded p-2 border text-gray-400 leading-snug text-sm {{ $errors->has('annotation') ? 'border-red-500' : 'border' }}" name="annotation" tabIndex="9">{{ $artifact->annotation}}</textarea>

                        {!! $errors->first('annotation', '<span class="text-red-500 text-sm mt-2">:message</span>') !!}

                        <p id="remaining" class="text-gray-400 text-xs">
                        You have <span x-text="remaining"></span> characters remaining.
                        </p>

                        </div>
                        <!-- End Annotation Column -->

                        <div class="w-full mt-6 mb-4 text-right">

                          <a href="{{ url()->previous() }}" class="inline-block mb-1 md:mb-0 bg-gray-400 hover:bg-red-500 text-gray-700 hover:text-white px-4 py-2 text-sm uppercase tracking-wide font-semibold rounded">Cancel</a>

                          <button type="submit" class="mb-1 md:mb-0 bg-gray-400 hover:bg-green-500 text-gray-700 hover:text-green-100 px-4 py-2 text-sm uppercase tracking-wide font-semibold rounded" tabIndex="10">Save</button>

                    </div>

                </div>
                
                </form>

{{-- End Form --}}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
