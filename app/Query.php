<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class Query extends Model
{
    //
    public static function getUsers(){
        return DB::table('users')
        ->get();
    }
    public static function getRecentUsers(){
        return DB::table('users')
        ->where('created_at', '>=', Carbon::now()->subDays(7)->toDateTimeString())
        ->get();
    }
    public static function getUsersByRole(){
        return DB::table('users')
        ->orderBy('role', 'asc')

        ->get();
    }
    public static function getUserById($id){
        return DB::table('users')
        ->where('id', '=', $id)
        ->first();
    }
    public static function deleteUserById($id){
        return DB::table('users')
        ->where('id', '=', $id)
        ->delete();
    }
    public static function getAllArtists(){
        return DB::table('users')
        ->where('role', '=', 'artist')
        ->get();
    }
    public static function getContractByUserId($id){
        return DB::table('contract')
        ->where('artist_id', '=', $id)
        ->first();
    }
   

    public static function getContactsForUser($id){
        $artists = DB::table('contacts')
        ->where('user_id', '=', $id)
        ->get();
        foreach($artists as $artist){
            $artist->info = self::getUserById($artist->contact_id);
        }

        return $artists;
    }
    public static function checkIfInContact($user_id,$contact_id){
        return DB::table('contacts')
        ->where('user_id' ,'=', $user_id)
        ->where('contact_id' ,'=', $contact_id)
        ->get();
    }
    public static function addContact($user_id,$contact_id){
        return DB::table('contacts')
        ->insert([
            'user_id' => $user_id,
            'contact_id' => $contact_id
        ]);
    }
    public static function removeContact($id){
        return DB::table('contacts')
        ->where('id', '=', $id)
        ->delete();
    }
  
    public static function getRecentContactsForArtist($id){
        $users =  DB::table('contacts')
        ->where('contact_id', '=', $id)
        ->limit(5)
        ->get();
        foreach($users as $user){
            $user->info = self::getUserById($user->user_id);
        }
        return $users;
    }
    public static function getAllContactsForArtist($id){
        $users =  DB::table('contacts')
        ->where('contact_id', '=', $id)
        ->get();
        foreach($users as $user){
            $user->info = self::getUserById($user->user_id);
        }
        return $users;
    }
    public static function createContract($user_id, $info, $limit){
        return DB::table('contract')
        ->insert([
            'artist_id' => $user_id,
            'change_limit' => $limit,
            'general' => $info,
        ]);
    }
    public static function editContract($id, $change_limit, $general){
        return DB::table('contract')
        ->where('id', '=', $id)
        ->update([
            'change_limit' => $change_limit,
            'general' => $general
        ]);
    }
    public static function updateShowOnWebsite($id){
        return DB::table('users')
        ->where('id', '=', $id)
        ->update([
            'show_on_site' => true
        ]);
    }
    public static function getDesigns(){
        return DB::table('designs')
        ->orderBy('artist_id', 'asc')
        ->get();
    }
    public static function getDesignByUserId($id){
        return DB::table('designs')
        ->where('artist_id', '=', $id)
        ->get();
    }
    public static function getDesignByUserDesignId($id){
        return DB::table('designs')
        ->where('id', '=', $id)
        ->first();
    }
    public static function deleteDesign($id){
        return DB::table('designs')
        ->where('id', '=', $id)
        ->delete();
    }
    public static function update_design($id, $title,$customer,$design_info,$image){
        return DB::table('designs')
        ->where('id', '=', $id)
        ->update([
            'design_title' => $title,
            'customer' => $customer,
            'design_info' => $design_info,
            'image' => $image
        ]);
    }
    public static function createDesign($artist_id, $title, $client_name, $info, $image_name){
        return DB::table('designs')
        ->insert([
            'artist_id' => $artist_id,
            'design_title' => $title,
            'customer' => $client_name,
            'design_info' => $info,
            'image' => $image_name
        ]);
    }
    public static function createPendingDesign($artist_id, $client_id, $design_id){
        return DB::table('pending_designs')
        ->insert([
            'artist_id' => $artist_id,
            'client_id' => $client_id,
            'design_id' => $design_id,
            
        ]);
    }
    public static function getApprovedDesignsByUserId($id){
        return DB::table('approved_designs')
        ->where('client_id', '=' ,$id)
        ->get();
    }
    public static function getPendingDesignsByUser($id){
        return DB::table('pending_designs')
        ->where('client_id', '=' ,$id)
        ->get();
    }
    public static function removeDesignsByid($id){
        return DB::table('pending_designs')
        ->where('id', '=' ,$id)
        ->delete();
    }
    public static function createDeclineDesign($artist_id, $design_id, $client_id, $reason){
        return DB::table('declined_designs')
        ->insert([
            'artist_id' => $artist_id,
            'client_id' => $client_id,
            'design_id' => $design_id,
            'reason' => $reason,
            
        ]);
    }
    public static function createAcceptDesign($artist_id, $design_id, $client_id){
        return DB::table('approved_designs')
        ->insert([
            'artist_id' => $artist_id,
            'client_id' => $client_id,
            'design_id' => $design_id,
            
        ]);
    }
    public static function checkDesignDeclineCount($artist_id, $client_id, $design_id){
        return DB::table('declined_designs')
        ->where('artist_id' , '=', $artist_id)
        ->where('client_id', '=', $client_id)
        ->where('design_id', '=', $design_id)
        ->get();
    }
    public static function getDesignsForArtistById($id){
        $accepted_designs =  DB::table('approved_designs')
                            ->where('artist_id', '=' ,$id)
                            ->get();
        $declined_designs =  DB::table('declined_designs')
                            ->where('artist_id', '=' ,$id)
                            ->get();
        $data = [
            'accepted' => $accepted_designs,
            'declined' => $declined_designs
        ];
        return $data;
    }
    public static function updateArtistProfile($id,$name,$email,$password,$tel,$shopname,$shopadress){
        return DB::table('users')
        ->where('id', '=', $id)
        ->update([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'tel' => $tel,
            'shopname' => $shopname,
            'shopadress' => $shopadress
        ]);
    }
    public static function updateUserProfile($id,$name,$email,$password,$tel){
        return DB::table('users')
        ->where('id', '=', $id)
        ->update([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'tel' => $tel
        ]);
    }
}
