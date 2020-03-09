<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Parish;
use App\Zone;
use App\Community;

class CommunityController extends Controller {

    private $baseDirViewPath = 'dashboard.hierarchies.communities';

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
            'zoneId' => 'required'
        ]);
        $community = Community::create([
            'name' => $request->name,
            'code' => $request->code,
            'zone_id' => $request->zoneId,
        ]);

     return response()->json(['community'=> $community]);
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
            'id' => 'required|numeric',
            'name' => 'required|min:3',
            'code' => 'required|min:2',
            'zoneId' => 'required|numeric'
        ]);

        if (!is_numeric($parishId)) {
            return response()->json([
                'parishId' => $parishId,
                'success' => false,
                'message' => 'The Parish ID: '.$parishId. ' is invalid.'
            ], 422);
        }

        $parish = Parish::find($parishId);
        if ($parish  == null) {
            return response()->json([
                'parishId' => $request->id,
                'success' => false,
                'message' => 'The Parish of ID: '.$request->id. ' doesn\'t  exist.'
            ], 404);
        }

        $zone = Zone::find($request->zoneId);
        if ($zone  == null) {
            return response()->json([
                'zoneId' => $request->zoneId,
                'success' => false,
                'message' => 'The Zone of ID: '.$request->id. ' doesn\'t  exist.'
            ], 404);
        }

        $community = Community::find($request->id);
        if ($community == null) {
            return response()->json([
                'communityId' => $request->id,
                'success' => false,
                'message' => 'The Community of ID: '.$request->id. ' doesn\'t  exist.'
            ], 404);
        }
        $community->name = $request->name;
        $community->code = $request->code;
        $community->zone_id = $zone->id;
        $community->save();

     return response()->json(['community'=> $community]);

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

    public function loadCommunities() {
        $communities = Community::all();
        return response()->json(['communities' => $communities]);
    }

    public function loadCommunitiesByZoneId($zoneId) {
        $communities = Community::where('zone_id', $zoneId)->get();
        return response()->json(['communities' => $communities]);
    }
}
