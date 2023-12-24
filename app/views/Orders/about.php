<?php 

// print_r($data);
?>


<table class='table'>
    <tr>
        <th>S.No.</th>
        <th>Product Name</th>
        <th>Product Price</th>
        <th>Bill no.</th>
        <th>Quantity</th>
        <th>Address ( Given at the time of order)</th>
        <th>Date of order</th>
        <th>Date of delivery</th>
        <th>Image</th>
        <?php 
        if($_SESSION['admin']['is_admin'] == 'yes'){?>
        <th>Delete</th>
        <?php } ?>


    <?php 
    $index = 1; 
    foreach($data as $value){ ?>
    <tr>
        <td><?=$index++?></td>
        <td><?=$value['product_name']?></td>
        <td><?=$value['product_price']?></td>
        <td><?=$value['bill_no']?></td>
        <td><?=$value['product_quantity']?></td>
        <td><?=$value['address']?></td>
        <td><?=$value['date_of_order']?></td>
        <?php if($value['delivery_time'] < date('Y-m-d')){ ?>
            <td> <span style="color:green;background-color:skyblue;padding:2px">ordered on <br><?=$value['delivery_time'] ?> </span> </td>
        <?php } else{?>
        <td>Will arrive on:- <?=$value['delivery_time']?></td>
        <?php } ?>
        <td>  <a target='_blank' href='<?=ROOT?>public/image/<?=$value['image']?>'> <img src='<?=ROOT?>public/image/<?=$value['image']?>' height='100px'> </a></td>
        <?php
        if($_SESSION['admin']['is_admin'] == 'yes'){
        ?>
        <td><a class="btn btn-primary" href="<?=ROOT?>orders/delete/<?=$value['id']?>">Delete</a></td>
       <?php } ?>
  
    </tr>
    <?php } ?> 
</table>
