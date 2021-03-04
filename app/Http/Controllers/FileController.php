<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(File::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreFileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'path' => 'required|max:255',
            'name' => 'required|min:4|max:255',
            'description' => 'max:1000',
            'user_id' => 'required|exists:users,id'
        ]);

        $user = File::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'path' => $validated['path'],
            'user_id' => $validated['user_id'],
        ]);

        return response()->json($user, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(File::findOrFail($id), 200);
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
        $file = File::findOrFail($id);

        $validated = $request->validate([
            'path' => 'required|max:255',
            'name' => 'required|min:4|max:255',
            'description' => 'max:1000'
        ]);

        $file->name = $validated['name'];
        $file->description =$validated['description'];
        $file->path = $validated['path'];

        $file->save();

        return response()->json($file, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = File::findOrFail($id);
        $file->disabled = false;
        $file->save();

        return response()->json($file, 200);
    }
}
