<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Giving;
use App\Helpers\GivingUtility;

class GivingController extends Controller {

    private $baseDirViewPath = 'dashboard.givings';

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
            'amount' => 'required',
            'minAmount' => 'required',
            'maxAmount' => 'required',
            'targetNumber' => 'required',
            'description' => 'required'
        ]);

        $giving = Giving::create([
            'name'  => $request->name,
            'amount' => $request->amount,
            'min_amount' => $request->minAmount,
            'max_amount' => $request->maxAmount,
            'target_number' => $request->targetNumber,
            'description' => $request->description,
        ]);
      return response()->json(['giving' => $giving]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

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

    public function findGivings() {
         return response()->json([
            'givings' => GivingUtility::mapGivings(Giving::all())
            ]);
    }

}
