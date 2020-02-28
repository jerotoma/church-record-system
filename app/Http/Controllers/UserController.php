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

class UserController extends Controller
{
    private $baseDirViewPath = 'dashboard.users';

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

        $data = $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'username' => 'required',
            'emailAddress' => 'required',
            'password' => 'required',
            'gender' => 'required',
            'confirmPassword' => 'required',
            'streetAddress' => 'required',
            'unitNumber' => 'required',
            'city' => 'required',
            'country' => 'required',
            'state' => 'required',
            'postalCode' => 'required',
        ]);

        $user = User::create([
            'username' => $data['username'],
            'password' =>  Hash::make($data['password']),
            'enabled' => false,
            'locked' => false,
            'confirmed' => false
        ]);

        $member = Member::create([
            'user_id' => $user->id,
            'first_name' => $data['firstName'],
            'last_name' => $data['lastName'],
            'email_address' => $data['emailAddress'],
            'gender' => $data['username'],
        ]);

        $address = Address::create([
            'member_id' => $member['id'],
            'street_address' => $data['streetAddress'],
            'unit_number' => $data['unitNumber'],
            'city' => $data['city'],
            'country' => $data['country'],
            'state' => $data['state'],
            'postal_code' => $data['postalCode'],
        ]);
      return response()->json($user);
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
