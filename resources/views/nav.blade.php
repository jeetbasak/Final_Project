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