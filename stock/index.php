<?php
include "connectdb.php";
session_start();
date_default_timezone_set("Asia/Bangkok");

if (@$_SESSION['username'] == "") {
  echo "<meta http-equiv='refresh' content='0; url=login.php'>";
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <div class="container text-center mt-3">
        <h1>Management Product</h1>
    </div>
    <div class="container  mt-3 ">
        <div class="d-flex justify-content-start"><h1>My Product</h1><a class="btn btn-danger  mt-1 m-3" href="logout.php">Log out</a></div>
        
        <div class="d-flex justify-content-end">
          <?php if($_SESSION['ath'] == "admin"){
            echo'<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Create Product</button>';
          } ?>
          </div>
    </div>
<table class="table shadow mt-3 rounded text-center">
  <thead>
    <tr>
      <th scope="col">ลำดับ</th>
      <th scope="col">ชื่อ</th>
      <th scope="col">รายละเอียด</th>
      <th scope="col">image</th>
      <th scope="col">คงเหลือ</th>
      <th scope="col">จัดการ Stock สินค้า</th>
      <?php if($_SESSION['ath'] == "admin"){
            echo'<th scope="col">จัดการสินค้า</th>';
          } ?>
      
      <!-- <th scope="col">จัดการรายละเอียดสินค้า</th> -->
    </tr>
  </thead>
  <tbody>
  <?php $sql = "SELECT * FROM product;";
  $query = mysqli_query($connection, $sql);
  $i = 1; ?>
    <tr>
    
  <?php foreach ($query as $value) { ?>
      <th scope="row"><?php echo $i++; ?></th>
      <td><?php echo$value['product_name']?></td>
      <td><?php echo$value['product_desc']?></td>
      <td><img style="width:80px;height: 80px;object-fit: cover;" src="<?php echo$value['img_link']?>" alt=""></td>
      <td><?php echo$value['qty']?></td>
      <td>
      <div class="btn-group" role="group" aria-label="Basic example">
      <button type="button" class="btn btn-warning text-white" data-bs-toggle="modal" data-bs-target="#add<?php echo$value['product_id']?>">เพิ่ม Stock สิ้นค้า</button>
      <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal" data-bs-target="#Edit<?php echo$value['product_id']?>">ขายออก</button>
  </div>
  </td>
  <?php if($_SESSION['ath'] == "admin"){
            echo'<td>
            <a  href="delectpd.php?id='.$value['product_id'].'" class="btn btn-danger m-1" ><i class="fa-solid fa-square-minus"></i></a>
            <a class="btn btn-warning m-1 text-white" type="button" class="btn btn-warning text-white" data-bs-toggle="modal" data-bs-target="#Editpd'.$value['product_id'].'"><i class="fa-solid fa-pen-to-square"></i></a>
          </td>';
          } ?>
  
    
    <!-- <td class="bg-secondary">
      <div class="btn-group" role="group" aria-label="Basic example">
      <button type="button" class="btn btn-warning text-white" data-bs-toggle="modal" data-bs-target="#edit<?php echo$value['product_id']?>">แก้ไข</button>
      <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal" data-bs-target="#delect<?php echo$value['product_id']?>">REMOVE</button>
  </div>
    </td> -->
    </tr>
    <!-- Modal -->
<div class="modal fade" id="add<?php echo$value['product_id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form action="add-qty.php" method="post">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <input type="hidden" name="product_id" value="<?php echo$value['product_id']?>">
        <h1 class="modal-title fs-5" id="exampleModalLabel">เพิ่ม Stock สิ้นค้า</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="input-group">
    <span class="input-group-text" id="basic-addon3">ชื่อสินค้า</span>
    <input type="text" class="form-control" value="<?php echo$value['product_name']?>" readonly>
  </div>
  <div class="input-group mt-1">
    <span class="input-group-text" id="basic-addon3">จำนวนที่มี</span>
    <input type="text" class="form-control" name="old_qty" value="<?php echo$value['qty']?>" readonly>
  </div>
      <div class="input-group mt-1">
    <span class="input-group-text" id="basic-addon3">จำนวนที่ต้องการเพิ่ม</span>
    <input type="text" class="form-control" value="" name="new_qty" >
  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Submit</button>
      </div>
    </div>
  </div>
  </form>
</div>
<!-- Modal -->
<div class="modal fade" id="reduce<?php echo$value['product_id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<form action="down-qty.php" method="post">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <input type="hidden" name="product_id" value="<?php echo$value['product_id']?>">
        <h1 class="modal-title fs-5" id="exampleModalLabel">ขายออก</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="input-group">
    <span class="input-group-text" id="basic-addon3">ชื่อสินค้า</span>
    <input type="text" class="form-control" value="<?php echo$value['product_name']?>" readonly>
  </div>
  <div class="input-group mt-1">
    <span class="input-group-text" id="basic-addon3">จำนวนที่มี</span>
    <input type="text" class="form-control" name="old_qty" value="<?php echo$value['qty']?>" readonly>
  </div>
      <div class="input-group mt-1">
    <span class="input-group-text" id="basic-addon3">จำนวนที่ขายออก</span>
    <input type="text" class="form-control" value="" name="new_qty" >
  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Submit</button>
      </div>
    </div>
  </div>
  </form>
</div>

<!-- Modal -->
<div class="modal fade" id="Editpd<?php echo$value['product_id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <form action="update_product.php" method="post">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Product</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <input type="hidden" name="product_id" value="<?php echo$value['product_id']?>">
      <label for="" class="form-label">Edit Name</label>
<input type="text" class="form-control" name="name"  value="<?php echo$value['product_name']?>">
<label for="" class="form-label">Edit Description</label>
<textarea type="text" name="desc" class="form-control" aria-label="With textarea"><?php echo$value['product_desc']?></textarea>
<label for="" class="form-label">จำนวนสินค้า</label>
<input type="text" class="form-control" name="qty" value="<?php echo$value['qty']?>">
<label for="" class="form-label">Url Image</label>
<input type="text" class="form-control" name="img_link" value="<?php echo$value['img_link']?>">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Create</button>
      </div>
    </div>
  </div>
  </form>
</div>
    <?php }?>
  </tbody>
  
</table>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <form action="insert_product.php" method="post">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Product</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <label for="" class="form-label">Create Name</label>
<input type="text" class="form-control" name="name">
<label for="" class="form-label">Create Description</label>
<textarea type="text" name="desc" class="form-control" aria-label="With textarea"></textarea>
<label for="" class="form-label">จำนวนสินค้า</label>
<input type="text" class="form-control" name="qty">
<label for="" class="form-label">Url Image</label>
<input type="text" class="form-control" name="img_link">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Create</button>
      </div>
    </div>
  </div>
  </form>
</div>




</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</html>