<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Information;
use App\Models\User;
use App\Models\post;
use App\Models\Comment;
use App\Models\reply;
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
    $posts = DB::table('posts')
      ->where('userid', $uid)
      ->get();
    $poststable = json_decode(json_encode($posts), true);
    $request = DB::table('friendrequests')
      ->where('to', $uid)
      ->where('status', 1)
      ->get();
    $frequest = json_decode(json_encode($request), true);
    // dd($frequest);
    $req->session()->regenerate();
    $req->session()->put('freqnum', count($frequest));
    $unseen_request = DB::table('friendrequests')
      ->where('to', $uid)
      ->where('status', 1)
      ->where('viewstatus', 0)
      ->get();
    $unseen_array = json_decode(json_encode($unseen_request), true);
    $req->session()->regenerate();
    $req->session()->put('unseen', count($unseen_array));
    $dp = array();
    for ($i = 0; $i < count($frequest); $i++) {
      // dd($frequest[$i]['from']);
      $infos = DB::table('information')
        ->where('userid', $frequest[$i]['from'])
        ->get();
      $inarray = json_decode(json_encode($infos), true);
      // dd($inarray[0]['name']);
      $req->session()->regenerate();
      $req->session()->put('name' . $i, $inarray[0]['name']);
      $req->session()->regenerate();
      $req->session()->put('idsender' . $i, $frequest[$i]['from']);
      $req->session()->regenerate();
      $req->session()->put($i, $inarray[0]['dp']);
    }
    // dd(session()->get('idsender1'));
    // dd($dp);
    // dd($poststable);
    return view('myaccount', ['members' => $getit[0]], ['posts' => $poststable], ['senders' => $frequest], ['dp' => $dp]);
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
      $dir = "uploads/posts";
      $file = $mydata['todel'];
      unlink($dir . '/' . $file);
      return $file;
    }
  }
  public function search(Request $req)
  {
    if ($req->ajax()) {
      $user = User::where('name', $_POST["keyword"])
        ->orWhere('name', 'like', '%' . $_POST["keyword"] . '%')->get();
      // dd($user);
      return $user;
    }
  }
  public function sendrequest(Request $req)
  {
    if ($req->ajax()) {
      $data = stripslashes(file_get_contents("php://input"));
      $mydata = json_decode($data, true);
      $sending_id = $mydata['senderid'];
      $receiving_id = $mydata['receiverid'];
      $sending_name = $mydata['sendername'];
      $receiving_name = $mydata['receivername'];
      $datab = new friendrequest;
      $datab->nameofsender = $sending_name;
      $datab->nameofreceiver = $receiving_name;
      $datab->from = $sending_id;
      $datab->to = $receiving_id;
      $datab->status = 1;
      $datab->save();
      return 'Request Sent';
    }
  }
  public function viewstatus(Request $req)
  {
    $uid = session()->get('id');
    if ($req->ajax()) {
      $data = stripslashes(file_get_contents("php://input"));
      $mydata = json_decode($data, true);
      $newstatus = $mydata['view'];
      DB::table('friendrequests')
        ->where('to', $uid)
        ->update(array('viewstatus' => $newstatus));
      return $newstatus;
    }
  }
  public function acceptrequest(Request $req)
  {
    $uid = session()->get('id');
    if ($req->ajax()) {
      $data = stripslashes(file_get_contents("php://input"));
      $mydata = json_decode($data, true);
      $target = $mydata['targetu'];
      DB::table('friendrequests')
        ->where('from', $target)
        ->where('to', $uid)
        ->update(array('status' => 2));
      return 'Now friends';
    }
  }
  public function deleterequest(Request $req)
  {
    $uid = session()->get('id');
    if ($req->ajax()) {
      $data = stripslashes(file_get_contents("php://input"));
      $mydata = json_decode($data, true);
      $target = $mydata['targetu'];
      friendrequest::where('from', $target)->where('to', $uid)->delete();
      return 'deleted';
    }
  }
  public function like(Request $req)
  {
    $uid = session()->get('id');
    if ($req->ajax()) {
      // return 1;
      $data = stripslashes(file_get_contents("php://input"));
      $mydata = json_decode($data, true);
      $postid = $mydata['post'];
      $posts = DB::table('posts')
        ->where('id', $postid)
        ->get();
      $postsarray = json_decode(json_encode($posts), true);
      // dd($postid);
      $num_of_likes = $postsarray[0]['likes'];
      // return $num_of_likes;
      // $peoplelikes = $postsarray[0]['likename'];
      $idlikes = $postsarray[0]['likeid'];
      $info = DB::table('information')
        ->where('userid', $uid)
        ->get();
      $infoarray = json_decode(json_encode($info), true);
      $name = $infoarray[0]['name'];
      $arrayid = explode(",", $idlikes);
      // return $arrayid;
      // $arrayname=explode(",",$peoplelikes);
      if (!in_array("$uid", $arrayid)) {
        $newidlikes = $idlikes . $uid . ',';
        $newnumlikes = $num_of_likes + 1;
        // $newnamelikes = $peoplelikes . $name . ',';
        DB::table('posts')
          ->where('id', $postid)
          ->update(array('likes' => $newnumlikes, 'likeid' => $newidlikes));
        return 1;
      } else {
        // $arrayuid=array("$uid");
        $newidlikes = str_replace($uid . ',', '', $idlikes);
        $newnumlikes = $num_of_likes - 1;
        DB::table('posts')
          ->where('id', $postid)
          ->update(array('likes' => $newnumlikes, 'likeid' => $newidlikes));
        $tocheckforcount = DB::table('posts')
          ->where('id', $postid)
          ->get();
        $count = json_decode(json_encode($tocheckforcount), true);
        if ($count[0]['likes'] == 0) {
          return 2;
        }
      }
    }
  }
  public function likelist(Request $req)
  {
    if ($req->ajax()) {
      $data = stripslashes(file_get_contents("php://input"));
      $mydata = json_decode($data, true);
      $id = $mydata['id'];
      $posts = DB::table('posts')
        ->where('id', $id)
        ->get();
      $postsarray = json_decode(json_encode($posts), true);
      $likeids = $postsarray[0]['likeid'];
      $likeidarray = explode(",", $likeids);
      $userarray = array();
      $i = 0;
      $html = "";
      foreach ($likeidarray as $ids) {
        if ($ids != "") {
          $user = DB::table('information')
            ->where('userid', $ids)
            ->get();
          $userj = json_decode(json_encode($user), true);
          if ($userj[0]['dp'] != null) {
            $html = $html . "<div class='row' id='" . strval($userj[0]['userid']) . "' style='margin-top:4px;'><div class='col-1' style='padding:0;'><img src='/uploads/" . $userj[0]['dp'] . "' alt='' style='max-width:40px; height:40px'></div><div class='col-5' style='padding:0;margin-top:10px;' >" . $userj[0]['name'] . "</div></div>";
          } else {
            $html = $html . "<div class='row' id='" . strval($userj[0]['userid']) . "' style='margin-top:4px;'><div class='col-1' style='padding:0;'><img src='/blank-profile-picture-973460_1280.png' alt='' style='max-width:40px; height:40px;'></div><div class='col-5' style='padding:0; margin-top:10px;'>" . $userj[0]['name'] . "</div></div>";
          }
          // return strval($userj[0]['userid']);
          // $name=
          // $html=$html."<div class='row' id='".(string)$userj[0]['uid']."'><div class='col-1' style='padding:0;'><img src='/uploads/".$userj[0]['dp']."' alt='' style='max-width:40px;'></div><div class='col-5' style='padding:0;'>".$userj[0]['name']."</div></div>";
          // $html=$html."<div class='row' id='".(string)$userj[0]['uid']."'><div class='col-1' style='padding:0;'><img src='/uploads/".$userj[0]['dp']."' alt='' style='max-width:40px;'></div><div class='col-5' style='padding:0;'>".$userj[0]['name']."</div></div>";
        }
      }
      return $html;
    }
  }
  public function comment(Request $req)
  {
    $uid = session()->get('id');
    if ($req->ajax()) {
      $data = stripslashes(file_get_contents("php://input"));
      $mydata = json_decode($data, true);
      $id = $mydata['id'];
      $comment = $mydata['material'];
      $datab = new Comment;
      $datab->postid = $id;
      $datab->comment = $comment;
      $datab->idcommentor = $uid;
      $datab->save();
      $info = DB::table('information')
        ->where('userid', $uid)
        ->get();
      $infoarray = json_decode(json_encode($info), true);
      if ($infoarray[0]['dp'] != null) {
        $html = "<div class='card itsacomment' style='width: 28rem;border-radius:20px; margin-top:3px;' id='" . $infoarray[0]['userid'] . "' postid='" . $id . "'>
            <div class='card-body' style='padding:5px;'>
              <div class='row'>
                <div class='col-2' style='padding-right: 0px; margin-right:0px; width:57px;'>
                  <img src='/uploads/" . $infoarray[0]['dp'] . "' id='postsdp' class='rounded-circle' style='height: 30px; width: 30px; object-fit:cover;margin-left: 10px;' alt=''>
                </div>
                <div class='col-8' style='padding-left: 0px; margin-left:0px;'>
                  <p style='font-size: 18px;'>" . $infoarray[0]['name'] . "</p>
                </div>
              </div>
              <div class='row' style='margin-left: 4px;margin-right: 4x;'>
                <div class='col-12' style='padding-left: 6px;'>
                  " . $comment . "
                </div>
              </div>
            </div>
            <div class='row'>
              <div class='col-2 likecomment' id='" . $datab->id . "' style='margin-left: 25px; margin-top:10px;padding-right:0px;'>
              <i class='fa-regular fa-thumbs-up'></i>
              </div>
              <div class='col-4 replycomment' id='" . $datab->id . "' style='margin-top: 10px;padding-left: 0px;'>
                Reply
              </div>
            </div>
          </div>
        </div>";
      } else {
        $html = "<div class='card itsacomment' style='width: 28rem;border-radius:20px; margin-top:3px;' id='" . $infoarray[0]['userid'] . "'>
                <div class='card-body' style='padding:5px;'>
                  <div class='row'>
                    <div class='col-2' style='padding-right: 0px; margin-right:0px; width:57px;'>
                      <img src='/blank-profile-picture-973460_1280.png' id='postsdp' class='rounded-circle' style='height: 30px; width: 30px; object-fit:cover;margin-left: 10px;' alt=''>
                    </div>
                    <div class='col-8' style='padding-left: 0px; margin-left:0px;'>
                      <p style='font-size: 18px;'>" . $infoarray[0]['name'] . "</p>
                    </div>
                  </div>
                  <div class='row' style='margin-left: 4px;margin-right: 4x;'>
                    <div class='col-12' style='padding-left: 6px;'>
                      " . $comment . "
                    </div>
                  </div>
                </div>
                <div class='row'>
                  <div class='col-2 likecomment' id='" . $datab->id . "' style='margin-left: 25px; margin-top:10px;padding-right:0px;'>
                  <i class='fa-regular fa-thumbs-up'></i>
                  </div>
                  <div class='col-4 replycomment' id='" . $datab->id . "' style='margin-top: 10px;padding-left: 0px;'>
                    Reply
                  </div>
                </div>
              </div>
            </div>";
      }
      return $html;
    }
  }
  public function viewcomments(Request $req)
  {
    $uid = session()->get('id');
    if ($req->ajax()) {
      $data = stripslashes(file_get_contents("php://input"));
      $mydata = json_decode($data, true);
      $id = $mydata['id'];
      $comment = DB::table('comments')
        ->where('postid', $id)
        ->get();
      // return $id;
      $commentarray = json_decode(json_encode($comment), true);
      $html = '';
      $no_of_comments = count($commentarray);
      for ($i = 0; $i < $no_of_comments; $i++) {

        $posts = DB::table('posts')
          ->where('id', $commentarray[$i]['postid'])
          ->get();
        $postsarray = json_decode(json_encode($posts), true);
        $info = DB::table('information')
          ->where('userid', $commentarray[$i]['idcommentor'])
          ->get();

        $infoarray = json_decode(json_encode($info), true);
        if ($commentarray[$i]['likes'] == 0) {
          if ($infoarray[0]['dp'] != null) {
            $nlikes = $commentarray[$i]['likes'] > 0 ? strval($commentarray[$i]['likes']) : "";
            $html = $html . "
            <div class='modal fade replytocomment'  id='reply_" . $commentarray[$i]['id'] . "' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h5 class='modal-title' id='exampleModalLabel'>Modal title</h5>
                  <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class='modal-body'>
                  ...
                </div>
                <div class='modal-footer'>
                  <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                  <button type='button' class='btn btn-primary'>Save changes</button>
                </div>
              </div>
            </div>
          </div>
            <div class='card itsacomment' style='width: 28rem;border-radius:20px; margin-top:3px;' id='" . $infoarray[0]['userid'] . "' postid='" . $id . "'>
            <div class='card-body' style='padding:5px;'>
              <div class='row'>
                <div class='col-2' style='padding-right: 0px; margin-right:0px; width:57px;'>
                  <img src='/uploads/" . $infoarray[0]['dp'] . "' id='postsdp' class='rounded-circle' style='height: 30px; width: 30px; object-fit:cover;margin-left: 10px;' alt=''>
                </div>
                <div class='col-8' style='padding-left: 0px; margin-left:0px;'>
                  <p style='font-size: 18px;'>" . $infoarray[0]['name'] . "</p>
                </div>
              </div>
              <div class='row' style='margin-left: 4px;margin-right: 4x;'>
                <div class='col-12' style='padding-left: 6px;'>
                  " . $commentarray[$i]['comment'] . "
                </div>
              </div>
            </div>
            <div class='row'>
              <div class='col-2 likecomment' id='" . $commentarray[$i]['id'] . "' style='margin-left: 25px; margin-top:10px;padding-right:0px;display:inline-block;'>
              <i class='fa-regular fa-thumbs-up'></i> <div class='clikes' style='display:inline-block;' nolikes='$nlikes'>" . $nlikes . "</div>
              </div>
              <div class='col-4 replycomment' id='" . $commentarray[$i]['id'] . "' style='margin-top: 10px;padding-left: 0px;'>
                Reply
              </div>
            </div>
          </div>
        </div>";
          } else {
            $nlikes = $commentarray[$i]['likes'] > 0 ? strval($commentarray[$i]['likes']) : "";
            $html = $html . "                  <div class='modal fade replytocomment'  id='reply_" . $commentarray[$i]['id'] . "' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h5 class='modal-title' id='exampleModalLabel'>Modal title</h5>
                  <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class='modal-body'>
                  ...
                </div>
                <div class='modal-footer'>
                  <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                  <button type='button' class='btn btn-primary'>Save changes</button>
                </div>
              </div>
            </div>
          </div>
            <div class='card itsacomment' style='width: 28rem;border-radius:20px; margin-top:3px;' id='" . $infoarray[0]['userid'] . "'>
                <div class='card-body' style='padding:5px;'>
                  <div class='row'>
                    <div class='col-2' style='padding-right: 0px; margin-right:0px; width:57px;'>
                      <img src='/blank-profile-picture-973460_1280.png' id='postsdp' class='rounded-circle' style='height: 30px; width: 30px; object-fit:cover;margin-left: 10px;' alt=''>
                    </div>
                    <div class='col-8' style='padding-left: 0px; margin-left:0px;'>
                      <p style='font-size: 18px;'>" . $infoarray[0]['name'] . "</p>
                    </div>
                  </div>
                  <div class='row' style='margin-left: 4px;margin-right: 4x;'>
                    <div class='col-12' style='padding-left: 6px;'>
                      " . $commentarray[$i]['comment'] . "
                    </div>
                  </div>
                </div>
                <div class='row'>
                  <div class='col-2 likecomment' id='" . $commentarray[$i]['id'] . "' style='margin-left: 25px; margin-top:10px;padding-right:0px;display:inline-block;'>
                  <i class='fa-regular fa-thumbs-up'></i> <div class='clikes' style='display:inline-block;' nolikes='$nlikes'>" . $nlikes . "</div>
                  </div>
                  <div class='col-4 replycomment' id='" . $commentarray[$i]['id'] . "' style='margin-top: 10px;padding-left: 0px;'>
                    Reply
                  </div>
                </div>
              </div>
            </div>";
          }
        } else {
          if ($infoarray[0]['dp'] != null) {
            $nlikes = $commentarray[$i]['likes'] > 0 ? strval($commentarray[$i]['likes']) : "";
            $html = $html . "
            <div class='modal fade replytocomment'  id='reply_" . $commentarray[$i]['id'] . "' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h5 class='modal-title' id='exampleModalLabel'>Modal title</h5>
                  <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class='modal-body'>
                  ...
                </div>
                <div class='modal-footer'>
                  <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                  <button type='button' class='btn btn-primary'>Save changes</button>
                </div>
              </div>
            </div>
          </div>
            <div class='card itsacomment' style='width: 28rem;border-radius:20px; margin-top:3px;' id='" . $infoarray[0]['userid'] . "' postid='" . $id . "'>
            <div class='card-body' style='padding:5px;'>
              <div class='row'>
                <div class='col-2' style='padding-right: 0px; margin-right:0px; width:57px;'>
                  <img src='/uploads/" . $infoarray[0]['dp'] . "' id='postsdp' class='rounded-circle' style='height: 30px; width: 30px; object-fit:cover;margin-left: 10px;' alt=''>
                </div>
                <div class='col-8' style='padding-left: 0px; margin-left:0px;'>
                  <p style='font-size: 18px;'>" . $infoarray[0]['name'] . "</p>
                </div>
              </div>
              <div class='row' style='margin-left: 4px;margin-right: 4x;'>
                <div class='col-12' style='padding-left: 6px;'>
                  " . $commentarray[$i]['comment'] . "
                </div>
              </div>
            </div>
            <div class='row'>
              <div class='col-2 likecomment' id='" . $commentarray[$i]['id'] . "' style='margin-left: 25px; margin-top:10px;padding-right:0px;display:inline-block;'>
              <i class='fa-solid fa-thumbs-up'></i> <div class='clikes' style='display:inline-block;' nolikes='$nlikes'>" . $nlikes . "</div>
              </div>
              <div class='col-4 replycomment' id='" . $commentarray[$i]['id'] . "' style='margin-top: 10px;padding-left: 0px;'>
                Reply
              </div>
            </div>
          </div>
        </div>";
          } else {
            $nlikes = $commentarray[$i]['likes'] > 0 ? strval($commentarray[$i]['likes']) : "";
            $html = $html . "                  <div class='modal fade replytocomment'  id='reply_" . $commentarray[$i]['id'] . "' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h5 class='modal-title' id='exampleModalLabel'>Modal title</h5>
                  <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class='modal-body'>
                  ...
                </div>
                <div class='modal-footer'>
                  <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                  <button type='button' class='btn btn-primary'>Save changes</button>
                </div>
              </div>
            </div>
          </div>
            <div class='card itsacomment' style='width: 28rem;border-radius:20px; margin-top:3px;' id='" . $infoarray[0]['userid'] . "'>
                <div class='card-body' style='padding:5px;'>
                  <div class='row'>
                    <div class='col-2' style='padding-right: 0px; margin-right:0px; width:57px;'>
                      <img src='/blank-profile-picture-973460_1280.png' id='postsdp' class='rounded-circle' style='height: 30px; width: 30px; object-fit:cover;margin-left: 10px;' alt=''>
                    </div>
                    <div class='col-8' style='padding-left: 0px; margin-left:0px;'>
                      <p style='font-size: 18px;'>" . $infoarray[0]['name'] . "</p>
                    </div>
                  </div>
                  <div class='row' style='margin-left: 4px;margin-right: 4x;'>
                    <div class='col-12' style='padding-left: 6px;'>
                      " . $commentarray[$i]['comment'] . "
                    </div>
                  </div>
                </div>
                <div class='row'>
                  <div class='col-2 likecomment' id='" . $commentarray[$i]['id'] . "' style='margin-left: 25px; margin-top:10px;padding-right:0px;display:inline-block;' >
                  <i class='fa-solid fa-thumbs-up'> </i> <div style='display:inline-block;'>" . $nlikes . "</div>
                  </div>
                  <div class='col-4 replycomment' id='" . $commentarray[$i]['id'] . "' style='margin-top: 10px;padding-left: 0px;'>
                    Reply
                  </div>
                </div>
              </div>
            </div>";
          }
        }
      }
      return $html;
    }
  }
  public function likecomment(Request $req)
  {
    $uid = session()->get('id');
    if ($req->ajax()) {
      // return 1;
      $data = stripslashes(file_get_contents("php://input"));
      $mydata = json_decode($data, true);
      $commentid = $mydata['id'];
      $comments = DB::table('comments')
        ->where('id', $commentid)
        ->get();
      $commentsarray = json_decode(json_encode($comments), true);
      // dd($postid);
      $num_of_likes = $commentsarray[0]['likes'];
      // return $num_of_likes;
      // $peoplelikes = $postsarray[0]['likename'];
      $idlikes = $commentsarray[0]['likeid'];
      $info = DB::table('information')
        ->where('userid', $uid)
        ->get();
      $infoarray = json_decode(json_encode($info), true);
      $name = $infoarray[0]['name'];
      $arrayid = explode(",", $idlikes);
      // return $arrayid;
      // $arrayname=explode(",",$peoplelikes);
      if (!in_array("$uid", $arrayid)) {
        $newidlikes = $idlikes . $uid . ',';
        $newnumlikes = $num_of_likes + 1;
        // $newnamelikes = $peoplelikes . $name . ',';
        DB::table('comments')
          ->where('id', $commentid)
          ->update(array('likes' => $newnumlikes, 'likeid' => $newidlikes));

        return 1;
      } else {
        // $arrayuid=array("$uid");
        $newidlikes = str_replace($uid . ',', '', $idlikes);
        $newnumlikes = $num_of_likes - 1;
        DB::table('comments')
          ->where('id', $commentid)
          ->update(array('likes' => $newnumlikes, 'likeid' => $newidlikes));
        $tocheckforcount = DB::table('comments')
          ->where('id', $commentid)
          ->get();
        $count = json_decode(json_encode($tocheckforcount), true);
        if ($count[0]['likes'] == 0) {
          return 2;
        }
      }
    }
  }
  public function replycomment(Request $req)
  {
    $uid = session()->get('id');
    if ($req->ajax()) {
      $data = stripslashes(file_get_contents("php://input"));
      $mydata = json_decode($data, true);
      $comid = $mydata['cid'];
      $reply = $mydata['r'];
      // return $reply;
      $replyo = new reply;
      $replyo->commentid = $comid;
      $replyo->replies = $reply;
      $replyo->replierid = $uid;
      $replyo->save();
      $info = DB::table('information')
        ->where('userid', $uid)
        ->get();
      $infoarray = json_decode(json_encode($info), true);
      $html = "<div class='card itsareply' style='width: 28rem;border-radius:20px; margin-top:3px;' id='" . $infoarray[0]['userid'] . "'>
      <div class='card-body' style='padding:5px;'>
        <div class='row'>
          <div class='col-2' style='padding-right: 0px; margin-right:0px; width:57px;'>
            <img src='/blank-profile-picture-973460_1280.png' id='postsdp' class='rounded-circle' style='height: 30px; width: 30px; object-fit:cover;margin-left: 10px;' alt=''>
          </div>
          <div class='col-8' style='padding-left: 0px; margin-left:0px;'>
            <p style='font-size: 18px;'>" . $infoarray[0]['name'] . "</p>
          </div>
        </div>
        <div class='row' style='margin-left: 4px;margin-right: 4x;'>
          <div class='col-12' style='padding-left: 6px;'>
            " . $reply . "
          </div>
        </div>
      </div>
      <div class='row'>
        <div class='col-2 likereply' id='" . $replyo->id . "' style='margin-left: 25px; margin-top:10px;padding-right:0px;' >
        <i class='fa-solid fa-thumbs-up'> </i>
        </div>
        <div class='col-4 replyr' id='" . $replyo->id . "' style='margin-top: 10px;padding-left: 0px;'>
          Reply
        </div>
      </div>
    </div>
  </div>";
      return $html;
    }
  }
  public function viewreplies(Request $req)
  {
    if ($req->ajax()) {
      // return 1;
      $data = stripslashes(file_get_contents("php://input"));
      $mydata = json_decode($data, true);
      $commentid = $mydata['cmid'];
      $replies = DB::table('replies')
        ->where('commentid', $commentid)
        ->get();
      $replyarray = json_decode(json_encode($replies), true);
      $html = '';
      $no_of_replies = count($replyarray);
      for ($i = 0; $i < $no_of_replies; $i++) {
        $info = DB::table('information')
          ->where('userid', $replyarray[$i]['replierid'])
          ->get();
        $infoarray = json_decode(json_encode($info), true);
        if ($replyarray[$i]['likes'] == 0) {
          if ($infoarray[0]['dp'] != null) {
            $nlikes = $replyarray[$i]['likes'] > 0 ? strval($replyarray[$i]['likes']) : "";
            $html = $html . "
            <div class='modal fade replytoreply'  id='reply_" . $replyarray[$i]['id'] . "' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h5 class='modal-title' id='exampleModalLabel'>Modal title</h5>
                  <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class='modal-body'>
                  ...
                </div>
                <div class='modal-footer'>
                  <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                  <button type='button' class='btn btn-primary'>Save changes</button>
                </div>
              </div>
            </div>
          </div>
            <div class='card itsareply' style='width: 28rem;border-radius:20px; margin-top:3px;' id='" . $infoarray[0]['userid'] . "' commenttid='" . $commentid . "'>
            <div class='card-body' style='padding:5px;'>
              <div class='row'>
                <div class='col-2' style='padding-right: 0px; margin-right:0px; width:57px;'>
                  <img src='/uploads/" . $infoarray[0]['dp'] . "' id='postsdp' class='rounded-circle' style='height: 30px; width: 30px; object-fit:cover;margin-left: 10px;' alt=''>
                </div>
                <div class='col-8' style='padding-left: 0px; margin-left:0px;'>
                  <p style='font-size: 18px;'>" . $infoarray[0]['name'] . "</p>
                </div>
              </div>
              <div class='row' style='margin-left: 4px;margin-right: 4x;'>
                <div class='col-12' style='padding-left: 6px;'>
                  " . $replyarray[$i]['replies'] . "
                </div>
              </div>
            </div>
            <div class='row'>
              <div class='col-2 likereply' id='" . $replyarray[$i]['id'] . "' style='margin-left: 25px; margin-top:10px;padding-right:0px;display:inline-block;'>
              <i class='fa-regular fa-thumbs-up'></i> <div class='rlikes' style='display:inline-block;' norlikes='$nlikes'>" . $nlikes . "</div>
              </div>
              <div class='col-4 replyreply' id='" . $replyarray[$i]['id'] . "' style='margin-top: 10px;padding-left: 0px;'>
                Reply
              </div>
            </div>
          </div>
        </div>";
          } else {
            $nlikes = $replyarray[$i]['likes'] > 0 ? strval($replyarray[$i]['likes']) : "";
            $html = $html . "                  <div class='modal fade replytoreply'  id='reply_" . $replyarray[$i]['id'] . "' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h5 class='modal-title' id='exampleModalLabel'>Modal title</h5>
                  <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class='modal-body'>
                  ...
                </div>
                <div class='modal-footer'>
                  <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                  <button type='button' class='btn btn-primary'>Save changes</button>
                </div>
              </div>
            </div>
          </div>
            <div class='card itsareply' style='width: 28rem;border-radius:20px; margin-top:3px;' id='" . $infoarray[0]['userid'] . "'>
                <div class='card-body' style='padding:5px;'>
                  <div class='row'>
                    <div class='col-2' style='padding-right: 0px; margin-right:0px; width:57px;'>
                      <img src='/blank-profile-picture-973460_1280.png' id='postsdp' class='rounded-circle' style='height: 30px; width: 30px; object-fit:cover;margin-left: 10px;' alt=''>
                    </div>
                    <div class='col-8' style='padding-left: 0px; margin-left:0px;'>
                      <p style='font-size: 18px;'>" . $infoarray[0]['name'] . "</p>
                    </div>
                  </div>
                  <div class='row' style='margin-left: 4px;margin-right: 4x;'>
                    <div class='col-12' style='padding-left: 6px;'>
                      " . $replyarray[$i]['replies'] . "
                    </div>
                  </div>
                </div>
                <div class='row'>
                  <div class='col-2 likereply' id='" . $replyarray[$i]['id'] . "' style='margin-left: 25px; margin-top:10px;padding-right:0px;display:inline-block;'>
                  <i class='fa-regular fa-thumbs-up'></i> <div class='rlikes' style='display:inline-block;' norlikes='$nlikes'>" . $nlikes . "</div>
                  </div>
                  <div class='col-4 replyreply' id='" . $replyarray[$i]['id'] . "' style='margin-top: 10px;padding-left: 0px;'>
                    Reply
                  </div>
                </div>
              </div>
            </div>";
          }
        } else {
          if ($infoarray[0]['dp'] != null) {
            $nlikes = $replyarray[$i]['likes'] > 0 ? strval($replyarray[$i]['likes']) : "";
            $html = $html . "
            <div class='modal fade replytoreply'  id='reply_" . $replyarray[$i]['id'] . "' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h5 class='modal-title' id='exampleModalLabel'>Modal title</h5>
                  <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class='modal-body'>
                  ...
                </div>
                <div class='modal-footer'>
                  <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                  <button type='button' class='btn btn-primary'>Save changes</button>
                </div>
              </div>
            </div>
          </div>
            <div class='card itsareply' style='width: 28rem;border-radius:20px; margin-top:3px;' id='" . $infoarray[0]['userid'] . "' postid='" . $commentid . "'>
            <div class='card-body' style='padding:5px;'>
              <div class='row'>
                <div class='col-2' style='padding-right: 0px; margin-right:0px; width:57px;'>
                  <img src='/uploads/" . $infoarray[0]['dp'] . "' id='postsdp' class='rounded-circle' style='height: 30px; width: 30px; object-fit:cover;margin-left: 10px;' alt=''>
                </div>
                <div class='col-8' style='padding-left: 0px; margin-left:0px;'>
                  <p style='font-size: 18px;'>" . $infoarray[0]['name'] . "</p>
                </div>
              </div>
              <div class='row' style='margin-left: 4px;margin-right: 4x;'>
                <div class='col-12' style='padding-left: 6px;'>
                  " . $replyarray[$i]['replies'] . "
                </div>
              </div>
            </div>
            <div class='row'>
              <div class='col-2 likereply' id='" . $replyarray[$i]['id'] . "' style='margin-left: 25px; margin-top:10px;padding-right:0px;display:inline-block;'>
              <i class='fa-solid fa-thumbs-up'></i> <div class='rlikes' style='display:inline-block;' norlikes='$nlikes'>" . $nlikes . "</div>
              </div>
              <div class='col-4 replyreply' id='" . $replyarray[$i]['id'] . "' style='margin-top: 10px;padding-left: 0px;'>
                Reply
              </div>
            </div>
          </div>
        </div>";
          } else {
            $nlikes = $replyarray[$i]['likes'] > 0 ? strval($replyarray[$i]['likes']) : "";
            $html = $html . "                  <div class='modal fade replytoreply'  id='reply_" . $replyarray[$i]['id'] . "' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h5 class='modal-title' id='exampleModalLabel'>Modal title</h5>
                  <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class='modal-body'>
                  ...
                </div>
                <div class='modal-footer'>
                  <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                  <button type='button' class='btn btn-primary'>Save changes</button>
                </div>
              </div>
            </div>
          </div>
            <div class='card itsareply' style='width: 28rem;border-radius:20px; margin-top:3px;' id='" . $infoarray[0]['userid'] . "'>
                <div class='card-body' style='padding:5px;'>
                  <div class='row'>
                    <div class='col-2' style='padding-right: 0px; margin-right:0px; width:57px;'>
                      <img src='/blank-profile-picture-973460_1280.png' id='postsdp' class='rounded-circle' style='height: 30px; width: 30px; object-fit:cover;margin-left: 10px;' alt=''>
                    </div>
                    <div class='col-8' style='padding-left: 0px; margin-left:0px;'>
                      <p style='font-size: 18px;'>" . $infoarray[0]['name'] . "</p>
                    </div>
                  </div>
                  <div class='row' style='margin-left: 4px;margin-right: 4x;'>
                    <div class='col-12' style='padding-left: 6px;'>
                      " . $replyarray[$i]['replies'] . "
                    </div>
                  </div>
                </div>
                <div class='row'>
                  <div class='col-2 likereply' id='" . $replyarray[$i]['id'] . "' style='margin-left: 25px; margin-top:10px;padding-right:0px;display:inline-block;' >
                  <i class='fa-solid fa-thumbs-up'> </i> <div class='rlikes' style='display:inline-block;' norlikes='$nlikes' >" . $nlikes . "</div>
                  </div>
                  <div class='col-4 replyreply' id='" . $replyarray[$i]['id'] . "' style='margin-top: 10px;padding-left: 0px;'>
                    Reply
                  </div>
                </div>
              </div>
            </div>";
          }
        }
      }
      return $html;
    }
  }
  public function likereply(Request $req)
  {
    $uid = session()->get('id');
    if ($req->ajax()) {
      // return 1;
      $data = stripslashes(file_get_contents("php://input"));
      $mydata = json_decode($data, true);
      $commentid = $mydata['id'];
      $comments = DB::table('replies')
        ->where('id', $commentid)
        ->get();
      $commentsarray = json_decode(json_encode($comments), true);
      // dd($postid);
      $num_of_likes = $commentsarray[0]['likes'];
      // return $num_of_likes;
      // $peoplelikes = $postsarray[0]['likename'];
      $idlikes = $commentsarray[0]['likeid'];
      $info = DB::table('information')
        ->where('userid', $uid)
        ->get();
      $infoarray = json_decode(json_encode($info), true);
      $name = $infoarray[0]['name'];
      $arrayid = explode(",", $idlikes);
      // return $arrayid;
      // $arrayname=explode(",",$peoplelikes);
      if (!in_array("$uid", $arrayid)) {
        $newidlikes = $idlikes . $uid . ',';
        $newnumlikes = $num_of_likes + 1;
        // $newnamelikes = $peoplelikes . $name . ',';
        DB::table('replies')
          ->where('id', $commentid)
          ->update(array('likes' => $newnumlikes, 'likeid' => $newidlikes));

        return 1;
      } else {
        // $arrayuid=array("$uid");
        $newidlikes = str_replace($uid . ',', '', $idlikes);
        $newnumlikes = $num_of_likes - 1;
        DB::table('replies')
          ->where('id', $commentid)
          ->update(array('likes' => $newnumlikes, 'likeid' => $newidlikes));
        $tocheckforcount = DB::table('replies')
          ->where('id', $commentid)
          ->get();
        $count = json_decode(json_encode($tocheckforcount), true);
        if ($count[0]['likes'] == 0) {
          return 2;
        }
      }
    }
  }
  public function viewfriendlist(Request $req)
  {
    $uid = session()->get('id');
    if ($req->ajax()) {
      $data = stripslashes(file_get_contents("php://input"));
      $mydata = json_decode($data, true);
      $user = $mydata['uid'];
      $html = '';
      $friends = DB::table('friendrequests')
        ->where('to', $uid)
        ->orWhere('from', $uid)
        ->where('status', '2')
        ->get();
      // return $friends;
      foreach ($friends as $friend) {
        // return $friend;
        $friendarray = json_decode(json_encode($friend), true);
        // dd($friendarray);
        // return $friendarray;
        // return $friendarray['to'];
        if ($friendarray['from'] != $uid) {
          $info = DB::table('information')
            ->where('userid', $friendarray['from'])
            ->get();
          // return 1;
        } else {
          $info = DB::table('information')
            ->where('userid', $friendarray['to'])
            ->get();
        }
        $infoarray = json_decode(json_encode($info), true);
        // return $infoarray[0]['dp'];
        // dd($infoarray);
        if ($infoarray[0]['dp'] != '') {
          // return $infoarray[0]['dp'];
          $html = $html . " <div class='row' style='margin-top:4px;' id='row_" . $infoarray[0]['userid'] . "'> <div class='col-1' style='padding:0;'> <img src='/uploads/" . $infoarray[0]['dp'] . "' alt='' style='max-width:40px; height:40px'> </div><div class='col-5' style='padding:0;margin-top:10px;'> " . $infoarray[0]['name'] . "</div><div class='col-2' style='margin-left:129px;'> <button type='button' class='btn btn-light unfriend' id='" . $infoarray[0]['userid'] . "'>Unfriend</button> </div></div>";
        } else {
          $html = $html . " <div class='row' style='margin-top:4px;' id='row_" . $infoarray[0]['userid'] . "'> <div class='col-1' style='padding:0;'> <img src='/blank-profile-picture-973460_1280.png' alt='' style='max-width:40px; height:40px'> </div><div class='col-5' style='padding:0;margin-top:10px;'> " . $infoarray[0]['name'] . " </div><div class='col-2' style='margin-left:129px;'> <button type='button' class='btn btn-light unfriend' id='" . $infoarray[0]['userid'] . "'>Unfriend</button> </div></div>";
        }
      }
      return $html;
    }
  }
  public function unfriend(Request $req)
  {
    $uid = session()->get('id');
    if ($req->ajax()) {
      $data = stripslashes(file_get_contents("php://input"));
      $mydata = json_decode($data, true);
      $rid = $mydata['id'];
      $friends = DB::table('friendrequests')
        ->where('to', $uid)
        ->orWhere('from', $rid)
        ->where('status', '2')
        ->get();
      if (empty($friends)) {
        DB::table('friendrequests')
          ->where('to', $rid)
          ->Where('from', $uid)
          ->where('status', '2')
          ->delete();
          return "deleted";
      } else {
        DB::table('friendrequests')
          ->where('to', $uid)
          ->Where('from', $rid)
          ->where('status', '2')
          ->delete();
          return "deleted";
      }
      // $friends->delete();
    }
  }
}
