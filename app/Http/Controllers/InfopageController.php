<?php

namespace App\Http\Controllers;
use App\Query;
use Illuminate\Http\Request;

class InfopageController extends Controller
{
    //
    public function index($id){
        $user = Query::getUserById($id);
        return view('info-page')->with(compact('user'));
    }
}
