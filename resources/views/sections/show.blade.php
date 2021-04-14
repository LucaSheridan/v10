<x-app-layout>
    
    <x-slot name="header">
        <h2 class="text-2xl text-gray-100 leading-tight">
            Classes
        </h2>
    </x-slot>
    
            @include('partials.sectionNav')
            <!-- Begin Content -->

            @hasrole('teacher')
            @include('sections.show-teacher')
            @endhasrole
            
            @hasrole('student')
            @include('sections.show-student')
            @endhasrole

            <!-- End Content -->

            </x-app-layout>

