<?php 
class ProductsController extends Controller{
    protected $proobj;
    public function __construct(){
        parent::__construct();
        $this->proobj = $this->loadModel('products');
        $this->catobj = $this->loadModel('categories');
        $this->catproducts = $this->loadModel('cat_products');
        $this->likeObj = $this->loadModel('likes');
    }


    // select products.id, categories.id as cat_id, categories.name as cat_name, products.name as pro_name,cost,grading,brand,stock,description,hidden, image from categories join cat_products on categories.id = cat_products.cat_id join products on products.id= cat_products.pro_id  where hidden ='no' order by products.id desc;


    // select products.id, categories.id as cat_id, categories.name as cat_name, products.name as pro_name,cost,grading,brand,stock,description,hidden, image from categories join cat_products on categories.id = cat_products.cat_id join products on products.id= cat_products.pro_id  where hidden ='no' order by products.id desc"

    public function index(){
        $carts_data = '';
        if(isset($_SESSION['admin']) && $_SESSION['admin']){
        $userId = $_SESSION['admin']['id'];

        $likeData = $this->likeObj->runSql("select product_id, user_id from likes where user_id = $userId");
        }
        else{
        $likeData = $this->likeObj->runSql("select product_id, user_id from likes ");
        }

        // (fetching with categories)
        // select count(product_id) as total , products.id, categories.id as cat_id, categories.name as cat_name, products.name as pro_name,cost,grading,brand,stock,description,hidden, image from categories join cat_products on categories.id = cat_products.cat_id join products on products.id= cat_products.pro_id left join likes on product_id = products.id where hidden='no' group by products.id  order by products.id desc

    $sql = "select count(product_id) as total , products.id, products.name as pro_name,cost,grading,brand,stock,description,hidden, image from  products left join likes on product_id = products.id where hidden='no' group by products.id  order by products.id desc;;";

    if(isset($_SESSION['admin'] ['is_admin']) && $_SESSION['admin']['is_admin'] == 'yes'){
        $sql = "select count(product_id) as total , products.id, products.name as pro_name,cost,grading,brand,stock,description,hidden, image from  products left join likes on product_id = products.id group by products.id  order by products.id desc;;";
    }

    $data = $this->proobj->runSql($sql);

        if(isset($_SESSION['admin'] ) && $_SESSION['admin'] ){ 
        $userId = $_SESSION['admin']['id'];
        $carts_data = $this->proobj->runSql("Select * from carts where user_id = $userId");
    }
        $this->load->view('products.index', compact('data','carts_data','likeData'));
    }

    public function create(){
        $catdata= $this->catobj->all();
        $this->load->view('products.create',compact('catdata'));
    }

    public function store(){
        if($_FILES['image']['error']==0){
            print_r($_FILES['image']);
            $from = $_FILES['image']['tmp_name'];
            $to = 'public/image/'.time().'-'.$_FILES['image']['name'];
            move_uploaded_file($from,$to);
        }

        $info = [
            'name'=>request('name'),
            'cost'=>request('cost'),
            'grading'=>request('grading'),
            'brand' => request('brand'),
            'delivery_time'=>request('delivery'),
            'image'=>time().'-'.$_FILES['image']['name'],
            'description' =>request('description'),
            'stock'=> request('stock')
        ];
        $proId = $this->proobj->create($info);
        $totalCat = request('cat_id');

        for($i= 0 ;$i <count($totalCat); $i++){

        $joininfo = [
            'cat_id'=>$totalCat[$i],
            'pro_id'=>$proId

        ];
            $result = $this->catproducts->create($joininfo);
            var_dump($result);

            if(!$result){
                $message = "duplicate name product";
                $this->load->view('products.index',compact('message'));
            }   
            else{
                redirect('products');
            }
        }

    }

    public function edit($id){

        $catdata= $this->catobj->all();
        $info  = $this->proobj->runSql("select products.id, categories.name as cat_name, products.name as pro_name,cost,brand,description,stock,grading,image from categories join cat_products on categories.id = cat_products.cat_id join products on products.id= cat_products.pro_id where products.id=$id");
        // $info = $info[0];

        $category_data = array_column($info,'cat_name');
        $this->load->view('products.edit',compact('info','catdata','category_data'));
    }

    public function update($id){

        if($_FILES['image']['error']==0){
            print_r($_FILES['image']);
            $from = $_FILES['image']['tmp_name'];
            $to = 'public/image/'.time().'-'.$_FILES['image']['name'];
            move_uploaded_file($from,$to);
        }
        $info = [
            'name'=>request('name'),
            'cost'=>request('cost'),
            'grading'=>request('grading'),
            'description' =>request('description'),
            'stock' => request('stock')
        ];
        
        if($_FILES['image']['error']==0){
            if(request('oldimage')){
                $oldfile = request('oldimage');
                $oldfile = substr($oldfile, strpos($oldfile, '-')+1);
            }
        $info = [
            'name'=>request('name'),
            'cost'=>request('cost'),
            'grading'=>request('grading'),
            'image'=>time().'-'.$_FILES['image']['name']
        ];
    }
        $this->proobj->update($info,$id);

        $this->catproducts->deleteCol("delete from cat_products where pro_id = $id");
        
        $totalCat = request('cat_id');

        for($i= 0 ;$i <count($totalCat); $i++){

        $joininfo = [
            'cat_id'=>$totalCat[$i],
            'pro_id'=>$id

        ];
        $this->catproducts->create($joininfo,$id);
        redirect('products');

    }

    }

    public function delete($id){
        // echo $id;
        // $this->catobj->runSql("Delete from cat_products where pro_id = $id");
        $this->proobj->delete($id);
        redirect('products');
        
    }

    public function hide($id){
        $is_hidden = $this->proobj->runSqlAssoc("Select hidden from products where id = $id");

        if($is_hidden['hidden'] == 'no'){
            $this->proobj->updateCol("update products set hidden = 'yes' where id = $id");
        }
        else{
            $this->proobj->updateCol("Update products set hidden = 'no' where id = $id");
        }
        redirect('products');
    }

    function getCat(){
        $data = ($_GET['data']);
        $category = $this->proobj->runSql("select * from products where name like '%$data%' ");
   
        foreach($category as $value){
            $val = $value['name'];
            // $path = ROOT."products/singleProduct/".$value['id']." ";
            // $anchor = "<a href='$path'></a>";
            $info = "<option value='$val' >";
            print_r($info);
        }
    }

    function singleProduct(){
        // echo $name;
        $name = request('search');
        $sql = "select products.id, categories.id as cat_id, categories.name as cat_name, products.name as pro_name,cost,grading,description, brand, image from categories join cat_products on categories.id = cat_products.cat_id join products on products.id= cat_products.pro_id where products.name like '%$name%' group by products.name order by products.id desc";
        $category = $this->proobj->runSql($sql);

        $proId = $category[0]['id'];
        $allCategories = $this->catproducts->runSql("Select name from cat_products join categories on cat_products.cat_id = categories.id where pro_id = $proId");
        
        $totalcategories = "";
        $message = false;

        if($category){
            foreach($allCategories as $value){
                $totalcategories.= $value['name']. ' ,';
            }
            
            $totalcategories = rtrim($totalcategories, ',');
        $this->load->view('products.single',compact('category','totalcategories','message','name'));
    }
    else{
        $message = true;
        $this->load->view('products.single',compact('message'));
    }
    }

    public function like($pro_id){
        $userId = $_SESSION['admin']['id'];
        $info = [
            'product_id' => $pro_id,
            'user_id' => $userId
        ];
        // print_r($info);

        $likeData = $this->likeObj->runSql("select * from likes where product_id=$pro_id and user_id = $userId");

        if(!(isset($likeData) && $likeData)){
            $this->likeObj->create($info);
        }
        else{
        $this->likeObj->delete($likeData[0]['id']);
        }
        redirect('products');
    }
}

?>