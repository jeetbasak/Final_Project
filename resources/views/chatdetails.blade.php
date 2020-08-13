
<html>
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="resources\views\chat.css">
<link rel="stylesheet" type="text/css" href="resources\views\chat.css">
<style type="text/css">
  
  body{

      background-image: url('https://mk0omfourop3d6at17y.kinstacdn.com/wp-content/uploads/grapes.jpg');
    background-size: cover;
  }
</style>
</head>
<body>
<div class="container">
<h3 class=" text-center" style="color:  yellow; font-weight: 700;padding-top: 10px;
padding-bottom: 10px">MESSENGER</h3>
<div class="messaging">
      <div class="inbox_msg">
        <div class="inbox_people">
          <div class="headind_srch">
            <div class="recent_heading">
              
               <a href="chat"> <i class="fa fa-arrow-circle-left" style="font-size:24px"></i></a>
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
          <div class="inbox_chat" style="background-color: moccasin"> 

            <!--  this foreach is comming from controller -->
              @foreach($row as $r)

              <?php  


        $c=DB::table('user')->where('id','=',$r->sender_id)->where('id','!=',$uid)->orwhere('id','=',$r->reciver_id)->where('id','!=',$uid)->get();



               ?>
          

        <div class="chat_list ">

          <!-- ---------START----------------FOREACH LOOP AFTER CONDITION CHECK FROM USER TABLE----------------------------------- -->
                <!-- this foreach from this page -->
                      @foreach($c as $k)

          <a href="chatdetails{{$k->id}}">
              
              <div class="chat_people " >




                <!-- BACKGROUND COLOUR OF ACTIVE ONE -->

                <?php  if(($id==$r->sender_id || $id==$r->reciver_id) && $id!=$uid){ ?> 
                  
                    <div class="chat_people " style="background-color: plum">      <?php  } else{  ?>

                       <div class="chat_people " > <?php } ?>






                <div class="chat_img"> <img src="{{url('/')}}/pic/{{$k->image}}" alt="sunil" > </div>
                <div class="chat_ib">
                  <h5 style="color: red; text-align: right;">{{$k->name }} <span class="chat_date" style="margin-left: 5px"> ID:{{$k->id}}</span></h5>
                      </div>
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
        <div class="mesgs" >
          <div class="msg_history" id='msghistory' style="background-image:url('') ">



          </div>


          <div class="type_msg">


            <form  id="frm" >
           @csrf
              <input type="hidden" name="rid" value="{{$id}}">

              <textarea type="text" class="write_msg" placeholder="Type a message" name='msg' id="msg" style="width: 600px; height: 70px"></textarea>
              <button class="msg_send_btn" type="button"onclick="chatsend()"><i class="fa fa-paper-plane-o" aria-hidden="true" ></i></button>
          </form>


          </div>
        </div>
        <form id="forsetintervel">
          @csrf
          <input type="hidden" name="rid" value={{$id}}>

        </form>
      </div>
      
      
      <p class="text-center top_spac"> Design by <a target="_blank" href="#">JEET BASAK</a></p>
      
    </div></div>
    </body>

<script type="text/javascript">
  
function chatsend(){

/*var j= $('#msg').val();
console.log(j);*/
$.ajax({

url:"http://localhost/piclara/chatdb",
method:'POST',
data:$('#frm').serialize(),
success:function(res){

 // alert('sent');

  $('#msghistory').html(res);
  /*now i want the msgbox to be emty after sent the msg*/
  $('#msg').val(null);
}

});

}

//refresh in every 3 sec
setInterval(function(){ 
$.ajax({
     url:'http://localhost/piclara/bb',
     type:'POST',
     data:$("#forsetintervel").serialize(),
     success:function(res){
 $("#msghistory").html(res);
         

     }
     });
 }, 1000);



</script>










    </html>