<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Query;
class ContractController extends Controller
{
    //
    public function index(){
        $user = auth()->user();
        $activeUser = Query::getUserById($user->id);
        if($activeUser->role == 'artist'){
            return view('contract')->with(compact('activeUser'));
        }else{
            return redirect()->back();
        }
       
    }
    public function create(Request $request, $id){
        $request->validate([
            'algemeene-info' => 'required|max:500',
            'aanpassings-limiet' => 'required',
        ]);
        Query::createContract(auth()->user()->id, $request->input('algemeene-info'), $request->input('aanpassings-limiet'));
        Query::updateShowOnWebsite(auth()->user()->id);
        return redirect('/profile');
    }
}
