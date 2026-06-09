<?php
    session_start();
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $con=mysqli_connect("localhost","root","","chat_application");
        if(!$con){
            die("unable to connect database");
        }
        $username=$_POST["username"];
        $email=$_POST["email"];
        $password=$_POST["password"];
        $confirm_password=$_POST["confirm_password"];
        if($password==$confirm_password){
            $query="insert into users(username,email,password) values('$username','$email','$password')";
            if(mysqli_query($con,$query)){
                $_SESSION["username"]=$username;
                header("Location: dashboard.php");
            }
            else{
                header("Location: registerForm.php?msg=username already taken");
            }
        }else{
            header("Location: registerForm.php?msg=password must be same");
        }

    }
?>