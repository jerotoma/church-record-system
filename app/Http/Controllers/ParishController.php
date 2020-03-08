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
        return view('dashboard.parishes.parishes');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewCommunities($parishId, $zoneId) {
        return view('dashboard.parishes.communities', [
            'zone' => Zone::find($zoneId),
        ]);
    }


    public function loadCommunitiesByZoneId($parishId, $zoneId) {
        $communities = Community::where('zone_id', $zoneId)->get();
        return response()->json(['communities' => $communities]);
    }

    public function  createCommunity(Request $request, $parishId, $zoneId) {
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

    public function  updateCommunity(Request $request, $parishId, $zoneId) {
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
        return view('dashboard.parishes.zones', [
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

    public function createZone(Request $request) {
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

    public function updateZone(Request $request) {
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

    public function loadZonesByParishId($parishId) {
        $zones = Zone::where('parish_id', $parishId)->get();
        return response()->json(['zones' => $zones]);
    }
}
