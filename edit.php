<?php
    require 'config.php';
    session_start();
if(empty($_SESSION['$user_id']) || empty($_SESSION['loginTime'])){
    header('location:login.php');
    exit();
}
if($_POST){
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $created_at = $_POST['created_at'];
    $id = $_GET['id'];

    if($_FILES){
      $targetFile = 'images/'.$_FILES['file']['name'];
      $filepath = pathinfo($targetFile,PATHINFO_EXTENSION);
      if($filepath != 'jpg' && $filepath != 'PNG'){
        echo "<script>alert('image must be jpg or png or git')</script>";
      }else{
        move_uploaded_file($_FILES['file']['tmp_name'],$targetFile);
        $stmt = $pdo->prepare("UPDATE post SET title='$title',description='$desc',created_at='$created_at',image='$targetFile' WHERE id=$id");
        $result = $stmt->execute();
      }
    }else{
      $stmt = $pdo->prepare("UPDATE post SET title='$title',description='$desc',created_at='$created_at' WHERE id=$id");
    $result = $stmt->execute();
    }
    if($result){
      echo "<script>alert('Update is Successful')</script>";
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

</head>
<style>
    .container{
          margin-top: 30px;
          width: 400px;
          border: 1px solid black;
          padding : 20px;
    }
    form div{
        margin : 10px;
    }
</style>
<body>
<?php
$sql = "SELECT * FROM post WHERE id=".$_GET['id'];
$stmt = $pdo->prepare($sql);
$stmt->execute();
$row = $stmt->fetchAll();
// exit();
?>
<div class="container">
    <form action="" method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" class="form-control" value="<?php echo $row[0]['title'] ?>" name="title" placeholder="Enter Your Title">
      </div>
      <div class="mb-3">
        <label class="form-label">Description</label>
        <input type="text" value="<?php echo $row[0]['description'] ?>" class="form-control" name="desc" placeholder="Enter Your Description">
      </div>
      <div class="mb-3">
        <img src="<?php echo $row[0]['image'] ?>">
        <label class="form-label">File</label>
        <input type="file" class="form-control" name="file">
      </div>
      <div class="mb-3">
        <label class="form-label">Date</label>
        <input type="date" value="<?php echo $row[0]['created_at'] 
        ?>" name="created_at" class="form-control">
      </div>
      <div class="mb-3">
        <button type="submit" class="btn btn-info">Update</button>
      </div>
      <div class="mb-3">
        <button type="submit" class="btn btn-Danger"><a href="home.php">Back</a></button>
      </div>
    </form>
  </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</body>
</html>