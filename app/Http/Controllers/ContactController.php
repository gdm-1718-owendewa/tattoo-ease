<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Query;
class ContactController extends Controller
{
    //
    public function index(){
        $user = auth()->user();
        if($user){
            $activeUser = Query::getUserById($user->id);
            if($activeUser->role == 'artist'){
                $userContacts = Query::getAllContactsForArtist($user->id);
                return view('contacts')->with(compact('activeUser', 'userContacts'));
            }elseif($activeUser->role == 'user'){
                $allArtists = Query::getAllArtists();
                $userContacts = Query::getContactsForUser($user->id);
                
                foreach($allArtists as $artist){
                    $artist->contractinfo = Query::getContractByUserId($artist->id);
                    $friended = Query::checkIfInContact(auth()->user()->id, $artist->id);
                    if(count($friended) != 0){
                        $artist->friended = true;
                    }elseif(count($friended) == 0){
                        $artist->friended = false;
                    };
                }
                return view('contacts')->with(compact('activeUser', 'userContacts', 'allArtists'));
            }  
            
        }else{
            return redirect('/login');
        }
    }   
    public function removeContact($id){
        Query::removeContact($id);
        return redirect()->back();
    }
    public function addContact($contact_id){
        Query::addContact(auth()->user()->id,$contact_id);
        return redirect()->back();
    }
}
