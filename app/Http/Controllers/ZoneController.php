<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Parish;
use App\Zone;
use App\Community;

class ZoneController extends Controller {

    private $baseDirViewPath = 'dashboard.hierarchies.zones';
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
    public function index() {
        return view($this->baseDirViewPath.'.view');
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
            'code' => 'required|min:2',
            'parishId' => 'required'
        ]);
        $parish = Parish::find($request->parishId);
        if ($parish  == null) {
            return response()->json([
                'parishId' => $request->parishId,
                'success' => false,
                'message' => 'The Parish of ID: '.$request->parishId. ' doesn\'t  exist.'
            ], 404);
        }

        $zone = Zone::create([
            'name' => $request->name,
            'code' => $request->code,
            'parish_id' => $parish->id,
        ]);

     return response()->json(['zone'=> $zone]);
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
            'name' => 'required|min:3',
            'code' => 'required|min:2',
            'parishId' => 'required'
        ]);

        $zone = Zone::find($request->id);
        if ($zone  == null) {
            return response()->json([
                'zoneId' => $request->id,
                'success' => false,
                'message' => 'The Zone of ID: '.$request->id. ' doesn\'t  exist.'
            ], 404);
        }

        $parish = Parish::find($request->parishId);
        if ($parish  == null) {
            return response()->json([
                'parishId' => $request->parishId,
                'success' => false,
                'message' => 'The Parish of ID: '.$request->parishId. ' doesn\'t  exist.'
            ], 404);
        }
        $zone->name = $request->name;
        $zone->code = $request->code;
        $zone->parish_id =  $parish->id;
        $zone->save();
        return response()->json(['zone'=> $zone]);
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

    public function loadZones() {
        $zones = Zone::all();
        return response()->json(['zones' => $zones]);
    }

    public function loadZonesByParishId($parishId) {
        $zones = Zone::where('parish_id', $parishId)->get();
        return response()->json(['zones' => $zones]);
    }
}
