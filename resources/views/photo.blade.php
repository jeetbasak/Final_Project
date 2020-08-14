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
</head>
<body style="color: white">

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="#">
    <img src="{{url('/')}}/pic/{{Session::get('img')}}"  class="img" alt="dp" style="width:50px; margin-top:10px; border-radius:360px; border:3px solid white">
  </a>
   <h3 style="color:white; font-size: 20px;margin-left: 20px"> {{Session::get('uname')}}</h3>
   <hr>
  <a href="{{url('/')}}/welcome">BACK</a>
   <a href="network">NETWORKS</a> 
 <a href="nf">NEWSFEED</a> 
  <a href="{{url('/')}}/logout">LOGOUT</a>
</div>
<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>


<div class="container">
  
  <!-- MODAL OPEN FOR UPLOAD IMAGE-->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" style="float: right; border-radius: 360px;">Upload Images</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style="background-color: black; border:1px solid white;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color: white;">Upload Images</h4>
        </div>
        <div class="modal-body"style="color: white;">
          <form class="form-horizontal hi" role="form" action="picupload" method="post" enctype="multipart/form-data">
              @csrf               
                <div class="form-group">
                    <label for="image" class="col-sm-3 control-label">Photos*</label>
                    <div class="col-sm-9">
                        <input type="file" name="image"  class="form-control">
                    </div>
                </div>

                <input type="submit" class="btn btn-primary btn-block" value="upload">
                
            </form> <!-- /form -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
<br>
<div class="container"> 

	<div class="row">
		@foreach($row as $r)
		<div class="col-md-3">
			<div class="row" style="margin-bottom: 10px">
	


{{$r->id}}
<img src="{{url('/')}}/upldimg/{{$r->image}}" style="width:240px;height: 300px; "  data-toggle="modal" 
data-target="#mypic{{$r->id}}" >

</div>
</div>
@endforeach
</div>
</div>

	@foreach($row as $r)
<!--  ----------------------------------------------ZOON IMAGE AND DELETE IMAGE IN A MODAL----------------------     -->

<!--   ------------------------------------JE PIC TA DEKHBO TAR ID SEND THROUGH MODAL DATA TARGET---------------------------- -->

<!-- --------------------------------------- WE CAN USE SAME DATA USING 2 FOREACH LOOP IN SAME PAGE ------------------- -->

<!-- Modal start-->
  <div class="modal fade" id="mypic{{$r->id}}" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style="background-color: black; border:1px solid white;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color: white;"> Images</h4>
        </div>
        <div class="modal-body"style="color: white;">
         

      <h5> Photo ID: {{$r->id}} </h5>

      <!------------------------------------------DELETE PICTURE ------------------------------------------ -->
      <a href="delete/{{$r->id}}" class="btn btn-danger" style="float: right; border-radius: 360px; ">DELETE</a>
      
       <img src="{{url('/')}}/upldimg/{{$r->image}}" style="width:350px; height: 480px; margin-left:100px" >

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div><!-- modal end -->
@endforeach











<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>
   
</body>
</html> 

