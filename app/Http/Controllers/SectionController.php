<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Assignment;
use App\Models\Comment;
use App\Models\Component;
use App\Models\Artifact;
use App\Models\Section;
use Illuminate\Support\Str;
use Auth;
use Illuminate\Support\Facades\DB;


class SectionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()

    {    

                       return redirect()->route('show-section', Auth::User()->firstActiveSection->first());


    }
     
     /**
     * Display the specified resource.
     *
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        
        $currentSection = Section::with('students','teachers','assignments')->where('id', $section->id)->first();

        $activeSections = Auth::User()->activeSections()->get();
        
        $sectionAssignments = Assignment::with('components')->where('section_id', $section->id)->orderBy('created_at','desc')->get(); 

        $feedback = Comment::with('artifact')->whereHas('artifact', function ($q)
            { $q->where('user_id', Auth::User()->id); })->where('user_id', '!=' , Auth::User()->id)->get();

        // $feedback = Artifact::with('comments')->whereHas('comments', function ($q) use ($section)
        // { $q->where('user_id', 1 );})->get();
        
        //dd($feedback);

        return view('sections.show', compact('currentSection','activeSections','sectionAssignments','feedback'));
    }

    /**
     * Show the form for creating a new section.
     *
     * @return \Illuminate\Http\Response
     */
        public function create()
    {
        
        $sites = Auth::User()->sites()->orderBy('id','asc')->get();

        return view('sections.create')->with('sites', $sites);
    }
    
    /**
     * Store a newly created section to the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
        
            'title' => 'required',
            // 'label' => 'required',
            'site' => 'required',

            ]);

            $section = New Section;
            $section->title = $request->input('title');
            $section->course_id = NULL;
            //$section->label = $request->input('label');
            $section->registrationCode = Str::random(8);
            $section->is_active = true;
            $section->is_open = true;
            $section->max_students = $request->input('max_students');
            $section->year = date('Y');
            $section->site_id = $request->input('site');
            $section->save();
            $section->users()->attach(Auth::User()->id);
            $section->save();

            //flash('New class created successfully!')->success();

            return redirect()->route('show-section', $section->id);
     }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {

        return view('sections.edit')->with('section', $section);

    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section)
    {
        // create valiadator
        $this->validate($request, [
        'title' => 'required',
        'registrationCode' => 'required',
        'max_students' => 'required'         
        // 'label' => 'required',

        ]);

        // get form input data
        $section->title = $request->input('title');
        $section->registrationCode = $request->input('registrationCode');
        $section->max_students = $request->input('max_students');

        // Active
        if ($request->input('active') == 'true') $section->is_active = TRUE;

        //Radio button has been set to "false" or a value was not selected
        else $section->is_active = FALSE;

        // Open
        if ($request->input('open') == 'true') $section->is_open = TRUE;

        //Radio button has been set to "false" or a value was not selected
        else $section->is_open = FALSE;

        //$section->label = $request->input('label');
        $section->save();

        // flash('Class updated!')->success();

        return redirect()->route('show-section', $section);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
       public function delete(Section $section)

    {
       return view('partials.teacher.section.delete')->with('section', $section);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
       public function destroy(Section $section)
    {

       $section->delete();
 
       //flash('Section deleted successfully!')->success();

       return redirect()->route('sections');


    }    


  public function studentProgress(Section $section, User $user)
    
    {
         
        // get this section assignments and set to an array
        $assignments = Assignment::where('section_id', $section->id)
                                 ->where('is_active', true)
                                 ->pluck('id')->toArray();

        $currentSection = $section; 

        $checklist = Artifact::with('assignment')

            ->rightjoin('components', function ($join) use ($user, $assignments) {

            $join->on('components.id', '=', 'artifacts.component_id')
                 ->where('artifacts.user_id', '=', $user->id);
                // This eliminates matches, not records
                })

                ->whereIn('components.assignment_id', $assignments)
                ->orderBy('assignment_id', 'desc')
                ->orderBy('components.date_due', 'asc')
                ->orderBy('components.title', 'asc')

                ->select(
                 'artifacts.id AS artifactID',
                 'components.assignment_id AS assignment_id',
                 'components.id AS componentID', 
                 'components.section_id AS sectionID', 

                 'components.title AS componentTitle',
                 'components.date_due AS componentDateDue',
                 'artifacts.artifact_thumb AS artifactThumb',
                 'artifacts.artifact_path AS artifactPath',
                 'artifacts.created_at AS artifactCreatedAt',
                 'artifacts.annotation AS artifactAnnotation',)
                 ->get();

                 // dd($checklist);

          return view('sections.progress')
               ->with(['currentSection' => $currentSection,
                      'section' => $section,
                      'assignments' => $assignments,
                      'checklist' => $checklist,
                      'user' => $user]);
    }

public function sectionProgress(Section $section)
    
    {
         
        // get this section users and set to an array
        $students = Section::with('students')->find($section->id)
         ->pluck('id')->toArray();

        // get this section assignments and set to an array
        $assignments = Assignment::where('section_id', $section->id)
                                 ->where('is_active', true)
                                 ->orderBy('created_at', 'asc')
                                 ->pluck('id')->toArray();

        // set classChecklist array
        $classChecklist = [];                         

            foreach ($students as $student)

                $studentChecklist = Artifact::with('assignment','user')

                ->rightjoin('components', function ($join) use ($students, $assignments) {

                $join->on('components.id', '=', 'artifacts.component_id')
                    ->where('artifacts.user_id', '=', $student->id);

                    })

                    ->whereIn('components.assignment_id', $assignments)

                   
                    ->orderBy('components.assignment_id', 'asc')
                    ->orderBy('artifacts.user_id', 'asc')

                    ->orderBy('components.date_due', 'asc')
                   
                    ->select(
                     'artifacts.id AS artifact_id',
                     'artifacts.user_id AS artistID',
                     'components.assignment_id AS assignment_id',
                     'components.id AS component_id', 
                     'components.title AS component_title',
                     'components.date_due AS component_due',
                     'artifacts.artifact_thumb AS artifact_thumb',
                     'artifacts.artifact_path AS artifact_path',
                     'artifacts.created_at AS artifact_created')
                     ->get();

        // add each studentChecklist to classChecklist array

         

        //dd($assignmentChecklist);                      

        return view('partials.teacher.section.progress')
               ->with(['section' => $section,
                      'assignments' => $assignments,
                      'checklist' => $checklist,
                      'students' => $students]);
    
    }

       /**
     * Display an individual student assignment
     *
     * @param  \App\Section $section
     * @param  \App\Assignment $assignment
     * @param  \App\User $student
     * @return \Illuminate\Http\Response
     */
    public function StudentAssignmentView(Section $section, Assignment $assignment, User $user)
    {
        $assignmentChecklist = Component::leftjoin('artifacts', function ($join) use ($assignment, $user) {

            $join->on('components.id', '=', 'artifacts.component_id')
                 ->where('artifacts.user_id', '=', $user->id); // This eliminates matches, not records

                })

                ->where('components.assignment_id', '=', $assignment->id)
                ->orderBy('components.date_due', 'ASC')
                ->select(
                 'artifacts.id AS artifactID',
                 'components.assignment_id AS assignmentID',
                 'components.id AS componentID', 
                 'components.title AS componentTitle',
                 'components.date_due AS componentDateDue',
                 'artifacts.artifact_thumb AS artifactThumb',
                 'artifacts.artifact_path AS artifactPath',
                 'artifacts.created_at AS artifactCreatedAt',
                 'artifacts.is_published AS is_published')
                 ->get();   

                 //dd($assignmentChecklist);                      

        return view('partials.teacher.section.student.singleAssignment', 
               compact('user', 'section', 'assignment', 'assignmentChecklist'));
    }

}



