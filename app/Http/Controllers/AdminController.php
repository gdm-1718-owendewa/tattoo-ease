<?php

namespace App\Http\Controllers;
use App\Query;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index(){
        $activeUser = Query::getUserById(auth()->user()->id);
        $userAmount = count(Query::getUsers());
        $recentUserAmount = count(Query::getRecentUsers());
        $designAmount = count(Query::getDesigns());
        if($activeUser->role != 'admin'){
            return redirect('/profile');
        }
        return view('admin/admindashboard')->with(compact('activeUser', 'userAmount', 'recentUserAmount', 'designAmount'));
    }
    public function users(){
        $activeUser = Query::getUserById(auth()->user()->id);
        if($activeUser->role != 'admin'){
            return redirect('/profile');
        }
        $users = Query::getUsersByRole();
        return view('admin/adminusers')->with(compact('users','activeUser'));
    }
    public function usersEdit($id){
        $activeUser = Query::getUserById(auth()->user()->id);
        if($activeUser->role != 'admin'){
            return redirect('/profile');
        }
        $user = Query::getUserById($id);
        if($user->role == "artist"){
            $contract = Query::getContractByUserId($user->id); 
            
            return view('admin/adminuseredit')->with(compact('user','contract','activeUser')); 
        }else{
            return view('admin/adminuseredit')->with(compact('user','activeUser'));
        }
    }
    public function usersDelete($id){
        Query::deleteUserById($id);
        Query::deleteDesignsByUserId($id);
        Query::deletecontactByUserId($id);
        Query::deleteContractByUserId($id);
        Query::deletePendingByUserId($id);
        Query::deleteAcceptedByUserId($id);
        Query::deleteDeclinedByUserId($id);
        return redirect()->back()->with('succes','User deleted');
    }
    public function designs(){
        $activeUser = Query::getUserById(auth()->user()->id);
        if($activeUser->role != 'admin'){
            return redirect('/profile');
        }
        $designs = Query::getDesigns();
        foreach($designs as $d){
            $d->artistinfo = Query::getUserById($d->artist_id);
        }
        return view('admin/admindesigns')->with(compact('designs'));
    }
    public function designsDelete($id){
        Query::deleteDesign($id);
        return redirect()->back()->with('succes','Design deleted');
    }
    
}
