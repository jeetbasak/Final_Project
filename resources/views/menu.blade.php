
          <ul class="sidebar-nav">
              <li class="sidebar-brand"> <a href="welcome"> HOME </a> </li>
              <li> <a href="photo">PHOTOS</a> </li>
              <?php  
              $ruid=Session::get('uid');

              $cntmsg = DB::table('chats')->where('reciver_id', $ruid)->where('isread',0)->get(); 

              ?>
              <li> <a href="chat"><span class="badge badge-pill badge-danger" style="text-indent:0 !important;  "><?php echo count($cntmsg); ?></span>  MESSANGER </a> </li>
              <li> <a href="friendlist">FRIEND LIST</a> </li>
              <li> <a href="network">NETWORKS</a> </li>
              <li> <a href="nf">NEWSFEED</a> </li>
              <li> <a href="#">Services</a> </li>
              <li> <a href="logout">LOGOUT</a> </li>
          </ul>
    