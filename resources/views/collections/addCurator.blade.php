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
                    Add Curator to Collection
                    </div>

                    {{-- Begin Form --}} 

                 <form id="add_curator" method="POST" action="{{ route('attach-curator', $collection)}}">
            
                {{ csrf_field() }}

                <div class="p-3 border-l-2 border-b-0 border-r-2">
            
                {{-- Begin Users Input--}}
            
                    <div class="mb-2">

                    <label for="add_curator" class="w-full md:mb-0 font-semibold text-gray-600 text-sm pt-2 pr-3 align-middle">Add Curator</label>

                        <select id="add_curator" form="add_curator" class="mt-2 px-2 py-1 pr-8 bg-gray-300 form-select text-sm w-full" name="add_curator" type="select" class="form-select">

                            @foreach ($users as $user)

                                <option value="{{$user->id}}">{{ $user->fullName}}</option>

                            @endforeach

                        </select>


                        {!! $errors->first('user', '<span class="text-red-500 text-sm mt-2">:message</span>') !!}
    
                    </div>
                    

                 <div class="my-1 text-center">

                          <a href="{{ url()->previous() }}" class="inline-block mb-1 md:mb-0 bg-gray-400 hover:bg-red-500 text-gray-700 hover:text-white px-4 py-2 text-sm uppercase tracking-wide font-semibold rounded">Cancel</a>

                          <button type="submit" class="mb-1 md:mb-0 bg-gray-400 hover:bg-green-500 text-gray-700 hover:text-green-100 px-4 py-2 text-sm uppercase tracking-wide font-semibold rounded">Submit</button>

                    </div>
                    </div>
                
                </form>

    {{-- End Form --}}

    {{-- End Form --}}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
