<x-app-layout>
    
    <x-slot name="header">
        <h2 class="text-2xl text-gray-100 leading-tight">
            ALL FREAKING SECTIONS
        </h2>
    </x-slot>
    

            @hasrole('teacher')

            <table cellpadding="10">
            @foreach ($sections as $section)
            <tr>
            
            <td>
            <a href="{{route('show-section', $section->id)}}">{{ $section->title}}</a></td>
            <td>{{ $section->users->count() }}</td>
            <td>{{ $section->year }}
            <td>{{ $section->created_at }}

            </td>
            </tr>
            @endforeach
            </table>
            
            @endhasrole
            
            <!-- End Content -->

            </x-app-layout>

