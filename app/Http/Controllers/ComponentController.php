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

        $component = Component::findOrfail($component->id);

        //dd($component);

        return view('partials.teacher.component.edit')->with(compact('section','assignment','component'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Section $section, Assignment $assignment)
    {
     	
     	//dd($request->date_due);

        $this->validate($request, [
        
        'title' => 'required',
        'date_due' => 'nullable|date_format:"m/d/y"',

        ]);
        
        
        //dd($request->input('date_due'));

        //create a new component instance
        $component = New Component;

        //set and title information
        $component->title = $request->input('title');

        //set section id 
        $component->section_id = $section->id;
       
       //set assignment id 
        $component->assignment_id = $assignment->id;
        
        //set component date due

            if (is_null($request->input('date_due')))

                {

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

                 //dd($component);

                 };
            
        flash('Component created successfully!', 'success');

 		 return redirect()->action( 'AssignmentController@show', [ 'section' => $section, 'assignment' => $assignment]);
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
        ]);
  
        //set and title information
        
            $component->title = $request->input('title');

        //set component date due

            if (is_null($request->input('date_due')))

                {

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

        flash('Component updated successfully!', 'success');

        return redirect()->action( 'AssignmentController@show', [ 'section' => $section, 'assignment' => $assignment]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, Section $section, Assignment $assignment, Component $component)

    {

    return view( 'partials.teacher.component.delete', [ 'section' => $section, 'assignment' => $assignment, 'component' => $component]);
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

            flash('Component deleted successfully!', 'success');

        return redirect()->action( 'AssignmentController@show', [ 'section' => $section, 'assignment' => $assignment]);


        }

        else {

        echo 'Cant delete component';

        }

    }

         public function gallery(Section $section, Assignment $assignment, Component $component)
    {
        
        $sections =  Auth::User()->sections()->get()->pluck('label','id');

        $activeSection = $section;
        $activeAssignment = $assignment;
        $activeComponent = $component;

        //dd($activeComponent);
        //dd($activeAssignment);

        $sectionAssignments = Assignment::where('section_id', $section->id)->get();

        $components = Component::where('assignment_id', $assignment->id)->get()->pluck('title','id');
    
        $students = User::with(['artifacts' => function ($query) use($component) {
        $query->where('component_id', '=', $component->id);
        }])->whereHas('roles', function ($query) { 
        $query->where('name', 'like', 'student');
            })->whereHas('sections', function ( $query ) use($section) {
        $query->where('id', $section->id );
        })->get()->sortBy('firstName');

        //dd($students);

        return view('partials.teacher.component.gallery')
               ->with(compact('sections', 'activeSection', 'sectionAssignments', 'activeAssignment', 'components', 'activeComponent', 'students'));
     }
}
