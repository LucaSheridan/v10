<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl text-gray-100 leading-tight">
            Edit Component
        </h2>
    </x-slot>

    <div class="mx-auto">
        <div class="flex flex-wrap justify-center">
            <div class="w-full max-w-sm">
                
                <div class="flex flex-col break-words bg-white border border-2 rounded shadow-md mt-8">

                    <div class="font-semibold bg-gray-200 text-gray-700 py-3 px-6 mb-0">
                        Edit Component
                    </div>

                    {{-- Begin Form--}}

                    <form id="edit_component" method="POST" action="{{ route('update-component',
                    [ 'section' => $section->id, 
                      'assignment' => $assignment->id,
                      'component' => $komponent->id
                    ])}}">
    
                    {{ csrf_field() }}

                    <input type="hidden" name="_method" value="PATCH">
 
                    <div class="p-3 border-l-2 border-b-0 border-r-2">
            
                    {{-- Begin Title Input--}}
            
                    <div class="mb-2">

                        <label for="title" class="w-full md:mb-0 font-semibold text-gray-600 text-sm pt-2 pr-3 align-middle">Title</label>

                        <input id="title" type="text" class="w-full mt-2 rounded h-8 p-1 border text-gray-600 text-sm {{ $errors->has('title') ? 'border-red-500' : 'border' }}" name="title" value="{{ $komponent->title }}" autofocus>
                        {!! $errors->first('title', '<span class="text-red-500 text-sm mt-2">:message</span>') !!}

                    </div>

                    {{-- Begin Description Input--}}
            
                    <div class="mb-2">

                        <label for="description" class="w-full md:mb-0 font-semibold text-gray-600 text-sm pt-2 pr-3 align-middle">Instructions</label>

                        <input id="description" type="text" class="w-full mt-2 rounded h-8 p-1 border text-gray-600 text-sm {{ $errors->has('description') ? 'border-red-500' : 'border' }}" name="description" value="{{ $komponent->description }}" autofocus>
                        {!! $errors->first('description', '<span class="text-red-500 text-sm mt-2">:message</span>') !!}

                    </div>

                  {{-- Begin Due Date Input --}}
                    
                    <div class="mb-2">
  
                        <label for="date_due" class="w-full m-0 font-semibold text-gray-600 text-sm pt-2 pr-3 align-middle">Due Date</label>

                        @if(is_null($komponent->date_due))
                        
                        <input id="date_due" type="text" class="w-full mt-2 rounded h-8 p-1 border text-gray-600 text-sm {{ $errors->has('date_due') ? 'border-red-500' : 'border' }}" name="date_due" value="" autofocus>

                        @else
                       
                        <input id="date_due" type="text" class="w-full mt-2 rounded h-8 p-1 border text-gray-600 text-sm {{ $errors->has('date_due') ? 'border-red-500' : 'border' }}" name="date_due" value="{{Carbon\Carbon::parse($komponent->date_due)->format('m/d/y') }}" autofocus>
                         @endif

                       <!--  <input id="date_due" type="text" class="w-full mt-2 rounded h-8 p-1 border text-gray-600 text-sm {{ $errors->has('date_due') ? 'border-red-500' : 'border' }}" name="date_due" value="{{Carbon\Carbon::parse($komponent->date_due)->format('m/d/y') }}" autofocus> -->
                        
                        {!! $errors->first('date_due', '<span class="text-red-500 text-sm mt-2">:message</span>') !!}
    
                        
                        </div>

                        <div class="mb-2">

                            <label for="class_viewable" class="w-full m-0 font-semibold text-gray-600 text-sm pt-2 pr-3 align-middle">Viewable By Class</label>

                                @if( $komponent->class_viewable =='1')
                            
                                        <label class="inline-flex items-center">
                                        <input type="radio" class="form-checkbox mr-2" checked name="class_viewable" value="true"
                                        >Yes
                                        </label>

                                        <label class="inline-flex items-center">
                                        <input type="radio" class="form-checkbox mr-2" name="class_viewable" value="false">No
                                        </label>

                                        @else

                                        <label class="inline-flex items-center">
                                        <input type="radio" class="form-checkbox mr-2" name="class_viewable" value="true"
                                        >Yes
                                        </label>

                                        <label class="inline-flex items-center">
                                        <input type="radio" class="form-checkbox mr-2" checked name="class_viewable" value="false">No
                                        </label>

                                @endif
                        
                        </div>

                        <div class="mb-2">

                            <label for="class_view" class="w-full m-0 font-semibold text-gray-600 text-sm pt-2 pr-3 align-middle">Time Due</label>

                                hour: <input id="hour" type="text" name="hour" value="{{Carbon\Carbon::parse($komponent->date_due)->format('H') }}" ><br/>
                                minutes: <input id="min" type="text" name="min" value="{{Carbon\Carbon::parse($komponent->date_due)->format('i') }}" >
                                <input id="sec" type="hidden" name="sec" value="59" >
                    
                        </div>    

                        <div class="mt-4 text-center">

                          <a href="{{ url()->previous() }}" class="inline-block border-gray-400 mb-1 md:mb-0 bg-gray-400 hover:bg-gray-500 text-gray-700 hover:text-white px-4 py-2 text-sm uppercase tracking-wide font-semibold rounded">Cancel</a>

                          <button type="submit" class="mb-1 md:mb-0 bg-gray-400 hover:bg-green-500 text-gray-700 hover:text-green-100 px-4 py-2 text-sm uppercase tracking-wide font-semibold rounded">Update</button>

                         
                         
                    </div>
                    </div>
                
                </form>

    {{-- End Form --}}

                </div>
            </div>
        </div>
    </div>

</x-app-layout>