<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Routing\Route;

class AdminController extends Controller {

    function index() {
        print_r($_POST);
        //return view('admin.login');
    }

}
