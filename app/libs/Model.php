<?php 
class Model extends PDO{
    protected $table,$primarykey='id';
    function __construct($table)
    {
        parent::__construct('mysql:hostname='.HOSTNAME.';dbname='.DBNAME,USERNAME,PASSWORD);
        if(!$this->table){
            $this->table=$table;
        }
    }
    function create($data){
        $keys=array_keys($data);
        $cols=implode(',',$keys);
        $lbls=implode(',',array_map(fn($v)=>":$v",$keys));
        $sql="insert into $this->table($cols)values($lbls)";
        try{
            $this->prepare($sql)->execute($data);
        }
        catch(Exception $e){
            return false;
        }
        return $this->lastInsertId();
      
    }


    function update($data,$id)
    {
        $keys = array_keys($data);
        $lbls = implode(',', array_map(fn ($v) => "$v=:$v", $keys));
        $sql = "update $this->table set $lbls where $this->primarykey=$id ";
        return $this->prepare($sql)->execute($data);
        
    }

    function delete($id)
    {
        $sql = "delete from $this->table  where $this->primarykey=? ";
        return $this->prepare($sql)->execute([$id]);
    }


    function all(array|string $cols="*",$order=null)
    {
        if(is_array($cols)){
            $cols=implode(",",$cols);
        }
        if($order and is_array($order)){
            $oc=$order[array_key_first($order)];
            $ob = $order[array_key_last($order)];
        }  else{
            $oc=$this->primarykey;
            $ob='desc';
        }
        $sql="select $cols from $this->table order by $oc $ob";
        $rs= $this->prepare($sql);
        $rs->execute();
        return $rs->fetchAll(PDO::FETCH_ASSOC);
        
    }
    function runSql($sql)
    {
        $rs = $this->prepare($sql);
        $rs->execute();
        return $rs->fetchAll(PDO::FETCH_ASSOC);
    }

    function runSqlAssoc($sql)
    {
  
        $rs = $this->prepare($sql);

        $rs->execute();
        return $rs->fetch(PDO::FETCH_ASSOC);
    }
    
    public function updateCol($sql){
        $rs = $this->prepare($sql);
        $rs->execute();
    }

    function find($id,array|string $cols = "*")
    {
        if (is_array($cols)) {
            $cols = implode(",", $cols);
        }
        $sql = "select $cols from $this->table where $this->primarykey=$id";

        $rs = $this->prepare($sql);
        $rs->execute();
        return $rs->fetch(PDO::FETCH_ASSOC);
        
    }
}