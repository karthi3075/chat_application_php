<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body class="vh-100 bg-dark d-flex justify-content-center align-items-center ">
    <div class="card bg-transparent shadow w-25">
        <form action="registration.php" method="post" class="card-body d-flex flex-column gap-2">
            <h1 class="text-center text-white">Register</h1>
            <p class="text-danger text-center"><?= $_GET["msg"] ?? "" ?></p>
            <div>
                <label for="" class="form-label text-white fs-5">Enter name</label>
                <input type="text" class="form-control" name="username" required>
            </div>
            <div>
                <label for="" class="form-label text-white fs-5">Enter email</label>
                <input type="email" class="form-control" name="email" required>
            </div>
             <div>
                <label for="" class="form-label text-white fs-5">Enter password</label>
                <input type="password" class="form-control" name="password" required>
            </div>
             <div>
                <label for="" class="form-label text-white fs-5">Enter confirm password</label>
                <input type="password" class="form-control" name="confirm_password" required>
            </div>
            <!-- <a href="./dashboard.html" class="btn btn-success" >register</a> -->
            <button class="btn btn-success">Register</button>
            <p>already have an accont? <a href="./login.php">login</a></p>
        </form>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</html> 