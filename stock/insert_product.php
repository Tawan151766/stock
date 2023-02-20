<?php
$name = $_POST['name'];
$desc = $_POST['desc'];
$qty = $_POST['qty'];

include 'connectdb.php';
$sql = "INSERT INTO `product` (`product_id`, `product_name`, `product_desc`,`qty`) VALUES (NULL, '$name', '$desc', '$qty');";

if (mysqli_query($connection, $sql)) {
  header("Location:index.php?page=new");
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($connection);
}
?>