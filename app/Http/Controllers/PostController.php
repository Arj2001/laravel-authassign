<?php

namespace App\Http\Controllers;

use App\Models\Likes;
use Illuminate\Http\Request;
use App\Models\Posts;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //
    public function index()
    {
        $posts = Posts::with('user')->orderBy('created_at', 'desc')->get();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,png',
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('uploads', 'public') : null;
        $userId = Auth::user()->id;
        Posts::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
            'user_id' => $userId,
        ]);

        return redirect()->route('posts.index')
                         ->with('success', 'Post created successfully.');
    }
    public function userPosts($id)
    {
        $posts = Posts::where('user_id', $id)->get();
        return view('posts.index', compact('posts'));
    }

    public function show($id)
    {
        $post = Posts::find($id);
        return view('posts.show', compact('post'));
    }

    public function edit($id)
    {
        $post = Posts::find($id);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,png',
        ]);
        if($request->file('image')){
            $imagePath = $request->file('image')->store('uploads', 'public');
        }else{
            $imagePath = Posts::find($id)->image;
        }
        $post = Posts::find($id);

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath
        ]);

        return redirect()->route('posts.userPosts', Auth::user()->id)
                         ->with('success', 'Post updated successfully.');
    }

    public function destroy($id)
    {
        $post = Posts::find($id);
        $post->delete();

        return redirect()->route('posts.index')
                         ->with('success', 'Post deleted successfully.');
    }
    public function like($id)
    {
        $post = Posts::find($id);
        Likes::create([
            'post_id' => $id,
            'user_id' => Auth::user()->id,
        ]);
        $count = Likes::where('post_id', $id)->count();
        $post->update([
            'likes' => $count
        ]);
        $post->save();

        return redirect()->route('posts.index')
                         ->with('success', 'Post liked successfully.');
    }
    public function dislike($id)
    {
        $post = Posts::find($id);
        $like = Likes::where('post_id', $id)->where('user_id', Auth::user()->id)->first();
        // $like = Likes::where('post_id', $id)->where('user_id', Auth::user()->id)->get();
        $like->delete();
        $count = Likes::where('post_id', $id)->count();
        $post->update([
            'likes' => $count
        ]);
        $post->save();

        return redirect()->route('posts.index')
                         ->with('success', 'Post liked successfully.');
    }
}
