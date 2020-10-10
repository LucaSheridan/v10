<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl text-gray-100 leading-tight">
            Artifact
        </h2>
    </x-slot>

    <div class="container mx-auto">
        <div class="flex flex-wrap justify-center">
            <div class="w-full max-w-lg">
                
                <div class="flex flex-col break-words bg-gray-100 border border-2 rounded shadow-md mt-8">

                    <div class="font-semibold bg-gray-200 text-gray-700 py-3 px-6 mb-0">
                        Edit Artifact Info
                    </div>

                {{-- Begin Form --}} 

                    <form id="edit_artifact" method="POST" action="{{ route('update-artifact', ['artifact' => $artifact->id]) }}">
                    
                    {{ csrf_field() }}
                    
                    <input type="hidden" name="_method" value="PATCH">

                    <div class="p-3 border-l-2 border-b-0 border-r-2">
            
                {{-- Begin Title Input--}}
            
                    <div class="mb-2">

                        <label for="title" class="w-full md:mb-0 font-semibold text-gray-600 text-sm pt-2 pr-3 align-middle">Title</label>

                        <input id="title" type="text" class="w-full mt-2 rounded h-8 p-1 border text-gray-600 text-sm {{ $errors->has('title') ? 'border-red-500' : 'border' }}" name="title" value="{{ $artifact->title}}" autofocus tabIndex="1">

                        {!! $errors->first('title', '<span class="text-red-500 text-sm mt-2">:message</span>') !!}

                    </div>

                {{-- Begin Artist Input--}}
            
                    <div class="mb-2">

                        <label for="artist" class="w-full md:mb-0 font-semibold text-gray-600 text-sm pt-2 pr-3 align-middle">Artist</label>

                        <input id="artist" type="text" class="w-full mt-2 rounded h-8 p-1 border text-gray-600 text-sm {{ $errors->has('artist') ? 'border-red-500' : 'border' }}" name="artist" value="{{ $artifact->artist}}" autofocus tabIndex="2">
                        {!! $errors->first('artist', '<span class="text-red-500 text-sm mt-2">:message</span>') !!}

                    </div>


                {{-- Begin Medium Input--}}
            
                    <div class="mb-2">

                        <label for="medium" class="w-full md:mb-0 font-semibold text-gray-600 text-sm pt-2 pr-3 align-middle">Medium</label>

                        <input id="medium" type="text" class="w-full mt-2 rounded h-8 p-1 border text-gray-600 text-sm {{ $errors->has('medium') ? 'border-red-500' : 'border' }}" name="medium" value="{{ $artifact->medium }}" autofocus tabIndex="2">
                        {!! $errors->first('medium', '<span class="text-red-500 text-sm mt-2">:message</span>') !!}

                    </div>

                 {{-- Begin Year Input--}}
            
                    <div class="mb-2">

                        <label for="year" class="w-full md:mb-0 font-semibold text-gray-600 text-sm pt-2 pr-3 align-middle">Year</label>

                        <input id="year" type="text" class="w-full mt-2 rounded h-8 p-1 border text-gray-600 text-sm {{ $errors->has('year') ? 'border-red-500' : 'border' }}" name="year" value="{{ $artifact->year}}" autofocus tabIndex="3">
                        {!! $errors->first('year', '<span class="text-red-500 text-sm mt-2">:message</span>') !!}

                    </div>

                {{-- Annotation Input--}}
            
                    <div class="mb-2">

                        <label for="description" class="w-full font-semibold text-gray-600 text-sm pt-2 pr-3 align-middle">Annotation</label>

                        <textarea id="annotation" class="w-full mt-2 rounded p-2 border text-gray-600 leading-snug text-sm {{ $errors->has('annotation') ? 'border-red-500' : 'border' }}" name="annotation" value="" tabIndex="4">{{ $artifact->annotation}}</textarea>

                    </div>

                {{-- Dimensions Height Input--}}
            
                    <div class="mb-2">

                        <label for="dimensions_height" class="w-full md:mb-0 font-semibold text-gray-600 text-sm pt-2 pr-3 align-middle">Dimensions Height</label>

                        <input id="dimensions_height" type="text" class="w-full mt-2 rounded h-8 p-1 border text-gray-600 text-sm {{ $errors->has('dimensions_height') ? 'border-red-500' : 'border' }}" name="dimensions_height" value="{{ $artifact->dimensions_height}}" autofocus tabIndex="3">
                        {!! $errors->first('dimensions_height', '<span class="text-red-500 text-sm mt-2">:message</span>') !!}

                    </div>

                {{-- Dimensions Width Input--}}
            
                    <div class="mb-2">

                        <label for="dimensions_width" class="w-full md:mb-0 font-semibold text-gray-600 text-sm pt-2 pr-3 align-middle">Dimensions Width</label>

                        <input id="dimensions_width" type="text" class="w-full mt-2 rounded h-8 p-1 border text-gray-600 text-sm {{ $errors->has('dimensions_width') ? 'border-red-500' : 'border' }}" name="dimensions_width" value="{{ $artifact->dimensions_width}}" autofocus tabIndex="3">
                        {!! $errors->first('dimensions_width', '<span class="text-red-500 text-sm mt-2">:message</span>') !!}

                    </div>

                {{-- Dimensions Depth Input--}}
            
                    <div class="mb-2">

                        <label for="dimensions_depth" class="w-full md:mb-0 font-semibold text-gray-600 text-sm pt-2 pr-3 align-middle">Dimensions Depth</label>

                        <input id="dimensions_depth" type="text" class="w-full mt-2 rounded h-8 p-1 border text-gray-600 text-sm {{ $errors->has('dimensions_depth') ? 'border-red-500' : 'border' }}" name="dimensions_depth" value="{{ $artifact->dimensions_depth}}" autofocus tabIndex="3">
                        {!! $errors->first('dimensions_depth', '<span class="text-red-500 text-sm mt-2">:message</span>') !!}

                    </div>

                {{-- Dimensions Units--}}
            
                    <div class="mb-2">

                        <label for="dimensions_units" class="w-full md:mb-0 font-semibold text-gray-600 text-sm pt-2 pr-3 align-middle">Measuring Units</label>

                        <input id="dimensions_units" type="text" class="w-full mt-2 rounded h-8 p-1 border text-gray-600 text-sm {{ $errors->has('dimensions_units') ? 'border-red-500' : 'border' }}" name="dimensions_units" value="{{ $artifact->dimensions_units}}" autofocus tabIndex="3">
                        {!! $errors->first('dimensions_units', '<span class="text-red-500 text-sm mt-2">:message</span>') !!}

                    </div>

                     <div class="my-1 text-center">

                          <a href="{{ url()->previous() }}" class="inline-block mb-1 md:mb-0 bg-gray-400 hover:bg-red-500 text-gray-700 hover:text-white px-4 py-2 text-sm uppercase tracking-wide font-semibold rounded">Cancel</a>

                          <button type="submit" class="mb-1 md:mb-0 bg-gray-400 hover:bg-green-500 text-gray-700 hover:text-green-100 px-4 py-2 text-sm uppercase tracking-wide font-semibold rounded" tabIndex="5">Save</button>

                    </div>

                </div>
                
                </form>

   <!--  <div class="w-full p-4">

    <form id="edit_artifact" method="POST" action="{{ route('update-artifact', ['artifact' => $artifact->id]) }}">
                    
    {{ csrf_field() }}
                    
    <input type="hidden" name="_method" value="PATCH">
  
    <div>

    <div class="mt-8 bg-gray-100 border-t border-gray-200 pt-8">
    
         <div class="sm:col-span-6">
          <label for="annotation" class="block text-sm font-medium leading-5 text-gray-700">
          Annotation
          </label>
          <div class="mt-1 rounded-md shadow-sm">
            <textarea id="annotation" rows="3" class="form-textarea block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">{{ $artifact->annotation}} </textarea>
          </div>
          <p class="mt-2 text-sm text-gray-500">Write a few sentences about your work.</p>
        </div>

        <div class="sm:col-span-6">
          <label for="title" class="block text-sm font-medium leading-5 text-gray-700">
          Title
          </label>
          <div class="mt-1 rounded-md shadow-sm">
            <input id="Title" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
          </div>
        </div>

        <div class="sm:col-span-6">
          <label for="title" class="block text-sm font-medium leading-5 text-gray-700">
          Artist
          </label>
          <div class="mt-1 rounded-md shadow-sm">
            <input id="artist" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
          </div>
        </div>

         <div class="sm:col-span-6">
          <label for="medium" class="block text-sm font-medium leading-5 text-gray-700">
          Medium
          </label>
          <div class="mt-1 rounded-md shadow-sm">
            <input id="medium" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
          </div>
        </div>

        <div class="sm:col-span-2">
          <label for="dimensions_height" class="block text-sm font-medium leading-5 text-gray-700">
          Height
          </label>
          <div class="mt-1 rounded-md shadow-sm">
            <input id="dimensions_height" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
          </div>
        </div>

        <div class="sm:col-span-2">
          <label for="dimensions_width" class="block text-sm font-medium leading-5 text-gray-700">
          Width
          </label>
          <div class="mt-1 rounded-md shadow-sm">
            <input id="dimensions_width" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
          </div>
        </div>

        <div class="sm:col-span-2">
          <label for="dimensions_depth" class="block text-sm font-medium leading-5 text-gray-700">
          Depth
          </label>
          <div class="mt-1 rounded-md shadow-sm">
            <input id="dimensions_depth" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
          </div>
        </div>
      </div>
    </div>

     <div class="sm:col-span-3">
          <label for="dimensions_units" class="block text-sm font-medium leading-5 text-gray-700">
          Dimension Units
          </label>
          <div class="mt-1 rounded-md shadow-sm">
            <select id="dimensions_units" class="form-select block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
              <option>cm</option>
              <option>inches</option>
            </select>
          </div>
        </div>
   
  </div>
  <div class="mt-8 border-t border-gray-200 pt-5">
    <div class="flex justify-end">
      <span class="inline-flex rounded-md shadow-sm">
        <button type="button" class="py-2 px-4 border border-gray-300 rounded-md text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
          Cancel
        </button>
      </span>
      <span class="ml-3 inline-flex rounded-md shadow-sm">
        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
          Save
        </button>
      </span>
    </div>
  </div>
</form> -->

{{-- End Form --}}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
