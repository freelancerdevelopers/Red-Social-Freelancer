<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\User;


class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }


    public function config() {
        return view('user.config');
        
    }
    
    public function update(Request $request){

        $user = \Auth::user();
        $id   = $user->id;

        $validate = $this->validate($request, [
            'name'  => 'required|string|max:255',
            'nick'  => 'required|string|max:255|unique:users,nick,'.$id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$id
        ]);
        
        $name = $request->input('name');
        $nick = $request->input('nick');
        $email = $request->input('email');
        
        $user->name = $name;
        $user->nick = $nick;
        $user->email = $email;
        
        $image = $request->file('image');
        if($image){
            $image_name = time().$image->getClientOriginalName();
            //disk --> storage/app/users (777)
            Storage::disk('users')->put($image_name, File::get($image));
            $user->image = $image_name;
        }

        $user->update();
        return redirect()->route('config')->with(['message'=>'El registro se actulizo correctamente']);
        
    }
    
    
    public function getImage ($filename){
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
        
    }
    
    public function profile ($id){
        $user = User::find($id);
        return view ('user.profile',[
            'user' => $user
        ]);
    }
    
    public function userlist ($search = null){
        if (!empty ($search)){
            $users =  User::where('nick', 'LIKE', '%'.$search.'%')
                            ->orWhere('name', 'LIKE', '%'.$search.'%')
                            ->orWhere('email', 'LIKE', '%'.$search.'%')
                            ->orderBy('id', 'desc')
                            ->paginate(5);
           return view ('user.userList',[ 'users'=> $users ]);
            
        }else{
            $users = User::orderBy('id', 'desc')->paginate(5);
            return view ('user.userList',[ 'users'=> $users ]);
        }
        
        
    }
}
