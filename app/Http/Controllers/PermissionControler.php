<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PermissionControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'model' => 'required',
            'description' => 'required'
        ]);

        $permission = config('roles.models.permission')::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'model' => $request->model,
            'description' => $request->description
        ]);

        return response()->json(['permission' => $permission]);
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
    public function update(Request $request, $id) {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'slug' => 'required',
            'model' => 'required',
            'description' => 'required'
        ]);

        $permission = config('roles.models.permission')::find($id);
        $permission->name = $request->name;
        $permission->slug = $request->slug;
        $permission->model = $request->model;
        $permission->description = $request->description;

        $permission->save();

        return response()->json(['permission' => $permission]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = config('roles.models.permission')::find($id);
        $permission->delete();

        return response()->json(['success' => true]);
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function findPermissions() {
        $permissions = config('roles.models.permission')::all();
        return response()->json(['permissions' => $permissions]);
    }
}
