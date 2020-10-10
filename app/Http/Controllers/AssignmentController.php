<?php

namespace App\Http\Controllers;

use Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Assignment;
use App\Models\Component;
use App\Models\Section;
use App\Models\User;
use Carbon\Carbon;

class AssignmentController extends Controller
{


/**
     * Display the specified resource.
     *
     * @param  \App\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section, Assignment $assignment)
    {
        $sectionAssignments = Assignment::where('section_id', $section->id)->get();
        
        return view('assignments.show')->with(['sectionAssignments' => $sectionAssignments,'activeAssignment' => $assignment, 'currentSection' => $section ]);
                        
    }
}