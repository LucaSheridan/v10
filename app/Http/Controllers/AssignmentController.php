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

     /**
     * Show the form for creating a new assignment.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Section $section, Assignment $assignment )
    {
       return view('assignments.edit')->with(['section' => $section, 'assignment' => $assignment]);
    }

    /**
     *  Update an assignment.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section, Assignment $assignment )
    {
        //validate form
        $this->validate($request, [
        
        'title' => 'required',
        'date_due' => 'nullable|date_format:"m-d-y"',
        'active' => 'required',

        ]);

        //set and persist assignment information to database
        $assignment->title = $request->input('title');
        $assignment->description = $request->input('description');
        $assignment->section_id = $section->id;
        $assignment->site_id = $section->site_id;
        $assignment->course_id = null;
        
        //Radio button has been set to "true"
        if ($request->input('active') == 'true') $assignment->is_active = TRUE;
        //Radio button has been set to "false" or a value was not selected
        else $assignment->is_active = FALSE;

        $assignment->save();

        //flash('Your assignment was updated successfully!', 'success');
        return redirect()->route('show-assignment', ['section' => $section, 'assignment' => $assignment]);
    }

    /**
     * Delete an assignment form the database along with all related components.
     *
     * @return \Illuminate\Http\Response
     */
        public function destroy (Section $section, Assignment $assignment)
    {
        $assignment->delete();

        //flash('Assignment deleted successfully!', 'success');
        return redirect()->route( 'show-section', $section);
    }
}