<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Information;
use App\Models\User;
use App\Models\post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\School;
use App\Models\friendrequest;

use function GuzzleHttp\json_encode;

class AccountController extends Controller
{
    //
    public function myaccount(Request $req)
    {

        $uid = session()->get('id');
        // dd($id);
        // $info= Information::find('userid',$uid);
        $info = DB::table('information')
            ->where('userid', $uid)
            ->get();
        // dd($info['name']);
        $getit = json_decode(json_encode($info), true);
        // dd($getit[0]);
        $posts=DB::table('posts')
            ->where('userid', $uid)
            ->get();
        $poststable = json_decode(json_encode($posts), true);
        $request=DB::table('friendrequests')
        ->where('to',$uid)
        ->where('status',1)
        ->get();
        $frequest=json_decode(json_encode($request), true);
        // dd($frequest);
        
        $req->session()->regenerate();
        $req->session()->put('freqnum',count($frequest));
        $dp=array();
        for($i=0;$i<count($frequest);$i++){
            // dd($frequest[$i]['from']);
            $infos = DB::table('information')
            ->where('userid', $frequest[$i]['from'])
            ->get();
            $inarray=json_decode(json_encode($infos), true);
            // dd($inarray[0]['name']);
            $req->session()->regenerate();
            $req->session()->put('name'.$i,$inarray[0]['name']);
            $req->session()->regenerate();
            $req->session()->put('idsender'.$i,$frequest[$i]['from']);
            $req->session()->regenerate();
            $req->session()->put($i,$inarray[0]['dp']);
        }
        // dd(session()->get('idsender1'));
        // dd($dp);
        // dd($poststable);
        return view('myaccount', ['members' => $getit[0]],['posts'=>$poststable],['senders'=>$frequest],['dp'=>$dp]);
    }
    public function uploadp(Request $req)
    {

        $uid = session()->get('id');
        if ($req->file('file')) {

            $file = $req->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $location = public_path('/uploads');
            $re = $file->move($location, $filename);
            DB::table('information')
                ->where('userid', $uid)
                ->update(array('dp' => $filename));

            return $filename;
        }
    }
    public function uploacp(Request $req)
    {

        $uid = session()->get('id');
        // $info = new Information;
        if ($req->file('file')) {

            $file = $req->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $location = public_path('/uploads/cp');
            $re = $file->move($location, $filename);
            DB::table('information')
                ->where('userid', $uid)
                ->update(array('cp' => $filename));

            return $filename;
        }
    }
    public function senddata(Request $req)
    {
        
        if ($req->ajax()) {
            $uid = session()->get('id');
            $data = stripslashes(file_get_contents("php://input"));
            $mydata = json_decode($data, true);
            $value = $mydata['value'];
            DB::table('information')
                ->where('userid', $uid)
                ->update(array('ed' => $value));
            return $value;
        }
    }
    public function preview(Request $req)
    {
        if ($req->file('file')) {

            $file = $req->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            // $location = public_path('/uploads/posts');
            // $re = $file->move($location, $filename);
            return $filename;
        }
    }
    public function postit(Request $req)
    {
        $uid = session()->get('id');
        if ($req->ajax()) {;
            $file = $req->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $caption = $req->post('nocap');
            $datab = new post;
            $datab->userid = $uid;
            $datab->picture = $filename;
            $datab->caption = $caption;
            $datab->save();
            $location = public_path('/uploads/posts');
            $re = $file->move($location, $filename);
            return $filename;
        }
    }
    public function notpostit(Request $req)
    {
        if ($req->ajax()) {
            $data = stripslashes(file_get_contents("php://input"));
            $mydata = json_decode($data, true);
            $dir="uploads/posts";
            $file=$mydata['todel'];
            unlink($dir.'/'.$file);
            return $file;
        }
    }
    public function search(Request $req){
        if ($req->ajax()){
            $user=User::where('name', $_POST["keyword"])
            ->orWhere('name', 'like', '%' . $_POST["keyword"] . '%')->get();
            // dd($user);
            return $user;
            

            
        }
    }
    public function sendrequest(Request $req){
        if ($req->ajax()) {
            $data = stripslashes(file_get_contents("php://input"));
            $mydata = json_decode($data, true);
            $sending_id=$mydata['senderid'];
            $receiving_id=$mydata['receiverid'];
            $sending_name=$mydata['sendername'];
            $receiving_name=$mydata['receivername'];
            $datab= new friendrequest;
            $datab->nameofsender=$sending_name;
            $datab->nameofreceiver=$receiving_name;
            $datab->from=$sending_id;
            $datab->to=$receiving_id;
            $datab->status=1;
            $datab->save();
            return 'Request Sent';
        }
    }
    public function notifyrequest(Request $req){
        $uid = session()->get('id');

    }
}
