<?php 
$obj = (new mysqli('localhost','root','','ecommerce'))->query("select * from categories")->fetch_all(1);

?>
<div class="container border">
<div class='h2 text-center bg-warning text-seondary p-4 mb-0'> E-Commerce DRY FRUITS &HUBS </div>
  
<div class="">
<div class="row">
<div class="col-lg-2">


<header>

<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 201px;height:600px" >
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
      <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
      <span class="fs-4">Website</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      
    <li class="nav-item">
        <a href="<?=ROOT?>dashboard/index" class="nav-link active" aria-current="page">
          <svg class="bi me-2" width="18" height="16"><use xlink:href="#home"/></svg>
          Dashboard
        </a>
      </li>

  <br>

          <li class="nav-item">
        <a href="<?=ROOT?>products/index" class="nav-link active" aria-current="page">
          <svg class="bi me-2" width="18" height="16"><use xlink:href="#home"/></svg>
          Products
        </a>
      </li>

      

      <?php if( isset($_SESSION['admin']) ){ ?>
        <br>
        <li class="nav-item">
          <a href="<?=ROOT?>categories/index" class="nav-link active" aria-current="page">
          <svg class="bi me-2" width="18" height="16"><use xlink:href="#home"/></svg>
          Categories
        </a>
      </li>   
      <?php } ?>

      <?php if( isset($_SESSION['admin']['is_admin'])  && $_SESSION['admin']['is_admin'] =='yes' ){ ?>
      <br>   

      <li class="nav-item">
        <a href="<?=ROOT?>carts/index" class="nav-link active" aria-current="page">
          <svg class="bi me-4" width="18" height="16"><use xlink:href="#home"/></svg>
          Carts
        </a>
      </li>

      <?php } ?>
      
      <li class="nav-item">
        
      <div class="dropdown mt-4 bg-warning "  >

      <a href="#cat" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <div class='mx-4 p-2' >
              <strong>Categories</strong>
            </div>
      </a>


      <ul id="cat" class="dropdown-menu dropdown-menu-dark text-small shadow " aria-labelledby="dropdownUser1">
        <li><a class="dropdown-item" href="<?=ROOT?>/dashboard/index">All Categories</a></li>
          <?php foreach($obj as $value){ ?>        
            <li><a class="dropdown-item " href="<?=ROOT?>/dashboard/index?id=<?=$value['id']?>"><?=$value['name']?></a></li>
          <?php } ?>
      </ul>

    </div>
    </li>

    </ul>
    
  
  </div>
</div>



          <div class="col-lg-10">
            <div class="container m-0 p-0">
              <div class="row mx-auto">




              <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                    <!-- <a class="navbar-brand" href="<?=ROOT?>dashboard">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button> -->

                

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                          <?php if( isset($_SESSION['admin']['is_admin'])  && $_SESSION['admin']['is_admin'] =='yes' ){ ?>
                          <li class="nav-item">
                              <a class="nav-link <?= ((request()->controller == 'CategoriesController'))?'active':''?>"  aria-current="page" href="<?= ROOT; ?>categories">Categories</a>
                          </li>
                          <?php } ?>


                            <li class="nav-item">
                                <a class="nav-link <?= ((request()->controller == 'DashboardController'))?'active':''?>"  aria-current="page" href="<?= ROOT; ?>dashboard">Dashboard</a>
                            </li>
                            
                            
                            <li class="nav-item">
                                <a class="nav-link <?= ((request()->controller == 'ProductsController'))?'active':''?>""  href="<?= ROOT; ?>products">Products</a>
                            </li>

                            <?php if(isset($_SESSION['admin'])  && $_SESSION['admin']) {?>

                            <li class="nav-item">
                                <a class="nav-link <?= ((request()->controller == 'CartsController'))?'active':''?>"  aria-current="page" href="<?= ROOT; ?>carts">Carts</a>
                            </li>
                            <li>
                           
                            </li>
                              <?php } ?>


                            <!-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Dropdown
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </li> -->

<!-- 
                            <li class="nav-item">
                                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                            </li> -->



                        </ul>
                        <!-- <form class="d-flex">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form> -->

                        <?php 
                        
                            if(isset($_SESSION['admin'])  && $_SESSION['admin']) {?>

                            <div class='float-end'>
                              <span><a href='<?=ROOT?>orders/about' class='btn btn-primary'>Your orders </a></span>
                            </div>
                                <li class="nav-item">
                                  <a class="btn btn-danger" href="<?=ROOT?>login/logout" tabindex="-1" aria-disabled="true">Logout</a>
                                </li>
                        <?php } 

                        else{?>
                        <li class="nav-item">
                                <a class="btn btn-danger" href="<?=ROOT?>login/" tabindex="-1" aria-disabled="true">LogIn</a>
                        </li>

                    <?php } ?>
                        </div>
                        &nbsp

                </div>
            </nav>
        </header>





              </div>
              <section>

              <div class="row">
            <div class="container pt-3 pb-3">

              
        






            
        






<!-- to see -->




            <!-- slider on  -->

<!-- 
<div class="col-4 d-flex">
   <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
      <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
      <span class="fs-4">Sidebar</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="#" class="nav-link active" aria-current="page">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
          Home
        </a>
      </li>
      <li>
        <a href="#" class="nav-link text-white">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
          Dashboard
        </a>
      </li>
      <li>
        <a href="#" class="nav-link text-white">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
          Orders
        </a>
      </li>
      <li>
        <a href="#" class="nav-link text-white">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
          Products
        </a>
      </li>
      <li>
        <a href="#" class="nav-link text-white">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
          Customers
        </a>
      </li>
    </ul>
    <hr>
    
  </div>

</div> -->


<!-- <div style="margin-left:200px"> -->

