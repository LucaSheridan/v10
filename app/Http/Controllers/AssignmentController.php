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
        $sectionAssignments = Assignment::where('section_id', $section->id)->orderBy('created_at', 'desc')->get();

        // Start L6 Student Checklist
        $checklist = DB::table('components')

            ->leftjoin('artifacts', function ($join) use ($assignment) {
           
            $join->on('components.id', '=', 'artifacts.component_id')
            ->where('artifacts.user_id', '=', Auth::User()->id); 
            // This eliminates matches, not records
            })
            ->where('components.assignment_id', '=', $assignment->id)
            ->orderBy('components.date_due', 'ASC')
            ->orderBy('components.title', 'ASC')
            ->select(
                      'artifacts.id AS artifactID',
                      'components.section_id AS sectionID',
                      'components.assignment_id AS assignmentID',
                      'components.id AS componentID', 
                      'components.title AS componentTitle',
                      'components.description AS componentDescription',
                      'components.class_viewable AS componentClassViewable',
                      'components.date_due AS componentDateDue',
                      'artifacts.artifact_thumb AS artifactThumb',
                      'artifacts.artifact_path AS artifactPath',
                      'artifacts.created_at AS artifactCreatedAt')->get();                           

        // End L6 Student Checklist
        
        // return view('assignments.show')->with(['sectionAssignments' => $sectionAssignments,'activeAssignment' => $assignment, 'currentSection' => $section ]);

            return view('assignments.show')->with(['sectionAssignments' => $sectionAssignments,'activeAssignment' => $assignment, 'currentSection' => $section, 'checklist' => $checklist]);
                        
    }

    /**
     * Show the form for creating a new assignment.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Section $section)
    {
       return view('assignments.create')->with('section', $section);
    }

    /**
     * Save a newly created Assignment to the Database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Section $section)
    {

        //validate form
        $this->validate($request, [
        
        'title' => 'required',
        'date_due' => 'nullable|date_format:"m/d/y"'
        ]);

        //set and persist assignment information to database

        $assignment = New Assignment;
        $assignment->title = $request->input('title');
        $assignment->description = $request->input('description');
        $assignment->section_id = $section->id;
        $assignment->site_id = $section->site_id;
        $assignment->course_id = NULL;
        $assignment->is_active = true;
        $assignment->save();

        $component = New Component;
        
        $component->title = 'Final';
        
        $component->section_id = $section->id;
        $component->assignment_id = $assignment->id;
        $component->class_viewable = false;

           
            //check if due date is set for simple component 

                if (is_null($request->input('date_due'))){

                    $component->date_due = NULL;
                    $component->save();

                    }
            
                else {

                     $date_due = Carbon::createFromFormat('m/d/y', $request->input('date_due'));

                     //set component time due
                     $date_due->hour = 23;
                     $date_due->minute = 59;
                     $date_due->second = 59;

                     //persisit component
                     $component->date_due = $date_due;
                     $component->save();

                     };
        
        session()->flash('success', "Assignment created");

        return redirect()->route( 'show-section', $section->id);

        // return view('/home');
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

        session()->flash('success', "Assignment updated");
        
        return redirect()->route('show-assignment', ['section' => $section, 'assignment' => $assignment]);
    }

    /**
     * Delete an assignment form the database along with all related components.
     *
     * @return \Illuminate\Http\Response
     */
        public function destroy (Section $section, Assignment $assignment)
    {
                
        foreach ($assignment->components as $component)
        {$component->delete();}
        
        $assignment->delete();

        session()->flash('success', "Assignment deleted");

        return redirect()->route( 'show-section', $section);
    }
}