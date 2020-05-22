<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommetController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function save (Request $request){
        $validate = $this->validate($request, [
            'id_image' => 'integer|required',
            'content_comment' => 'string|required'
        ]);
        
        $user = \Auth::user();
        $id_user   = $user->id;
        $id_image = $request->input('id_image');
        $content_comment = $request->input('content_comment');
        
        $comment = new Comment();
        $comment->user_id = $id_user;
        $comment->image_id = $id_image;
        $comment->content_comment = $content_comment;
        $comment->status_comment = 1;
        
        $comment->save();
        return redirect()->route('image.detail', ['id_image' => $id_image])->with(['message'=>'El comentario se publico correctamente']);
        
    }
    
    public function delete($id){
        $user = \Auth::user();
        $comment = Comment::find($id);
        
        
        if($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id || $user->role == 'ADMINISTRATOR')){
            $comment->delete();
            return redirect()->route('image.detail', ['id_image' => $comment->image->id])->with(['message'=>'El comentario se elimino correctamente']);
        }else{
            return redirect()->route('image.detail', ['id_image' => $comment->image->id])->with(['message'=>'Error C-02: El comentario NO se elimino']);
        }
        
    }
    
}
