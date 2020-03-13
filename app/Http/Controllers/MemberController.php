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

use App\Helpers\MemberUtility;
use App\Helpers\HelperUtility;
use App\Helpers\AddressUtility;

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
    public function index()
    {
        return view($this->baseDirViewPath . '.view');
    }


      /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
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
            'phoneNumber' => 'required',
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
            'phone_number' => $request->phoneNumber,
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
            'phoneNumber' => 'required',
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
        $member->phone_number = $request->phoneNumber;
        $member->community_id = $request->communityId;
        $member->save();

        $mAddress = HelperUtility::arrayToObject(AddressUtility::mapAddresses($member)[0]);
        $address = Address::find($mAddress->id);
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

    public function loadMembers() {
        $items = array();
        $members = Member::with(['community', 'addresses'])->get();
        foreach ($members as $member) {
            $items[] = MemberUtility::mapMember($member);
        }

        return response()->json(['members' => $items]);
    }

}
