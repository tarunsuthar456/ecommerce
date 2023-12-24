<?php 
class OrdersController extends Controller{
    protected $catobj;
    public function __construct(){
        parent::__construct();
        $this->orderobj = $this->loadModel('orders');
        $this->cartsobj = $this->loadModel('carts');
        $this->usersobj = $this->loadModel('users');
        $this->productsobj = $this->loadModel('products');
    }


    public function index($did){
        $userId = $_SESSION['admin']['id'];
        $sql = "Select products.id as products_id, carts.id as carts_id,name,user_id, cost,grading,products.delivery_time as delivery_time,image,pro_id,quantity,price,total_price from products join carts on products.id = carts.pro_id and user_id =$userId";
        $data = $this->orderobj->runSql($sql);
        
        $userdata = $this->usersobj->runSqlAssoc("Select username,address from users where id = $userId"); 
        
        $deliveryTime = $did;
        
        $total_products = count($data);

        $bill_no = $this->orderobj->runSqlAssoc('select bill_no from orders order by bill_no desc limit 1');
 
        if(isset($bill_no) && $bill_no){
            $bill_no = $bill_no['bill_no']+1;
        }
        else{
            $bill_no = 101;
        }
        $total_price = array_column($data,'total_price');
        $total_price = array_sum($total_price);
 
        if(count($data)==0){
            $bill_no = '';
        }

        $this->load->view('orders.index',compact('data','total_products','total_price','bill_no','userdata','deliveryTime'));
    }

    public function create(){
        $this->load->view('categories.create');
    }

    public function store($bill_no){
            $address = $_GET['address'];
            $userId = $_SESSION['admin']['id'];
            $data = $this->orderobj->runSql("Select products.id as products_id, carts.id as carts_id,name,user_id, cost,grading,image,pro_id,products.delivery_time as delivery_time, quantity,price,total_price from products join carts on products.id = carts.pro_id and user_id =$userId ");
            // echo count($data);
            // exit();

            $deliveryTime = array_column($data, 'delivery_time');
            rsort($deliveryTime);
            $deliveryTime = ($deliveryTime[0]);
            $deliveryTime = date('Y-m-d', time() + 86400 * $deliveryTime);

            $product_name = array_column($data,'name');
            $product_price = array_column($data,'price');
            $product_quantity = array_column($data,'quantity');
            $product_total_price = array_column($data,'total_price');
            $product_images = array_column($data,'image');
            
            
            $total_products = count($data);
    
    
        for($i=0;$i<$total_products;$i++){
            $info =[
                'bill_no'=>$bill_no,
                'product_name'=>$product_name[$i],
                'product_price'=>$product_price[$i],
                'product_quantity'=>$product_quantity[$i],
                'product_quantity'=>$product_quantity[$i],
                'product_total_price'=>$product_total_price[$i],
                'date_of_order'=>date('Y-m-d'),
                'user_id'=>$_SESSION['admin']['id'],
                'address'=>$address,
                'image'=>$product_images[$i],
                'delivery_time' => $deliveryTime

            ];

            $this->orderobj->create($info);
        }
        
            $this->cartsobj->runSql("delete from carts where user_id = $userId");
                
            redirect('orders/about');

    }

    public function edit(){

    }

    public function update(){

    }

    public function delete($id){
        $this->orderobj->delete($id);
        redirect("orders/about");
    }

    public function about(){
        $userId = $_SESSION['admin']['id'];
        $data = $this->orderobj->runSql("select * from orders where user_id = $userId ");
        return $this->load->view('orders.about',compact('data'));
    }


}

?>