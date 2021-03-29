<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl text-gray-100 leading-tight">
            Edit Comment
        </h2>
    </x-slot>
    
    <div class="container mx-auto ">
        <div class="flex flex-wrap justify-center mx-3">
            <div class="w-full max-w-md ">
                
                <div class="flex flex-col break-words bg-white rounded-lg shadow-md mt-8">

                    <div class="font-semibold text-gray-700 py-3 px-4 mb-0 rounded-t-lg bg-gray-100 border-b">
                        Edit Comment
                    </div>                    

                        {{-- Begin Form --}} 

                    <form id="edit_comment" method="POST" action="{{ route('update-comment', $comment) }}">
                    
                    {{ csrf_field() }}
                    
                    <input type="hidden" name="_method" value="PATCH">
                    
                    <input type="hidden" name="artifact_id" value="{{$comment->artifact_id}}">
                    <input type="hidden" name="user_id" value="{{$comment->user_id}}">

                    <div class="p-3">

                {{-- Begin Description Input--}}
            
                    <div class="mb-2">

                        <label for="description" class="w-full font-semibold text-gray-600 text-sm pt-2 pl-1 align-middle">Comment Body</label>

                        <textarea id="body" class="w-full mt-2 rounded pl-1 py-2 border text-gray-600 leading-snug text-sm {{ $errors->has('body') ? 'border-red-500' : 'border' }}" name="body">{{ $comment->body}}</textarea>

                    </div>

                    <div class="my-1 text-center">

                          <a href="{{ url()->previous() }}" class="inline-block mb-1 md:mb-0 bg-gray-400 hover:bg-gray-500 text-gray-700 hover:text-white px-4 py-2 text-sm uppercase tracking-wide font-semibold rounded">Cancel</a>

                          <button type="submit" class="mb-1 md:mb-0 bg-gray-400 hover:bg-green-500 text-gray-700 hover:text-green-100 px-4 py-2 text-sm uppercase tracking-wide font-semibold rounded" tabIndex="2">Save</button>

                    </div>

                </div>
                
                </form>

    {{-- End Form --}}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
