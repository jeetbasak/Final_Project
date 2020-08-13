<!DOCTYPE html>
<html dir="ltr">
<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
          <ul class="sidebar-nav">
              <li class="sidebar-brand"> <a href="#"> Start Bootstrap </a> </li>
              <li> <a href="{{url('/')}}/photo">PHOTOS</a> </li>
              <li> <a href="#">Shortcuts</a> </li>
              <li> <a href="#">Overview</a> </li>
              <li> <a href="#">Events</a> </li>
              <li> <a href="#">About</a> </li>
              <li> <a href="#">Services</a> </li>
              <li> <a href="{{url('/')}}/logout">LOGOUT</a> </li>
          </ul>
      </div> <!-- /#sidebar-wrapper -->
      <!-- Page Content -->
      <div id="page-content-wrapper">
          <div class="container-fluid" style="color: white;">
              <h1 style="text-align: center;">Search Result</h1>
              
               <table class="table table-striped">
                    <thead>
                      <tr >
                        <th style="text-align: left" >ADD FRIEND</th>
                        <th style="text-align: left">IMAGE</th>
                        <th style="text-align: left">NAME</th>
                      </tr>
                    </thead>
                    <tbody>
                       @foreach($row as $r)
                      <tr >
                        
                        <td style="text-align: left">j</td>
                        <td style="text-align: left"><a href="details/{{$r->id}}"style="text-decoration:none"><img src="{{url('/')}}/pic/{{$r->image}}" style="width:100px; margin-top:10px; border-radius:360px; border:3px solid white"></a></td>
                       <td style="text-align: left"><a href="details/{{$r->id}}"style="text-decoration:none; color: white">{{$r->name}}</a></td>
                      
                      </tr>
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

</body>
</html>