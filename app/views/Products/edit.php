<?php 
echo "<br>";
print_r($info[0]['image']);
?>
<form method='post' action="<?=ROOT?>products/update/<?=$info[0]['id']?>" enctype='multipart/form-data'>

<select name='cat_id[]' multiple class="form-select">
<option value=''>Select One</option>

<?php 
foreach($catdata as $value) {
?>
<option value=<?=$value['id']?>  <?= (in_array($value['name'],$category_data))?'selected':'';?> > <?=$value['name']?> </option>
<?php 
} ?>

</select>

<label for='name'>Name</label>
<input type="text" name="name" id='name' class="form-control" placeholder='type name of product' value='<?=$info[0]['pro_name']?>'>

<label for="cost">Cost</label>
<input type="number" class="form-control" name="cost" placeholder='type cost per kg.' id='cost' value='<?=$info[0]['cost']?>'>

<label for='description'>Description</label>
<textarea name="description" id='description' placeholder='type description of product' class="form-control"><?=$info[0]['description']?> </textarea>

<label for='brand'>Brand</label>
<input type="text" class="form-control" name="brand" id='brand' placeholder='type brand' value='<?=$info[0]['brand']?>'>

<label for='stock' class='mt-3'>Number of Stock</label>
<input type="number" name="stock" id='stock' class="form-control" placeholder='type number of stock' value='<?=$info[0]['stock']?>' class='form-control'>

<label for='grading' class='mt-3'>Select grading</label>

<select name='grading' class="form-select">
<option value=''>Select One</option>
<option value='low'  <?= ($info[0]['grading']=='low')?'selected':'' ?>>Low</option>
<option value='medium' <?= ($info[0]['grading']=='medium')?'selected':'' ?>>Medium</option>
<option value='high' <?= ($info[0]['grading']=='high')?'selected':'' ?>>High</option>

</select>

<label for='file'>Edit new file</label>
<input type='file' class="form-control" name='image' id='file'>
<input type='hidden'  name='oldimage' value="<?php echo $info[0]['image'] ?>" >
<div class='container text-center'>
<button class='btn btn-primary mt-3'>ok </button>
</div>
</form>


