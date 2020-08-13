<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="resources\views\photo.css">
<title></title>
<style type="text/css">
 body {
     background-image: url('https://answers.unity.com/storage/temp/135164-fade.png');
    background-size: cover;
}
</style>
</head>
<body>

<div id="mySidenav" class="sidenav" style="background-color:transparent;">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="#">
    <img src="{{url('/')}}/pic/{{Session::get('img')}}"  class="img" alt="dp" style="width:50px; margin-top:10px; border-radius:360px; border:3px solid white">
  </a>
   <h3 style="color:white; font-size: 20px;margin-left: 20px"> {{Session::get('uname')}}</h3>
   <hr>
  <a href="{{url('/')}}/welcome">BACK</a>
  <a href="#">Services</a>
  <a href="#">Clients</a>
  <a href="{{url('/')}}/logout">LOGOUT</a>
</div>
<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>

<div class="container">
  <h2 style="color: white;">YOUR FRIENDLIST</h2>
          
  <table class="table table-hover">
    <thead>
      <tr>
      <!--   <th style="color: white;">Firstname</th>
        <th style="color: white;">Lastname</th> -->
      </tr>
    </thead>

@foreach($row as $r)

<?php
$myid= Session::get('uid');

$fl=DB::table('user')->where('id','=',$r->sender_id)->where('id','!=',$myid)->orwhere('id','=',$r->reciver_id)->where('id','!=',$myid)->get();

?>

    @foreach($fl as $k)
   
    <tbody>
      <tr>
        
      	 <td ><a href="details/{{$k->id}}"><img src="{{url('/')}}/pic/{{$k->image}}" style="width: 350px;height: 200px;"></a></td>
        <td style='font-size: 30px'>{{$k->name}}</td>
      </a>
      </tr>
     
     
    </tbody>

    @endforeach

    @endforeach
  </table>
</div>








</body>
<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>
</html>