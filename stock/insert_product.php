<?php
$name = $_POST['name'];
$desc = $_POST['desc'];
$qty = $_POST['qty'];
$img_link = $_POST['img_link'];

include 'connectdb.php';
$sql = "INSERT INTO `product` (`product_id`, `product_name`, `product_desc`,`qty`,`img_link`) VALUES (NULL, '$name', '$desc', '$qty', '$img_link');";

if (mysqli_query($connection, $sql)) {
  header("Location:index.php?page=new");
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($connection);
}
?>