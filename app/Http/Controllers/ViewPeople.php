<?php

namespace App\Http\Controllers;

use App\Models\friendrequest;
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
            ->where('to', $id)
            ->get();
        // $frequest=friendrequest::whereIn('');
        // $requi=
        $reqf = json_decode(json_encode($frequest), true);
        // if(empty($reqf))
        // dd($reqf);
        if (!empty($reqf[0])) {
            if ($reqf[0]['status'] == 1){
            $req->session()->regenerate();
            $req->session()->put('status', 1);
            return view('peopleprofile', ['info' => $getit[0]], ['posts' => $poststable], ['status' => $reqf]);
            }
            if ($reqf[0]['status'] == 2) {
                $req->session()->regenerate();
                $req->session()->put('status', 3);
                return view('peopleprofile', ['info' => $getit[0]], ['posts' => $poststable], ['status' => $reqf]);
            }
            if (!empty($reqf[0])) {
                $req->session()->regenerate();
                $req->session()->put('status', 2);
            } 
            else {
                $req->session()->regenerate();
                $req->session()->put('status', 404);
            }
        } else {
            $frequest = DB::table('friendrequests')
                ->where('to', $uid)
                ->where('from', $id)
                ->get();
            $reqf = json_decode(json_encode($frequest), true);
            if (!empty($reqf[0])){
            if ($reqf[0]['status'] == 2) {
                $req->session()->regenerate();
                $req->session()->put('status', 3);
                return view('peopleprofile', ['info' => $getit[0]], ['posts' => $poststable], ['status' => $reqf]);
            }}
            if (!empty($reqf[0])) {
                $req->session()->regenerate();
                $req->session()->put('status', 2);
            } else {
                $req->session()->regenerate();
                $req->session()->put('status', 404);
            }
        }
        return view('peopleprofile', ['info' => $getit[0]], ['posts' => $poststable], ['status' => $reqf]);
    }
}
