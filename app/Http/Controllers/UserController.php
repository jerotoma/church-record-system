<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
           // dd($user->getRoles());
            $items[] = UserUtility::mapUser($user);
        }

        return response()->json(['users' => $items]);
    }
}
