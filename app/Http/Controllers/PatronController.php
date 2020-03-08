<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Helpers\PatronUtility;
use  App\Helpers\PaginateUtility;
use  App\Patron;

class PatronController extends Controller {

    private $baseDirViewPath = 'dashboard.patrons';


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
        return view($this->baseDirViewPath . '.view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function findPatrons(Request $request) {

        $patrons = Patron::paginate($request->perPage);

        return response()->json([
                'pagination' =>  PaginateUtility::mapPagination($patrons),
                'patrons'=> PatronUtility::mapPatrons($patrons)
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'memberIds' => 'required|min:1|array',
            'givingId' => 'required|min:1',
            'amount' => 'required|numeric',
            'datePaid' => 'required|date',
        ]);

        foreach ($request->memberIds as $key =>  $memberId) {
            $patron = Patron::create([
                'member_id' => $memberId,
                'giving_id' => $request->givingId,
                'amount' => $request->amount,
                'date_paid' => $request->datePaid,
            ]);
        }
     return response()->json(['patron'=> $patron]);
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
    public function destroy($id)
    {
        //
    }
}
