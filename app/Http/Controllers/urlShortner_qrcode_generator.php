<?php

namespace App\Http\Controllers;
use Bitly;
use Illuminate\Http\Request;

class urlShortner_qrcode_generator extends Controller
{

    public function index(Request $req){

        $req->validate([
            'link' => 'required',
            ]);
        
        $link = $req->input("link");
        if($link){
        // echo "dd";
        // $bitlyUrl = $req->$link;
        $bitlyUrl = app('bitly')->getUrl($link);
        if ($req->ajax()) {
            return response()->json([
                'bitlyUrl'=>$bitlyUrl,
            ]);
        }
    
        return view('/index', [
           'bitlyUrl' => $bitlyUrl
        ]);
    }else{
        return response()->json(['error' => 'Error msg'], 404); // Status code here

    }
}
    
}
