<a class="btn btn-primary" href="<?=ROOT?>products">All products</a>

<?php 
// print_r($likeData);
$newLikeData = array_column($likeData,'product_id');

if(isset($message) && $message){
    ?>
<div class='text-center h2 '><?=$message?></div>
    <?php
    exit();
}
?>

<datalist id="cate" class="categoryclass">
</datalist>

<div class="container" >
    <div class="row" >
      <div class="col-md-12" >
        <div class="data-list-container">
        <form method="post" action="<?=ROOT?>products/singleProduct">
        <input type="text" onkeyup="getCat(this.value)" list="cate" id="inputcat"  name="search">
        <datalist id="cate" >
                    
        </datalist>
        <!-- <button type="button" class="btn btn-primary" onclick='hello(inputcat.value)'>search</button> -->
        <button  class="btn btn-primary" >search</button>
        </form>
        </div>
      </div>
    </div>
</div>




<h3 class='text-center'>Products</h3>
<?php 
if( isset($_SESSION['admin']['is_admin'])  && $_SESSION['admin']['is_admin'] == 'yes'){ ?>

<a class='btn btn-primary' href="<?=ROOT?>products/create"> Create Product </a>

<?php } ?>


<?php
if(isset($_SESSION['admin'])  && $_SESSION['admin']) {?>
<a class='btn btn-warning float-end ' href="<?=ROOT?>carts"> Carts <span class='text-danger'><?=count($carts_data)?></span></a>
<?php } ?>

<table class='table table-bordered'>
    <tr>
        <th>S.No.</th>
        <th>Category Name</th>
        <th>Brand</th>
        <th>Product Name</th>
        <th>Description</th>
        <th>Cost (per kg.)</th>
        <th>Grading</th>
        <th>Image</th>

        <?php if(isset($_SESSION['admin']['is_admin'])  && $_SESSION['admin']['is_admin'] == 'yes'){ ?>
        <th>Stocks remaining</th>
        <th>Edit</th>
        <th>Hide</th>
        <th>Delete</th>
        <?php } ?>


    <?php       

    if(isset($_SESSION['admin'])  && $_SESSION['admin']) {?>
        <th>Add to carts</th>
        <?php } ?>  
    </tr>


    <?php
    
    $index = 1; 
    foreach($data as $value){ 
        ?>
        
    <tr>
  <!-- ❤️ Like -->
  <!-- <i class='fas fa-heart'></i>
  <i class="far fa-heart"></i> -->
        <td><?=$index++?></td>
        <td><?=$value['cat_name']?> 
    
        <span style="float:right">
            <?php if(isset($_SESSION['admin']) && $_SESSION['admin']){ ?>
            <button id='btn<?=$value['id']?>' class="<?=(in_array($value['id'],$newLikeData)) ?"btn btn-danger":"btn btn-outline-danger" ?>" onclick="like(<?=$value['id']?>)">
                <i class="<?=(in_array($value['id'],$newLikeData)) ?"fas fa-heart":"far fa-heart" ?>"></i>
            </button> <span class="bg-warning p-1 m-2 pb-2 btn btn-outline-danger rounded"><?=$value['total']?></span>
            <?php } else{ ?>
                <div class="bg-warning p-1 btn btn-outline-danger rounded"><?=$value['total']?> likes<div>
            <?php }?>

            </span>
        
        </td>
        <td><?=$value['brand']?></td>
        <td><?=($value['stock']<=0)?" <span style='color:red'> $value[pro_name] -- Out of stock</span>":"$value[pro_name]"?></td>
        <td><?=$value['description']?></td>
        <td><?=$value['cost']?></td>
        <td><?=$value['grading']?></td>
        <td> <a target='_blank' href='<?=ROOT?>public/image/<?=$value['image']?>'> <img src='<?=ROOT?>public/image/<?=$value['image']?>' height='100px'> </a></td>
       
        <?php if(isset($_SESSION['admin']['is_admin'])  && $_SESSION['admin']['is_admin'] == 'yes'){ ?>
            <td><?=$value['stock']?></td>
            <td> <a class='btn btn-primary' href="<?=ROOT?>products/edit/<?=$value['id']?>">Edit</a></td>
            <td> <a class='btn btn-danger' href="<?=ROOT?>products/hide/<?=$value['id']?>"><?=($value['hidden'] == 'no')?"Hide":"Unhide"?></a></td>
            <td> <a class='btn btn-danger' href="<?=ROOT?>categories/delete/<?=$value['cat_id']?>?proId=<?=$value['id']?>">Delete</a></td>
        <?php } ?>
        
        <?php
            if((isset($_SESSION['admin'])  && $_SESSION['admin']) && !($value['stock'] <= 0 )) {?>
            <td> <a class='btn btn-warning' href="<?=ROOT?>carts/store/<?=$value['id']?>">Add to cart</a></td>

        <?php } else{ ?>
            <td> <a class='btn btn-warning' href="javascript:alert('This is out of stock')">Add to cart</a></td>
            
        <?php } ?>
    </tr>
    <?php } ?> 
</table>

<?php 

if(!isset($data)){ ?>
    <div class='h3 text-center p-3  text-warning bg-dark'> No Products</div>
<?php } ?>




<!-- <script>
function store(id){
    let result = location.href=`<?=ROOT?>carts/checkproduct/${id}`;
    console.log(result);
    if(!result){
        alert("this product exists");
    }
    else{
    location.href=`<?=ROOT?>carts/store/${id}`;
        
    }
}
</script> -->

<script>
const ROOTS = "http://localhost/mvc/";

    function getCat(info){
    // console.log(info);
    $.ajax({
        type:'get',
        url:`${ROOTS}products/getCat`,
        data:{data:info},
        success:function(data){
            console.log(data)
            $('#cate').html(data);
        },
        error:function(){
            console.log("error");
        }

    })

}

function like(pro_id){
    location.href=`${ROOT}products/like/${pro_id}`;
}


// function like(pro_id){
//     $.ajax({
//         type:'get',
//         url:`${ROOT}products/like/${pro_id}`,
//         success:function(result){
//             const trimmed = result.trim()
//             alert(trimmed.length);
//             if(trimmed == "product unliked"){
//                 `btn${pro_id}`.innerHTML = 'liked';
//             }
//             else{
//                 console.log("liked");

//                 `btn${pro_id}`.innerHTML = 'Unliked';
//             }
            
//         },
//         error:function(error){
//             console.log(error);
//         }
//     })
// }

function hello(value){
const ROOTS = "http://localhost/mvc/";

    location.href=`${ROOTS}products/singleProduct/${value}`;
}
    </script>