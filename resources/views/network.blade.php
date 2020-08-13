<!DOCTYPE html>
<html dir="ltr">
<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title></title>
   <link rel="stylesheet" href="resources\views\style.css">
</head>
<style type="text/css">
  body {
     
      background-image: url('https://mk0omfourop3d6at17y.kinstacdn.com/wp-content/uploads/grapes.jpg');
    background-size: cover;
}
.ltr{
direction: ltr;
}

</style>
<body>
  
  <nav class="navbar navbar-expand navbar-dark bg-primary"> <a href="#menu-toggle" id="menu-toggle" class="navbar-brand"><span class="navbar-toggler-icon"></span></a> <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>

      <div class="collapse navbar-collapse" id="navbarsExample02">

  <a href="#">
    <img src="{{url('/')}}/pic/{{Session::get('img')}}"  class="img" alt="dp" style="width:40px; margin-right: 20px">
  </a>
   <h2 style="color: black; font-size: 20px;margin-left: 10px; margin-right: 10px"> {{Session::get('uname')}}</h2><h2>ID:{{Session::get('uid')}}</h2>
  
          <ul class="navbar-nav mr-auto">
           <li>
            <form action="search" method="post" class="ltr">
              @csrf
              <input type="text" name="search" style="background-color:   powderblue" >
              <input type="submit" value="search" style="float: right;background-color:   cyan" >

            </form>
         
          <form class="form-inline my-2 my-md-0"> </form>
      </div>
  </nav>
  <div id="wrapper" class="toggled">
      <!-- Sidebar -->
      <div id="sidebar-wrapper">
         
         @include('menu')



      </div> <!-- /#sidebar-wrapper -->
      <!-- Page Content -->
      <div id="page-content-wrapper">
          <div class="container-fluid" style="color: white;">
              <h1 style="text-align: center;">NETWOR PANNEL</h1>
              
       <table class="table table-striped">
            <thead>
              <tr >
                <!-- <th style="text-align: left" >ADD FRIEND</th>
                <th style="text-align: left">IMAGE</th>
                <th style="text-align: left">NAME</th>
              </tr> -->
            </thead>
            <tbody>
               @foreach($row as $r)
               <?php

               $myid=Session::get('uid');

     $fnd=DB::table('friends')->where('sender_id','=',$r->id)->where('reciver_id','=',$myid)->where('status','=',2)->orwhere('sender_id','=',$myid)->where('reciver_id','=',$r->id)->where('status','=',2)->get();
        
        $j=count($fnd);
              ?>
  

     @if($j==0)
              <!--  for those r->id the count is 0.. it will print the record who are not in friendlist  -->
              <tr >
                <td style="text-align: left">
                  <!-- making the form for send friend req -->
                    <form id="f{{$r->id}}">
                      @csrf
                    <input type="hidden" name="rid" value="{{$r->id}}">
                    <input type="hidden" name="rname" value="{{$r->name}}">

                    <?php 
       $s=DB::table('friends')->where('sender_id','=',$myid)->where('reciver_id','=',$r->id)->where('status','=',1)->get();
        $t=count($s);
                     ?>
                     @if($t==0)

            <span id="s{{$r->id}}"> <i class='fas fa-user-plus' style='font-size:24px; color:cyan' onclick="addfriend('{{$r->id}}')" ></i> </span>
                      @endif

                       @if($t>0)

            <span id="s{{$r->id}}"> <i class='fa fa-user-times' style='font-size:24px' onclick="cancelfriend('{{$r->id}}')" ></i> </span>
                      @endif


                      </form>     


                </td>
                <td style="text-align: left"><a href="details/{{$r->id}}"style="text-decoration:none"><img src="{{url('/')}}/pic/{{$r->image}}" style="width:100px; margin-top:10px; border-radius:360px; border:3px solid white"></a></td>
               <td style="text-align: left"><a href="details/{{$r->id}}"style="text-decoration:none; color: white">{{$r->name}}</a></td>
              
              </tr>
      @endif
     



              <!-- it will print who are in friend list and count is more than 0 or 1 -->
              @if($j==1)

              <tr >
                
                <td style="text-align: left">FRIEND</td>
                <td style="text-align: left"><a href="details/{{$r->id}}"style="text-decoration:none"><img src="{{url('/')}}/pic/{{$r->image}}" style="width:100px; margin-top:10px; border-radius:360px; border:3px solid white"></a></td>
               <td style="text-align: left"><a href="details/{{$r->id}}"style="text-decoration:none; color: white">{{$r->name}}</a></td>
              
              </tr>
              @endif
              @endforeach
            </tbody>
          </table>

             



              
               </div>
      </div> <!-- /#page-content-wrapper -->
  </div> <!-- /#wrapper -->
        <!-- Bootstrap core JavaScript -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script> <!-- Menu Toggle Script -->
        <script>
          $(function(){
            $("#menu-toggle").click(function(e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });

            $(window).resize(function(e) {
              if($(window).width()<=768){
                $("#wrapper").removeClass("toggled");
              }else{
                $("#wrapper").addClass("toggled");
              }
            });
          });
           
        </script>
   
  </html>

  <script type="text/javascript">
    
function addfriend(id){
$.ajax({
url:'http://localhost/piclara/friendreqsend',
method:'POST',
data:$('#f'+id).serialize(),  // id of that pic
success:function(res){

//alert('request sent');

$('#s'+id).html("<i class='fa fa-user-times' style='font-size:24px'  onclick='cancelfriend("+id+")'></i>");
}

});

}

  </script>

 <script type="text/javascript">
    
function cancelfriend(id){
 //alert('hi');
$.ajax({
url:'http://localhost/piclara/cancel',
method:'POST',
data:$('#f'+id).serialize(),  // id of that pic
success:function(res){

//alert('deleted');

$('#s'+id).html("<i class='fas fa-user-plus' style='font-size:24px; color:cyan' onclick='addfriend("+id+")'></i>");
}

});

}

  </script>

</body>
</html>