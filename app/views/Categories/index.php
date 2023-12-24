<h3 >Categories</h3>


<?php 
if( isset($_SESSION['admin']['is_admin'])  && $_SESSION['admin']['is_admin'] == 'yes'){ ?>

<a class='btn btn-primary' href="<?=ROOT?>categories/create"> Create Category </a>

<?php } ?>



<table class='table'>
    <tr>
        <th>S.No.</th>
        <th>Category Name</th>
        <th>Action</th>
    </tr>

    <?php $index = 1; 
    foreach($data as $value){ ?>
    <tr>
        <td><?=$index++?></td>
        <td><?=$value['name']?></td>
        <td><a class='btn btn-warning' href="<?=ROOT?>categories/edit/<?=$value['id']?>">Edit </a></td>
        <td><a class='btn btn-danger' href="<?=ROOT?>categories/deleteCat/<?=$value['id']?>">Delete </a></td>
    </tr>
    <?php } ?>
</table>

