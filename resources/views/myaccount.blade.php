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
  <link rel="stylesheet" href="/font-awesome-4.7.0/css/font-awesome.min.css">
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
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/dashboard">Feed</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
          </li>
        </ul>
        <form method="GET" action="/logout" class="d-flex" style="margin-right:50px;">
          <button type="Submit" class="btn btn-light">Logout</button>
        </form>
      </div>
    </div>
  </nav>
  <div class="container" style="background-color:white;">
    <div class="main">
      <div class="cover">
        @if($members['cp']=='')
        <img src="/boxed-water-is-better-rXJXsecq8YU-unsplash.jpg" id="oldcp" alt="/mikita-yo-uw4HlQ53cAA-unsplash.jpg" />
        @else
        <img src="/uploads/cp/{{$members['cp']}}" id="oldcp" alt="not available" />
        @endif
        <div class="text-block">
          <i class="fa fa-pencil rounded-circle border border-white border-1 cp_upload" style="background-color:black; padding:5px;" aria-hidden="true"></i>
        </div>
      </div>

      <div class="profile rounded-circle">
        @if($members['dp']=='')
        <img src="/mikita-yo-uw4HlQ53cAA-unsplash.jpg" alt="/mikita-yo-uw4HlQ53cAA-unsplash.jpg" id="olddp" class="rounded-circle border border-white border-4 dp" />
        @else
        <img src="/uploads/{{$members['dp']}}" alt="notavailable" id="olddp" class="rounded-circle border border-white border-4 dp" />
        @endif
        <img src="/uploads/{{$members['dp']}}" alt="notavailable" class="rounded-circle border border-white border-4 dp" id="newdp" style="display: none;" />
        <div style="display: none;">
          <img src="" alt="">
        </div>
        <div class="text-block-dp">
          <form action="POST" action="/uploadp" enctype="multipart/form-data">
            <div id="fileuploader"><i class="fa fa-pencil rounded-circle border border-white border-1 dp_upload" id="{{$members['id']}}" style="background-color:black; padding:5px;" aria-hidden="true"></i></div>
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
                    <button type="button" class="can"><i class="fa fa-ban"></i></button>
                  </div>
                  <div class="col-2">
                    <button type="submit"><i class="fa fa-floppy-o"></i></button>
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
          <input type="file" name="" id="postp" style="display:none;" multiple>
            <textarea name="" class="form-control" id="" cols="30" style="border-radius: 50px;" placeholder="Write something here..." rows="10"></textarea>
            <!-- <input type="text" class="form-control" id="floatingInputValue" style="border-radius:150px; height: 70px;"> -->
            <!-- <label for="floatingInputValue">Write something here....</label> -->
            <div class="row">
              <div class="col-6">
                <button type="button" class="btn btn-dark mt-2 uploadphotos" style="border-radius:50px; width:100%;">Upload Photos</button>
                <button type="button" class="btn btn-primary modal" style="display:none;" data-toggle="modal" data-target="#exampleModal">
                  Launch demo modal
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                  <div class="modal-dialog">
                    <div class="modal-content" style=" border-radius:10px;">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="">
                          <input type="text" name="" id="" class='form-control' style="border-radius:100px;" placeholder="Something about the post...">
                          <img src="" alt="xzfdz" id="preview" >
                        </form>
                        
                      </div>
                      <br>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary">Post</button>
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
        </div>
      </div>
    </div>
    <!-- Optional JavaScript; choose one of the two!

          Option 1: Bootstrap Bundle with Popper
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

          Option 2: Separate Popper and Bootstrap JS
          
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

<script>
  $('#test').change(function(e) {
    var files = $('.uploadp')[0].files;
    // console.log(files);

    var fd = new FormData();
    // Append data 
    fd.append('file', files[0]);
    //  fd.append('_token',CSRF_TOKEN);
    // console.log(fd);
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
        // $('#olddp').removeClass('.profile');
        // $('#olddp').addClass('.re-profile');
        // $('#newdp').addClass('profile');
        $("#olddp").attr("src", filesrc);
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
        // $('#olddp').removeClass('.profile');
        // $('#olddp').addClass('.re-profile');
        // $('#newdp').addClass('profile');
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
  $('#postp').change(function(e){
    var files = $(this)[0].files;
    console.log(files);
    var fd = new FormData();
    fd.append('file', files[0]);
        $.ajax({
      url: "/preview",
      method: 'post',
      data: fd,
      contentType: false,
      processData: false,
      success: function(response) {
        console.log(response);
        let filesrc = "/uploads/posts/" + response;
        $("#preview").attr("src", filesrc);
         $('.modal').click();
      }

    })
  })
</script>

</html>