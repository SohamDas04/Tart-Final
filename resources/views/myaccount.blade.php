<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <link href="http://hayageek.github.io/jQuery-Upload-File/4.0.11/uploadfile.css" rel="stylesheet">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script src="http://hayageek.github.io/jQuery-Upload-File/4.0.11/jquery.uploadfile.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="https://unpkg.com/@popperjs/core@2"> -->
  <!-- <link rel="stylesheet" href="/font-awesome-4.7.0/css/font-awesome.min.css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <!-- <script src="/JS/jQuery.js"></script> -->
  <!-- <script src="/JS/bootstrap.js"></script> -->
  <!-- <script src="/JS/popper.js"></script> -->
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>

  <style>
    .main {
      display: block;
      position: relative;
      width: 100%;
      height: 100%;
      margin: 0 auto;
    }

    img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .cover {
      display: block;
      position: relative;
      height: 437px;
      overflow: hidden;
      z-index: 1;
      border-radius: 40px;
    }

    .text-block {
      position: absolute;
      bottom: 20px;
      right: 40px;
      color: white;
      padding-left: 0px;
      padding-right: 0px;
      font-size: 25px;
    }

    .text-block-dp {
      position: absolute;
      bottom: 20px;
      right: 40px;
      color: white;
      padding-left: 0px;
      padding-right: 0px;
      font-size: 25px;
    }

    .cover img {
      max-width: 100%;
      z-index: 1;
    }

    .profile {
      display: block;
      position: relative;
      /* border: solid 10px; */
      /* border-radius: 1000px; */
      /* border-width: 15px; */
      width: 250px;
      height: 250px;
      margin: -140px 0 10px 20px;
      z-index: 999;
    }

    .re-profile {
      display: none;
      position: relative;
      /* border: solid 10px; */
      /* border-radius: 1000px; */
      /* border-width: 15px; */
      width: 250px;
      height: 250px;
      margin: -140px 0 10px 20px;
      z-index: 999;
    }

    .profile img {
      width: 100%;
      z-index: 999;
      height: 100%;
    }

    /* .top-0 {
    top: 6px;
    } */
    .top-0 {
      top: 9px !important;
    }

    .start-100 {
      left: 74% !important;
    }
  </style>

</head>

<body style="background-color:ghostwhite;">
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="display: none;">
    Launch demo modal
  </button>

  <!-- Modal -->
  <div class="modal fade" id="friendlist_{{$members['userid']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Friends</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body flist_{{$members['userid']}}">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  <span style="display: none;">
    <form action="/uploadp">@csrf<input type="file" name="dpupload" class="uploadp" id="test"></form>
  </span>
  <span style="display: none;">
    <form action="/uploacp">@csrf<input type="file" name="cpupload" class="uploacp" id="testc"></form>
  </span>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item" style="padding: 0px;">
            <a class="nav-link active" aria-current="page" href="/dashboard">Feed</a>
          </li>
          <li class="nav-item dropdown showflist">
            <!-- <class="nav-link" href="#" id="navbarDropdown" > -->
            <a button type="button" class="btn btn-dark position-relative dropdown-toggle " data-bs-toggle="dropdown" aria-expanded="false" style="border-top-width: 68.111;margin-top: 2px;">
              <i class=" fa-solid fa-user-group"></i>
              @if(session()->get('unseen')>0)
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-light tohide" style="color:black;">
                {{session()->get('unseen')}}+
              </span>

              <!-- <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark">
                1
              </span> -->
              @endif
              </button>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="width:400px;">
              @for($i=0;$i< session()->get('freqnum');$i++)
                <div class="row">
                  <div class="col-2" style="padding-right: 0px;">
                    @if(session()->get($i)!=null)
                    <img src="/uploads/{{session()->get($i)}}" class="rounded-circle" alt="" style="height:40px; width: 40px; margin-left:8px;">
                    @else
                    <img src="/360_F_346839683_6nAPzbhpSkIpb8pmAwufkC7c5eD7wYws.jpg" class="rounded-circle" alt="">
                    @endif
                  </div>
                  @if(session()->get($i)==null)
                  <div class="col-6" style="margin-left:10px;padding-left:0px; padding-right:0px;margin-top:17px;  height: 40px;">
                    <a href="" style="color: black;">{{session()->get('name'.$i)}}</a>
                  </div>
                  @else
                  <div class="col-6" style="margin-left:10px;padding-left:0px; padding-right:0px;margin-top:10px;  height: 40px;">
                    <a href="" style="color: black;">{{session()->get('name'.$i)}}</a>
                  </div>
                  @endif
                  <div class="col-1">
                    <button type="button" class="btn btn-light acceptreq" style="padding-left: 0px;
                    padding-top: 0px;
                    border-bottom-width: 0px;
                    padding-right: 0px;
                    border-right-width: 0px;
                    border-top-width: 0px;
                    padding-bottom: 0px;
                    height: 40px;
                    width: 52.11111px;" id="{{session()->get('idsender'.$i)}}">Accept</button>
                  </div>
                  <div class="col-1">
                    <button type="button" class="btn btn-light deletereq" style="padding-left: 0px;
                    padding-top: 0px;
                    border-bottom-width: 0px;
                    padding-right: 0px;
                    border-right-width: 0px;
                    border-top-width: 0px;
                    padding-bottom: 0px;
                    margin-left:20px;
                    margin-right:4px;
                    height: 40px;
                    width: 52.11111px;" id="{{session()->get('idsender'.$i)}}">Delete</button>
                  </div>
                </div>
                @endfor
                <li>
                  <hr class="dropdown-divider">
                </li>
                @if(session()->get('freqnum')==0)
                <li><a class="dropdown-item" href="#">You have no friend request</a></li>
                @endif
            </ul>
          </li>
          <li class="nav-item" style="margin-left:60px;">
            <div class="frmsearch" style="margin-right:80px;">
              <form class="d-flex searchform" autocomplete="off">
          <li class="nav-item dropdown mt-0 pt-0">
            <div class="row mt-0 pt-0">
              <div class="col-10" style="margin-right:0px; padding-right:0px;">
                <input class="form-control me-2 dropdown-toggle stoggle" type="text" placeholder="Search" hideit="" id="search-box" aria-label="Search">
              </div>
              <div class="col-2" style="margin-left:0px; padding-left:2px;">
                <button class="btn btn-outline-light search " id="" type="button">Search</button>
              </div>
            </div>
            <ul class="dropdown-menu smenu" aria-labelledby="navbarDropdown">
              <div id="plist" class="plist"></div>
              <div id="divider"></div>
              <div id="seeall"></div>
            </ul>

          </li>
          </form>
      </div>
      </li>
      </ul>

      <form method="GET" action="/logout" class="d-flex" style="margin-right:50px;">
        <button type="Submit" class="btn btn-light">Logout</button>
      </form>
    </div>
    </div>
  </nav>
  <div class="body">
    <div class="container" style="background-color:white;">
      <div class="main">
        <div class="cover">
          @if($members['cp']=='')
          <img src="/boxed-water-is-better-rXJXsecq8YU-unsplash.jpg" id="oldcp" alt="Not Available" />
          @else
          <img src="/uploads/cp/{{$members['cp']}}" id="oldcp" alt="not available" />
          @endif
          <div class="text-block">
            <i class="fa fa-solid fa-camera rounded-circle border border-white border-1 cp_upload" style="background-color:black; padding:5px;" aria-hidden="true"></i>
          </div>
        </div>


        <div class="profile rounded-circle">
          @if($members['dp']=='')
          <img src="/blank-profile-picture-973460_1280.png" alt="notavailable" id="olddp" class="rounded-circle border border-white border dp" />
          @else
          <img src="/uploads/{{$members['dp']}}" alt="notavailable" id="olddp" class="rounded-circle border border-white border-4 dp" />
          @endif
          <img src="/uploads/{{$members['dp']}}" alt="notavailable" class="rounded-circle border border-white border-4 dp" id="newdp" style="display: none;" />
          <div style="display: none;">
            <img src="" alt="">
          </div>
          <div class="text-block-dp">
            <form action="POST" action="/uploadp" enctype="multipart/form-data">
              <div id="fileuploader"><i class="fa fa-solid fa-camera rounded-circle border border-white border-1 dp_upload" id="{{$members['id']}}" style="background-color:black; padding:5px;" aria-hidden="true"></i></div>
            </form>
          </div>
          <div class="row">
            <div class="col">
              <h2 class="d-flex justify-content-center">{{$members['name']}}</h2>
            </div>
          </div>
        </div>
      </div>
      <br><br><br>
      <div class="container">
        <div class="row">
          <div class=" col-4">
            <div class="row">
              <button type="button" class="btn btn-dark viewfriendl" style="border-radius:50px;" id="{{$members['userid']}}">Friends List</button>
            </div>
            <br>
            <div class="row" style="background-color:rgba(250, 248, 245)">
              <div class="col-12">
                Date of birth <i class="fa fa-pencil" aria-hidden="true"></i>
                <p>{{$members['dob']}}</p>
              </div>
            </div>
            <div class="row" style="background-color:rgba(250, 248, 245);">
              <div class="col-12">
                From <i class="fa fa-pencil" aria-hidden="true"></i>
                <p>{{$members['place']}}</p>
              </div>
            </div>
            <div class="row" style="background-color:rgba(250, 248, 245);">
              <div class="col-12">
                Education <i class="fa fa fa-pencil ed" aria-hidden="true"></i>
                <p class="education">{{$members['ed']}}</p>
                <!-- <p> -->
                <form class="eded" style="display:none;" action="">
                  <div class="row">
                    <div class="col-8">
                      <input type="text" class="form-control" style="border-radius: 70px;" name="" id="edid">
                    </div>
                    <div class="col-2">
                      <button type="button" class="can btn"><i class="fa fa-ban"></i></button>
                    </div>
                    <div class="col-2">
                      <button type="submit" class="btn"><i class="fa-regular fa-floppy-disk"></i></button>
                    </div>
                  </div>
                </form>
                <!-- </p> -->
              </div>
            </div>
            <div class="row" style="background-color:rgba(250, 248, 245);">
              <div class="col-12">
                Gender <i class="fa fa-pencil" aria-hidden="true"></i>
                <p>{{$members['gender']}}</p>
              </div>
            </div>
            <div class="row" style="background-color:rgba(250, 248, 245);">
              <div class="col-12">
                Interested <i class="fa fa-pencil" aria-hidden="true"></i>
                <p>{{$members['interested']}}</p>
              </div>
            </div>
          </div>
          <div class="col-8">
            <form class="form-floating" enctype="multipart/form-data">
              @csrf
              <input type="file" name="" id="postp" style="display:none;" multiple>
              <textarea name="" class="form-control" id="" cols="30" style="border-radius: 50px; padding: 1px 20px 1px 20px;" placeholder="Write something here..." rows="10"></textarea>
              <!-- <input type="text" class="form-control" id="floatingInputValue" style="border-radius:150px; height: 70px;"> -->
              <!-- <label for="floatingInputValue">Write something here....</label> -->
              <div class="row">
                <!-- <button type="button" class="btn btn-dark mt-2 a">a Modal</button>
              <button type="button" class="btn btn-dark mt-2 b">b Modal</button> -->
                <div class="col-6">

                  <button type="button" class="btn btn-dark mt-2 uploadphotos" style="border-radius:50px; width:100%;">Upload Photos</button>
                  <button type="button" class="btn btn-primary modal" style="display:none;" data-toggle="modal" data-target="#exampleModal">
                    Launch demo modal
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content" style=" border-radius:10px;">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                          <button type="button" class="close" id='cm' data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="">
                            @csrf
                            <input type="text" name="" class='form-control mb-4' style="border: none transparent;outline: none;" id="something" placeholder="Something about the post...">
                            <img src="" alt="xzfdz" id="preview">
                          </form>

                        </div>
                        <br>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" id="discard" data-dismiss="modal">Discard</button>
                          <button type="button" id="postit" class="btn btn-primary">Post</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-6">
                  <button type="submit" class="btn btn-dark mt-2" style="border-radius:50px; width:100%;">Post</button>
                </div>
              </div>
            </form>
            <!-- Button trigger modal -->
            <br>
            <ul class="nav nav-tabs">
              <li class="nav-item">
                <a class="nav-link active" href="#">Active</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled" href="#">Disabled</a>
              </li>
            </ul>
            @foreach($posts as $post)
            <br>
            <div class="row" id="newpost">
              <div class="card" style="border: transparent;">
                <div class="row">
                  <div class="col-1">
                    <img src="/uploads/{{$members['dp']}}" id='postsdp' class="rounded-circle" style="height: 50px; width: 50px; object-fit:cover;" alt="">
                  </div>
                  <div class="col-10" style="padding-top:10px; margin-left:8px; padding-left: 0px;padding-right: 0px;">
                    <p style="font-size: 20px;">{{$members['name']}}</p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-8 mt-2 mb-2">
                    {{$post['caption']}}
                  </div>
                </div>
                <?php
                if ($post['picture'] != '') {
                ?>
                  <div style="background: black;" class="imagesofposts">
                    <img class="card-img-top" src="/uploads/posts/{{$post['picture']}}" style="max-height: 350px; width:100%; object-fit:contain;">
                  </div>
                <?php
                }
                ?>
                <div class="row mt-1 likenumzone" postid="{{$post['id']}}">
                  <div class="col-4">
                    <div class="zerolikes2" style="display: none;">
                      Be the first to like this <i class="fa-regular fa-thumbs-up"></i>
                    </div>
                    <?php if ($post['likes'] == 0) {
                    ?><div class="zerolikes">
                        Be the first to like this <i class="fa-regular fa-thumbs-up"></i>
                      </div>
                      <div class="somelikes" id="0" style="display:none;">
                        <i class="fa-regular fa-thumbs-up"></i> {{$post['likes']}}
                      </div>
                    <?php
                    } else {
                    ?>
                      <div class="somelikes" id="{{$post['likes']}}">
                        <i class="fa-regular fa-thumbs-up"></i> {{$post['likes']}}
                      </div>
                    <?php
                    }
                    ?>
                  </div>
                </div>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary likelist" data-bs-toggle="modal" data-bs-target="#exampleModal" style="display:none;">
                  Launch demo modal
                </button>

                <!-- Modal -->
                <div class="modal fade " id="itsdifferent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Likes <i class="fa-solid fa-thumbs-up"></i></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body likepeople">
                        <!-- <div class="row">
                            <div class="col-1" style="padding:0;">
                              <img src="/uploads/1654858329_is.jpeg" alt="" style="max-width:40px;">
                            </div>
                            <div class="col-5" style="padding:0;">
                              Soham Das
                            </div>
                          </div> -->
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6" style="padding-right:0px; height: 50px;">
                    <?php
                    $uid = session()->get('id');
                    if (!empty($post['likeid'])) {
                      if (!str_contains($post['likeid'], $uid)) {
                    ?>
                        <button class="btn btn-light btn-lg btn-block likeb" style="width:100%; background: white;" id="{{$post['id']}}"><i class="fa-regular fa-thumbs-up"></i></button>
                      <?php
                      } else {
                      ?>
                        <button class="btn btn-light btn-lg btn-block likeb" style="width:100%; background: white;" id="{{$post['id']}}"><i class="fa-solid fa-thumbs-up"></i></button>
                      <?php
                      }
                    } else {
                      ?>
                      <button class="btn btn-light btn-lg btn-block likeb" style="width:100%; background: white;" id="{{$post['id']}}"><i class="fa-regular fa-thumbs-up"></i></button>
                    <?php
                    }
                    ?>
                  </div>
                  <div class="modal fade commentsection" id="{{$post['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                      <div class="modal-content" style="min-height:700px;">
                        <div class="modal-header">
                          <h5 class="modal-title" id="chead_{{$post['id']}}">Comments <i class="fa-solid fa-comment-dots"></i></h5>
                          <h5 class="modal-title" id="rhead_{{$post['id']}}" style="display:none;"><i class="fa-solid fa-arrow-left"></i> Replies</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body bodyofcomments" id="commentmodal_{{$post['id']}}">
                          <!-- <div class="card itsacomment" style="width: 28rem;border-radius:20px;margin-top:3px;">
                            <div class="card-body" style="padding:5px;">
                              <div class="row">
                                <div class="col-2" style="padding-right: 0px; margin-right:0px; width:57px;">
                                  <img src="/uploads/1654604596_is.jpeg" id='postsdp' class="rounded-circle" style="height: 30px; width: 30px; object-fit:cover;margin-left: 10px;" alt="">
                                </div>
                                <div class="col-8" style="padding-left: 0px; margin-left:0px;">
                                  <p style="font-size: 18px;">Soham Das</p>
                                </div>
                              </div>
                              <div class="row" style="margin-left: 4px;margin-right: 4x;">
                                <div class="col-12" style="padding-left: 6px;">
                                  Hey! This is a comment and this is for testing and this is absolutely static and I've got nothing else to say but still i gotta test this.
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-2" style="margin-left: 25px; margin-top:10px;padding-right:0px;">
                              <i class="fa-regular fa-thumbs-up"></i>
                              </div>
                              <div class="col-4" style="margin-top: 10px;padding-left: 0px;">
                                Reply
                              </div>
                            </div>
                          </div> -->

                        </div>
                        <div class="modal-footer foc_{{$post['id']}}" style="margin:1px; padding:0px;">
                          <div class="row">
                            <div class="col-10" style="padding-left: 5px;">
                              <input type="text" name="" placeholder="Write a comment.." class="form-control commentcontent" id="" style="width: 400px; margin-left:1px; border-radius:20px;" minlength="1">
                            </div>
                            <div class="col-2">
                              <button type="button" class="btn btn-primary postcomment" id="{{$post['id']}}" style="border-radius:20px;">Post</button>
                            </div>
                          </div>

                        </div>
                        <div class="modal-footer for_{{$post['id']}}" style="margin:1px; padding:0px; display:none;">
                          <div class="row">
                            <div class="col-10" style="padding-left: 5px;">
                              <input type="text" name="" placeholder="Write a reply.." class="form-control replycontent" id="replycontent_{{$post['id']}}" style="width: 400px; margin-left:1px; border-radius:20px;" minlength="1">
                            </div>
                            <div class="col-2">
                              <button type="button" class="btn btn-primary postreply" id="" style="border-radius:20px;">Post</button>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="display:none;">
                    Launch demo modal
                  </button>

                  <!-- Modal -->

                  <div class="col-6" style="padding-left:0px; height :50px;">
                    <button class="btn btn-light btn-lg comment comment_{{$post['id']}}" style="width: 100%; background: white;" id="{{$post['id']}}"><i class="fa fa-commenting" aria-hidden="true"></i></button>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Optional JavaScript; choose one of the two!
          Option 1: Bootstrap Bundle with Popper
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
          Option 2: Separate Popper and Bootstrap JS
          
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

<script>
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        console.log(e.target.result);
        $("#preview").attr("src", e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }
  $('#test').change(function(e) {
    var files = $('.uploadp')[0].files;
    var fd = new FormData();
    // Append data 
    fd.append('file', files[0]);
    // AJAX request 
    $.ajax({
      url: "/uploadp",
      method: 'post',
      data: fd,
      contentType: false,
      processData: false,
      //  dataType: 'json',
      success: function(response) {
        console.log(response);
        let filesrc = "/uploads/" + response;
        $("#olddp").attr("src", filesrc);
        $("#postsdp").attr("src", filesrc);
      }
    })
  })
  $('.dp_upload').click(function(e) {
    console.log('Edit Profile photo');
    $('.uploadp').click();
  })
  $('#testc').change(function(e) {
    var files = $('.uploacp')[0].files;
    console.log(files);
    var fd = new FormData();
    // Append data 
    fd.append('file', files[0]);
    //  fd.append('_token',CSRF_TOKEN);
    console.log(fd);
    // AJAX request 
    $.ajax({
      url: "/uploacp",
      method: 'post',
      data: fd,
      contentType: false,
      processData: false,
      //  dataType: 'json',
      success: function(response) {
        console.log(response);
        let filesrc = "/uploads/cp/" + response;
        $("#oldcp").attr("src", filesrc);
      }
    })
  })
  $('.cp_upload').click(function(e) {
    console.log('Edit Cover photo');
    $('.uploacp').click();
  })
  $('.ed').click(function(e) {
    console.log("Educate");
    var eduadd = this;
    $('.eded').css('display', 'block');
    $(this).hide();
  })
  $('.can').click(function(e) {
    console.log('cancel button clicked');
    $('.eded').css('display', 'none');
    $('.ed').show();
  })
  $('.eded').submit(function(e) {
    e.preventDefault();
    console.log('save button clicked');
    let va = $('#edid').val();
    mydata = {
      value: va
    }
    console.log(mydata);
    $.ajax({
      url: '/createdu',
      method: 'POST',
      data: JSON.stringify(mydata),
      success: function(data) {
        console.log(data);
        $('.education').text(data);
        $('.eded').css('display', 'none');
        $('.ed').show();
      }
    })
  })
  // AJAX call for autocomplete 
  $('.uploadphotos').click(function(e) {
    console.log("upload");
    $('#postp').click();
    // console.log("hi");
  });
  $("#search-box").keyup(function(e) {
    $(".plist").empty();
    $("#divider").empty();
    $("#seeall").empty();
    if ($('#search-box').val() != '') {
      $("#search-box").css("background", "#FFF url(/Spinner-5.gif) no-repeat 250px");
    } else {
      $("#search-box").css('background', '#FFF');
    }
    if ($('#search-box').val() == '') {
      $('.smenu').hide();
      console.log('Empty');
    }
    if (e.keyCode >= 8 && e.keyCode <= 46 && $('#search-box').val() == '') {
      console.log('b tapped');
      console.log('Empty');
      return false;
    }
    $('.body').click(function() {
      $('.smenu').hide();
      $("#search-box").val('');
      $("#search-box").css('background', '#FFF');
    })
    $.ajax({
      type: "POST",
      url: '/search',
      data: 'keyword=' + $(this).val(),
      beforeSend: function() {
        // $("#search-box").css("background", "#FFF url(/Spinner-5.gif) no-repeat 250px");
      },
      success: function(data) {
        console.log(data);
        if (data.length == 0) {
          $('.smenu').hide();
        }
        // $('#searchform').addClass('nav-item');
        // $('#searchform').addClass('dropdown');
        let c = 0;
        let namearray = [];
        for (let i = 0; i < data.length; i++) {
          console.log(data[c]['name']);
          let name = data[c]['name'];
          // $("#suggesstion-box").show();
          $("#plist").append('<button type="button" class="btn btn-light dbu"><li><class="dropdown-item" id="' + data[c]['id'] + '">' + name + '</li></button><br>');
          $("#divider").html('<li><hr class="dropdown-divider"></li>');
          $("#seeall").html('<li><a class="dropdown-item" href="#">See all results</a></li>');
          if (data[c]['name'] != '')
            $('.smenu').show();
          $("#search-box").css("background", "#FFF");
          namearray[i] = data[c]['id'];
          console.log(namearray);
          c++;
        }
        $('.dbu').click(function(e) {
          // e.preventDefault();
          console.log($(this).children().text());
          console.log($(this).children().children().attr('id'));
          $('#search-box').attr('hideit', $(this).children().children().attr('id'))
          console.log($('#search-box').attr('hideit'))
          $('#search-box').val($(this).children().text());
          $('.smenu').hide();
          $('.search').attr('id', $(this).children().children().attr('id'));
          let clid = $(this).children().children().attr('id');
          console.log($('.search').attr('id'));
          $('.search').click(function() {
            mydata = {
              person: clid,
            }
            $.ajax({
              url: '/viewpeople',
              method: 'POST',
              data: JSON.stringify(mydata),
              success: function(data) {
                // console.log(data);
                location.href = "/showpeople";
              }
            })
          })
        })
      }
    });
  });
  $('#postp').change(function(e) {
    readURL(this);
    $('.modal').click();
    var files = $(this)[0].files;
    console.log(files);
    var fd = new FormData();
    fd.append('file', files[0]);
    $('#postit').click(function(e) {
      let capshn = $('#something').val();
      fd.append('nocap', capshn);
      console.log($('#something').val())
      $.ajax({
        url: "/postit",
        method: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response) {
          console.log(response);
          var nameofpic = response;
          $('#something').val('');
          $('#cm').click();
          $('#newposts').children().append()
        }
      })
    })
  })
  $('.dropdown-item').click(function() {
    console.log($(this).text());
  })
  $('.acceptreq').click(function() {
    console.log($(this).attr('id'));
    console.log('User wants to accept this person as a friend');
    let target = $(this).attr('id');
    $(this).parent().parent().remove();
    // return false;
    mydata = {
      targetu: target
    }
    $.ajax({
      url: '/acceptrequest',
      method: 'POST',
      data: JSON.stringify(mydata),
      success: function(data) {
        console.log(data);
        $(this).parent().parent().remove();
      }
    })
  })
  $('.deletereq').click(function() {
    console.log($(this).attr('id'));
    console.log('User wants to delete this person as a friend');
    let target = $(this).attr('id');
    // return false;
    $(this).parent().parent().remove();
    // return false;
    mydata = {
      targetu: target
    }
    $.ajax({
      url: '/deleterequest',
      method: 'POST',
      data: JSON.stringify(mydata),
      success: function(data) {
        console.log(data);
        $(this).parent().parent().remove();
      }
    })
  })
  $('.showflist').click(function() {
    console.log('Friend Request List Viewed');
    mydata = {
      view: 1
    }
    $.ajax({
      url: "/viewstatus",
      method: "POST",
      data: JSON.stringify(mydata),
      success: function(data) {
        console.log(data);
        $('.tohide').css('display', 'none');
      }
    })
  })
  $('.likeb').click(function() {
    console.log('Like button clicked');
    let p = $(this).attr('id');
    console.log(p);
    let th = this;
    mydata = {
      post: p
    }
    let zone = $(th).parent().parent().parent().children().next().next().next();
    console.log($(th).parent().parent().parent().children().next().next().next().attr('class'));
    console.log($(zone).children().children().attr('class'));
    console.log($(zone).children().find('.somelikes').attr('id'));
    let num = parseInt($(zone).children().find('.somelikes').attr('id'));
    console.log(num)
    // return false;
    $.ajax({
      url: "/like",
      method: "POST",
      data: JSON.stringify(mydata),
      success: function(data) {
        console.log(data);
        if (data == 1) {
          console.log('entering');
          // return false;
          $(th).children().removeClass('fa-regular');
          $(th).children().addClass('fa-solid');
          $(zone).children().find('.zerolikes').css('display', 'none');
          let newnum = num + 1;
          if (newnum != 1) {
            $(zone).children().find('.somelikes').attr('id', newnum.toString())
          }
          $(zone).children().find('.somelikes').html('<i class="fa-regular fa-thumbs-up"></i>' + " " + newnum.toString());
          $(zone).children().find('.somelikes').css('display', 'block');
        } else if (data == 2) {
          $(th).children().removeClass('fa-solid');
          $(th).children().addClass('fa-regular');
          console.log($(zone).children().children());
          $(zone).children().find('.zerolikes2').css('display', 'block')
          $(zone).children().find('.somelikes').css('display', 'none')
          $(zone).children().find('.somelikes').attr('id', "0")
          $(zone).children().find('.zerolikes2').html('<div class="zerolikes">Be the first to like this <i class="fa-regular fa-thumbs-up"></i></div>');
        } else {
          $(th).children().removeClass('fa-solid');
          $(th).children().addClass('fa-regular');
          let newnum = num - 1;
          $(zone).children().find('.somelikes').html('<i class="fa-regular fa-thumbs-up"></i>' + " " + newnum.toString());
          $(zone).children().find('.somelikes').attr('id', newnum.toString())
        }
      }
    })
  })
  $('.likenumzone').click(function() {
    console.log('People who have liked the post');
    // $('.likelist').click()
    console.log($(this).attr('postid'));
    let postid = $(this).attr('postid');
    mydata = {
      id: postid
    }
    // return false;
    let th = this;
    $.ajax({
      url: '/likelist',
      method: "POST",
      data: JSON.stringify(mydata),
      success: function(data) {
        console.log(data);
        $(th).parent().find('#itsdifferent').modal('show');
        $(th).parent().find('#itsdifferent').children().children().find('.likepeople').html(data);
      }
    })

  })

  $('.comment').click(function() {
    console.log('Clicked on comments');
    $(this).parent().parent().find('.commentsection').modal('show');
    console.log($(this).attr('id'));
    let postid = $(this).attr('id');
    var vcom = $('.comment_' + postid);
    mydata = {
      id: postid
    }
    $.ajax({
      url: '/viewcomments',
      method: 'POST',
      data: JSON.stringify(mydata),
      success: function(data) {
        console.log(data);
        $("#commentmodal_" + postid).html(data);
        $('.likecomment').click(function() {
          console.log('wants to like comment')
          // console.log($(this).attr('id'));
          let comid = $(this).attr('id');
          console.log($(this).children().next().text())
          // return false;
          if ($(this).children().next().text() != '') {
            var nnc = parseInt($(this).children().next().text());
          } else {
            var nnc = 0;
          }
          // console.log(nnc);
          // return false;
          mydata = {
            id: comid
          }
          // $(this).children().removeClass('fa-regular');
          // $(this).children().addClass('fa-solid');
          let th = this;
          console.log(nnc);
          // return false;
          $.ajax({
            url: "/likecomment",
            method: "POST",
            data: JSON.stringify(mydata),
            success: function(data) {
              console.log(data);
              if (data == 1) {
                console.log('entering');
                // return false;
                $(th).children().removeClass('fa-regular');
                $(th).children().addClass('fa-solid');
                if ($(th).children().text() != '') {
                  let nl = nnc + 1;
                  $(th).children().next().text(toString(nl))
                } else {
                  $(th).children().next().text('1')
                }
              } else if (data == 2) {
                $(th).children().removeClass('fa-solid');
                $(th).children().addClass('fa-regular');
                // let nl = nnc + 1;
                $(th).children().text('');
              } else {
                $(th).children().removeClass('fa-solid');
                $(th).children().addClass('fa-regular');
                let nl = nnc - 1;
                $(th).children().next().text(toString(nl))
              }

            }
          })
        })
        $('.replycomment').click(function() {
          console.log('User wants to reply to a comment');
          console.log($(this).attr('id'));
          let comid = $(this).attr('id');
          // $(this).parent().css('display','none');
          // console.log($(this).parent().parent().parent().parent().parent().parent().parent())
          $('#commentmodal_' + postid).html('');
          $('#chead_' + postid).css('display', 'none');
          $('#rhead_' + postid).css('display', 'block');
          mydatax = {
            cmid: comid,
          }
          $.ajax({
            url: '/viewreplies',
            method: 'POST',
            data: JSON.stringify(mydatax),
            success: function(data) {
              $('#rhead_' + postid).click(function() {
                $('#rhead_' + postid).css('display', 'none');
                $('#chead_' + postid).css('display', 'block');
                $(vcom).click();
              })
              console.log(data);
              $('#commentmodal_' + postid).html(data);
              $('.likereply').click(function() {
                console.log('User wants to like reply');
                let lrep = $(this).attr('id');
                console.log(lrep);
                console.log($(this).children().next().text())
                // return false;
                if ($(this).children().next().text() != '') {
                  var nnc = parseInt($(this).children().next().text());
                } else {
                  var nnc = 0;
                }
                mydata = {
                  id: lrep
                }
                let th = this;
                console.log(nnc);
                $.ajax({
                  url: "/likereply",
                  method: "POST",
                  data: JSON.stringify(mydata),
                  success: function(data) {
                    $('#rhead_' + postid).click(function() {
                      $('#rhead_' + postid).css('display', 'none');
                      $('#chead_' + postid).css('display', 'block');
                      $(vcom).click();
                    })
                    console.log(data);
                    if (data == 1) {
                      console.log('entering');
                      // return false;
                      $(th).children().removeClass('fa-regular');
                      $(th).children().addClass('fa-solid');
                      if ($(th).children().text() != '') {
                        let nl = nnc + 1;
                        $(th).children().next().text(toString(nl))
                      } else {
                        $(th).children().next().text('1')
                      }
                    } else if (data == 2) {
                      $(th).children().removeClass('fa-solid');
                      $(th).children().addClass('fa-regular');
                      // let nl = nnc + 1;
                      $(th).children().text('');
                    } else {
                      $(th).children().removeClass('fa-solid');
                      $(th).children().addClass('fa-regular');
                      let nl = nnc - 1;
                      $(th).children().next().text(toString(nl))
                    }

                  }
                })
              })
            }
          })
          // $('#reply_'+comid).modal('show');
          $('.foc_' + postid).css('display', 'none');
          $('.for_' + postid).css('display', 'block');
          $('.for_' + postid).children().find('.postreply').attr('id', comid);
          $('.for_' + postid).children().find('.postreply').off().click(function() {
            console.log('User wants to post the reply')
            console.log($('#replycontent_' + postid).val())
            let reply = $('#replycontent_' + postid).val()
            mydata = {
              cid: comid,
              r: reply
            }
            // return false;
            $.ajax({
              url: '/replycomment',
              method: 'POST',
              data: JSON.stringify(mydata),
              success: function(data) {
                $('#rhead_' + postid).click(function() {
                  $('#rhead_' + postid).css('display', 'none');
                  $('#chead_' + postid).css('display', 'block');
                  $(vcom).click();
                })
                console.log(data);
                $('#commentmodal_' + postid).append(data);
                $('#replycontent_' + postid).val('')
                $.ajax({
                  url: '/viewreplies',
                  method: 'POST',
                  data: JSON.stringify(mydatax),
                  success: function(data) {
                    $('#rhead_' + postid).click(function() {
                      $('#rhead_' + postid).css('display', 'none');
                      $('#chead_' + postid).css('display', 'block');
                      $(vcom).click();
                    })
                    console.log(data);
                    $('#commentmodal_' + postid).html('');
                    $('#replycontent_' + postid).val('')
                    $('#commentmodal_' + postid).html(data);
                    $('.likereply').click(function() {
                      console.log('User wants to like reply');
                      let lrep = $(this).attr('id');
                      console.log(lrep);
                      console.log($(this).children().next().text())
                      // return false;
                      if ($(this).children().next().text() != '') {
                        var nnc = parseInt($(this).children().next().text());
                      } else {
                        var nnc = 0;
                      }
                      mydata = {
                        id: lrep
                      }
                      let th = this;
                      console.log(nnc);
                      $.ajax({
                        url: "/likereply",
                        method: "POST",
                        data: JSON.stringify(mydata),
                        success: function(data) {
                          $('#rhead_' + postid).click(function() {
                            $('#rhead_' + postid).css('display', 'none');
                            $('#chead_' + postid).css('display', 'block');
                            $(vcom).click();
                          })
                          console.log(data);
                          if (data == 1) {
                            console.log('entering');
                            // return false;
                            $(th).children().removeClass('fa-regular');
                            $(th).children().addClass('fa-solid');
                            if ($(th).children().text() != '') {
                              let nl = nnc + 1;
                              $(th).children().next().text(toString(nl))
                            } else {
                              $(th).children().next().text('1')
                            }
                          } else if (data == 2) {
                            $(th).children().removeClass('fa-solid');
                            $(th).children().addClass('fa-regular');
                            // let nl = nnc + 1;
                            $(th).children().text('');
                          } else {
                            $(th).children().removeClass('fa-solid');
                            $(th).children().addClass('fa-regular');
                            let nl = nnc - 1;
                            $(th).children().next().text(toString(nl))
                          }

                        }
                      })
                    })
                  }
                })
              }
            })
          })

        })
      }
    })
  })


  $('.postcomment').click(function() {
    console.log('User wants to post the written comment');
    let th = this;
    let postid = $(this).attr('id');
    var vcom = $('.comment_' + postid);
    let comment = $(this).parent().parent().find('.col-10').children().val();
    let bodyofcomment = $(th).parent().parent().parent().parent().children().next();
    console.log(bodyofcomment);
    // return false;
    console.log(comment);
    console.log(postid);
    mydata = {
      id: postid,
      material: comment,
    }
    $.ajax({
      method: 'POST',
      url: '/comment',
      data: JSON.stringify(mydata),
      success: function(data) {
        console.log(data);
        $("#commentmodal_" + postid).append(data);
        $(th).parent().parent().children().children().val('');
        $('#rhead_' + postid).click(function() {
          $('#rhead_' + postid).css('display', 'none');
          $('#chead_' + postid).css('display', 'block');
          $(vcom).click();
        })
        $.ajax({
          url: '/viewcomments',
          method: 'POST',
          data: JSON.stringify(mydata),
          success: function(data) {
            console.log(data);
            $("#commentmodal_" + postid).html(data);
            $('.likecomment').click(function() {
              console.log('wants to like comment')
              // console.log($(this).attr('id'));
              let comid = $(this).attr('id');
              console.log($(this).children().next().text())
              // return false;
              if ($(this).children().next().text() != '') {
                var nnc = parseInt($(this).children().next().text());
              } else {
                var nnc = 0;
              }
              // console.log(nnc);
              // return false;
              mydata = {
                id: comid
              }
              // $(this).children().removeClass('fa-regular');
              // $(this).children().addClass('fa-solid');
              let th = this;
              console.log(nnc);
              // return false;
              $.ajax({
                url: "/likecomment",
                method: "POST",
                data: JSON.stringify(mydata),
                success: function(data) {
                  console.log(data);
                  if (data == 1) {
                    console.log('entering');
                    // return false;
                    $(th).children().removeClass('fa-regular');
                    $(th).children().addClass('fa-solid');
                    if ($(th).children().text() != '') {
                      let nl = nnc + 1;
                      $(th).children().next().text(toString(nl))
                    } else {
                      $(th).children().next().text('1')
                    }
                  } else if (data == 2) {
                    $(th).children().removeClass('fa-solid');
                    $(th).children().addClass('fa-regular');
                    // let nl = nnc + 1;
                    $(th).children().text('');
                  } else {
                    $(th).children().removeClass('fa-solid');
                    $(th).children().addClass('fa-regular');
                    let nl = nnc - 1;
                    $(th).children().next().text(toString(nl))
                  }

                }
              })
            })
            $('.replycomment').click(function() {
              console.log('User wants to reply to a comment');
              console.log($(this).attr('id'));
              let comid = $(this).attr('id');
              // $(this).parent().css('display','none');
              // console.log($(this).parent().parent().parent().parent().parent().parent().parent())
              $('#commentmodal_' + postid).html('');
              $('#chead_' + postid).css('display', 'none');
              $('#rhead_' + postid).css('display', 'block');
              mydatax = {
                cmid: comid,
              }
              $.ajax({
                url: '/viewreplies',
                method: 'POST',
                data: JSON.stringify(mydatax),
                success: function(data) {
                  $('#rhead_' + postid).click(function() {
                    $('#rhead_' + postid).css('display', 'none');
                    $('#chead_' + postid).css('display', 'block');
                    $(vcom).click();
                  })
                  console.log(data);
                  $('#commentmodal_' + postid).html(data);
                  $('.likereply').click(function() {
                    console.log('User wants to like reply');
                    let lrep = $(this).attr('id');
                    console.log(lrep);
                    console.log($(this).children().next().text())
                    // return false;
                    if ($(this).children().next().text() != '') {
                      var nnc = parseInt($(this).children().next().text());
                    } else {
                      var nnc = 0;
                    }
                    mydata = {
                      id: lrep
                    }
                    let th = this;
                    console.log(nnc);
                    $.ajax({
                      url: "/likereply",
                      method: "POST",
                      data: JSON.stringify(mydata),
                      success: function(data) {
                        $('#rhead_' + postid).click(function() {
                          $('#rhead_' + postid).css('display', 'none');
                          $('#chead_' + postid).css('display', 'block');
                          $(vcom).click();
                        })
                        console.log(data);
                        if (data == 1) {
                          console.log('entering');
                          // return false;
                          $(th).children().removeClass('fa-regular');
                          $(th).children().addClass('fa-solid');
                          if ($(th).children().text() != '') {
                            let nl = nnc + 1;
                            $(th).children().next().text(toString(nl))
                          } else {
                            $(th).children().next().text('1')
                          }
                        } else if (data == 2) {
                          $(th).children().removeClass('fa-solid');
                          $(th).children().addClass('fa-regular');
                          // let nl = nnc + 1;
                          $(th).children().text('');
                        } else {
                          $(th).children().removeClass('fa-solid');
                          $(th).children().addClass('fa-regular');
                          let nl = nnc - 1;
                          $(th).children().next().text(toString(nl))
                        }

                      }
                    })
                  })
                }
              })
              // $('#reply_'+comid).modal('show');
              $('.foc_' + postid).css('display', 'none');
              $('.for_' + postid).css('display', 'block');
              $('.for_' + postid).children().find('.postreply').attr('id', comid);
              $('.for_' + postid).children().find('.postreply').off().click(function() {
                console.log('User wants to post the reply')
                console.log($('#replycontent_' + postid).val())
                let reply = $('#replycontent_' + postid).val()
                mydata = {
                  cid: comid,
                  r: reply
                }
                // return false;
                $.ajax({
                  url: '/replycomment',
                  method: 'POST',
                  data: JSON.stringify(mydata),
                  success: function(data) {
                    $('#rhead_' + postid).click(function() {
                      $('#rhead_' + postid).css('display', 'none');
                      $('#chead_' + postid).css('display', 'block');
                      $(vcom).click();
                    })
                    console.log(data);
                    $('#commentmodal_' + postid).append(data);
                    $('#replycontent_' + postid).val('')
                    $.ajax({
                      url: '/viewreplies',
                      method: 'POST',
                      data: JSON.stringify(mydatax),
                      success: function(data) {
                        $('#rhead_' + postid).click(function() {
                          $('#rhead_' + postid).css('display', 'none');
                          $('#chead_' + postid).css('display', 'block');
                          $(vcom).click();
                        })
                        console.log(data);
                        $('#commentmodal_' + postid).html('');
                        $('#replycontent_' + postid).val('')
                        $('#commentmodal_' + postid).html(data);
                        $('.likereply').click(function() {
                          console.log('User wants to like reply');
                          let lrep = $(this).attr('id');
                          console.log(lrep);
                          console.log($(this).children().next().text())
                          // return false;
                          if ($(this).children().next().text() != '') {
                            var nnc = parseInt($(this).children().next().text());
                          } else {
                            var nnc = 0;
                          }
                          mydata = {
                            id: lrep
                          }
                          let th = this;
                          console.log(nnc);
                          $.ajax({
                            url: "/likereply",
                            method: "POST",
                            data: JSON.stringify(mydata),
                            success: function(data) {
                              $('#rhead_' + postid).click(function() {
                                $('#rhead_' + postid).css('display', 'none');
                                $('#chead_' + postid).css('display', 'block');
                                $(vcom).click();
                              })
                              console.log(data);
                              if (data == 1) {
                                console.log('entering');
                                // return false;
                                $(th).children().removeClass('fa-regular');
                                $(th).children().addClass('fa-solid');
                                if ($(th).children().text() != '') {
                                  let nl = nnc + 1;
                                  $(th).children().next().text(toString(nl))
                                } else {
                                  $(th).children().next().text('1')
                                }
                              } else if (data == 2) {
                                $(th).children().removeClass('fa-solid');
                                $(th).children().addClass('fa-regular');
                                // let nl = nnc + 1;
                                $(th).children().text('');
                              } else {
                                $(th).children().removeClass('fa-solid');
                                $(th).children().addClass('fa-regular');
                                let nl = nnc - 1;
                                $(th).children().next().text(toString(nl))
                              }

                            }
                          })
                        })
                      }
                    })
                  }
                })
              })

            })
          }
        })
      }
    })
  })
  $('.viewfriendl').click(function() {
    console.log('user wants to view friends list');
    console.log($(this).attr('id'));
    let id = $(this).attr('id');
    $('#friendlist_' + id).modal('show');
    mydata={
      uid: id,
    }
    $.ajax({
      url:'/viewfriendlist',
      method:'POST',
      data: JSON.stringify(mydata),
      success: function(data){
        console.log(data);
        $('.flist_'+id).html(data);
        $('.unfriend').click(function(){
          console.log('User wants to unfriend id: '+$(this).attr('id'))
          let rid=$(this).attr('id');
          $('#row_'+rid).remove();
          mydata={
            id: rid,
          }
          $.ajax({
            url: "/unfriend",
            method:'POST',
            data: JSON.stringify(mydata),
            success: function(data){
              console.log(data);
              
            }
          })
        })
      }
    })

  })
</script>

</html>