<?php
$old_qty = $_POST['old_qty'];
$new_qty = $_POST['new_qty'];
$result = $old_qty - $new_qty;
$product_id = $_POST['product_id'];
include 'connectdb.php';
$sql = "UPDATE `product` SET `qty` = $result WHERE `product`.`product_id` = $product_id;";

if (mysqli_query($connection, $sql)) {
  header("Location:index.php?page=new");
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($connection);
}
?>