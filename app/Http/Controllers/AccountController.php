<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Information;
use App\Models\post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\School;

use function GuzzleHttp\json_encode;

class AccountController extends Controller
{
    //
    public function myaccount()
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
        return view('myaccount', ['members' => $getit[0]]);
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
}
