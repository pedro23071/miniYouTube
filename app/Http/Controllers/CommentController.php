<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Comment;

class CommentController extends Controller
{
    //
    public function store(Request $request){
        $validate = $this->validate($request, [
            'body' => 'required'
        ]);

        $comment = new Comment();
        $user = \Auth::user();
        
        $comment->user_id = $user->id;
        $comment->video_id = $request->input('video_id');
        $comment->body = $request->input('body');

        $comment->save();

        return redirect()->route('detailVideo', ['video_id' => $comment->video_id])->with(array(
            'message'=>'El comentario se agrego exitosamente'
        ));
    }
}
