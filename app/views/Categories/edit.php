<h3 >Categories Create Form</h3>


<div class="container">
<form method='post' class='form-control p-4' action='<?=ROOT?>categories/update/<?=$info['id']?>' >


<label for='cat_name' class='mt-3'>Enter new category Name</label>
<input type="text" name="cat_name" id='cat_name' placeholder='Category Name' class='form-control' value="<?=$info['name']?>">

<button class='btn btn-primary mt-3'>Save </button>
</form>
</div>

