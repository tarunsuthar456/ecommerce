<?php
class Categories extends Model{

    public function totalProduct($id){
        $sql = "select pro_id from cat_products where pro_id = $id ";
        $rs = $this->prepare($sql);
        $rs->execute();
        
        $data = $rs->fetchAll(PDO::FETCH_ASSOC);
        return count($data);
    }
}
?>