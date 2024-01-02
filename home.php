<?php
require 'config.php';
session_start();
if(empty($_SESSION['$user_id']) || empty($_SESSION['loginTime'])){
    header('location:login.php');
    exit();
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous"

</head>
<body>
    
    <section>
    <table class="table caption-top">
 <button class="btn btn-danger"><a href="add.php">Create New</a></button>
 <button class="btn btn-dark"><a href="logout.php">Logout</a></button>
  <thead>
    <?php
        $sql = "SELECT * From post";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
    ?>
    <tr>
      <th scope="col">id</th>
      <th scope="col">title</th>
      <th scope="col">description</th>
      <th scope="col">Created_at</th>
      <th scope="col">action</th>
    </tr>
  </thead>
  <tbody>
    <?php
        if($result){
            foreach ($result as $key) {
        ?>
        <tr>
      <th scope="row"><?php echo $key['id']?></th>
      <td><?php echo $key['title'] ?></td>
      <td><?php echo $key['description'] ?></td>
      <td><?php echo date('y-m-d',strtotime($key['created_at'])) ?></td>
      <td><button class="btn btn-success"><a href="edit.php?id=<?php echo $key['id']?>">Edit</a></button></td>
      <td><button class="btn btn-primary">
        <a href="delete.php?id=<?php echo $key['id']?> ">Delete</a>
    </button></td>
    </tr>
        <?php
            }
        }
    ?>
    
  </tbody>
</table>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>