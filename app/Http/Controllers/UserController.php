<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Helpers\UserUtility;
use App\Helpers\HelperUtility;
use App\Helpers\AddressUtility;


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
   public function index() {
       return view($this->baseDirViewPath . '.view');
   }

   public function loadLoggedInUser() {
        return response()->json(['auth' => UserUtility::mapUser(Auth::user())]);
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'firstName' => 'required',
                'lastName' => 'required',
                'roleId' => 'required|numeric',
                'email' => 'required|email',
                'username' => 'required|unique:users,username',
                'password' => 'required|min:5',
                'confirmPassword' => 'required|min:5|same:password',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ], 422); // 400 being the HTTP code for an invalid request.
            } else {
                $role = config('roles.models.role')::find($request->roleId);

                $user = User::create([
                    'first_name' => $request->firstName,
                    'last_name' => $request->lastName,
                    'middle_name' => $request->middleName,
                    'email' => $request->email,
                    'gender' => $request->gender,
                    'username' => $request->username,
                    'password' => Hash::make($request->password),
                    'phone' => $request->phoneNumber,
                    'community_id' => $request->communityId,
                ]);
                $user->attachRole($role);
            }
            return response()->json([
                'success' => true,
                'message' => 'The user ' .$request->firstName. ' ' . $request->lastName. ' has been created',
                'hasMessage' => true,
            ], 200);
        } catch (\Exception $ex) {
            return response()->json(array(
                'success' => false,
                'errors' => $ex->getMessage()
            ), 400); // 400 being the HTTP code for an invalid request.
        }
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return view($this->baseDirViewPath . '.show', [
            'user'=> UserUtility::mapUser(User::find($id)),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required|numeric',
                'firstName' => 'required',
                'lastName' => 'required',
                'roleId' => 'required|numeric',
                'email' => 'required|email',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ], 422); // 400 being the HTTP code for an invalid request.
            } else {
                $role = config('roles.models.role')::find($request->roleId);

                $user = User::find($request->id);
                $user->first_name = $request->firstName;
                $user->last_name = $request->lastName;
                $user->middle_name = $request->middleName;
                $user->email = $request->email;
                $user->phone = $request->phoneNumber;
                $user->save();
                $user->detachAllRoles();
                $user->attachRole($role);
            }
            return response()->json([
                'success' => true,
                'message' => 'The user ' .$request->firstName. ' ' . $request->lastName. ' has been created',
                'hasMessage' => true,
            ], 200);
        } catch (\Exception $ex) {
            return response()->json(array(
                'success' => false,
                'errors' => $ex->getMessage()
            ), 400); // 400 being the HTTP code for an invalid request.
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

    }

    public function loadUsers() {
        $items = array();
        $users = User::all();
        foreach ($users as $user) {
            $items[] = UserUtility::mapUser($user);
        }

        return response()->json(['users' => $items]);
    }
}
