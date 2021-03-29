<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class EnrollmentController extends Controller
{
  
    /**
     * Show the form for enrolling a student in a new class.
     *
     * @return \Illuminate\Http\Response
     */
    public function select()

    {
      
      return view('sections/select');
    
    }

    /**
     * Attach new section to user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function join(Request $request)
    {
        // create valiadator

        $this->validate($request, [
        
            'registrationCode' => 'required|exists:sections,registrationCode',

            ]);

                $code = $request['registrationCode'];

                // Use code to look up section
                $section = Section::where('registrationCode', $code)->first();
                
                // Get array of section's registered students 
                $roster = $section->students()->pluck('id');

                // check array for Authorized User to eliminate duplicate registrations
                if ($roster->contains(Auth::User()->id)){
                   
                    session()->flash('success', 'You are currently enrolled in '.$section->title.'.');

                    return redirect()->route('show-section', $section);
                }

                // Check enrolled students against class seats
                if ($section->students->count() < $section->max_students) {

                    // Enroll student in section
                    Auth::User()->sections()->attach($section->id);
                    // Enroll student at site
                    Auth::User()->sites()->sync($section->site_id);
                    // Flash Success Message
                    session()->flash('success', 'You have enrolled in '.$section->title.'.');

                    return redirect()->route('show-section', $section);

                } 

                else {

                // Flash Class Full Message
                session()->flash('warning', $section->title.' is currently full.');
                
                return redirect()->back();
                }
                
               

    }

   
}
