<!DOCTYPE html>
<html>
<head>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-2.1.3.min.js"></script>
<style type="text/css">
  body {
     background: url('https://www.desktopbackground.org/download/800x600/2014/12/02/865110_rainbow-full-screen-hd-wallpaper-best-backgrounds-hd-free_2560x1440_h.jpg') fixed;
    background-size: cover;
}

*[role="form"] {
    max-width: 530px;
    padding: 15px;
    margin: 0 auto;
    border-radius: 0.3em;
    background-color: #f2f2f2;
}

*[role="form"] h2 { 
    font-family: 'Open Sans' , sans-serif;
    font-size: 40px;
    font-weight: 600;
    color: #000000;
    margin-top: 5%;
    text-align: center;
    text-transform: uppercase;
    letter-spacing: 4px;
}
.hi{
  margin-top: 200px
}


</style>
  <title></title>
</head>
<body>

@if(Session::has('msg'))
<strong style="margin-left: 600px; background-color: red; font-size: 20px" >{{Session::get('msg')}}</strong> 
@endif

<div class="container">
            <form class="form-horizontal hi" role="form" action="logincheck" method="post" style="background-color: violet !important; border-radius: 50px">
              @csrf
                <h2>LOGIN</h2>
               
                
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email* </label>
                    <div class="col-sm-9">
                        <input type="email" name="email" placeholder="Email" class="form-control" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Password*</label>
                    <div class="col-sm-9">
                        <input type="password" name="password" placeholder="Password" class="form-control">
                    </div>
                </div>

                <input type="submit" class="btn btn-primary btn-block" value="Login">
                <a href="{{url('/')}}" class="btn-block" style="color: black">NEW USER.. DO REGESTER</a>
            </form> <!-- /form -->
        </div> <!-- ./container -->

</body>
</html>