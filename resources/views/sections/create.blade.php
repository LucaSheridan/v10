<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl text-gray-100 leading-tight">
            Classes
        </h2>
    </x-slot>

    <div class="container mx-auto h-full">
        <div class="flex flex-wrap justify-center">
            <div class="w-full max-w-sm">
                
                <div class="flex flex-col break-words bg-white border border-2 rounded shadow-md mt-8">

                    <div class="font-semibold bg-gray-200 text-gray-700 py-3 px-6 mb-0">
                        Create New Section
                    </div>

                    {{-- Begin Form --}} 

                 <form id="create_section" method="POST" action="{{ route('save-section')}}">
            {{ csrf_field() }}

            <div class="p-3 border-l-2 border-b-0 border-r-2">
            
                {{-- Begin Title Input--}}
            
                    <div class="mb-2">

                        <label for="title" class="w-full md:mb-0 font-semibold text-gray-600 text-sm pt-2 pr-3 align-middle">Name</label>

                        <input id="title" type="text" class="w-full mt-2 rounded h-8 p-1 border text-gray-600 text-sm {{ $errors->has('title') ? 'border-red-500' : 'border' }}" name="title" value="{{ old('title') }}" autofocus>
                        {!! $errors->first('title', '<span class="text-red-500 text-sm mt-2">:message</span>') !!}

                    </div>

                {{-- Site Input --}}
                    
                    <div class="mb-2">
  
                        <label for="site" class="w-full m-0 font-semibold text-gray-600 text-sm pt-2 pr-3 align-middle">Site</label>

                        <select id="site" form="create_section" class="mt-2 px-2 py-1 pr-8 bg-gray-300 form-select text-sm w-full" name="site" type="select" class="form-select">


                        @foreach ($sites as $site)

                            <option value="{{$site->id}}">{{ $site->name}}</option>

                        @endforeach

                        </select>

                        {!! $errors->first('site', '<span class="text-red-500 text-sm mt-2">:message</span>') !!}
    
                    </div>

                {{-- Submit or Cancel --}}

                    <div class="my-1 text-center">

                          <a href="{{ url()->previous() }}" class="inline-block mb-1 md:mb-0 bg-gray-400 hover:bg-red-500 text-gray-700 hover:text-white px-4 py-2 text-sm uppercase tracking-wide font-semibold rounded">Cancel</a>

                          <button type="submit" class="mb-1 md:mb-0 bg-gray-400 hover:bg-green-500 text-gray-700 hover:text-green-100 px-4 py-2 text-sm uppercase tracking-wide font-semibold rounded">Submit</button>

                    </div>
                    </div>
                
                </form>

    {{-- End Form --}}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
