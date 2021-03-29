<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl text-gray-100 leading-tight">
            Assignment
        </h2>
    </x-slot>

      <div class="container mx-auto h-full bg-cool-gray-400">
        <div class="flex flex-wrap justify-center">
            <div class="w-full max-w-md mx-4">
                
                <div class="flex flex-col break-words bg-white border border-2 rounded shadow-md mt-8">

                    <div class="font-semibold bg-gray-200 text-gray-700 py-3 px-6 mb-0">
                        Create New Assignment
                    </div>

                    {{-- Begin Form --}} 

    <form id="create_assignment" method="POST" action="{{ route('save-assignment', $section->id) }}">
            {{ csrf_field() }}

            <div class="p-3 border-l-2 border-b-0 border-r-2">
            
                {{-- Begin Title Input--}}
            
                    <div class="mb-2">

                        <label for="title" class="w-full md:mb-0 font-semibold text-gray-600 text-sm pt-2 pr-3 align-middle">Title</label>

                        <input id="title" type="text" class="w-full mt-2 rounded h-8 px-2 border text-gray-600 text-md p-1 {{ $errors->has('title') ? 'border-red-500' : 'border' }}" name="title" value="{{ old('title') }}" autofocus tabIndex="1">
                        {!! $errors->first('title', '<span class="text-red-500 text-sm mt-2">:message</span>') !!}

                    </div>

                {{-- Begin Description Input--}}
            
                    <div class="mb-2">

                        <label for="description" class="w-full font-semibold text-gray-600 text-sm pt-2 pr-3 align-middle">Description</label>

                        <textarea id="description" class="w-full mt-2 rounded p-2 border text-gray-600 text-sm leading-snug {{ $errors->has('description') ? 'border-red-500' : 'border' }}" name="description" value="{{ old('description') }}" tabIndex="2">{{ old('description') }}</textarea>
                        {!! $errors->first('description', '<span class="text-red-500 text-sm mt-2">:message</span>') !!}


                    </div>

                {{-- Begin Due Date Input--}}
            
                    <div class="mb-2">

                        <label for="date_due" class="w-full md:mb-0 font-semibold text-gray-600 text-sm pt-2 pr-3 align-middle">Due Date (mm/dd/yy)</label>

                        <input id="date_due" type="text" class="w-full mt-2 rounded h-8 text-md p-1  border text-gray-600 text-sm {{ $errors->has('date_due') ? 'border-red-500' : 'border' }}" name="date_due" value="{{ old('date_due') }}" tabIndex="3">
                        {!! $errors->first('date_due', '<span class="text-red-500 text-sm mt-2">:message</span>') !!}

                    </div>
       
                    <div class="my-1 text-center">

                          <a href="{{route('show-section', $section)}}" class="inline-block mb-1 md:mb-0 bg-gray-400 hover:bg-red-500 text-gray-700 hover:text-white px-4 py-2 text-sm uppercase tracking-wide font-semibold rounded">Cancel</a>

                          <button type="submit" class="mb-1 md:mb-0 bg-gray-400 hover:bg-green-500 text-gray-700 hover:text-green-100 px-4 py-2 text-sm uppercase tracking-wide font-semibold rounded" tabIndex="4">Submit</button>

                    </div>
                    </div>
                
                </form>

    {{-- End Form --}}

                </div>
            </div>
        </div>
    </div>

</x-app-layout>