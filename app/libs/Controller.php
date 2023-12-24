<?php 
class Controller{
    protected $load, $catobj;
    public function __construct()
    {
        $this->load=new View();
    }
    public function loadModel($modelname):object{
        $modelname=ucfirst(strtolower($modelname));
        $path="app/models/$modelname.php";
        if(file_exists($path)){
            include_once $path;

            return new $modelname(strtolower($modelname));
        }
    }

    public function category(){
        $this->catobj = $this->loadModel('categories');
        // print_r($catobj);
    } 
}
?>