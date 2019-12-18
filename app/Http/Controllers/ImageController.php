<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
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
        $validatedData = request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $hash = md5_file($validatedData['image']);
        dd($hash);

        $imageName = $hash.'.'.request()->featured_pic->getClientOriginalExtension();
        request()->featured_pic->move(public_path('uploads'), $imageName);
        $imagePath = "/uploads/".$imageName;
    }
}
