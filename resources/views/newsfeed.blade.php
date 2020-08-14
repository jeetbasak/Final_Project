<!DOCTYPE html>
<html>
<head> 
 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="resources\views\photo.css">
  <title></title>
	<style type="text/css">
  body {
     
      background-image: url('https://venngage-wordpress.s3.amazonaws.com/uploads/2018/09/Minimalist-Crumpled-Paper-Simple-Background-Image.jpg');
    background-size: cover;
     background-repeat: no-repeat;
  background-attachment: fixed;
}
img {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 40%;
}
.friendbtn{

background-color:yellow;
width: 100px;
font-weight: 900;
color: black;
 text-align: center;

}
.canclebtn{
	background-color:magenta;
width: 100px;
font-weight: 900;
color: black;
}
.declinebtn{
background-color:darkmagenta;
}
.addbtn{
	background-color:cyan;
	font-weight: 900;
}
.hr{
border: 1px solid orange;

}
</style>
</head>
<body>
	<nav class="navbar navbar-inverse">

  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand">{{Session::get('uname')}}</a>
      <ul style="float: left">
    <img src="{{url('/')}}/pic/{{Session::get('img')}}"  alt="dp" style="width:50px; height:50px;  margin-right: 20px">
  </ul>
     
  
    </div>

    <ul class="nav navbar-nav" style="float: right">
      <li><a href="{{url('/')}}/welcome">HOME</a></li>
      <li><a href="{{url('/')}}/photo">MY GALLERY</a></li>
      <li><a href="#">Page 2</a></li>
      <li><a href="{{url('/')}}/logout">LOGOUT</a></li>
    </ul>
  </div>
</nav>
  
	

	<div class="container-fluid">
		
                  

      <!-----------------start-------------Uploded picture means gallery on main page --------------------- ---------- -------- -->
			
					<div ><!-- start of 1st foreach (row1) -->
						@foreach($row1 as $r1)


 <?php  

$n=DB::table('user')->where('id','=',$r1->sid)->get();

  ?>


                 
						<div class="col-md-12">
              @foreach($n as $p)

             <span> <h5 style="color: black; margin-left: 100px;font-weight: 900;font-size: 40px">{{$p->name}}</h5>
               <img src="{{url('/')}}/pic/{{$p->image}}" style="width:80px;height: 50px; border-radius: 360px ;margin-right: 750px;margin-left: 50px" ></span>
							<div class="row" style="margin-bottom: 10px">
					   
				<a href="{{url('/')}}/upldimg/{{$r1->image}}">	<img src="{{url('/')}}/upldimg/{{$r1->image}}" style="width:380px;height: 400px; margin-right: 750px"  data-toggle="modal"data-target="#pic{{$r1->id}}" ></a>
					</div>

               <!--------end--------- ------------------SHOW picture on main page --------------------- ---------- -------- -->







<!--       --------START------------LIKE OPERATION START IN THE PAGE====------------------------------------------------------ -->
				<div>
      
<?php 
$session=Session::get('uid');
// counting of like for the perticular pic and session
$l=DB::table('likes')->where('picid','=',$r1->id)->where("sid","=",$session)->get(); //session is comes from controller detail fun
$cnt=count($l);
 
 //counting part end
?>


       <form action="http://localhost/piclara/like" method="post" id=lk{{$r1->id}}>
         @csrf
        <input type="hidden" name="picid"  value="{{$r1->id}}"><!-- id of that pic in value -->



                     
                          <!-- --------THE LIKE BUTTON WITH ID OF PERTICULAR PIC------->

                          @if($cnt==0)
  <span id="btn{{$r1->id}}">
    <i class="glyphicon glyphicon-star-empty" style="color: black;margin-top: 20px;font-size: 30px;margin-left: 330px;" 
     
     onclick="like('{{$r1->id}}')" ></i>
 </span>
    
                         @endif

                          @if($cnt>0)
       <span id="btn{{$r1->id}}">             
    <i class="glyphicon glyphicon-star" style="color: blue;margin-top: 20px;font-size: 30px;margin-left: 330px;" 
     
     onclick="removelike('{{$r1->id}}')" ></i>
        </span>
   
                         @endif

               <!-----------------------  now count the already total likes --------------->
                          <?php

            $alredyliked = DB::table('likes')->where("picid","=",$r1->id)->get();
            //print_r($cnt);
            $cn1=count($alredyliked);
            ?>

                        <span id="sl{{$r1->id}}">{{$cn1}}</span>
               <!----------------------  end of count the total likes --------------->
     </form>    
        </div>
        <!-------- --------END------------LIKE OPERATION END IN THE PAGE---------------------------------------------- -->

        <hr class="hr">
          @endforeach





<!---------------------------------------------------PICTURE Modal start -------------------------------------------->
  <div class="modal fade" id="pic{{$r1->id}}" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style="background-color: black; border:1px solid white;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color: white;"> Images</h4>
        </div>
        <div class="modal-body"style="color: white;">
         

      <h5> Photo ID: {{$r1->id}} </h5>
      
       <img src="{{url('/')}}/upldimg/{{$r1->image}}" style="width:350px; height: 480px; margin-left:100px" >

                  <!----------END----------ONLY PICTURE AND ID SHOW COMPLETED------------------ -->

<!--       --------START------------LIKE OPERATION START WITHIN THE MODAL before modal footer--------------------------------- -->
<!--       --------END------------LIKE OPERATION END WITHIN THE MODAL before modal footer--------------------------------- -->

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>

  </div><!----------------------------------------------- modal BODY end -------------------------------------------------->
					</div>
     
					@endforeach
					</div>
					<!-- end of 1st foreach (row1) -->


	        </div>

       </div>
	</div>

<script type="text/javascript">

function like(id){

//alert(id);
$.ajax({

url:'http://localhost/piclara/like',
method:'POST',
data:$('#lk'+id).serialize(),
success:function(res){

//alert(res);// respone is success .......................backend work successfully



$('#btn'+id).html("<i class='glyphicon glyphicon-star' style='color: blue;margin-top: 20px;font-size: 30px;margin-left: 330px;' onclick='removelike("+id+")' ></i>");
 //$("#btn"+id).html("<i class='fas fa-heart' style='font-size:20px;color:red' onclick='removelike("+id+")' ></i>");
//now counting the total likes
 $("#sl"+id).html(res);


}


});


}




function removelike(id){

//---------------------THIS IS FOR DELETE OR REMOVE THE LIKE of that perticulae picid-----------------------

$.ajax({

url:'http://localhost/piclara/removelike',
method:'POST',
data:$('#lk'+id).serialize(),  // id of that pic
success:function(res){

//alert('deleted '+res);
$('#btn'+id).html("<i class='glyphicon glyphicon-star-empty' style='color: black;margin-top: 20px;font-size: 30px;margin-left: 330px; ' onclick='like("+id+")'></i>");
$("#sl"+id).html(res);
//star with double court and in between use single coute

}

});

}	










</script>


</body>
</html>