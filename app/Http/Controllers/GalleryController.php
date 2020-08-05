<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use App\Query;
class GalleryController extends Controller
{
    //
    public function index(){
        if(auth()->user()->role=="artist"){
            $designs = Query::getDesignByUserId(auth()->user()->id);
            $count = count($designs);
            $foldername = auth()->user()->id;
            return view('gallery')->with(compact('designs','count','foldername'));
        }else{
            return redirect()->back();
        }

    }
    public function addDesign(Request $request){
        $request->validate([
            'design-title' => 'required|max:50',
            'client-name' => 'required|max:50',
            'design-info' => 'required|max:255',
            'design-file' => 'required|mimes:png,jpeg,jpg,JPG,JPEG',
        ]);
        $image = \Request::file('design-file');
        $name = $image->getClientOriginalName();
         
        $image->move(public_path('/images/'. auth()->user()->id), $name);

        Query::createDesign(auth()->user()->id, $request->input('design-title'), $request->input('client-name'), $request->input('design-info'), $name);
        return redirect()->back()->with('succes', 'Uw design is aangemaakt');
    }
    public function choosedesign($clientid){
        if(auth()->user()->role=="artist"){
            $designs = Query::getDesignByUserId(auth()->user()->id);
            $count = count($designs);
            $foldername = auth()->user()->id;
            return view('choosedesign')->with(compact('designs','count','foldername','clientid'));
        }else{
            return redirect()->back();
        }

    }
    public function senddesign($clientid, $designid){
        $client = Query::getUserById($clientid);
        Query::createPendingDesign(auth()->user()->id, $clientid, $designid);
        return redirect()->back()->with('succes', 'Uw design is verstuurd naar '.$client->name);

    }
    public function edit($designid){
        if(auth()->user()->role=="artist" || auth()->user()->role=="admin"){
            $design = Query::getDesignByUserDesignId($designid);
            if(auth()->user()->role=="admin"){
                $artist = Query::getUserById($design->artist_id);
                $design->path = asset('/images/'.$design->artist_id.'/'.$design->image);
                return view('gallery-edit')->with(compact('design', 'artist'));
            }
            elseif(auth()->user()->id != $design->artist_id){
                return redirect()->back();
            }else{
                $artist = Query::getUserById($design->artist_id);
                $design->path = asset('/images/'.$design->artist_id.'/'.$design->image);
                return view('gallery-edit')->with(compact('design', 'artist'));
            }
           
        }else{
            return redirect()->back();
        }

    }
    public function save(Request $request, $id){
       $original_design =  Query::getDesignByUserDesignId($id);
       $design_title = $request->input('design-title');
       $client_name = $request->input('client-name');
       $design_info = $request->input('design-info');
       $design_file = $request->file('design-file');
       
       if($design_file == null){
           Query::update_design($id, $design_title,$client_name,$design_info,$original_design->image);
           return redirect()->back()->with('sucess',' Design aangepast');
       }else{        
        $image = $design_file;
        $name = $image->getClientOriginalName();
        $image->move(public_path('/images/'. auth()->user()->id), $name);
        Query::update_design($id, $design_title,$client_name,$design_info,$name);
        return redirect()->back()->with('sucess',' Design aangepast');
       }

    }
}
