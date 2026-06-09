<?php
    session_start();
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $con=mysqli_connect("localhost","root","","chat_application");
        if(!$con){
            die("unable to connect database");
        }
        $sender=$_SESSION["username"];
        $receiver=$_GET["receiver"];
        $msg=$_POST["msg"] ?? null;
        $date_time=date("Y-m-d H:i:s");
        if(isset($_FILES['file']) && !empty($_FILES['file']['name'])){
            $filename=time()."_".$_FILES['file']['name'];
            $target="uploads/".$filename;
            $extension=pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
            move_uploaded_file($_FILES['file']['tmp_name'],$target);
        }else{
            $target=null;
            $extension=null;
        }
        $query="insert into messages(sender,receiver,message,date_time,file_path,extension) values('$sender','$receiver','$msg','$date_time','$target','$extension')";
        $result=mysqli_query($con,$query);
        header("Location: dashboard.php?receiver=$receiver");
    }
?>