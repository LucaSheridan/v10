<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artifact;
use App\Models\Comment;

class CommentController extends Controller
{
    
    /**
     * Show thxe form for creating a new assignment component.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Artifact $artifact)
    {

        return view('comment.create')->with(['artifact' => $artifact]);

    }

   /**
     *  Persist  a new component to the database.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
        
        'body' => 'required',
        'artifact_id' => 'required',
        'user_id' => 'required',
        
        ]);
        
        //create a new comment instance
        $comment = New Comment;
        $comment->body = $request->input('body');
        $comment->artifact_id = $request->input('artifact_id');
		$comment->user_id = $request->input('user_id');
		$comment->save();

		session()->flash('message', 'Your comment was created successfully!');

        return redirect()->route('show-artifact', $comment->artifact_id);

    }

    /**
     * Show the form for creating a new assignment component.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Artifact $artifact, Comment $comment)
    {

        //dd($comment);

        return view('comment.edit')->with(['artifact' => $artifact, 'comment' => $comment]);

    }

    /**
     *  Persist  a new component to the database.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Artifact $artifact, Comment $comment)
    {
        
        $this->validate($request, [
        
        'body' => 'required',
        'artifact_id' => 'required',
        'user_id' => 'required',
        
        ]);
        
        $comment->body = $request->input('body');
        $comment->artifact_id = $request->input('artifact_id');
        $comment->user_id = $request->input('user_id');
        $comment->save();

        flash('Your comment was edited successfully!', 'success');

        return redirect()->action('ArtifactController@show', $comment->artifact_id);

    }

    /**
     *  Persist  a new component to the database.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Artifact $artifact, Comment $comment)
    {
        
        $comment->delete();

        flash('Your comment was deleted successfully!', 'success');

        return redirect()->action('ArtifactController@show', $comment->artifact_id);

    }
}