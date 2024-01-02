            <?php
                require 'config.php';
                if(!empty($_POST)){
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $sql = "SELECT COUNT(email) AS row FROM user WHERE email=:email";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindValue(':email',$email);
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if($row['row']>0){
                        echo "<script>alert('Your email is have alredy')</script>";
                    }else{
                        $hashPassword = password_hash($password,PASSWORD_BCRYPT);
                        $sql = "Insert Into user(name,email,password) values(:name,:email,:password)";
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindValue(':name',$name);
                        $stmt->bindValue(':email',$email);
                        $stmt->bindValue(':password',$hashPassword);
                        $result = $stmt->execute();
                        if($result){
                            echo "<script>alert('Register Success')</script>";
                        }
                    }
                }
            ?>

            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
                <!-- Latest compiled and minified CSS -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

            <!-- Optional theme -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

                <link rel="stylesheet" href="style.css">
            </head>
            <body>
            <div class="container">
            <div class="row justify-content-center">
            <div class="col-md-5">
            <div class="card">
                <h2 class="card-title text-center">Register</h2>
                <div class="card-body py-md-4">
                <form  action="register.php" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" placeholder="Name" name="name">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                        </div>
                                        
                                    
            <div class="form-group">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            </div>
            <div class="form-group">
                <input type="date" class="form-control"  id="confirm-password">
            </div>
            <div class="d-flex flex-row align-items-center justify-content-between">
                <a href="login.php">Login</a>
                                            <button class="btn btn-primary" type="submit">Register</button>
                    </div>
                </form>
                </div>
            </div>
            </div>
            </div>
            </div>
            <!-- Latest compiled and minified JavaScript -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

            </body>
            </html>