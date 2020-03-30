<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;
use App\Address;
use App\Member;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\Helpers\MemberUtility;
use App\Helpers\HelperUtility;
use App\Helpers\AddressUtility;
use App\Helpers\PaginateUtility;

class MemberController extends Controller
{
    private $baseDirViewPath = 'dashboard.members';

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
        return view($this->baseDirViewPath . '.view');
    }


      /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'firstName' => 'required',
            'lastName' => 'required',
            'communityId' => 'required|numeric',
            'zoneId' => 'required|numeric',
            'parishId' => 'required|numeric',
            'email' => 'required|email',
            'phone' => 'required',
            'gender' => 'required|max:6',
            'occupation' => 'required',
            'streetAddress' => 'required',
            'unitNumber' => 'required',
            'city' => 'required',
            'country' => 'required',
            'state' => 'required',
            'postalCode' => 'required',
        ]);

        $member = Member::create([
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'middle_name' => $request->middleName,
            'email' => $request->email,
            'gender' => $request->gender,
            'occupation' => $request->occupation,
            'phone' => $request->phone,
            'community_id' => $request->communityId,
        ]);

        $address = Address::create([
            'member_id' => $member['id'],
            'street_address' => $request->streetAddress,
            'unit_number' => $request->unitNumber,
            'city' => $request->city,
            'country' => $request->country,
            'state' => $request->state,
            'postal_code' => $request->postalCode,
        ]);
      return response()->json(['member' => MemberUtility::mapMember(Member::find($member['id']))]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return view($this->baseDirViewPath . '.show', [
            'member'=> MemberUtility::mapMember(Member::find($id)),
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
            'id' => 'required|numeric',
            'firstName' => 'required',
            'lastName' => 'required',
            'communityId' => 'required|numeric',
            'zoneId' => 'required|numeric',
            'parishId' => 'required|numeric',
            'email' => 'required:email',
            'phone' => 'required',
            'gender' => 'required:max:6',
            'occupation' => 'required',
            'streetAddress' => 'required',
            'unitNumber' => 'required',
            'city' => 'required',
            'country' => 'required',
            'state' => 'required',
            'postalCode' => 'required',
        ]);

        $member = Member::find($request->id);

        $member->first_name = $request->firstName;
        $member->last_name = $request->lastName;
        $member->middle_name = $request->middleName;
        $member->email = $request->email;
        $member->gender = $request->gender;
        $member->occupation = $request->occupation;
        $member->phone = $request->phone;
        $member->community_id = $request->communityId;
        $member->save();

        $address = Address::find($member->address->id);
        $address->member_id = $member->id;
        $address->street_address = $request->streetAddress;
        $address->unit_number = $request->unitNumber;
        $address->city = $request->city;
        $address->country = $request->country;
        $address->state = $request->state;
        $address->postal_code = $request->postalCode;
        $address->save();

      return response()->json(['member' => MemberUtility::mapMember(Member::find($member->id))]);

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
                'memberId' => $id,
                'success' => false,
                'message' => 'Invalid member ID: '.$id. ' was given.'
            ], 404);
        }

        $member = Member::find($id);

        if ($member == null) {
            return response()->json([
                'memberId' => $id,
                'success' => false,
                'message' => 'The Member of ID: '.$id. ' doesn\'t  exist.'
            ], 404);
        }

        $member->delete();
        return response()->json([
            'memberId' => $id,
            'success' => true,
            'message' => 'The Member of ID: '.$id. ' has been deleted'
        ], 200);
    }

    public function loadMembers(Request $request) {
        $request->validate([
            'sortField' => 'required',
            'sortType' => 'required|max:5',
            'perPage' => 'required',
            'page' => 'required',
        ]);
        $members = Member::with(['community', 'address']);
        $members = $this->processSortRequest($request, $members)->paginate($request->perPage);
        return response()->json([
            'members' => MemberUtility::mapMembers($members),
            'pagination' =>  PaginateUtility::mapPagination($members),
        ]);
    }

    public function searchMember(Request $request) {
        $request->validate([
            'searchTerm' => 'required',
            ]
        );

        $searchTerms = explode(' ', $request->searchTerm, 2);
        if (count($searchTerms) > 1) {
            $members = $this->findMemberBySearchTerm($searchTerms[0]);
            if (count($members) == 0) {
                $members = $this->findMemberBySearchTerm($searchTerms[1]);
            }
        } else {
            $members = $this->findMemberBySearchTerm($searchTerms[0]);
        }
        return response()->json(['members' => MemberUtility::mapMembers($members)]);
    }

    private function findMemberBySearchTerm($searchTerm) {
        return Member::where(DB::raw('lower(first_name)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' )
            ->orWhere(DB::raw('lower(last_name)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' )
            ->orWhere(DB::raw('lower(middle_name)'), 'LIKE', '%'. Str::lower($searchTerm). '%' )
            ->orWhere(DB::raw('lower(email)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' )
            ->get();
    }

    private function processSortRequest(Request $request, $members) {
        if ($request->sortField == 'fullName') {
            $members = $members
               ->orderBy('members.first_name', $request->sortType)
               ->orderBy('members.middle_name', $request->sortType)
               ->orderBy('members.last_name', $request->sortType);
       } else if ($request->sortField == 'phoneNumber') {
            $members = $members->orderBy('members.phone_number', $request->sortType);
       } else if ($request->sortField == 'community') {
            $members = $members
                ->join('addresses', 'addresses.member_id', '=', 'members.id')
                ->join('communities', 'communities.id', '=', 'members.community_id')
                ->orderBy('communities.name', $request->sortType)
                ->select('members.*', 'addresses.id as addressId', 'communities.*');
       } else if ($request->sortField == 'zone') {
            $members = $members
                ->join('addresses', 'addresses.member_id', '=', 'members.id')
                ->join('communities', 'communities.id', '=', 'members.community_id')
                ->join('zones', 'zones.id', '=', 'communities.zone_id')
                ->orderBy('zones.name', $request->sortType)
                ->select('members.*', 'addresses.id as addressId', 'communities.*');
       } else {
            $members = $members->orderBy('members.'.$request->sortField, $request->sortType);
       }
       return  $members;
   }
}
