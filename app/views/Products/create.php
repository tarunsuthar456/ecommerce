<div class="container">
<form method='post' class='form-control p-4' action='<?=ROOT?>products/store' enctype='multipart/form-data'>

<label for='select one'>Pick your categroy</label>

<select name='cat_id[]' id='select one' multiple class='form-select'>
<?php foreach($catdata as $value) {?>
<option value=<?=$value['id']?> > <?=$value['name']?> </option>
<?php }?>
</select>

<label for='name' class='mt-3'>Name</label>
<input type="text" name="name" id='name' placeholder='type name of product' class='form-control'>

<label for="description">Description</label>
<textarea id="description" name="description" class="form-control"></textarea>

<label for='cost' class='mt-3'>Cost</label>
<input type="number" name="cost" id='cost' placeholder='type cost per kg.' class='form-control'>

<label for='brand' class='mt-3'>Brand</label>
<input type="text" name="brand" id='brand' placeholder='type brand' class='form-control'>

<label for='delivery' class='mt-3'>Delivery Time</label>
<input type="number" name="delivery" id='delivery' placeholder='type days of delivery' class='form-control'>

<label for='stock' class='mt-3'>Number of Stock</label>
<input type="number" name="stock" id='stock' placeholder='type number of stock' class='form-control'>


<label for='select two' class='mt-3'>Select grading</label>

<select name='grading' id='select two' class='form-select'>
<option value=''>Select One</option> 
<option value='low'>Low</option>
<option value='medium'>Medium</option>
<option value='high'>High</option>

</select>

<label for='image' class='mt-3'>Select One</label>

<input type='file' name='image'  id='image' class='form-control'>

<button class='btn btn-primary mt-3'>Save </button>
</form>
</div>

