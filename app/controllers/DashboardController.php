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

        $sql = "select products.id as pro_id,categories.id as cat_id, products.name, cost,image, categories.name as cat_name, products.name as pro_name,cost,grading,image from categories join cat_products on categories.id = cat_products.cat_id join products on products.id= cat_products.pro_id where hidden='no' group by products.name order by categories.name ";

    if(isset($_SESSION['admin'] ['is_admin']) && $_SESSION['admin']['is_admin'] == 'yes'){
        $sql = "select products.id as pro_id,categories.id as cat_id, products.name, cost,image, categories.name as cat_name, products.name as pro_name,cost,grading,image from categories join cat_products on categories.id = cat_products.cat_id join products on products.id= cat_products.pro_id group by products.name order by categories.name";
    }

    $catData = $this->catobj->runSql($sql);
    // $data = [];
    foreach($catData as $value){
        $catNames = $this->catobj->runSql("Select name from categories join cat_products on cat_id = categories.id where pro_id = $value[pro_id]");
        $extractedCatNames = implode(',',array_column($catNames,'name')); 
        array_push($value,$extractedCatNames);
        // array_push($data,$value);        // If we dont give $data as blank array it will give error that it can not add into any array as we have to assigned the $data as blank array 
        $data[] = $value;   // Here as we write $data, it is declared as in php when we write any variable it is by default declared at that place. So here $data array is declared 
    }
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