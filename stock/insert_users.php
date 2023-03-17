<?php
$username = $_POST['username'];
$password = $_POST['password'];
$fullname = $_POST['fullname'];
$ath = $_POST['ath'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$address = $_POST['address'];
$gender = $_POST['gender'];
$date_of_birth = $_POST['date_of_birth'];

include 'connectdb.php';
$sql = "INSERT INTO `users` (`id`, `username`, `password`, `fullname`, `ath`, `phone`, `email`, `address`, `gender`, `date_of_birth`) 
VALUES (NULL, '$username', '$password', '$fullname', '$ath', '$phone', '$email', '$address', '$gender', '$date_of_birth');";

if (mysqli_query($connection, $sql)) {
  header("Location:Login.php?page=new");
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($connection);
}
?>
