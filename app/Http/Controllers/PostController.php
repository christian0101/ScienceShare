<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index',
          [
            'posts' => Post::latest()->paginate(10)
          ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function apiIndex()
    {
        return Post::latest()->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate data
        $validatedData = $request->validate([
          'title' => 'required|between:2,255',
          'featured_pic'  => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
          'tags' => 'nullable|string',
          'content' => 'required|min:2'
        ]);

        // upload image
        $imagePath = null;
        if ($request->has('featured_pic'))
        {
            $hash = md5_file($validatedData['featured_pic']);
            $imageName = $hash.'.'.request()->featured_pic->getClientOriginalExtension();
            request()->file('featured_pic')->storeAs('uploads', $imageName, 'uploads');
            $imagePath = "/uploads/".$imageName;
        }

        // save validated data to database
        $post = new Post;
        $post->user_id = Auth::user()->id;
        $post->title = $validatedData['title'];
        $post->featured_pic_path = $imagePath;
        $post->content = $validatedData['content'];
        $post->save();

        // save tags
        $tags = json_decode($validatedData['tags']) ?? [];
        foreach ($tags as $tag)
        {
            $tag_obj = Tag::firstOrNew(
              ['name' => $tag->value],
              ['name' => $tag->value]
            );

            if (!$tag_obj->exists) {
              $tag_obj->save();
            }

            if (!$tag_obj->posts->contains($post)) {
              $tag_obj->posts()->attach($post->id);
            }
        }

        session()->flash('message', 'Post succesfully created');
        session()->flash('alert-class', 'alert-success');
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()->route('posts')->with('message', 'Post Deleted');
    }
}
