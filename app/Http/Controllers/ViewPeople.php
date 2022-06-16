<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\json_encode;

class ViewPeople extends Controller
{
    //
    public function viewpeople(Request $req)
    {
        if ($req->ajax()) {
            $data = stripslashes(file_get_contents("php://input"));
            $mydata = json_decode($data, true);
            $id = $mydata['person'];
            // return view('peopleprofile',['info'=>$info],['posts'=>$poststable],['user'=>$uid]);
            $req->session()->regenerate();
            $req->session()->put('idp', $id);
            return redirect('/showpeople');
        }
    }
    public function showpeople(Request $req)
    {
        $uid = session()->get('id');
        $id =   session()->get('idp');
        // dd($uid);
        $info = DB::table('information')
            ->where('userid', $id)
            ->get();
        $posts = DB::table('posts')
            ->where('userid', $id)
            ->get();
        $poststable = json_decode(json_encode($posts), true);
        $getit = json_decode(json_encode($info), true);
        // dd($info);
        $idarray = ['acting_user' => $uid];
        $frequest = DB::table('friendrequests')
            ->where('from', $uid)
            ->where('to',$id)
            ->get();
        $reqf=json_decode(json_encode($frequest), true);
        if(!empty($reqf[0]['status'])){
        $req->session()->regenerate();
        $req->session()->put('status', $reqf[0]['status']);
        }
        else{
            $req->session()->regenerate();
            $req->session()->put('status', 404);
        }
        return view('peopleprofile', ['info' => $getit[0]], ['posts' => $poststable], ['status' => $reqf]);
    }
}
