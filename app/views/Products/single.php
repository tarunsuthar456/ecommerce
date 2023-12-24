<a class="btn btn-primary" href="<?=ROOT?>products">All products</a>

<?php 
if($message){
    ?>
    <h2 class="h2 text-secondary text-center">No product found</h2>
    <?php
    exit();
}

?>
    <h3 class="text-center bg-info p-3 m-4">Results for <?=$name?></h3>

<table class='table'>
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
        <th>Edit</th>
        <th>Delete</th>
        <?php } ?>


    <?php       

    if(isset($_SESSION['admin'])  && $_SESSION['admin']) {?>
        <th>Add to carts</th>
        <?php } ?>  
    </tr>


    <?php
    
    $index = 1; 
    foreach($category as $value){ 
        ?>
        
    <tr>
        <td><?=$index++?></td>
        <td><?=$totalcategories?></td>
        <td><?=$value['brand']?></td>
        <td><?=$value['pro_name']?></td>
        <td><?=$value['description']?></td>
        <td><?=$value['cost']?></td>
        <td><?=$value['grading']?></td>
        <td> <a target='_blank' href='<?=ROOT?>public/image/<?=$value['image']?>'> <img src='<?=ROOT?>public/image/<?=$value['image']?>' height='100px'> </a></td>
       
        <?php if(isset($_SESSION['admin']['is_admin'])  && $_SESSION['admin']['is_admin'] == 'yes'){ ?>
            <td> <a class='btn btn-primary' href="<?=ROOT?>products/edit/<?=$value['id']?>">Edit</a></td>
            <td> <a class='btn btn-danger' href="<?=ROOT?>categories/delete/<?=$value['cat_id']?>?proId=<?=$value['id']?>">Delete</a></td>
        <?php } ?>
        
        <?php
            if(isset($_SESSION['admin'])  && $_SESSION['admin']) {?>
            <td> <a class='btn btn-warning' href="<?=ROOT?>carts/store/<?=$value['id']?>">Add to cart</a></td>
        <?php } ?>
    
    </tr>
    <?php } ?> 
</table>