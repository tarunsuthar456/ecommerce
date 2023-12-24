<h3 class='text-center'>Login Form</h3>
<div class="container">
<form method='post' action='<?=ROOT?>login/checkuser' class='form-control p-4'>
<label for="name">Name</label>
<input type='text' id="name" name='name'class='form-control' >
<label for="password">Password</label>
<input type='password' id='password' name='password' class='form-control'>
<div class='py-4 text-center'>
<div>
    <button class='btn btn-primary'>Ok</button>
</div>
<span > Dont have an account? </span><a href='<?=ROOT?>login/create' >Sign up<a>
</div>
</form>


</div>



