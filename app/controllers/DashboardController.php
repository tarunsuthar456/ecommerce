<?php 
class DashboardController extends Controller{
    protected $catobj;
    public function __construct(){
        parent::__construct();
        $this->catobj = $this->loadModel('categories');

    }


    public function index(){
        // $where = '';
        // if($id = request('id')){
        //     $where = "where categories.id = $id";
        // }

        $carts_data = '';

        $sql = "select products.id as pro_id,categories.id as cat_id, products.name, cost,image, categories.name as cat_name, products.name as pro_name,cost,grading,image from categories join cat_products on categories.id = cat_products.cat_id join products on products.id= cat_products.pro_id where hidden='no' order by categories.name ";

    if(isset($_SESSION['admin']) && $_SESSION['admin']['is_admin'] == 'yes'){
        $sql = "select products.id as pro_id,categories.id as cat_id, products.name, cost,image, categories.name as cat_name, products.name as pro_name,cost,grading,image from categories join cat_products on categories.id = cat_products.cat_id join products on products.id= cat_products.pro_id  order by categories.name";
    }

    $data = $this->catobj->runSql($sql);


        
        $this->load->view('dashboard.index',compact('data'));
    }

    public function create(){
        $this->load->view('categories.create');
    }

    public function store(){
        
    }

    public function edit(){

    }

    public function update(){

    }

    public function delete($id){
    
    }

    
}


?>