<?php

namespace App\Http\Controllers;

use App\Vote;
use App\Post;
use Auth;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function apiStore(Request $request, Post $post)
    {
        // validate data
        $validatedData = $request->validate([
          'type' => 'required|numeric|in:1,-1',
        ]);

        $vote = Vote::firstOrNew(
          [
            'user_id' => Auth::user()->id,
            'post_id' => $post->id
          ],
          [
            'user_id' => Auth::user()->id,
            'post_id' => $post->id,
            'type' => $validatedData['type']
          ]
        );

        if (!$vote->exists) {
          $vote->save();
          return response()->json('Vote Added');
        } else {
          if ($vote->type != $validatedData['type']) {
            $vote->type = $validatedData['type'];
            Vote::where(['user_id' => $vote->user_id, 'post_id' => $vote->post_id])->update([
              'user_id' => $vote->user_id,
              'post_id' => $vote->post_id,
              'type' => $vote->type
            ]);
            return response()->json('Vote Updated');
          } else {
            return response()->json('Cannot Vote Again!');
          }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function show(Vote $vote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function edit(Vote $vote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vote $vote)
    {
        // validate data
        $validatedData = $request->validate([
          'type' => 'required|numeric|in:1,-1',
        ]);

        if ($vote->type != $validatedData['type']) {
          Vote::where(['user_id' => $vote->user_id, 'post_id' => $vote->post_id])->update([
            'user_id' => $vote->user_id,
            'post_id' => $vote->post_id,
            'type' => $validatedData['type']
          ]);
          return response()->json('Vote Updated');
        } else {
          return response()->json('Cannot Vote Again!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function apiUpdate(Request $request, Vote $vote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vote $vote)
    {
        //
    }
}
