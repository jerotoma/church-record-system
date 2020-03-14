<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GivingType;
use App\Helpers\GivingTypeUtility;

class GivingTypeController extends Controller {

    private $baseDirViewPath = 'dashboard.giving-types';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
       $this->middleware('auth');
    }

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        return view($this->baseDirViewPath . '.view');
    }
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $request->validate([
            'name'  => 'required',
            'amount' => 'required|numeric',
            'minAmount' => 'required|numeric',
            'maxAmount' => 'required|numeric',
            'targetNumber' => 'required|numeric',
            'description' => 'required'
        ]);

        $givingType = GivingType::create([
            'name'  => $request->name,
            'amount' => $request->amount,
            'min_amount' => $request->minAmount,
            'max_amount' => $request->maxAmount,
            'target_number' => $request->targetNumber,
            'description' => $request->description,
        ]);
      return response()->json(['givingType' => GivingTypeUtility::mapGivingType($givingType)]);
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
            'name'  => 'required',
            'amount' => 'required',
            'minAmount' => 'required',
            'maxAmount' => 'required',
            'targetNumber' => 'required',
            'description' => 'required'
        ]);

        $givingType = GivingType::find($request->id);

        if ($givingType  == null) {
            return response()->json([
                'givingId' => $request->id,
                'success' => false,
                'message' => 'The GivingType type of ID: '.$request->id. ' doesn\'t  exist.'
            ], 404);
        }
        $givingType->name  = $request->name;
        $givingType->amount = $request->amount;
        $givingType->min_amount = $request->minAmount;
        $givingType->max_amount = $request->maxAmount;
        $givingType->target_number = $request->targetNumber;
        $givingType->description = $request->description;

        $givingType->save();

        return response()->json(['givingType' => GivingTypeUtility::mapGivingType($givingType)]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function findGivingTypes() {
         return response()->json([
            'givingTypes' => GivingTypeUtility::mapGivingTypes(GivingType::all())
            ]);
    }

}
