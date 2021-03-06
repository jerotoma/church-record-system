<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
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
    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'level' => 'required|numeric',
            'description' => 'required'
        ]);

        $role = config('roles.models.role')::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'level' => $request->level,
            'description' => $request->description
        ]);

        return response()->json(['role' => $role]);
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
            'level' => 'required|numeric',
            'description' => 'required'
        ]);

        $role = config('roles.models.role')::find($id);
        $role->name = $request->name;
        $role->slug = $request->slug;
        $role->level = $request->level;
        $role->description = $request->description;
        $role->save();

        return response()->json(['permission' => $role]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = config('roles.models.role')::find($id);
        $role->delete();
        return response()->json(['success' => true]);
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function findRoles() {
        $roles = config('roles.models.role')::all();
        return response()->json(['roles' => $roles]);
    }
}
