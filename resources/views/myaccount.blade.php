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
  </style>

</head>

<body style="background-color:ghostwhite;">

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
          <li class="nav-item" style="margin-left:60px;">
            <div class="frmsearch" style="margin-right:80px;">
              <form class="d-flex searchform">
          <li class="nav-item dropdown mt-0 pt-0">
            <div class="row mt-0 pt-0">
              <div class="col-10" style="margin-right:0px; padding-right:0px;">
                <input class="form-control me-2 dropdown-toggle stoggle" type="search" placeholder="Search" id="search-box" aria-label="Search">
              </div>
              <div class="col-2" style="margin-left:0px; padding-left:2px;">
                <button class="btn btn-outline-success" type="submit">Search</button>
              </div>
            </div>




            <!-- <a class="nav-link dropdown-toggle stoggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown
            </a> -->
            <ul class="dropdown-menu smenu" aria-labelledby="navbarDropdown">
              <div id="plist" class="plist"></div>
              <!-- <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li> -->

              <div id="divider"></div>
              <!-- <li>
                <hr class="dropdown-divider">
              </li> -->
              <div id="seeall"></div>
              <!-- <li><a class="dropdown-item" href="#">See all results</a></li> -->
            </ul>

          </li>




          <!-- <div id="suggesstion-box">
              <ul id="usuggestion">

              </ul>
            </div> -->

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
              <button type="button" class="btn btn-dark" style="border-radius:50px;">Friends</button>
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
                  <div style="background: black;">
                    <img class="card-img-top" src="/uploads/posts/{{$post['picture']}}" style="max-height: 350px; width:100%; object-fit:contain;">
                  </div>
                <?php
                }
                ?>
                <div class="row">
                  <div class="col-6" style="padding-right:0px; height: 50px;">
                    <button class="btn btn-light btn-lg btn-block" style="width:100%; background: white;"><i class="fa-regular fa-thumbs-up"></i></button>
                  </div>
                  <div class="col-6" style="padding-left:0px; height :50px;">
                    <button class="btn btn-light btn-lg " style="width: 100%; background: white;"><i class="fa fa-commenting" aria-hidden="true"></i></button>
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
  $('.uploadphotos').click(function(e) {
    console.log('Upload Images');
    $('#postp').click();
  })
  $('#postp').off().change(function(e) {
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
  // $("body").click(function(e) {
  //     console.log(e.target);
  //   });
  // AJAX call for autocomplete 
  $(document).ready(function() {

    $("#search-box").keyup(function(e) {
      $(".plist").empty();
      $("#divider").empty();
      $("#seeall").empty();
      // console.log( $(this).val());
      // return false;
      // $('.stoggle').click();
      if ($('#search-box').val() == '') {
        $('.smenu').hide();
      }
      if (e.keyCode >= 8 && e.keyCode <= 46 && $('#search-box').val() == '') {
        console.log('b tapped');
        return false;
      }

      $('.body').click(function() {
        $('.smenu').hide();
        $("#search-box").val('');
      })
      // return false;
      $.ajax({
        type: "POST",
        url: '/search',
        data: 'keyword=' + $(this).val(),
        beforeSend: function() {
          $("#search-box").css("background", "#FFF url(/Spinner-5.gif) no-repeat 165px");
        },
        success: function(data) {
          console.log(data);
          if(data.length==0){
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
            $("#plist").append('<li><a class="dropdown-item" href="#">' + name + '</a></li>');
            $("#divider").html('<li><hr class="dropdown-divider"></li>');
            $("#seeall").html('<li><a class="dropdown-item" href="#">See all results</a></li>');
            if(data[c]['name']!='')
            $('.smenu').show();

            $("#search-box").css("background", "#FFF");

            namearray[i] = data[c]['id'];
            console.log(namearray);
            c++;
          }

          // return false;
          // <li><a class="dropdown-item" href="#">Action</a></li>
        }

      });
    });
  });

  //To select user name
  // function selectUser(val) {
  //   $("#search-box").val(val);
  //   $("#suggesstion-box").hide();
  // }
  // $('.stoggle').click(function() {
  //   console.log('clicked');
  // })
</script>

</html>