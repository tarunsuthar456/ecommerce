<?php 
function request($key=""){
    $robj=(object)['controller'=>'DashboardController','method'=>'index','get'=>$_GET,'post'=>$_POST,'para'=>null];
    if(isset($_GET['url']) && $_GET['url']){
        $url= explode('/',rtrim($_GET['url'],'/'));
        $robj->controller=ucfirst(strtolower($url[0]))."Controller";
        $robj->method=$url[1]??$robj->method;
        $robj->para=$url[2]??($robj->para);
        unset($robj->get['url']);
    }
    if($key){
        if(array_key_exists($key,$_POST)){
            return $_POST[$key];
        }

        if (array_key_exists($key, $_GET)) {
            return $_GET[$key];
        }
        return NULL;
    }
    return $robj;
}

?>