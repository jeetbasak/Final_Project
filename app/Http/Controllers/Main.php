<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use DB;

class Main extends Controller
{
    public function reg(){
    	return view('reg');
    }


    public function submit(Request $r){
     

     $n=$r->name;
     $e=$r->email;
     $p=$r->password;
      //image insert.........................
     $c=$r->file('image');
     $fn=$c->getClientOriginalName();
     $ext=$c->getClientOriginalExtension();
     $size=$c->getSize();

     if(($ext=='jpg'|| $ext=='png' || $ext=='jpeg') && (($size/1024)<=2000)){

     $obj= new App\User();

     $obj->name=$n;
     $obj->email=$e;
     $obj->password=$p;
     $obj->image=$fn;
    

     $obj->save();
     $c->move("pic",$fn);
     return redirect('loginform');

    }
    }


    public function lgfrm(){
    	return view("login");
    }

    public function lgck(Request $r){
    $e=$r->email;
    $p=$r->password;

    $obj=App\user::where("email","=",$e)->where("password","=",$p)->get();

    if(count($obj)>0){

    	// session creation
       foreach ($obj as $k) {
       	$r->session()->put('uid',$k->id);
       	$r->session()->put('uname',$k->name);
       	$r->session()->put('img',$k->image);

       	return redirect('welcome');
       }

    }

    else{

    	$r->session()->flash('msg','incorrect username or password');
    		return redirect('loginform');
    }

    }


    public function welcome(Request $r){

    	if($r->session()->has('uid')){
    	return view('welcome');
    }
    else{
    	return redirect('loginform');
    }
    }
    



    public function logout(Request $r){
     
     $r->session()->forget('uid');
     $r->session()->forget('uname');
     $r->session()->forget('img');

     return redirect('loginform');

    }

//,,,,,,,,,-------------------------------------------============================--------------------------------------.,,,,


    public function photo(Request $r){

        $myid=$r->session()->get('uid');

        $j=App\pic::where('sid','=',$myid)->get();
        $w=array(

            'row'=>$j
        );

        return view('photo')->with($w);
    }





    public function picupload(Request $r){

        $myid=$r->session()->get('uid');
        $c=$r->file('image');

         $fn=$c->getClientOriginalName();
         $ext=$c->getClientOriginalExtension();
         $size=$c->getSize();


         if(($ext=='jpeg'||$ext=='png'||$ext=='jpg')&&($size/1024)<=2000){

            $obj=new App\pic();

            $obj->image=$fn;
            $obj->sid=$myid;

            $obj->save();

            $c->move('upldimg',$fn);

            return redirect('photo');
         }

    }




    public function delete(Request $r){
        $id=$r->id;

        $dlt=App\pic::find($id);


      //print_r($dlt->image);
        $img=$dlt->image;
        unlink('./upldimg/'.$img); // delete image from folder too


        $dlt->delete();

      return redirect('photo');

    }

    public function sview(){
        return view('search');
    }



    public function search(Request $r){

        $s=$r->search;

        $obj=App\user::where("name","like",$s.'%')->orwhere("email",'=',$s)->get();

        $w=array(
        'row'=>$obj
           );

        return view('search')->with($w);
    }





    public function details(Request $r){

        $id=$r->id;

         $obj=App\user::where("id",'=',$id)->get(); // get details from user table

         $obj1=App\pic::where("sid",'=',$id)->get();  // get details from image table

         $w=array(
        'row'=>$obj,
        'row1'=>$obj1,
        'session'=>$r->session()->get('uid')

           );

        return view('details')->with($w);
    }



//-------------------------------insertion of like in new database table------------------------------
    public function like(Request $r){
      $picid=$r->picid;
      $session=$r->session()->get('uid');

      //return $session;

      $obj= new App\like();

      $obj->picid=$picid;
      $obj->sid=$session;

      $obj->save();


           //for the count of like


        $sel=App\Like::where("picid","=",$picid)->get();
        echo count($sel);

    }


    //deletion of that perticular like that is already liked

     public function removelike(Request $r){
      $picid=$r->picid;
      $session=$r->session()->get('uid');

      //return $session;

      $obj= App\like::where("picid","=",$picid)->where("sid","=",$session)->delete();

           //after dlete the count of like

        $sel=App\Like::where("picid","=",$picid)->get();
        echo count($sel);

     }




      public function friendreqsend(Request $r){
       //return $r;

        $rid=$r->rid;
        $rname=$r->rname;
        $session=$r->session()->get('uid');
        $sname=$r->session()->get('uname');
        $status=1;

        $obj= new App\Friend();

        $obj->sender_id=$session;
        $obj->s_name=$sname;
        $obj->reciver_id=$rid;
        $obj->r_name=$rname;
        $obj->status=$status;


        $obj->save();

         return redirect('details/'.$rid);

        }





        public function unfriend(Request $r){


       $rid=$r->id;
       $session=$r->session()->get('uid');

        $j=DB::table('friends')->where('reciver_id','=',$rid)->where("sender_id","=",$session)->orwhere('reciver_id','=',$session)->where("sender_id","=",$rid)->delete();
     

             return redirect('details/'.$rid); 

        }





      public function friendreqcancel(Request $r){

       $rid=$r->id;
       $session=$r->session()->get('uid');
       
        $obj=App\Friend::where('reciver_id','=',$rid)->where("sender_id","=",$session)->delete();
     
             return redirect('details/'.$rid); //redirect details page with id in url

      }


      public function friendreqcancel2(Request $r){

       $rid=$r->id;
       $session=$r->session()->get('uid');
      
        
      $obj1=App\Friend::where('reciver_id','=',$session)->where("sender_id","=",$rid)->delete();

             return redirect('details/'.$rid); //redirect details page with id in url

      }





      public function accept(Request $r){

       $rid=$r->acceptid;
       $session=$r->session()->get('uid');

       //return $rid;
      
        
      $obj1=DB::table('friends')->where('reciver_id','=',$session)->where("sender_id","=",$rid)->update(['status'=>2]);

             return redirect('details/'.$rid); //redirect details page with id in url

      }





      //=-------------------------------------------- START OF CHART PORTION-----------------------------------------------------
       
       public function chat(Request $r){
        
        $session=$r->session()->get('uid');
        $nm=$r->session()->get('uname');

        $c=DB::table('friends')->where('sender_id','=',$session)->where('status','=','2')->orwhere('reciver_id','=',$session)->where('status','=','2')->get();

        //separetly need to use where after orwhere---------------------------------above
       
        $w=array(

            'row'=>$c,
            'uid'=>$r->session()->get("uid")
        );
          // return $w;
           return view('chat')->with($w);

         }



       
       public function chatdetails(Request $r){
        
        $session=$r->session()->get('uid');
        $id=$r->id;
//return $id;
        $c=DB::table('friends')->where('sender_id','=',$session)->where('status','=','2')->orwhere('reciver_id','=',$session)->where('status','=','2')->get();
        $w=array(

            'row'=>$c,
            'uid'=>$r->session()->get("uid"),
            'id'=>$id
        );
          // return $w;
           return view('chatdetails')->with($w);

         }




         public function chatdb(Request $r){

            //return $r;
            $rid=$r->rid;
            $nm=DB::table('user')->where('id','=',$rid)->get();
            $rname=$nm[0]->name;

            //return $rname;
            $sid=$r->session()->get('uid');
            $sname=$r->session()->get('uname');

            $msg=$r->msg;

            $obj = new App\Chat();

            $obj->msg=$msg;
            $obj->sender_id=$sid;
            $obj->s_name=$sname;
            $obj->reciver_id=$rid;
            $obj->r_name=$rname;
            $obj->isread=0;

            $obj->save();


            //now fetch the msg
            // sesion id can be in reciverid or senderid in database for that we need to check both case

            $fetch=DB::table('chats')->where('sender_id','=',$sid)->where('reciver_id','=',$rid)->orwhere('sender_id','=',$rid)->where('reciver_id','=',$sid)->get();


        //here session is reciving the msg means session is reciver_id and the other one is sending msg , so that on is senderid and update it to isread 1
              $upd=DB::table('chats')->where('sender_id','=',$rid)->where('reciver_id','=',$sid)->update(['isread'=>1]);

            $w=array(

                'row'=>$fetch,
                /*we need to send oue session id for seperate the chat background*/
                'sid'=>$sid,
                'rid'=>$rid

            );

            return view('inner')->with($w);


         }

         public function bb(Request $r){

            $rid=$r->rid;
            $sid=$r->session()->get('uid');

            $fetch=DB::table('chats')->where('sender_id','=',$sid)->where('reciver_id','=',$rid)->orwhere('sender_id','=',$rid)->where('reciver_id','=',$sid)->get();

           //here session is reciving the msg means session is reciver_id and the other one is sending msg , so that on is senderid and update it to isread 1
             $upd=DB::table('chats')->where('sender_id','=',$rid)->where('reciver_id','=',$sid)->update(['isread'=>1]);

            $w=array(

                'row'=>$fetch,
                /*we need to send oue session id for seperate the chat background*/
                'sid'=>$sid,
                'rid'=>$rid

            );

            return view('inner')->with($w);
         }



         public function dp(Request $r){

          $myid=$r->session()->get('uid');
         $c=$r->file('image');

         $fn=$c->getClientOriginalName();
         $ext=$c->getClientOriginalExtension();
         $size=$c->getSize();


         if(($ext=='jpeg'||$ext=='png'||$ext=='jpg')&&($size/1024)<=2000){

            $obj= App\user::where('id','=',$myid)->update(['image'=>$fn]);
            $c->move("pic",$fn);

              //CHANGE THE SESSION PICTURE INSTANTLYA

              $obj=App\user::where('id','=',$myid)->get();

                if(count($obj)>0){

                    // session creation
                   foreach ($obj as $k) {
                  
                    $r->session()->put('img',$k->image);

                    //return redirect('welcome');
                   }

                        return redirect('welcome');
                     }
                 }
             }


        public function friendlist(Request $r){
            $myid=$r->session()->get('uid');

            $fl=DB::table('friends')->where('sender_id','=',$myid)->orwhere('reciver_id','=',$myid)->get();

            $w=array(
                'row'=>$fl

            );

            return view('friendlist')->with($w);
        }
       

       public function network(Request $r){
            $myid=$r->session()->get('uid');

            $n=DB::table('user')->where('id','!=',$myid)->get();

            $w=array(
                'row'=>$n

            );

            return view('network')->with($w);

       }

       public function cancel(Request $r){

        $rid=$r->rid;

        $session=$r->session()->get('uid');

        $cn=DB::table('friends')->where('sender_id','=',$session)->where('reciver_id','=',$rid)->delete();



       }

       public function nf(Request $r){

         //$obj1=App\pic::all();
          $obj1=App\pic::inRandomOrder()->get();
         // $obj1=App\pic::all()->random(1)->first();

         $w=array('row1'=>$obj1);


        return view('newsfeed')->with($w);
       }



       
         

































}
