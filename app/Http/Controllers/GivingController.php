<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\GivingUtility;
use App\Helpers\PaginateUtility;
use App\Giving;
use App\Member;
use App\GivingType;
use App\Community;
use App\Zone;

class GivingController extends Controller
{
    private $baseDirViewPath = 'dashboard.contributions.givings';


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
   public function findGivings(Request $request) {
        $request->validate([
            'sortField' => 'required',
            'sortType' => 'required|max:5',
            'perPage' => 'required',
            'page' => 'required',
        ]);
        $givings = $this->processSortRequest($request, Giving::where('givings.id','>', 0))->paginate($request->perPage);
        return response()->json([
               'pagination' =>  PaginateUtility::mapPagination($givings),
               'givings'=> GivingUtility::mapGivings($givings)
           ]);
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request) {
        $giving = '';
        $request->validate([
            'memberIds' => 'required|min:1|array',
            'givingTypeId' => 'required|min:1',
            'amount' => 'required|numeric',
            'datePaid' => 'required|date',
        ]);

        foreach ($request->memberIds as $key =>  $memberId) {
            $giving = Giving::create([
                'member_id' => $memberId,
                'giving_type_id' => $request->givingTypeId,
                'amount' => $request->amount,
                'date_paid' => $request->datePaid,
            ]);
        }
    return response()->json(['giving'=> $giving]);
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
   public function destroy($id) {
        if (!is_numeric($id)) {
            return response()->json([
                'givingId' => $id,
                'success' => false,
                'message' => 'Invalid Giving ID: '.$id. ' was given.'
            ], 404);
        }

        $giving = Giving::find($id);

        if ($giving == null) {
            return response()->json([
                'givingId' => $id,
                'success' => false,
                'message' => 'The Giving of ID: '.$id. ' doesn\'t  exist.'
            ], 404);
        }
        $giving->delete();

        return response()->json([
            'givingId' => $id,
            'success' => true,
            'message' => 'The Giving of ID: '.$id. ' has been deleted'
        ], 200);
    }

     /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function findGivingsByMemberId(Request $request, $memberId) {
        $request->validate([
            'sortField' => 'required',
            'sortType' => 'required|max:5',
            'perPage' => 'required',
            'page' => 'required',
        ]);
        $givings = Giving::where('member_id', $memberId);
        $givings = $this->processSortRequest($request, $givings)->paginate($request->perPage);

        return response()->json([
            'pagination' =>  PaginateUtility::mapPagination($givings),
            'givings'=> GivingUtility::mapGivings($givings)
        ]);
    }

    public function findGivingsByGivingTypeId(Request $request, $givingTypeId) {
        $request->validate([
            'sortField' => 'required',
            'sortType' => 'required|max:5',
            'perPage' => 'required',
            'page' => 'required',
        ]);
        $givings = Giving::where('giving_type_id', $givingTypeId);
        $givings = $this->processSortRequest($request, $givings)->paginate($request->perPage);

        return response()->json([
            'pagination' =>  PaginateUtility::mapPagination($givings),
            'givings'=> GivingUtility::mapGivings($givings)
        ]);
    }

    private function processSortRequest(Request $request, $givings) {
         if($request->sortField == 'fullName') {
            $givings = $givings
                ->join('members', 'members.id', '=', 'givings.member_id')
                ->orderBy('members.first_name', $request->sortType)
                ->orderBy('members.middle_name', $request->sortType)
                ->orderBy('members.last_name', $request->sortType);
        }else if($request->sortField == 'datePaid') {
            $givings = $givings->orderBy('date_paid', $request->sortType);
        }else if($request->sortField == 'givingType') {
            $givings = $givings
                ->join('giving_types', 'giving_types.id', '=', 'givings.giving_type_id')
                ->orderBy('giving_types.name', $request->sortType);
        }else if($request->sortField == 'community') {
            $givings = $givings
                ->join('members', 'members.id', '=', 'givings.member_id')
                ->join('communities', 'communities.id', '=', 'members.community_id')
                ->orderBy('communities.name', $request->sortType);

        }else if($request->sortField == 'zone') {
            $givings = $givings
                ->join('members', 'members.id', '=', 'givings.member_id')
                ->join('communities', 'communities.id', '=', 'members.community_id')
                ->join('zones', 'zones.id', '=', 'communities.zone_id')
                ->orderBy('zones.name', $request->sortType);
        }else {
            $givings = $givings->orderBy($request->sortField, $request->sortType);
        }

        return  $givings;
    }
}
