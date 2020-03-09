<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Parish;
use App\Zone;
use App\Community;

class ParishController extends Controller {

    private $baseDirViewPath = 'dashboard.hierarchies.parishes';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
       $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->baseDirViewPath.'.view');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|min:3',
            'code' => 'required|min:2'
        ]);

        $parish = Parish::create([
            'name' => $request->name,
            'code' => $request->code,
        ]);

     return response()->json(['parish'=> $parish]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return view($this->baseDirViewPath.'.zones', [
            'parish' => Parish::find($id),
        ]);
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
    public function update(Request $request) {
        $request->validate([
            'id' => 'required',
            'name' => 'required|min:3',
            'code' => 'required|min:2'
        ]);

        $parish = Parish::find($request->id);

        if ($parish  == null) {
            return response()->json([
                'parishId' => $request->id,
                'success' => false,
                'message' => 'The Parish of ID: '.$request->id. ' doesn\'t  exist.'
            ], 404);
        }

        $parish->name = $request->name;
        $parish->code = $request->code;
        $parish->save();
        return response()->json(['parish'=> $parish]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

    }

    public function loadParishes() {
        $parishes = Parish::all();

        return response()->json(['parishes' => $parishes]);
    }

    public function loadParish($parishId) {
        $parish = Parish::find($parishId);

        return response()->json(['parish' => $parish]);
    }

}
