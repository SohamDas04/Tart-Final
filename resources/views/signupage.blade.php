<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title></title>
  </head>
  <body>
      <div class="container-fluid" style="width: 100%;">
        <div class="row">
            <div class="col-8">
                1 of 2
            </div>
        <div class="col-4">
        <div class="card" style="width: 18rem;margin-left: 120px; margin-top:150px; length: 800px; border: solid transparent;">
            <div class="card-body">
                <h3 class="card-title">Card title</h3>
                <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                <form action="" id="sform">
                    @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" minlength="3">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" minlength="8">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" minlength="8">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" minlength="4">
                </div>
                <div class="mb-3">
                    <label for="confirm" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm" name="confirm">
                    <div id="prompt" class="form-text" style="display:none;">Both the passwords should match!</div>
                </div>
                <br>
                <div class="d-grid gap-2 col-12 mx-auto">
                    <button class="btn btn-primary" type="submit">Sign Up</button>
                </div>
                <br>
                <div class="d-grid gap-2 col-12 ">
                    <a href="/login" button class="btn btn-primary" type="button">Log in</button></a>
                </div>
                </form>
            </div>
            </div>
        </div>
  </div>
      </div>
   

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->

  </body>
    <script src="/JS/jQuery.js"></script>
    <script src="/JS/bootstrap.js"></script>
    <script src="/JS/popper.js"></script>
    <script>
        $("#sform").submit(function(e){
            e.preventDefault();
            let name=$('#name').val();
            let username=$('#username').val();
            let password=$('#password').val();
            let cpassword=$('#confirm').val();
            let email=$('#email').val();
            if(password!=cpassword){
                $('#prompt').css('display','block');
                return false;
            }
            mydata={
                name: name,
                uname: username,
                p: password,
                cp: cpassword,
                email:email
            }
            console.log(mydata);
            $.ajax({
                url : "/signup",
                method: 'POST',
                data: JSON.stringify(mydata),
                success:function(data){
                    console.log(data);
                }
            })

        })
    </script>
</html>