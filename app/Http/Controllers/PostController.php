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
        $tagC = new TagController();
        $tags = $tagC->apiIndex()->pluck('name');
        return view('posts.create', ['tags' => $tags]);
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
          'featured_pic_path' => 'nullable|string',
          'tags' => 'nullable|string',
          'content' => 'required|min:2'
        ]);

        // save validated data to database
        $post = new Post;
        $post->user_id = Auth::user()->id;;
        $post->title = $validatedData['title'];
        $post->featured_pic_path = $validatedData['featured_pic_path'];
        $post->content = $validatedData['content'];
        $post->save();

        // save tags
        $tags = json_decode($validatedData['tags']);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('posts.show', ['post' => Post::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
