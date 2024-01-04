<h3 class='text-center'>Dashboard</h3>

<?php 
// $categories = array_column($info,'name');
// $categories = array_unique($categories);

?>

<div class='row border' style='border"2px solid blue'>

    <?php foreach($data as $value) { ?>
    
    <div class='col-2'> <img class='mt-4' height='100px' src='<?=ROOT?>public/image/<?=$value['image']?>' alt='not Available'> </div>
    <div class='col-2 mt-3 ' >
        Name: <?= $value['name']?> 
        <br>
        Cost: <?= $value['cost']?>
        <br>
        Grading: <?= $value['grading']?>
        <br>
        Category: <?= $value[0]?>
    </div>
    <?php } ?>
</div>

<?php 

if(!isset($data) ){ ?>
    <div class='h3 text-center p-3  text-warning bg-dark'> No Products</div>
<?php } ?>


<script>
let ROOT = '<?=ROOT;?>';
function categories(name){

location.href=`${ROOT}/categories/show?name=${name}`;

//     $.ajax({
//     url:`${ROOT}/categories/show`,
//     type:'get',
//     data:`name=${name}`,
//     success:function(rs){
//         console.log(rs)
//     },
    
// })
}
</script>
