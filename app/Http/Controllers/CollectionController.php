<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artifact;
use App\Models\Collection;
use App\Models\Section;
use App\Models\User;

use Auth;

class CollectionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
      /**
     * Show all of a Users Collections.
     *
     * @return \Illuminate\Http\Response
     */
        public function index(Request $request, User $user)
    {
        
        $collections = $user->collections()->with('artifacts')->get();

        return view('collections', ['collections' => $collections]);

    }

     /**
     * Show the form for creating a new collection.
     *
     * @return \Illuminate\Http\Response
     */
        public function create(Artifact $artifact)
    {
        return view('collections.create')->with('artifact', $artifact);
    }

       /**
     * Show the a new collection.
     *
     * @return \Illuminate\Http\Response
     */
        public function show(Request $request, Collection $collection)
    {
        
        // dd($collection);

        return view('collections.show_new')->with( 'collection', $collection );
    }

    /**
     * Store a newly created collection  to the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd($request);

        $this->validate($request, [
        
            'title' => 'required',
            //'site' => 'required',

            ]);

            //
            $collections = Collection::all()->count();
            //
            // $artifact = $request->input('artifact');
            
            $artifact = Artifact::find($request->input('artifact'));
            
            $collection = New Collection;
            $collection->title = $request->input('title');
            $collection->description = $request->input('description');
            $collection->save();
            $collection->curators()->attach(Auth::User()->id);
            
            if ( !is_null($artifact)) {

                $collection->artifacts()->attach($artifact, [

                'position' => 1,
                'artist' => $artifact->artist,
                'title' => $artifact->title,
                'medium' => $artifact->medium,
                'year' => $artifact->year,
                'dimensions_height' => $artifact->dimensions_height,
                'dimensions_width' => $artifact->dimensions_width,
                'dimensions_depth' => $artifact->dimensions_depth,
                'dimensions_units' => $artifact->dimensions_units,
                'label_text' => $artifact->annotation
            
                ]); 
            
            }

            else {}

            $collection->save();

            //flash('You created a collection called '.$collection->title.'!', 'success');

            //dd($collection);

            return redirect()->route('collections', ['user' => Auth::User()]);
     }

       /**
     * Show the form for creating a new collection.
     *
     * @return \Illuminate\Http\Response
     */
        public function edit(Request $request, Collection $collection)
    {
        return view('collections.edit')->with( 'collection', $collection );
    }

    /**
     * Store a newly created collection  to the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Collection $collection)
    {

        $this->validate($request, [
        
            'title' => 'required',

            ]);
            
            $collection->title = $request->input('title');
            $collection->description = $request->input('description');
            $collection->save();
           
            //flash('Collection updates successfully!', 'success');

            return redirect()->route('collections', Auth::User());
     }

    // /**
    //  * Show the confirmation dialogue to delete a coillection.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    //    public function delete(Request $request, Collection $collection)
    // {
    //     return view('collection.delete')->with( 'collection', $collection );
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
       public function destroy(Collection $collection)
    {

       $collection->delete();

       // flash('Collection deleted successfully!', 'success');

       return redirect()->route('collections', Auth::User());

    }    

    public function addArtifact(Request $request, Artifact $artifact)
    {

        $artifact = Artifact::find($request->input('artifact'));
        
        $collection = Collection::find($request->input('collection'));
   
        // find the highest position in the collection
        $max = $collection->artifacts()->max('position');
        
        $artifact->collections()->attach($request->input('collection'), [

        'position' => $max +1,
        'artist' => $artifact->artist,
        'title' => $artifact->title,
        'medium' => $artifact->medium,
        'year' => $artifact->year,
        'dimensions_height' => $artifact->dimensions_height,
        'dimensions_width' => $artifact->dimensions_width,
        'dimensions_depth' => $artifact->dimensions_depth,
        'dimensions_units' => $artifact->dimensions_units,
        'label_text' => $artifact->annotation
        
        ]); 
        
        $collection->save();

        //flash('Artifact added to '.$collection->title.'!', 'success');

        return redirect()->route('collections', Auth::User());

    }


    public function removeArtifact(Request $request, Collection $collection, Artifact $artifact)
    {
        
        //dd($collection);
        //dd($artifact);

        $artifact->collections()->detach($collection->id); 

        //flash('Artifact removed from '.$collection->title.'!', 'success');

        return redirect()->action('CollectionController@show', $collection->id);

    }
     
  

       public function editLabel(Request $request, Collection $collection, Artifact $artifact)
    {
        
        //$artist = ($request->input('artist'));
        $position = ($request->input('position'));
        $artist = ($request->input('artist'));
        $title = ($request->input('title'));
        $medium = ($request->input('medium'));
        $year = ($request->input('year'));
        $dimensions_height = ($request->input('dimensions_height'));
        $dimensions_width = ($request->input('dimensions_width'));
        $dimensions_depth = ($request->input('dimensions_depth'));
        $dimensions_units = ($request->input('dimensions_units'));  
        $label_text = ($request->input('label_text'));

        //dd($label_text);

        return view('collection.editLabel')->with(compact('collection','artifact','position','artist','title','medium','year','dimensions_height','dimensions_width','dimensions_depth','dimensions_units','label_text'));

    }

      public function updateLabel(Request $request, Collection $collection, Artifact $artifact)
    {

        $artist = ($request->input('artist'));
        $position = ($request->input('position'));
        $title = ($request->input('title'));
        $medium = ($request->input('medium'));
        $year = ($request->input('year'));
        $dimensions_height = ($request->input('dimensions_height'));
        $dimensions_width = ($request->input('dimensions_width'));
        $dimensions_depth = ($request->input('dimensions_depth'));
        $dimensions_units = ($request->input('dimensions_units'));
        $label_text = ($request->input('label_text'));
        
        $artifact->collections()->updateExistingPivot($collection, 

        [
         'position' => $position,
         'artist' => $artist,
         'title' => $title,
         'medium' => $medium,
         'year' => $year,
         'dimensions_height' => $dimensions_height,
         'dimensions_width' => $dimensions_width,
         'dimensions_depth' => $dimensions_depth,
         'dimensions_units' => $dimensions_units,
         'label_text' => $label_text

          ]); 
        
        // $collection->save();

        flash('Label Updated', 'success');

        return redirect()->action('CollectionController@show', $collection);

    }

    /**
     * Store a newly created collection  to the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function makeIBExhibitions(Request $request, Section $section)
    {

        foreach ($section->students as $student) {

            $artifacts = $student->artifacts()->where('is_published', 1,)->get();
            $position = 1;

            $collection = New Collection;
            $collection->title = "IB Exhibition";
            $collection->description = $request->input('description');
            $collection->save();
            $collection->curators()->attach($student->id);
            
                foreach ($artifacts as $artifact) {

                $collection->artifacts()->attach($artifact, [

                    'position' => $position,
                    'artist' => $artifact->artist,
                    'title' => $artifact->title,
                    'medium' => $artifact->medium,
                    'year' => $artifact->year,
                    'dimensions_height' => $artifact->dimensions_height,
                    'dimensions_width' => $artifact->dimensions_width,
                    'dimensions_depth' => $artifact->dimensions_depth,
                    'dimensions_units' => $artifact->dimensions_units,
                    'label_text' => $artifact->annotation
        
                    ]); 
        
                $position = $position +1; 

                }
                
                $collection->save();

            }

            return redirect()->action('HomeController@index');
     }

     /**
     * Store a newly created collection  to the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function  removeArtifactFromCollection (Request $request, Collection $collection, Artifact $artifact)
    
    {

        $artifact->collections()->detach($collection->id); 

        return redirect()->route('show-collection', $collection->id);

    }



}

