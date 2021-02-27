<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');   
    }

    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id'); //user_id od profiles table (za da se izbegni integrituy contsraint violation) 

        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);

        return view ('posts.index',compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
       $data= request()->validate([
           'caption' => 'required',
           'image' => 'required|image',
       ]);

       $imagePath = request('image')->store('uploads','public');

       $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200);
       $image->save();

       //  not passing id   \App\Post::create($data);
       auth()->user()->posts()->create([
           'caption' => $data['caption'],
           'image' => $imagePath,
       ]);
       
       return redirect('/profile/' .auth()->user()->id);

    }


    public function show( Post $post)  //fatching user auto.. vo profile controler ni e manually ( $user = User::findOrFail($user); ) 
    {
        return view('posts.show', compact('post'));
        // ['post'=>$post]; smeneto so kompakt
    }

   
}
