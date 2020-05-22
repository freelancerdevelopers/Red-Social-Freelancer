<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Image;
use App\Comment;
use App\Like;



class ImageController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function create(){
        return view('image.create');
    }
    public function save(Request $request){
        $validate = $this->validate($request,[
           'description_image' => 'required',
            'images_path_image' => 'required|image'
        ]);
        
        $images_path_image = $request->file('images_path_image');
        $description_image = $request->input('description_image');
        
        $user = \Auth::user();
        $id   = $user->id;
        
        $image = new Image();
        $image->user_id = $id;
        //$image->created_at = date('Y');
        $image->status_image = 1;
        $image->description_image = $description_image;
        
        if($images_path_image){
            $image_name = time().$images_path_image->getClientOriginalName();
            //disk --> storage/app/images (777)
            Storage::disk('images')->put($image_name, File::get($images_path_image));
            $image->images_path_image = $image_name;
        }
        
        $image->save();
        return redirect()->route('home')->with(['message'=>'La imagen se publico correctamente']);
    }
    
    public function getImage ($filename){
        $file = Storage::disk('images')->get($filename);
        return new Response($file, 200);
    }
    
    public function detail ($id_image){
        $image = Image::find($id_image);
        return view ('image.detail', ['image' => $image]);

    }
    public function delete ($id){
        $user = \Auth::user();
        $image = Image::find($id);
        $comments = Comment::where('image_id', $id)->get();
        $likes = Like::where('image_id', $id)->get();
        
        if($user && $image && $image->user->id == $user->id || $user->role == "ADMINISTRATOR"){
            //elimino comentarios
            if($comments && count($comments) >= 1){
                foreach ($comments as $comment){
                    $comment->delete();
                }
            }
            //elimino likes
            if($likes && count($likes) >= 1){
                foreach ($likes as $like){
                    $like->delete();
                }
            }
            //elimino fichero
            Storage::disk('images')->delete($image->images_path_image);
            //elimino registro image
            $image->delete ();   
            $message = array ('message' => 'La imagen se borro');
        }else{
            $message = array ('message' => 'La imagen no se borro');
        }
        return redirect()->route ('home')->with($message);
    }
    
    
    
}
