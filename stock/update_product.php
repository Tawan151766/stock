<?php

$product_id = $_POST['product_id'];
$name = $_POST['name'];
$desc = $_POST['desc'];
$qty = $_POST['qty'];
$img_link = $_POST['img_link'];
include 'connectdb.php';
$sql = "UPDATE `product` SET  `product_name` = '$name' , `product_desc`= '$desc',`qty`='$qty',`img_link`='$img_link'    WHERE `product`.`product_id` = $product_id;";

if (mysqli_query($connection, $sql)) {
  header("Location:index.php?page=new");
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($connection);
}
?>