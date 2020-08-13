<!DOCTYPE html>
<html>
<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>

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
.anim{


width: 300px !important;
height: 400px;
    margin-top: 40px;
    margin-right: 430px !important;
    animation: up-down 2s ease-in-out infinite alternate-reverse both;
 

}

@-webkit-keyframes up-down{
0%{
    transform: translateY(10px);
   }
100%{
    transform: translateY(-10px);
    }
}


@keyframes up-down{

0%{
    transform: translateY(20px);

}
100%{
    transform: translateY(-20px);
    
}

}

.ml5 {
  position: relative;
  font-weight: 300;
  font-size: 4.5em;
  color: #402d2d;
}

.ml5 .text-wrapper {
  position: relative;
  display: inline-block;
  padding-top: 0.1em;
  padding-right: 0.05em;
  padding-bottom: 0.15em;
  line-height: 1em;
}

.ml5 .line {
  position: absolute;
  left: 0;
  top: 0;
  bottom: 0;
  margin: auto;
  height: 3px;
  width: 100%;
  background-color: #402d2d;
  transform-origin: 0.5 0;
  background-color: yellow;
}

.ml5 .ampersand {
  font-family: Baskerville, serif;
  font-style: italic;
  font-weight: 400;
  width: 1em;
  margin-right: -0.1em;
  margin-left: -0.1em;
}

.ml5 .letters {
  display: inline-block;
  opacity: 0;
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
              <form action="search" method="post" class="ltr" >
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
          <div class="container-fluid" style="color: white;">
              <h1>FACEAPP</h1>
              <p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas</p>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                        CHANGE DP
                      </button>

              <h1 class="ml5" style="text-align: center; direction: ltr"  >
                  <span class="text-wrapper">
                    <span class="line line1"style="color: white !important;"></span>
                    <span class="letters letters-left" style="color: white !important;color: yellow !important;">WELCOME</span>
                    <span class="letters ampersand"style="color: white !important;color:white !important;">&amp;</span>
                    <span class="letters letters-right" style="color: white !important; font-weight: 600; color: yellow !important;">{{Session::get('uname')}}</span>
                    <span class="line line2"style="color: white !important;"></span>
                  </span>
                </h1>

              <img src="{{url('/')}}/pic/{{Session::get('img')}}" class="img-fluid anim" style=" text-align: center;
        display: block;margin-right: 600px">
          </div>
      </div> <!-- /#page-content-wrapper -->
  </div> <!-- /#wrapper -->





        <!-- ----------------Bootstrap core JavaScript ------------------------------->
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
   <!-- -------------------------END OD SIDEBAR------------------------ -->




<script type="text/javascript">
  
  anime.timeline({loop: true})
  .add({
    targets: '.ml5 .line',
    opacity: [0.5,1],
    scaleX: [0, 1],
    easing: "easeInOutExpo",
    duration: 700
  }).add({
    targets: '.ml5 .line',
    duration: 600,
    easing: "easeOutExpo",
    translateY: (el, i) => (-0.625 + 0.625*2*i) + "em"
  }).add({
    targets: '.ml5 .ampersand',
    opacity: [0,1],
    scaleY: [0.5, 1],
    easing: "easeOutExpo",
    duration: 600,
    offset: '-=600'
  }).add({
    targets: '.ml5 .letters-left',
    opacity: [0,1],
    translateX: ["0.5em", 0],
    easing: "easeOutExpo",
    duration: 600,
    offset: '-=300'
  }).add({
    targets: '.ml5 .letters-right',
    opacity: [0,1],
    translateX: ["-0.5em", 0],
    easing: "easeOutExpo",
    duration: 600,
    offset: '-=600'
  }).add({
    targets: '.ml5',
    opacity: 0,
    duration: 1000,
    easing: "easeOutExpo",
    delay: 1000
  })
</script>

<!-- model start for dp change -->
<div class="modal" id="myModal" >
  <div class="modal-dialog" >
    <div class="modal-content" style="background-color: transparent !important;">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title" style="color: white; font-weight: 700; direction: ltr !important">CHOSEE PROFILE PICTURE</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" >
        <form class="form-horizontal hi" role="form" action="dp" method="post" enctype="multipart/form-data">
              @csrf               
                <div class="form-group">
                    <label for="image" class="col-sm-3 control-label">Photos*</label>
                    <div class="col-sm-9">
                        <input type="file" name="image"  class="form-control">
                    </div>
                </div>

                <input type="submit" class="btn btn-primary btn-block" value="upload">
                
            </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
</body>
</html>