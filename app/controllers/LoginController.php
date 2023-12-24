<?php 
class LoginController extends Controller{
    protected $user;
    public function __construct(){
        parent::__construct();
        $this->user = $this->loadModel('users');
    }
    public function index(){
        $this->load->view('login.index');
    }

    public function create(){
        $this->load->view('login.create');
    }

    public function store(){

        $info = [
            'username'=>request('name'),
            'password'=>request('password'),
        ];
        $this->user->create($info);
        redirect('dashboard/index');
    }


    public function checkuser(){
        $data = $this->user->all();
        print_r($data);
        $username = request('name');
        $password = request('password');

        if(request('name')==$username){
            if(request('password')==$password){
                $info = $this->user->runSqlAssoc("select * from users where username = '$username' and password = '$password' ");
                print_r($info);
                $_SESSION['admin']=$info;
            }

            // print_r($_SESSION['admin']);
        }
        header("Location:".ROOT."dashboard");


    }

    public function logout(){
    
    session_destroy();
    header("Location:".ROOT."login");


    }

    public function edit(){

    }

    public function update(){

    }

    public function delete(){
        
    }
}

?>