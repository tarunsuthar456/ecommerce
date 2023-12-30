<?php 
class CartsController extends Controller{
    protected $cartssobj;
    public function __construct(){
        parent::__construct();
        $this->cartsobj = $this->loadModel('carts');
        $this->proobj = $this->loadModel('products');

    }


    public function index(){
        if(!$_SESSION['admin']){
            redirect('login');
        }

        $userId = $_SESSION['admin']['id'];
        $data = $this->cartsobj->runSql("Select products.id as products_id, carts.id as carts_id,name,user_id, products.delivery_time as delivery_time, cost,grading,image,pro_id,quantity,price,total_price from products join carts on products.id = carts.pro_id and user_id =$userId ");
        
        $deliveryTime = array_column($data, 'delivery_time');
        rsort($deliveryTime);
        $deliveryTime = $deliveryTime[0]??'';

        $this->load->view('carts.index',compact('data', 'deliveryTime'));
    }

    public function create(){
    }

    public function store($id){

        if(!$_SESSION['admin']){
            redirect('login');
        }
        $user_id = $_SESSION['admin']['id'];

        $cartsdata = $this->cartsobj->runSqlAssoc("Select * from carts where pro_id = $id and user_id = $user_id");
        $prodata = $this->proobj->runSqlAssoc("Select * from products where id = $id");
        
        if($cartsdata){
            print_r($cartsdata);
            $this->cartsobj->runSql("update carts set quantity = carts.quantity +1, total_price = price * quantity where pro_id = $id and user_id = $user_id");

            $this->proobj->updateCol("update products set stock = stock-1 where id=$id");
            redirect('products');
        }
        
        else{

        $info = [
            'pro_id'=> $id,
            'quantity'=>1,
            'price'=>$prodata['cost'],
            'total_price'=>$prodata['cost'],
            'user_id'=>$_SESSION['admin']['id'],
            'delivery_time'=>$deliveryTime,
        ];
        $this->cartsobj->create($info);
        $this->proobj->updateCol("update products set stock = stock-1 where id=$id");

        redirect('products');

        }
    }

    public function edit(){

    }

    public function update(){

    }

    public function delete($id){
        $productQuantity = $_GET['data'];
        $cartsData = $this->cartsobj->runSqlAssoc("select * from carts where id = $id");
        $this->proobj->updateCol("update products set stock = stock + $productQuantity where id = $cartsData[pro_id]");
        $this->cartsobj->delete($id);
        redirect('carts');
    }

    public function change(){
        $value = $_GET['value'];
        $carts_id = $_GET['carts_id'];
        $user_id=  $_SESSION['admin']['id'];
            
        $cartsdata = $this->cartsobj->runSqlAssoc("Select * from carts where id = $carts_id and user_id = $user_id ");
        
        $productsData = $this->proobj->runSqlAssoc("select stock from products where id = $cartsdata[pro_id]");

        // print_r($cartsdata);
        echo $change = $value - $cartsdata['quantity'];
        
        if($value <= 0){
            redirect('carts');
        }
        if($productsData['stock'] <= 0 && $change >= 0 ){
            redirect('carts');
        }

        else{
        $this->cartsobj->runSql("update carts set quantity = $value, total_price = price * quantity where id = $carts_id");
        $this->proobj->updateCol("update products set stock = stock - $change where id = $cartsdata[pro_id]");
        redirect('carts');
        }
    }

    // public function checkproduct($id){
    // echo $id;
    // exit;
    //     $result = $this->cartsobj->runSql("update carts set quantity = $value, total_price = total_price * quantity where id =$id ");
    //     print_r(result);
    //     exit;
    //     if($result){
    //         return true; 
    //     }
    //     redirect('carts');

    // }
}

?>