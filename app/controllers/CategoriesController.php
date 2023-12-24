<?php 
class CategoriesController extends Controller{
    protected $catobj;
    public function __construct(){
        parent::__construct();
        $this->catobj = $this->loadModel('categories');
        $this->proobj = $this->loadModel('products');

    }


    public function index(){
        $data = $this->catobj->all();

        $this->load->view('categories.index',compact('data'));
    }

    public function create(){
        $this->load->view('categories.create');
    }

    public function store(){
        $info = [
            'name'=>request('cat_name')
        ];

        $this->catobj->create($info);
        redirect('categories');
    }

    public function edit($id){
        $info = $this->catobj->find($id);
        $this->load->view('categories.edit',compact('info'));
    }

    public function update($id){
        $info = [
            'name'=>request('cat_name')
        ];

        $this->catobj->update($info,$id);
        redirect('categories');
    }

    public function delete($id){
        $proId = ($_GET['proId']);
        $totalProId = $this->catobj->totalProduct($proId);

        $this->catobj->runSql("Delete from cat_products where cat_id = $id");
        if($totalProId == 1){
            $this->proobj->delete($proId);
        }
        redirect('products');
    }

    public function deleteCat($id){
        $this->catobj->delete($id);
        redirect('categories');
    }

    public function show(){
        $name = request('name');
        echo $name;
        $data = $this->catobj->runSql("select products.id, products.name, cost,image, categories.name as cat_name, products.name as pro_name,cost,grading,image from categories join cat_products on categories.id = cat_products.cat_id join products on products.id= cat_products.pro_id where categories.name='$name' order by categories.name");
        $info = $this->catobj->runSql('select * from categories');
        print_r($data);
        $this->load->view('dashboard.index',compact('data','info'));
    }
}

?>