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
                        Edit Section
                    </div>

                    {{-- Begin Form --}} 

                    <form id="edit_section" method="POST" action="{{ route('update-section', $section) }}">
                    
                    {{ csrf_field() }}
                    
                    <input type="hidden" name="_method" value="PATCH">

                    <div class="p-3 border-l-2 border-b-0 border-r-2">
            
                {{-- Begin Title Input--}}
            
                    <div class="mb-2">

                        <label for="title" class="w-full md:mb-0 font-semibold text-gray-600 text-sm pt-2 pr-3 align-middle">Title</label>

                        <input id="title" type="text" class="w-full mt-2 rounded h-8 p-1 border text-gray-600 text-sm {{ $errors->has('title') ? 'border-red-500' : 'border' }}" name="title" value="{{ $section->title}}" autofocus>
                        {!! $errors->first('title', '<span class="text-red-500 text-sm mt-2">:message</span>') !!}

                    </div>

                {{-- Begin Registration Code Input--}}
            
                    <div class="mb-2">

                        <label for="registrationCode" class="w-full md:mb-0 font-semibold text-gray-600 text-sm pt-2 pr-3 align-middle">Registration Code</label>

                        <input id="registrationCode" type="text" class="w-full mt-2 rounded h-8 p-1 border text-gray-600 text-sm {{ $errors->has('registrationCode') ? 'border-red-500' : 'border' }}" name="registrationCode" value="{{ $section->registrationCode}}">
                        {!! $errors->first('registrationCode', '<span class="text-red-500 text-sm mt-2">:message</span>') !!}

                    </div>


                    <div class="mb-6">

                        @if( $section->is_active)
                        
                        <label class="inline-flex items-center">
                        
                        <input type="radio" class="form-checkbox mr-2" checked name="active" value="true"
                        >Active
                        </label>

                        <label class="inline-flex items-center">
                        <input type="radio" class="form-checkbox mr-2" name="active" value="false">Inactive
                        </label>

                        @else

                        <label class="inline-flex items-center">
                        <input type="radio" class="form-checkbox mr-2" name="active" value="true"
                        >Active
                        </label>

                        <label class="inline-flex items-center">
                        <input type="radio" class="form-checkbox mr-2" checked name="active" value="false">Inactive
                        </label>

                        @endif
                    
                    </div>

                    <div class="mb-6">

                        @if( $section->is_open)
                        
                            <label class="inline-flex items-center">
                            
                            <input type="radio" class="form-checkbox mr-2" checked name="open" value="true"
                            >Registration is Open
                            </label>

                            <label class="inline-flex items-center">
                            <input type="radio" class="form-checkbox mr-2" name="open" value="false">Registration is Closed
                            </label>

                        @else

                            <label class="inline-flex items-center">
                            <input type="radio" class="form-checkbox mr-2" name="open" value="true"
                            >Registration is Open
                            </label>

                            <label class="inline-flex items-center">
                            <input type="radio" class="form-checkbox mr-2" checked name="open" value="false">Registration is Closed
                            </label>

                        @endif
                    
                    </div>


                    <div class="my-1 text-center">

                          <a href="{{ url()->previous() }}" class="inline-block mb-1 md:mb-0 bg-gray-400 hover:bg-red-500 text-gray-700 hover:text-white px-4 py-2 text-sm uppercase tracking-wide font-semibold rounded">Cancel</a>

                          <button type="submit" class="mb-1 md:mb-0 bg-gray-400 hover:bg-green-500 text-gray-700 hover:text-green-100 px-4 py-2 text-sm uppercase tracking-wide font-semibold rounded">Save</button>

                    </div>

                </div>
                
                </form>

    {{-- End Form --}}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
