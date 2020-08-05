<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Query;
class NotificationsController extends Controller
{
    //
    public function index(){
        $user = auth()->user();
        if($user){
            $activeUser = Query::getUserById($user->id);
            
            if($activeUser->role == 'artist'){
                $notifications = Query::getDesignsForArtistById($activeUser->id);
                foreach($notifications['accepted'] as $n){
                    
                    $n->artistInfo = Query::getUserById($n->artist_id);
                    $n->clientInfo = Query::getUserById($n->client_id);
                    $n->designInfo = Query::getDesignByUserDesignId($n->design_id);
                    $n->design_path = '/images/'.$n->artistInfo->id.'/'.$n->designInfo->image;
                    
                 }
                 foreach($notifications['declined'] as $n){
                    $n->artistInfo = Query::getUserById($n->artist_id);
                    $n->clientInfo = Query::getUserById($n->client_id);
                    $n->designInfo = Query::getDesignByUserDesignId($n->design_id);
                    $n->design_path = '/images/'.$n->artistInfo->id.'/'.$n->designInfo->image;
                   
                 }
                return view('notifications')->with(compact('activeUser', 'notifications'));
            }elseif($activeUser->role == 'user'){
                $notifications = Query::getPendingDesignsByUser($activeUser->id);
                foreach($notifications as $n){
                   $n->artistInfo = Query::getUserById($n->artist_id);
                   $n->designInfo = Query::getDesignByUserDesignId($n->design_id);
                   $n->design_path = '/images/'.$n->artistInfo->id.'/'.$n->designInfo->image;
                   $n->decline_count = count(Query::checkDesignDeclineCount($n->artist_id, $n->client_id, $n->design_id));
                   $n->change_limit = Query::getContractByUserId($n->artist_id)->change_limit;
                }
                return view('notifications')->with(compact('notifications','activeUser'));
            }  
            
        }else{
            return redirect('/login');
        }
    }
    public function declineDesign(Request $request,$notification_id, $artist_id, $design_id, $client_id){
        $request->validate([
            'design-decline-reason' => 'required|max:255',
        ]);
        Query::createDeclineDesign($artist_id, $design_id, $client_id, $request->input('design-decline-reason'));
        Query::removeDesignsByid($notification_id);
        return redirect()->back()->with('succes', 'Design afgekeurd');
    }
    public function acceptDesign($notification_id, $artist_id, $design_id, $client_id){

        Query::createAcceptDesign($artist_id, $design_id, $client_id);
        Query::removeDesignsByid($notification_id);
        return redirect()->back()->with('succes', 'Design geaccepteerd');
       
    }
}
