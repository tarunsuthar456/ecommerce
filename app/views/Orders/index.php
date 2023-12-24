<?php
$index = 1;
?>
<div class='text-center h2 '>Your order</div>
<table class='table table-stripped'>
    <thead>
        <tr>
        <th>S.no.</th>    
        <th>Bill Number</th>    
        <th>Total products</th>    
        <th>Total price</th>    
        <th>Delivery Date</th>    
    </tr>
    </thead>
<?php if(isset($total_price)){ ?>
    <tbody>
        
        <tr>
        <td><?=$index++?></td>
            <td><?=$bill_no?></td>
            <td><?=$total_products?></td>
            <td><?=$total_price?></td>
            <td><?=date('Y-m-d', time() + 86400 * $deliveryTime)?></td>

        </tr>
</tbody>
<?php } ?>
</table>

<input type="text" id="add" value="<?=$userdata['address']?>">
<div class='text-center'>
<a onclick="buy()" class='btn btn-warning'>Buy</a>
</div>

<script>
    function buy(){
        alert("product ordered");
        location.href=`<?=ROOT?>orders/store/<?=$bill_no?>?address=${add.value}`;

    }
    </script>