<?php
class View
{
    public function view($viewname, $data = [], $hf = true)
    {

        $viewname = str_replace('.', '/', $viewname);
        $path = "app/views/$viewname.php";
        if (file_exists($path)) {
            extract($data);
            include_once "app/views/layout/top.php";

            if ($hf)
                include_once "app/views/layout/header.php";
            include $path;
            if ($hf)
                include_once "app/views/layout/footer.php";
            include_once "app/views/layout/bottom.php";
            
        }
        //echo "this is $viewname";
    }
}
