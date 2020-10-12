<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl text-gray-100 leading-tight">
            Collections
        </h2>
    </x-slot>

      <div class="container mx-auto">
        <div class="flex flex-wrap justify-center">
            <div class="w-full max-w-sm">
                
                <div class="flex flex-col break-words bg-white border border-2 rounded shadow-md mt-8">

                    <div class="font-semibold bg-gray-200 text-gray-700 py-3 px-6 mb-0">
                        Edit Label
                    </div>

                {{-- Begin Form --}} 

                <form id="update_label" method="POST" action="{{ action('App\Http\Controllers\CollectionController@updateLabel', ['collection' => $collection, 'artifact' => $artifact]) }}">

                <input type="hidden" name="_method" value="PATCH">

                {{ csrf_field() }}

                    <div class="p-3 border-l-2 border-b-0 border-r-2">
            
                    <input id="artifact" type="hidden" name="artifact" value="{{ $artifact->id }}">

                    {{-- Begin Position Input--}}
            
                    <div class="mb-2">

                        <label for="position" class="w-full md:mb-0 font-semibold text-gray-600 text-sm pt-2 pr-3 align-middle">Position</label>

                        <input id="position" type="text" class="w-full mt-2 rounded h-8 px-2 border text-gray-600 text-md p-1 {{ $errors->has('position') ? 'border-red-500' : 'border' }}" name="position" value="{{$position}}" autofocus tabIndex="">
                        {!! $errors->first('position', '<span class="text-red-500 text-sm mt-2">:message</span>') !!}

                    </div>

                    {{-- Begin Artist Input--}}
            
                    <div class="mb-2">

                        <label for="artist" class="w-full md:mb-0 font-semibold text-gray-600 text-sm pt-2 pr-3 align-middle">Artist</label>

                        <input id="artist" type="text" class="w-full mt-2 rounded h-8 px-2 border text-gray-600 text-md p-1 {{ $errors->has('artist') ? 'border-red-500' : 'border' }}" name="artist" value="{{$artist}}" autofocus tabIndex="1">
                        {!! $errors->first('artist', '<span class="text-red-500 text-sm mt-2">:message</span>') !!}

                    </div>

                    <div class="mb-2">

                        <label for="title" class="w-full md:mb-0 font-semibold text-gray-600 text-sm pt-2 pr-3 align-middle">Title</label>

                        <input id="title" type="text" class="w-full mt-2 rounded h-8 px-2 border text-gray-600 text-md p-1 {{ $errors->has('title') ? 'border-red-500' : 'border' }}" name="title" value="{{$title}}" autofocus tabIndex="2">
                        {!! $errors->first('title', '<span class="text-red-500 text-sm mt-2">:message</span>') !!}

                    </div>

                    {{-- Begin Medium Input--}}

                    <div class="mb-2">

                        <label for="medium" class="w-full md:mb-0 font-semibold text-gray-600 text-sm pt-2 pr-3 align-middle">Medium</label>

                        <input id="medium" type="text" class="w-full mt-2 rounded h-8 px-2 border text-gray-600 text-md p-1 {{ $errors->has('medium') ? 'border-red-500' : 'border' }}" name="medium" value="{{$medium}}" autofocus tabIndex="2">
                        {!! $errors->first('medium', '<span class="text-red-500 text-sm mt-2">:message</span>') !!}

                    </div>

                    {{-- Begin Year Input--}}

                    <div class="mb-2">

                        <label for="year" class="w-full md:mb-0 font-semibold text-gray-600 text-sm pt-2 pr-3 align-middle">Year</label>

                        <input id="year" type="text" class="w-full mt-2 rounded h-8 px-2 border text-gray-600 text-md p-1 {{ $errors->has('year') ? 'border-red-500' : 'border' }}" name="year" value="{{$year}}" autofocus tabIndex="3">
                        {!! $errors->first('year', '<span class="text-red-500 text-sm mt-2">:message</span>') !!}

                    </div>

                    {{-- Begin Hight Input--}}

                    <div class="mb-2">

                        <label for="dimensions_height" class="w-full md:mb-0 font-semibold text-gray-600 text-sm pt-2 pr-3 align-middle">Height</label>

                        <input id="dimensions_height" type="text" class="w-full mt-2 rounded h-8 px-2 border text-gray-600 text-md p-1 {{ $errors->has('dimensions_height') ? 'border-red-500' : 'border' }}" name="dimensions_height" value="{{ $dimensions_height}}" autofocus tabIndex="4">
                        {!! $errors->first('dimensions_height', '<span class="text-red-500 text-sm mt-2">:message</span>') !!}

                    </div>

                     <div class="mb-2">

                        <label for="dimensions_width" class="w-full md:mb-0 font-semibold text-gray-600 text-sm pt-2 pr-3 align-middle">Width</label>

                        <input id="dimensions_width" type="text" class="w-full mt-2 rounded h-8 px-2 border text-gray-600 text-md p-1 {{ $errors->has('dimensions_width') ? 'border-red-500' : 'border' }}" name="dimensions_width" value="{{$dimensions_width}}" autofocus tabIndex="5">
                        {!! $errors->first('dimensions_width', '<span class="text-red-500 text-sm mt-2">:message</span>') !!}

                    </div>

                     <div class="mb-2">

                        <label for="dimensions_depth" class="w-full md:mb-0 font-semibold text-gray-600 text-sm pt-2 pr-3 align-middle">Depth</label>

                        <input id="dimensions_depth" type="text" class="w-full mt-2 rounded h-8 px-2 border text-gray-600 text-md p-1 {{ $errors->has('dimensions_depth') ? 'border-red-500' : 'border' }}" name="dimensions_depth" value="{{$dimensions_depth}}" autofocus tabIndex="6">
                        {!! $errors->first('dimensions_depth', '<span class="text-red-500 text-sm mt-2">:message</span>') !!}

                    </div>

                    <div class="mb-2">

                        <label for="dimensions_units" class="w-full md:mb-0 font-semibold text-gray-600 text-sm pt-2 pr-3 align-middle">Measurement Units</label>

                        <input id="dimensions_units" type="text" class="w-full mt-2 rounded h-8 px-2 border text-gray-600 text-md p-1 {{ $errors->has('dimensions_units') ? 'border-red-500' : 'border' }}" name="dimensions_units" value="{{$dimensions_units}}" autofocus tabIndex="7">
                        {!! $errors->first('dimensions_units', '<span class="text-red-500 text-sm mt-2">:message</span>') !!}

                    </div>




                    {{-- Begin Collection Description Input --}}
            
                    <div class="mb-2">

                        <label for="description" class="w-full font-semibold text-gray-600 text-sm pt-2 pr-3 align-middle">Label Text</label>

                        <textarea id="label_text" class="w-full my-2 rounded p-2 border text-gray-600 text-sm leading-tight {{ $errors->has('label_text') ? 'border-red-500' : 'border' }}" name="label_text" tabIndex="8">{{$label_text}}</textarea>

                    </div>
       
                    <div class="my-1 text-center">

                          <a href="{{route('show-collection', $collection)}}" class="inline-block mb-1 md:mb-0 bg-gray-400 hover:bg-red-500 text-gray-700 hover:text-white px-4 py-2 text-sm uppercase tracking-wide font-semibold rounded">Cancel</a>

                          <button type="submit" class="mb-1 md:mb-0 bg-gray-400 hover:bg-green-500 text-gray-700 hover:text-green-100 px-4 py-2 text-sm uppercase tracking-wide font-semibold rounded" tabIndex="9">Update</button>

                    </div>
                    </div>
                
                </form>

                {{-- End Form --}}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
