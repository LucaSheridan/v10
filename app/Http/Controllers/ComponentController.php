<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Component;
use App\Models\Section;
use App\Models\Assignment;
use App\Models\User;
use Auth;
use Carbon\Carbon;

class ComponentController extends Controller
{
    
	/**
     * Show the form for creating a new assignment component.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Section $section, Assignment $assignment)
    {
        //dd($section);
        //dd($assignment);

        return view('components.create')->with(compact('section','assignment'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section, Assignment $assignment, Component $component)
    {
        return view('partials.teacher.component.show')->with(['section' => $section, 'assignment' => $assignment, 'component' => $component]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section, Assignment $assignment, Component $component)
    {

        $komponent = Component::findOrfail($component->id);

        //dd($component);

        return view('components.edit')->with(compact('section','assignment','komponent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Section $section, Assignment $assignment)
    {
     	
     	//dd($request);

        $this->validate($request, [
        
        'title' => 'required',
        'date_due' => 'nullable|date_format:"m/d/y"',
        ]);
        
        
        //dd($request->input('date_due'));

        //create a new component instance
        $component = New Component;

        //set and title information
        $component->title = $request->input('title');
        $component->description = $request->input('description');

        //set section id 
        $component->section_id = $section->id;
       
       //set assignment id 
        $component->assignment_id = $assignment->id;

        // set class viewable 
        $component->class_viewable = FALSE;
        
        //set component date due

            if (is_null($request->input('date_due')))

                {

                $component->date_due = NULL;

                }
        
            else {
              
                 $date_due = Carbon::createFromFormat('m/d/y', $request->input('date_due'));
                 $date_due->hour = $request->input('hour');
                 $date_due->minute = $request->input('min');
                 $date_due->second = $request->input('sec');
                 $date_due->setTimezone('UTC');
                 $component->date_due = $date_due;                 
                
                 };

                 $component->save();

                 session()->flash('success', "Component created!" );


 		         return redirect()->route( 'show-assignment', [ 'section' => $section, 'assignment' => $assignment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, Section $section, Assignment $assignment, Component $component)
    {
        
        $this->validate($request, [
    
        'title' => 'required',
        'date_due' => 'nullable|date_format:"m/d/y"',
        'class_viewable' => 'required',
        ]);
  
        //set and title information
        
            $component->title = $request->input('title');
            $component->description = $request->input('description');

        //set class_viewable
                //Radio button has been set to "true"
                if ($request->input('class_viewable') == 'true') $component->class_viewable = TRUE;
                //Radio button has been set to "false" or a value was not selected
                else $component->class_viewable = FALSE;


        //set component date due

            if (is_null($request->input('date_due')))

                {

                $component->date_due = NULL;

                }
        
            else {

                $date_due = Carbon::createFromFormat('m/d/y', $request->input('date_due'));

                 //set component time due
                 $date_due = Carbon::createFromFormat('m/d/y', $request->input('date_due'));
                 $date_due->hour = $request->input('hour');
                 $date_due->minute = $request->input('min');
                 $date_due->second = $request->input('sec');
                 $date_due->setTimezone('UTC');
                         
                 $component->date_due = $date_due;

                 };

                 //persist component 
                 $component->save();

                 session()->flash('success', "Component updated successfully" );
                 

        return redirect()->route( 'show-assignment', [ 'section' => $section, 'assignment' => $assignment]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Section $section, Assignment $assignment, Component $component)
    {
        
        //dd($section);
        //dd($assignment);
        //dd($component);

        if ($assignment->components->count() >= 2 ) {

            $component->delete();

            session()->flash('success', "Component deleted!" );

            return redirect()->route( 'show-assignment', [ 'section' => $section, 'assignment' => $assignment]);

            }

            else {

            //dd($assignment->components);

            session()->flash('warning', "Can't delete an assignment's only component");

            return redirect()->route( 'show-assignment', [ 'section' => $section, 'assignment' => $assignment]);

            }

    }

     public function gallery(Section $section, Assignment $assignment, Component $component)
    
    {
        $currentSection = $section;
        $activeAssignment = $assignment;
        $activeComponent = $component;

        $sections =  Auth::User()->sections()->get()->pluck('label','id');

        $sectionAssignments = Assignment::with('components')->where('section_id', $section->id)->orderBy('created_at','desc')->get(); 

        $components = Component::where('assignment_id', $assignment->id)->get()->pluck('title','id');
        
        // Can we simplify by using scope?
        $students = User::with(['artifacts' => function ($query) use($component) {
        $query->where('component_id', '=', $component->id);
        }])->whereHas('roles', function ($query) { 
        $query->where('name', 'like', 'student');
            })->whereHas('sections', function ( $query ) use($section) {
        $query->where('id', $section->id );
         })->get()->sortBy('lastName');

            //dd($students);

        return view('components.gallery')->with(compact('sections', 'currentSection', 'sectionAssignments', 'activeAssignment', 'components', 'activeComponent', 'students'));

     }
}
