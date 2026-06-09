<!DOCTYPE html>
<?php
    session_start();
    if(!isset($_SESSION["username"])){
        header("Location: login.php");
    }

    $con=mysqli_connect("localhost","root","","chat_application");
    if(!$con){
        die("unable to connect database");
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <title>dashboard</title>
</head>
<body class="">
    <div class="row p-0 m-0">
        <div class="col-md-4 bg-dark text-light vh-100" >
            <div class="bg-primary p-2  w-100">
                <h4><i class="bi bi-person-circle"></i> <?php echo $_SESSION["username"]; ?></h4>
            </div>
            <div style="height:500px" class="overflow-auto">
                <?php  
                    $query="select username from users";
                    $result=mysqli_query($con,$query);
                    while($users=mysqli_fetch_assoc($result)){
                        if($users['username'] != $_SESSION['username']){
                            echo "
                                <a class='text-white text-decoration-none' href='dashboard.php?receiver={$users['username']}'>
                                    <div class='border-bottom p-2'>
                                        {$users['username']}
                                    </div>
                                </a>
                                    
                            ";
                        }

                    }
                ?>
            </div>  
        </div>
        <div class="col-md-8 p-0 m-0 position-relative vh-75">
            <div class="d-flex justify-content-between bg-primary p-3">
                <h3><?= $_GET["receiver"]?? "Hi" ?></h3>
                <a href="logout.php" class="btn btn-danger"><i class="bi bi-box-arrow-right "></i></a>
            </div>

            <div class="p-3 overflow-auto" style="height:450px" id="chatBox">
                <?php
                if(!empty($_GET["receiver"])){
                    $sender=$_SESSION["username"];
                    $receiver=$_GET["receiver"];
                    $query="select * from messages where (sender='$sender' and receiver='$receiver') or (sender='$receiver' and receiver='$sender') order by date_time  ";
                    $result=mysqli_query($con,$query);
                    while($row=mysqli_fetch_assoc($result)){
                        if($row['sender']==$_SESSION["username"]){
                            $position="justify-content-end";
                        }else{
                            $position="justify-content-start";
                        }
                         if(in_array($row['extension'],["jpg","png","jpeg","webp","gif"])){
                            $file_path=$row['file_path'];
                            echo "
                                <div class='d-flex $position'>
                                    <div class='card my-2'>
                                        <a href='$file_path' target='blank' class='card-body'>
                                            <img src='$file_path' style='width:300px'>
                                        </a>
                                    </div>
                                </div>";
                        }
                        if(in_array($row['extension'],["mp4","avi","mov","wmv","mkv","webm","flv","mpeg","mpg","3gp"])){
                            $file_path=$row['file_path'];
                            echo "
                                <div class='d-flex $position'>
                                    <div class='card my-2'>
                                        <a href='$file_path' target='blank' class='card-body'>
                                           <video src='$file_path'  style='width:300px' controls>
                                        </a>
                                    </div>
                                </div>";
                        }
                        if(in_array($row['extension'],["mp3","wav","aac","ogg","flac","m4a","wma"])){
                            $file_path=$row['file_path'];
                            echo "
                                <div class='d-flex $position'>
                                    <div class='card my-2'>
                                        <a href='$file_path' target='blank' class='card-body'>
                                           <audio src='$file_path'  style='width:300px' controls>
                                        </a>
                                    </div>
                                </div>";
                        }
                        if($row['message']!=""){
                            echo "
                                <div class='d-flex $position'>
                                    <div class='card mb-2 mt-2'>
                                        <p class='card-body'>{$row['message']}</p>
                                    </div>
                                </div>
                            ";
                        }
                        

                    }
                }
                ?>
            </div>

            <script>
                const chatBox=document.getElementById("chatBox");
                chatBox.scrollTop=chatBox.scrollHeight;
            </script>

            <div class="position-absolute bottom-0 start-0 end-0 card bg-info">
                <form method="post" enctype="multipart/form-data" action="sendMessage.php?receiver=<?= $_GET['receiver'] ?? ""  ?>" class="d-flex gap-2 p-2 card-body">
                    <input type="text" class="form-control" name="msg">
                    <input type="file" name="file" class="form-control w-25">
                    <?php
                        if(empty($_GET["receiver"])){
                            echo "<button class='btn btn-success' disabled>send</button>";
                        }
                        else{
                             echo "<button class='btn btn-success'><i class='bi bi-send-fill text-white'></i></button>";
                        }
                    ?>
                    
                </form>

            </div>
        </div>
    </div>
</body>
</html>