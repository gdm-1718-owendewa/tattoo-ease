<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Query;

class ProfileController extends Controller
{
    //
    public function index(Request $request) {
        $user = auth()->user();
        if($user){
            $activeUser = Query::getUserById($user->id);
            $contract = Query::getContractByUserId($user->id);
            if($activeUser->role == 'artist'){
                $userContacts = Query::getRecentContactsForArtist($user->id);
                return view('profile')->with(compact('activeUser', 'contract', 'userContacts'));

            }elseif($activeUser->role == 'user'){
                $approvedDesigns = Query::getApprovedDesignsByUserId($user->id);
                foreach($approvedDesigns as $n){
                    $n->artistInfo = Query::getUserById($n->artist_id);
                    $n->clientInfo = Query::getUserById($n->client_id);
                    $n->designInfo = Query::getDesignByUserDesignId($n->design_id);
                    $n->design_path = '/images/'.$n->artistInfo->id.'/'.$n->designInfo->image;
                   
                 }
                $userContacts = Query::getContactsForUser($user->id);
                $count = count($approvedDesigns);
                return view('profile')->with(compact('activeUser', 'contract', 'userContacts','count','approvedDesigns'));

            }elseif($activeUser->role == 'admin'){
                return redirect('admin-dash');
            }
           
        }else{
            return redirect('/login');
        }
    }
    public function getEditPage(Request $request, $id) {
        if($id != auth()->user()->id){
            return redirect('/profile/edit/'.auth()->user()->id);
        }
        $activeUser = Query::getUserById($id);
        if($activeUser->role == "artist"){
            $contract = Query::getContractByUserId($activeUser->id); 
            
            return view('profile-edit')->with(compact('activeUser','contract')); 
        }else{
            return view('profile-edit')->with(compact('activeUser'));
        }
    }
    public function saveContract(Request $request){
        $contract_id = $request->input('contract_id');
        $change_limit = $request->input('change_limit');
        $general = $request->input('general_info');
        Query::editContract($contract_id, $change_limit, $general);
        return redirect()->back()->with('succes','Contract updated');
    }
    public function save(Request $request, $id){
        $activeUser = Query::getUserById($id);
        if($activeUser->role=="artist"){
            $user_name = $request->input('user-name');
            $user_email = $request->input('user-email');
            $user_password = $request->input('user-password');
            $user_password_confirm = $request->input('user-password-confirm');
            $user_tel = $request->input('user-tel');
            $user_shopname = $request->input('user-shopname');
            $user_shopadress = $request->input('user-shopadress');

            $foldername = str_replace(" ", "",strtolower($activeUser->name));
            $newfoldername = str_replace(" ", "",strtolower($user_name));

            if($user_password != null && $user_password != $user_password_confirm){
                return redirect()->back()->with('fail','Wachtwoorden zijn niet hetzelfde');
            }
            elseif($user_password == null && $user_password_confirm != null){
                return redirect()->back()->with('fail','Gelieve elk wachtwoord veld in te vullen');
            }
            elseif($user_password == null && $user_password_confirm == null){
                Query::updateArtistProfile($activeUser->id,$user_name, $user_email, $activeUser->password, $user_tel, $user_shopname, $user_shopadress);
                return redirect()->back()->with('succes','Profiel aangepast');

            }
            elseif($user_password != null && $user_password == $user_password_confirm){
                Query::updateArtistProfile($activeUser->id,$user_name, $user_email, $user_password, $user_tel, $user_shopname, $user_shopadress);
                return redirect()->back()->with('succes','Profiel aangepast');

            }
        }elseif($activeUser->role=="user" || $activeUser->role=="admin"){
            $user_name = $request->input('user-name');
            $user_email = $request->input('user-email');
            $user_password = $request->input('user-password');
            $user_password_confirm = $request->input('user-password-confirm');
            $user_tel = $request->input('user-tel');
            if($user_password != null && $user_password != $user_password_confirm){
                return redirect()->back()->with('fail','Wachtwoorden zijn niet hetzelfde');
            }
            elseif($user_password == null && $user_password_confirm != null){
                return redirect()->back()->with('fail','Gelieve elk wachtwoord veld in te vullen');
            }
            elseif($user_password == null && $user_password_confirm == null){
                Query::updateUserProfileSamePass($activeUser->id,$user_name, $user_email, $activeUser->password, $user_tel);
                return redirect('/profile');

            }
            elseif($user_password != null && $user_password == $user_password_confirm){
                Query::updateUserProfileWithPass($activeUser->id,$user_name, $user_email, $user_password, $user_tel);
                return redirect('/profile');

            }
        }
    }
}
