<?php

namespace NanoCMS\Http\Controllers\NanoCMS;

use NanoCMS\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CMSHomeController extends \NanoCMS\Http\Controllers\Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
        $this->user = Auth::user();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $data = [
            'user' => $this->user
        ];

        return view('home', $data);
    }

}
