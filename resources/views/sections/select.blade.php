<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl text-gray-100 leading-tight">
            Enroll
        </h2>
    </x-slot>
    <div class="container mx-auto">
        <div class="flex flex-wrap justify-center">
            <div class="w-full max-w-sm">
                
                <div class="flex flex-col break-words bg-white border border-2 rounded shadow-md mt-8">

                    <div class="font-semibold bg-gray-200 text-gray-700 py-3 px-6 mb-0">
                    Enroll in a new Class
                    </div>

                    {{-- Begin Form --}} 


                    <form id="join_class" method="POST" role="form" action="{{ route('join-class') }}" novalidate>

                    {{ csrf_field() }}

                    <div class="p-3 border-l-2 border-b-0 border-r-2">
              
                    {{-- Begin Registration Code Input--}}
            
                    <div class="mb-2">

                        <label for="registrationCode" class="w-full md:mb-0 font-semibold text-gray-600 text-sm pt-2 pr-3 align-middle">Registration Code</label>

                        <input id="registrationCode" type="text" class="w-full mt-2 rounded h-8 px-2 border text-gray-600 text-md p-1 {{ $errors->has('registrationCode') ? 'border-red-500' : 'border' }}" name="registrationCode" value="{{ old('registrationCode') }}" autofocus tabIndex="1">
                        {!! $errors->first('registrationCode', '<span class="text-red-500 text-sm mt-2">:message</span>') !!}

                    </div>

                        <div class="my-1 text-center">

                          <a href="{{url('/home')}}" class="inline-block mb-1 md:mb-0 bg-gray-400 hover:bg-gray-500 text-gray-700 hover:text-white px-4 py-2 text-sm uppercase tracking-wide font-semibold rounded">Cancel</a>

                          <button type="submit" class="mb-1 md:mb-0 bg-gray-400 hover:bg-green-500 text-gray-700 hover:text-green-100 px-4 py-2 text-sm uppercase tracking-wide font-semibold rounded" tabIndex="3">Enroll in Class</button>

                    </div>
                    </div>
                
                </form>

                {{-- End Form --}}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
        