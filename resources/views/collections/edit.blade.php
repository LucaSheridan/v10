<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl text-gray-100 leading-tight">
            Collections
        </h2>
    </x-slot>

    <div class="container mx-auto">
        <div class="flex flex-wrap justify-center">
            <div class="w-full min-w-md max-w-lg">
                
                <div class="flex flex-col break-words bg-white border border-2 rounded shadow-md mt-8">

                    <div class="font-semibold bg-gray-200 text-gray-700 py-3 px-6 mb-0">
                        Edit Collection
                    </div>

                {{-- Begin Form --}} 

                <form id="edit_collection" method="POST" action="{{ route('update-collection', $collection) }}">
                {{ csrf_field() }}

                    <input type="hidden" name="_method" value="PATCH">

                    <div class="p-3 border-l-2 border-b-0 border-r-2">
            
                    {{-- Begin Title Input--}}
            
                    <div class="mb-2">

                        <label for="title" class="w-full md:mb-0 font-semibold text-gray-600 text-sm pt-2 pr-3 align-middle">Title</label>

                        <input id="title" type="text" class="w-full mt-2 rounded h-8 px-2 border text-gray-600 text-md p-1 {{ $errors->has('title') ? 'border-red-500' : 'border' }}" name="title" value="{{ $collection->title }}" autofocus tabIndex="1">
                        {!! $errors->first('title', '<span class="text-red-500 text-sm mt-2">:message</span>') !!}

                    </div>

                    {{-- Begin Collection Description Input --}}
            
                    <div class="mb-2">

                        <label for="description" class="w-full font-semibold text-gray-600 text-sm pt-2 pr-3 align-middle">Description</label>

                        <textarea id="description" class="w-full mt-2 rounded p-2 border text-gray-600 text-sm leading-tight {{ $errors->has('description') ? 'border-red-500' : 'border' }}" name="description" tabIndex="2">{{ $collection->description }}</textarea>

                    </div>
       
                    <div class="my-1 text-center">

                          <a href="{{route('collections', Auth::User())}}" class="inline-block mb-1 md:mb-0 bg-gray-400 hover:bg-gray-500 text-gray-700 hover:text-white px-4 py-2 text-sm uppercase tracking-wide font-semibold rounded">Cancel</a>

                          <button type="submit" class="mb-1 md:mb-0 bg-gray-400 hover:bg-green-500 text-gray-700 hover:text-green-100 px-4 py-2 text-sm uppercase tracking-wide font-semibold rounded" tabIndex="3">Update</button>

                    </div>
                    </div>
                
                </form>

                {{-- End Form --}}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

