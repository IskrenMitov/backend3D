<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Upvote;
use Illuminate\Http\Request;

class UpvoteController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'file_id' => 'required|exists:files,id',
        ]);

        $upvote = Upvote::create([
            'user_id' => $validated['user_id'],
            'file_id' => $validated['file_id'],
        ]);

        return response()->json($upvote, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        if (Upvote::destroy($id))
            return response()->json('Success', 200);
        else
            return response()->json('An error ocurred while deleting the object.', 500);
    }
}
