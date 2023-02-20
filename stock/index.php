<?php
include "connectdb.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <div class="container text-center mt-3">
        <h1>Management Product</h1>
    </div>
    <div class="container  mt-3 ">
        <div class="d-flex justify-content-start"><h1>My Product</h1></div>
        
        <div class="d-flex justify-content-end"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Create Product</button></div>
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
      <td><img style="width:100px;" src="https://www.freepik.com/free-photo/computer_1017081.htm#query=computer&position=0&from_view=search&track=sph" alt=""></td>
      <td><?php echo$value['qty']?></td>
      <td>
      <div class="btn-group" role="group" aria-label="Basic example">
      <button type="button" class="btn btn-warning text-white" data-bs-toggle="modal" data-bs-target="#add<?php echo$value['product_id']?>">เพิ่ม Stock สิ้นค้า</button>
      <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal" data-bs-target="#reduce<?php echo$value['product_id']?>">ขายออก</button>
  </div>
    <!-- </td>
    <td class="bg-secondary">
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
<label for="" class="form-label">Upload Image</label>
<input type="file" class="form-control" aria-label="Upload">
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