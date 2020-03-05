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
            'communityId' => 'required',
            'zoneId' => 'required',
            'parishId' => 'required',
            'emailAddress' => 'required',
            'phoneNumber' => 'required',
            'gender' => 'required',
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
            'email' => $request->emailAddress,
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
    public function update(Request $request, $id)
    {

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

    public function loadMembers() {
        $items = array();
        $members = Member::with(['community', 'addresses'])->get();
        foreach ($members as $member) {
            $items[] = MemberUtility::mapMember($member);
        }

        return response()->json(['members' => $items]);
    }

}
