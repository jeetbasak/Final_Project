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
     
      background-image: url('https://mk0omfourop3d6at17y.kinstacdn.com/wp-content/uploads/grapes.jpg');
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
		<div class="row">
			<div style="width: 100%; height: 400px;background-image: url('https://i.ytimg.com/vi/7-RQ5_D9paU/maxresdefault.jpg');margin-top: 0px">//here background picture
				
				<div>
		               <!-- start of 1st foreach(row) -->
					@foreach($row as $r)

							 <img src="{{url('/')}}/pic/{{$r->image}}"  alt="dp" style="width:500px; height:350px ; margin-top: 120px ; border-radius: 200px; float: center;" >
					               <h2 style="color:lawngreen; text-align: center; font-weight: 900;">{{$r->name}}</h2>
					




		   </div>
		  <!--      ------- ------------START----------------- ADD FRIEND BUTTON --------------------- ---------- -------- -->

         <div>
         	
              <?php  
              // checking if friendreq alreadyb send or not 

             $f=DB::table('friends')->where('reciver_id','=',$r->id)->where("sender_id","=",$session)->where('status','=','1')->get();
                 $fcnt=count($f);
               ?>





                @if($fcnt>0)
                 <span class="btn btn-primary" style="color:white;margin-left:670px; border-radius:300px;margin-top: 30px; margin-bottom: 5px; text-align: center; " >REQUEST SENT</span>
                 <!-- cancel friend rquest send -->
                 <button style="margin-left:685px; border-radius:300px;margin-top: 1px; margin-bottom: 20px;color: white " class="btn canclebtn"><a href="http://localhost/piclara/friendreqcancel/{{$r->id}}" style="
                 cursor: default;color: white;font-weight: 700;font-size: 18px; ">cancel</a></button> 
         	       @endif




           <!--------   now this portion for them to whom friend request send. they can accept or delete the request------ -->
                        <!-- here the session is reciver_id of database-->

          <?php  
             
         $l=DB::table('friends')->where('reciver_id','=',$session)->where("sender_id","=",$r->id)->where('status','=','1')->get();
                 $ck=count($l);
             ?>


             @if($ck>0)



                      <!--   this form is for accept the request and update the status to '2' -->
        <form action="http://localhost/piclara/accept" method="post">
        	@csrf
        	<input type="hidden" name="acceptid" value="{{$r->id}}">

                 <input type="submit" value="ACCEPT" class="btn btn-info" style=" text-align: center;margin-left:695px; border-radius:300px;margin-top: 10px; margin-bottom: 20px ">
        </form>
                       <!--------------------  Accept form end    --------------->




                 <!-- cancel friend rquest send -->
                 <button style="margin-left:685px; border-radius:300px;margin-top: 1px; margin-bottom: 20px;color: white " class="btn declinebtn"><a href="http://localhost/piclara/friendreqcancel2/{{$r->id}}" style="
                 cursor: default;color: white;font-weight: 700; text-align: center;font-size: 18px">DECLINE</a></button> 

             @endif





            <?php  
              // checking if status is 2 or not .................

             $m=DB::table('friends')->where('reciver_id','=',$r->id)->where("sender_id","=",$session)->where('status','=','2')->get();
                 $m1=count($m);
            ?>

            <?php
               $n=DB::table('friends')->where('reciver_id','=',$session)->where("sender_id","=",$r->id)->where('status','=','2')->get();
                 $n1=count($n);

                 //checking done here....................
             ?>
               
                      <!-- if any of above is true then they are friend to each other -->
                @if($m1>0 || $n1>0 )

        <span class=" btn friendbtn" style="margin-left:700px; border-radius:300px;margin-top: 30px; text-align: center; margin-bottom: 5px " >FRIEND</span>
         <a href="{{url('/')}}/unfriend/{{$r->id}}" style="float: right; margin-right: 40px;color: white; text-align: 500">UNFRIEND</a>

               @endif







               @if($fcnt==0 && $ck==0 && $m1==0 && $n1==0 )
             <form action="http://localhost/piclara/friendreqsend" method="post">
         		@csrf
         	<input type="hidden" name="rid" value="{{$r->id}}">
         	<input type="hidden" name="rname" value="{{$r->name}}">

         	<input type="submit" value="ADD FRIEND" class="btn addbtn" style="margin-left:685px; text-align: center; border-radius:300px;margin-top: 30px; margin-bottom: 20px " >
                 
            </form>


               @endif
         </div>
          <!--      ------- -------------END--------------- ADD FRIEND BUTTON --------------------- ---------- -------- -->
                      @endforeach
			   
                      <!-- end of 1st foreach(row) -->











      <!-----------------start-------------Uploded picture means gallery on main page --------------------- ---------- -------- -->
			
					<div ><!-- start of 2nd foreach (row1) -->
						@foreach($row1 as $r1)
						<div class="col-md-3">
							<div class="row" style="margin-bottom: 10px">
					              {{$r1->id}}
					<img src="{{url('/')}}/upldimg/{{$r1->image}}" style="width:340px;height: 300px; "  data-toggle="modal" 
					data-target="#pic{{$r1->id}}" >

					</div>

               <!--------end--------- ------------------Uploded picture on main page --------------------- ---------- -------- -->
				





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

<?php 

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
		<i class="glyphicon glyphicon-star-empty" style="color: white;margin-top: 20px;font-size: 30px;margin-left: 40px;" 
     
     onclick="like('{{$r1->id}}')" ></i>
 </span>
    
                         @endif

                          @if($cnt>0)
       <span id="btn{{$r1->id}}">             
		<i class="glyphicon glyphicon-star" style="color: blue;margin-top: 20px;font-size: 30px;margin-left: 40px;" 
     
     onclick="removelike('{{$r1->id}}')" ></i>
        </span>
   
                         @endif

               <!-----------------------  now count the total likes --------------->

                          <?php

						$alredyliked = DB::table('likes')->where("picid","=",$r1->id)->get();
						//print_r($cnt);
						$cn1=count($alredyliked);
						?>

                        <span id="sl{{$r1->id}}">{{$cn1}}</span>
               <!----------------------  end of count the total likes --------------->

    <!--  <input type="submit" name=""> -->
     </form>


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
					<!-- end of 2nd foreach (row1) -->


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

//targrt the like span tag and changing the color after hit the like of the perticular picture using {{$r->id}}

$('#btn'+id).html("<i class='glyphicon glyphicon-star' style='color: blue;margin-top: 20px;font-size: 30px;margin-left: 40px' onclick='removelike("+id+")' ></i>");
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
$('#btn'+id).html("<i class='glyphicon glyphicon-star-empty' style='color: white;margin-top: 20px;font-size: 30px;margin-left: 40px; ' onclick='like("+id+")'></i>");
$("#sl"+id).html(res);
//star with double court and in between use single coute

}

});

}	










</script>


</body>
</html>