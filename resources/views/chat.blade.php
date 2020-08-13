

    <!DOCTYPE html>
<html>
<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <title></title>
   <link rel="stylesheet" href="resources\views\style.css">
   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="resources\views\chat.css">
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
  <!-- top menu -->
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
              <input type="text" name="search" class="ltr" style="background-color:   white">
              <input type="submit" value="search" style="float: right;background-color:   cyan" class="ltr" >

            </form>
          
          </li>
         
          <form class="form-inline my-2 my-md-0"> </form>
      </div>
  </nav>
  <!-- end -->
  <div id="wrapper" class="toggled">
      <!-- Sidebar -->
      <div id="sidebar-wrapper">
          @include('menu')
      </div> <!-- /#sidebar-wrapper -->
      <!-- Page Content -->
      <div id="page-content-wrapper">

                          <!--  -----------------------START OF CHAT PORTION---------------------------- -->


          <div class="container-fluid">
<h3 class=" text-center" style="color:  yellow; font-weight: 700;padding-top: 10px;
padding-bottom: 10px" >MESSENGER</h3>
<div class="messaging">
      <div class="inbox_msg">
        <div class="inbox_people">
          <div class="headind_srch">
            <div class="recent_heading">
              <h4>Recent</h4>
            </div>
            <div class="srch_bar">
              <div class="stylish-input-group">
                <input type="text" class="search-bar"  placeholder="Search" >
                <span class="input-group-addon">
                <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                </span> </div>
            </div>
          </div>
               
                    <!--  start of chatbox where we can see our friend -->    
          <div class="inbox_chat"  style="background-color: moccasin"> 

              @foreach($row as $r)

              <?php  


        $c=DB::table('user')->where('id','=',$r->sender_id)->where('id','!=',$uid)->orwhere('id','=',$r->reciver_id)->where('id','!=',$uid)->get();



               ?>
          

        <div class="chat_list ">

          <!-- ---------START----------------FOREACH LOOP AFTER CONDITION CHECK FROM USER TABLE----------------------------------- -->
                      @foreach($c as $k)

                  <a href="chatdetails{{$k->id}}">

              <div class="chat_people">
                <div class="chat_img"> <img src="{{url('/')}}/pic/{{$k->image}}" alt="sunil" > </div>
                <div class="chat_ib">



        <!--START ----------PERTICULAR J MSG KORECHE AND ISREAD IS 0 AND TAR PASE MSG NUMBER DEKHABE----------------- -->                  
                  <?php $ruids=Session::get('uid');

              $cntmsgs = DB::table('chats')->where('reciver_id', $ruids)->where('sender_id', $k->id)->where('isread',0)->get(); 

                   ?>


                  <h5 style="color: red; margin-right:40px; " >{{$k->name }}<span class="badge badge-pill badge-primary" style="text-indent:0 !important; "><?php echo count($cntmsgs); ?></span></h5>


        <!--END ----------PERTICULAR J MSG KORECHE AND ISREAD IS 0 AND TAR PASE MSG NUMBER DEKHABE----------------- -->                  
         
                </div>
              </div>
            </a>
                          @endforeach
         <!-- --------END----------------------FOREACH LOOP AFTER CONDITION CHECK FROM USER TABLE----------------------------------- -->
           

            </div>

            @endforeach
        
        </div>

          <!--    end of inbox chat -->
        </div>
        <div class="mesgs">
          <div class="msg_history">
            
            
            </div>
          </div>
         
          </div>
        </div>
      </div>
      
      
     
      
    </div></div>
    <!-- -------------------------END OF CHAT--------------- -->
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

</body>
</html>