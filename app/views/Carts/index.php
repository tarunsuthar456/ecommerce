<h3 class='text-center'>Carts</h3>

<div class='row border' style='border"2px solid blue'>
    <?php foreach($data as $value) { ?>

    <div class='col-2'> <img class='mt-4' height='100px' src='<?=ROOT?>public/image/<?=$value['image']?>' alt='not Available'> </div>
    <div class='col-2 mt-3 ' >
        Name: <?= $value['name']?> 
        <br>
        Price: <?= $value['price']?>
        <br>
        Quantity (in grams):
        <!-- <button onclick="down(quantity.value,<?=$value['carts_id']?>)">-</button> -->
        <input class='form-control' id="quantity" type='number' onchange="change(this.value,<?=$value['carts_id']?>)" value='<?= $value['quantity']?>';> 
        <!-- <button onclick="up(quantity.value,<?=$value['carts_id']?>)">+</button> -->
        <br>
        Total Price: <?= $value['total_price']?>
        <br>
        <a href='<?=ROOT?>carts/delete/<?=$value['carts_id']?>'  class='btn btn-primary'>Delete</a>
    </div>
    <?php } ?>
    
</div>


<?php if(count($data)){ ?>

<div class='text-center p-4'>
<a class='btn btn-success' href="<?=ROOT?>orders/index/<?=$deliveryTime?>" >Order Now </a>
</div>
<?php } 
else{ ?>

<div class='h3 text-center p-3  text-warning bg-dark'> No Products in Carts</div>

<?php } ?>

<script>
function change(value,carts_id){
    console.log(value);
    location.href=`<?=ROOT?>carts/change?value=${value}&carts_id=${carts_id}`;
}

// function up(value,carts_id){
//     value =Number(value) +1;
//     location.href=`<?=ROOT?>carts/change?value=${value}&carts_id=${carts_id}&task=up`;

// }

// function down(value,carts_id){
//     if(value == 1){
//         alert("can not go under 1");
//     }
//     else{
//     value =Number(value) -1;
//     location.href=`<?=ROOT?>carts/change?value=${value}&carts_id=${carts_id}&task=down`;
//     }
// }
</script>

