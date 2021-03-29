<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artifact;
use App\Models\Collection;
use App\Models\Section;
use App\Models\User;
use App\Models\Comment;

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
        // $this->middleware('auth');
        $this->middleware('auth', ['except' => [
            'showPublic'
        ]]);
    }
      /**
     * Show all of a Users Collections.
     *
     * @return \Illuminate\Http\Response
     */
        public function index(Request $request, User $user)
    {
        
        $collections = $user->collections()->with('artifacts')->paginate(12);

        return view('collections.index', ['collections' => $collections ]);

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
     * Show a collection.
     *
     * @return \Illuminate\Http\Response
     */
        public function show(Request $request, Collection $collection)
    {
        
        // dd($collection);

        return view('collections.show')->with( 'collection', $collection );
    }

       /**
     * Show a collection publicly
     *
     * @return \Illuminate\Http\Response
     */
        public function showPublic (Request $request, Collection $collection)
    {
        
        // dd($collection);

        return view('public')->with( 'collection', $collection );
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

            // get artifact information if supplied
            $artifact = Artifact::find($request->input('artifact'));
            
            $collection = New Collection;
            $collection->title = $request->input('title');
            $collection->subtitle = $request->input('subtitle');
            $collection->description = $request->input('description');   
            $collection->showArtist = 1;
            $collection->showTitle = 1;
            $collection->showSubtitle = 1;
            $collection->showMedium = 1;
            $collection->showYear = 1;
            $collection->showDimensions = 1;
            $collection->showLabel = 1;

            $collection->save();

            // Attach User

            // Find and increment position of new collection 
            $maxPosition = Auth::User()->collections()->max('position') +1 ;

            $collection->curators()->attach(Auth::User()->id, ['position' => $maxPosition]);

            // Attatch Artifact
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

    //    public function editLabel(Request $request, Collection $collection, Artifact $artifact)
    // {
    //     $artifact = $artifact->collections()->where('collection_id', $collection->id)->first();

        //dd($artifact);

            public function editLabel(Request $request, Collection $collection, Artifact $artifact)
    {
        
        $position = $request->input('position');
        $artist = $request->input('artist');
        $title = $request->input('title');
        $medium = $request->input('medium');
        $year = $request->input('year');
        $dimensions_height = $request->input('dimensions_height');
        $dimensions_width = $request->input('dimensions_width');
        $dimensions_depth = $request->input('dimensions_depth');
        $dimensions_units = $request->input('dimensions_units');  
        $label_text = $request->input('label_text');

        //dd($label_text);

        return view('collections.editLabel')->with(compact('position','collection','artifact','position','artist','title','medium','year','dimensions_height','dimensions_width','dimensions_depth','dimensions_units','label_text'));

    }


// $position = $artifact->pivot->position;
//         $artist = $artifact->pivot->artist;
//         $title = $artifact->pivot->title;
//         $medium = $artifact->pivot->medium;
//         $year = $artifact->pivot->year;
//         $dimensions_height = $artifact->pivot->dimensions_height;
//         $dimensions_width = $artifact->pivot->dimensions_width;
//         $dimensions_depth = $artifact->pivot->dimensions_depth;
//         $dimensions_units = $artifact->pivot->dimensions_units;
//         $label_text = $artifact->pivot->annotation;

//         return view('collections.editLabel')->with(compact('collection','artifact','position','artist','title','medium','year','dimensions_height','dimensions_width','dimensions_depth','dimensions_units','label_text'));

//     }

      public function updateLabel(Request $request, Collection $collection, Artifact $artifact)
    {

        $artist = $request->input('artist');
        //dd($request->input('artist'));
        $position = $request->input('position');
        //dd($request->input('position'));
        $title = $request->input('title');
        //dd($request->input('title'));
        $medium = $request->input('medium');
        //dd($request->input('medium'));

        $year = $request->input('year');
        //dd($request->input('year'));

        $dimensions_height = $request->input('dimensions_height');
        //dd($request->input('dimensions_height'));

        $dimensions_width = $request->input('dimensions_width');
        //dd($request->input('dimensions_width'));

        $dimensions_depth = $request->input('dimensions_depth');
        //dd($request->input('dimensions_depth'));

        $dimensions_units = $request->input('dimensions_units');
        //dd($request->input('dimensions_units'));

        $label_text = $request->input('label_text');
        //dd($request->input('label_text'));
        
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

          //$collection->save();

        //flash('Label Updated', 'success');

        return redirect()->route('show-collection', $collection);

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

       /**
     * Show the a new collection.
     *
     * @return \Illuminate\Http\Response
     */
        public function addCurator(Request $request, Collection $collection)
    {
            
        $users = User::all();
        //dd($users);

        return view('collections.addCurator')->with(['collection' => $collection, 'users' => $users]);
    }

     /**
     * Persist new curator to the database.
     *
     * @return \Illuminate\Http\Response
     */
        public function saveCurator(Request $request, Collection $collection)
    {
        
        $curator = $request->input('add_curator');     
       
            // Find and increment position of new collection 
        $maxPosition = User::find($curator)->collections()->max('position') +1 ;
        //dd($maxPosition);

        $collection->curators()->attach($curator, ['position' => $maxPosition]);

        $collection->save();

        return redirect()->route('show-collection', $collection);
    }

    /**
     * Persist new curator to the database.
     *
     * @return \Illuminate\Http\Response
     */
        public function removeCurator(Request $request, Collection $collection)
    {
        
        $curator = $request->input('remove_curator');     
        $collection->curators()->detatch($curator);
        $collection->save();

        return redirect()->route('show-collection', $collection);
    }



}

