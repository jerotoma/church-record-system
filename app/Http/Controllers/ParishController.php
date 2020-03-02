<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Parish;
use App\Zone;
use App\Community;

class ParishController extends Controller {

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
        return view('dashboard.parishes.view');
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
        return view('dashboard.parishes.show', [
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

    public function createZone(Request $request) {
        $request->validate([
            'name' => 'required|min:3',
            'code' => 'required|min:2',
            'parishId' => 'required'
        ]);

        $zone = Zone::create([
            'name' => $request->name,
            'code' => $request->code,
            'parish_id' => $request->parishId
        ]);

     return response()->json(['zone'=> $zone]);
    }

    public function loadZones() {
        $zones = Zone::all();
        return response()->json(['zones' => $zones]);
    }
}
