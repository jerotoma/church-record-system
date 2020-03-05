<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

}
