<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Artifact;
use App\Models\Assignment;
use App\Models\Collection;
use App\Models\Component;
use App\Models\Section;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;

// testing extension($path) for image rotate
use Illuminate\Filesystem\Filesystem;


class ArtifactController extends Controller
{
   /**
     * Show User's Artifacts
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
   
        {

        $artifacts = Artifact::where('user_id', Auth::User()->id)->orderBy('created_at', 'DESC')->paginate(12);

        //session()->flash('success', 'Successful Login.');
        // session()->flash('warning', 'Please confirm your email address.');
        // session()->flash('danger', 'Passwords do not match.');

    	return view('artifacts')->with('artifacts', $artifacts);

        }

   /**
     * Show Artifact Detail Page
     *
     * @param  \App\Artifact  $artifact
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Artifact $artifact)
    {
 
        return view('artifacts.show')->with('artifact', $artifact);
    }

       /**
     * Show Artifact Detail Page
     *
     * @param  \App\Artifact  $artifact
     * @return \Illuminate\Http\Response
     */
    public function zoom(Request $request, Artifact $artifact)
    {
        return view('artifacts.zoom')->with('artifact', $artifact);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create(Request $request, Section $section, Assignment $assignment, Component $komponent)
   
        {

    return view('artifacts.create')
    ->with(['section' => $section, 'assignment' => $assignment, 'komponent' => $komponent]);

        }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request)
        
        {

        $this->validate($request, [
        
            'file' => 'required|image',
            'mimes:jpeg,png,jpg,pdf|max:10000',
            'user_id' => 'required',
            //'assignment_id' => 'required',
            //'component_id' => 'required',
            ]);

            //dd($request);


            // get form input data
            $user_id = $request->input('user_id');
            $section_id = $request->input('section_id');
            $assignment_id = $request->input('assignment_id');
            $component_id = $request->input('component_id');
            
            // get file input data as object
            $image = $request->file('file');

            // dd($image);


            // get real path to file in temp directory
            $realPath = $request->file('file')->getRealPath();
            
            // set image and thumbnail filenames
            $fileName = time();
            $imageFileName = $fileName.'.'. $image->getClientOriginalExtension();
            $thumbFileName = $fileName.'.thumb.'. $image->getClientOriginalExtension();

            // set storage
            $s3 = \Storage::disk('s3');

            // set paths
            $imagePath = 'uploads/' . $imageFileName;
            $thumbPath = 'uploads/' . $thumbFileName;
       
        // PHOTO UPLOAD PROCESS
            
            // create a new Image/Intervention instance from file system
            $image = Image::make($realPath)->orientate();

         
            // apply image transformations

                //check for portrait or landscape orientation
                $width = $image->width();
                $height = $image->height();

                if ($height >= $width) { $orientation = "portrait"; }
                else { $orientation = "landscape"; }

                //resize logic based on image orientation
            
                if ($orientation == 'portrait')

                { 
                    // Initial resize to 1000 pixels
                    $image->resize(null, 1000, function ($constraint) { 
                    $constraint->aspectRatio();
                    $constraint->upsize();
                    })->interlace()->encode('jpg', 85);

                    // Capture Resized Pixel Dimensions
                    $resized_width = $image->width();
                    $resized_height = $image->height();
                    
                    // Save image to Amazon S3
                    $s3->put($imagePath, $image->__toString(), 'public');

                    // Resize to 200 pixels for thumnail generation
                    $image->resize(200, null, function ($constraint) { 
                    $constraint->aspectRatio();
                    $constraint->upsize();
                    // Crop and encode thumbnail as jpg
                    })->crop(200, 200)->interlace()->encode('jpg', 85);
                    // Save thumbnail to Amazon S3
                    $s3->put($thumbPath, $image->__toString(), 'public');
                }

                else 
                
                {    
                    // Initial resize to 1000 pixels
                    $image->resize(1800, null, function ($constraint) { 
                    $constraint->aspectRatio();
                    $constraint->upsize();
                    })->interlace()->encode('jpg', 85);

                    // Capture Resized Pixel Dimensions
                    $resized_width = $image->width();
                    $resized_height = $image->height();

                    // Save image to Amazon S3
                    $s3->put($imagePath, $image->__toString(), 'public');

                    // Resize to 200 pixels for thumnail generation
                    $image->resize(null, 200, function ($constraint) { 
                    $constraint->aspectRatio();
                    $constraint->upsize();
                    // Crop and encode thumbnail as jpg
                    })->crop(200, 200)->interlace()->encode('jpg', 85);
                    // Save thumbnail to Amazon S3
                    $s3->put($thumbPath, $image->__toString(), 'public');
                }

            // Good for smaller files... 
            // $s3->put($path, file_get_contents($image), 'public');
            // Better for big files...
            // $s3->put($path, fopen($image, 'r+'), 'public');

            // set and persist information to database
            $artifact = New Artifact;
        
            $artifact->user_id = $user_id;
            $artifact->section_id = $section_id;  
            $artifact->assignment_id = $assignment_id;
            $artifact->component_id = $component_id;

            $artifact->artifact_path = $imagePath;
            $artifact->artifact_thumb = $thumbPath;

            $artifact->dimensions_width_pixels = $resized_width;
            $artifact->dimensions_height_pixels = $resized_height;

            $artifact->is_published = 0;
            $artifact->is_public = 1;
            $artifact->artist = Auth::User()->fullName;

            $artifact->save();

            // return redirect()->action('ArtifactsController@show', $artifact->assignment_id);

            // return redirect()->action('AssignmentController@index');
            if (!$artifact->assignment_id)

            {
            
            session()->flash('success', 'Your artifact was created successfully!');

            return redirect()->route('artifacts');
            // return redirect()->route('edit-artifact', $artifact);

            }

            else 

            { 

            session()->flash('success', 'Your artifact has been submitted to this assignment');

            return redirect()->route('show-assignment', [
                'section' => $section_id , 
                'assignment' => $assignment_id ]);

            }
        }

    
/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function storeFromURL(Request $request)
        
        {

        // create valiadator
        $this->validate($request, [
        
            'url' => 'required|url',
            'user_id' => 'required',
            //'assignment_id' => 'required',
            //'component_id' => 'required',
            ]);

            // get form input data
            $user_id = $request->input('user_id');
            $section_id = $request->input('section_id');
            $assignment_id = $request->input('assignment_id');
            $component_id = $request->input('component_id');
            $url = $request->input('url');
      
            // set image and thumbnail filenames
            $fileName = time();
            $imageFileName = $fileName.'.jpg';
            $thumbFileName = $fileName.'.thumb.jpg';

            // // create a new Image/Intervention instance
            // $image = Image::make($image)->orientate();

            // create a new Image/Intervention instance from file system
            
            $image = Image::make($url);

            // set storage
            $s3 = \Storage::disk('s3');

            // set paths
            $imagePath = 'uploads/' . $imageFileName;
            $thumbPath = 'uploads/' . $thumbFileName;
            
            // apply image transformations

                //check for portrait or landscape orientation
                $width = $image->width();
                $height = $image->height();

                if ($height >= $width) { $orientation = "portrait"; }
                else { $orientation = "landscape"; }

                //resize logic based on image orientation
            
                if ($orientation == 'portrait')

                { 
                    // Initial resize to 1000 pixels
                    $image->resize(null, 1600, function ($constraint) { 
                    $constraint->aspectRatio();
                    $constraint->upsize();
                    })->interlace()->encode('jpg', 85);
                    // Save image to Amazon S3
                    $s3->put($imagePath, $image->__toString(), 'public');

                    // Resize to 200 pixels for thumnail generation
                    $image->resize(200, null, function ($constraint) { 
                    $constraint->aspectRatio();
                    $constraint->upsize();
                    // Crop and encode thumbnail as jpg
                    })->crop(200, 200)->interlace()->encode('jpg', 85);
                    // Save thumbnail to Amazon S3
                    $s3->put($thumbPath, $image->__toString(), 'public');
                }

                else 
                
                {    
                    // Initial resize to 1000 pixels
                    $image->resize(1600, null, function ($constraint) { 
                    $constraint->aspectRatio();
                    $constraint->upsize();
                    })->interlace()->encode('jpg', 85);
                    // Save image to Amazon S3
                    $s3->put($imagePath, $image->__toString(), 'public');

                    // Resize to 200 pixels for thumnail generation
                    $image->resize(null, 200, function ($constraint) { 
                    $constraint->aspectRatio();
                    $constraint->upsize();
                    // Crop and encode thumbnail as jpg
                    })->crop(200, 200)->interlace()->encode('jpg', 85);
                    // Save thumbnail to Amazon S3
                    $s3->put($thumbPath, $image->__toString(), 'public');
                }

            // Good for smaller files... $s3->put($path, file_get_contents($image), 'public');
            // Better for big files...  $s3->put($path, fopen($image, 'r+'), 'public');

            // set and persist information to database
            $artifact = New Artifact;
        
            $artifact->user_id = $user_id;
            $artifact->section_id = $section_id;
            
            $artifact->assignment_id = $assignment_id;
            $artifact->component_id = $component_id;

            $artifact->artifact_path = $imagePath;
            $artifact->artifact_thumb = $thumbPath;

            $artifact->is_published = 0;
            $artifact->is_public = 1;
            $artifact->from_URL = 1;
            $artifact->artist = "";

            $artifact->save();

            //dd($artifact);
            
            // return redirect()->action('ArtifactsController@show', $artifact->assignment_id);

            // return redirect()->action('AssignmentController@index');
            if ($artifact->from_URL = 1 )

            {

            session()->flash('success', 'Your artifact was created successfully! Record some information abnout it.');

            // return redirect()->route('artifacts');
            return redirect()->route('edit-artifact', $artifact);

            }

            else 

            { 

            session()->flash('success', 'Your artifact has been submitted to this assignment');

            return redirect()->route('show-assignment', [
                'section' => $section_id , 
                'assignment' => $assignment_id ]);

            }
        }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Artifact  $artifact
     * @return \Illuminate\Http\Response
     */
    public function edit(Artifact $artifact)
    {
        
        return view('artifacts.edit')->with('artifact', $artifact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Artifact  $artifact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Artifact $artifact)
    {
        
        // create valiadator
        $this->validate($request, [
        // 'title' => 'required',
        // 'medium' => 'required',
        // 'artist' => 'required',
        // 'dimensions_height' => 'required',
        // 'dimensions_width' => 'required',
        // 'dimensions_depth' => 'required',
        //'dimensions_units' => 'required',
        'annotation' => 'max:500'


        ]);

        // get form input data
        $artifact->title = $request->input('title');
        $artifact->artist = $request->input('artist');
        $artifact->medium = $request->input('medium');
        $artifact->year = $request->input('year');
        
        $artifact->dimensions_height = $request->input('dimensions_height');
        $artifact->dimensions_width = $request->input('dimensions_width');
        $artifact->dimensions_depth = $request->input('dimensions_depth');
        $artifact->dimensions_units = $request->input('dimensions_units');

        $artifact->annotation = $request->input('annotation');

        $artifact->save();

        session()->flash('success', 'Artifact successfully updated!');

        // return redirect()->route('artifacts');
        return redirect()->route('show-artifact', $artifact);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function delete(Artifact $artifact)
    {
     
    return view('artifact.delete')->with('artifact', $artifact);

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Artifact  $artifact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artifact $artifact)
    {
        
    
    // Delete image files from storage
        
        File::delete($artifact->artifact_thumb);
        File::delete($artifact->artifact_path);
    
    // Delete artifact record from database
        
        $artifact->delete();



    // Set confirmation message

        session()->flash('success', 'Artifact deleted!');

        return redirect()->route('artifacts');

    
    }

    /**
     * Rotate the specified artifact.
     *
     * @param  \App\Artifact  $artifact
     * @return \Illuminate\Http\Response
     */
    public function rotate(Artifact $artifact, $degrees)
    {

    // get artifact from database

            $artifact = Artifact::findOrFail($artifact->id);

    //get file extension from database

            $originalExtension = Str::after($artifact->artifact_path,'.');
                        
    // create new Image/Intervention instances

            $rotatedImage = Image::make(Storage::disk('s3')->url($artifact->artifact_path));
            $rotatedThumb = Image::make(Storage::disk('s3')->url($artifact->artifact_thumb));
            
    // Rotate by degree and re-encode.
            
            $rotatedImage->rotate($degrees)->encode();
            $rotatedThumb->rotate($degrees)->encode();
            //return $rotatedImage->response();

    // set image and thumbnail filenames
           
            $fileName = time();
            $rotatedImagePath = 'uploads/'.$fileName.'.'. $originalExtension;
            $rotatedThumbPath = 'uploads/'.$fileName.'.thumb.'.$originalExtension;

    // Set Storage path
     
            $s3 = \Storage::disk('s3');

    // Save image to storage
            
             $s3->put($rotatedImagePath, $rotatedImage->__toString(), 'public');
             $s3->put($rotatedThumbPath, $rotatedThumb->__toString(), 'public');

    //save old storage paths for deletion

             $old_artifact_path = $artifact->artifact_path;
             $old_thumb_path = $artifact->artifact_thumb;

    //save new storage paths to database

            $artifact->artifact_path = $rotatedImagePath;
            $artifact->artifact_thumb = $rotatedThumbPath;
            $artifact->save();

    // Delete old image files from storage
            
            File::delete($old_thumb_path);
            File::delete($old_artifact_path);

            session()->flash('success', 'Artifact rotated');

            return redirect()->back();
    }   

     /**
     * Show artifact to a Collection
     *
     * @param  \App\Artifact  $artifact
     * @return \Illuminate\Http\Response
     */
    public function selectCollection(Artifact $artifact)
    
    {
        
        //dd($artifact);

        //create an array of the IDs of the artifacts collections. 
        $isCollectedIn = $artifact->collections->pluck('id');
        //dd($isCollectedIn); 

        //get the user ID of the artifact.
        $user = $artifact->user;
        //dd($user);

        //create an array of the IDs of all the users collections.
        $couldBeCollectedIn = Auth::User()->collections->pluck('id');

        // remove all current collections from all Possible Collections.
        $diff = $couldBeCollectedIn->diff($isCollectedIn);

        //get all collections that the artifact could be added to.
        $addable = Collection::find($diff);
        $addable = $addable->sortBy('title'); 

        $dropable = Collection::find($isCollectedIn);


        //dd($addable);
        //dd($dropable);

        return view('artifacts.selectCollection')->with(['artifact' => $artifact, 'addable' => $addable, 'dropable' => $dropable ]);
    }

 /**
     * remove artifact to the Collection
     *
     * @param  \App\Artifact  $artifact
     * @return \Illuminate\Http\Response
     */
    public function removeFromCollection(Artifact $artifact, Collection $collection)
    
    {
        $artifact->collections()->detach($collection->id); 

        session()->flash('success', 'Artifact removed from collection' );


        return redirect()->route('show-artifact', $artifact->id);
    } 

     /**
     * remove artifact to the Collection
     *
     * @param  \App\Artifact  $artifact
     * @return \Illuminate\Http\Response
     */
    public function unsubmit(Artifact $artifact)
    
    {
        $artifact->section_id = NUll; 
        $artifact->assignment_id = NUll;
        $artifact->component_id = NUll; 
        $artifact->save();

        session()->flash('success', 'Artifact unsubmitted' );

        return back();
    } 
}
