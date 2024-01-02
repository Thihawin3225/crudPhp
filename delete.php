<?php
require 'config.php';
$stmt =$pdo->prepare("DELETE FROM post WHERE id=".$_GET['id']);
$result = $stmt->execute();
if($result){
    header("Location:home.php");
}

