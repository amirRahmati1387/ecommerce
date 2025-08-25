<?php

class model extends mainDB{
    protected $type;
    protected $base;
    protected $where;
    protected $limit;
    protected $join;
    protected $countQuery;
    protected $groupBy;
    protected $x = '';

    public static function select(array $fields = ["*"]){  
        $className = static :: class;
        $obj = factory :: factory($className);
        $obj -> type = "select";
        $obj -> base = "SELECT " . implode("," , $fields);
        return $obj;
    }
    
    public static function find(){
        $className = static :: class;
        $obj = factory :: factory($className);
        // $obj -> type = "find";
        return $obj :: select();
        
    }

    public static function limit($start , $end){
        $className = static :: class;
        $obj = factory :: factory($className);
        $obj :: select();
        $obj -> type = "limit";
        if($start > $end){
            $limit = $start - $end;
            $obj -> limit = " LIMIT " . $end . " , " . $limit;
        }else if($end > $start){
            $limit = $end - $start;
            $obj -> limit = " LIMIT " . $start . " , " . $limit;
        }else{
            echo"error";
            return;
        }
        return $obj;
    }

    public static function pagenate(){
        $className = static :: class;
        $obj = factory :: factory($className);
        $key = $_SERVER['REQUEST_URI'];
        $uriArray = explode("/" , $key);
        $id = $uriArray[4];
        $obj :: select() -> from();
        $obj -> type = "pagenate";
        if($uriArray[3] === "page"){
            $id = $uriArray[4];
            $end = ($id - 1) * 5;
            $obj -> base .= " LIMIT " . $end . " , " . 5;
        }
        return $obj -> get();
    }

    public static function count(){
        $className = static :: class;
        $obj = factory :: factory($className);
        $obj -> type = "select";
        $obj -> base = " SELECT count(*)";
        return $obj;
    }

    public static function all(){
        $className = static :: class;
        $obj = factory :: factory($className);
        return $obj :: select() -> get();
    }

    public static function delete(){
        $className = static :: class;
        $obj = factory :: factory($className);
        $obj -> type = "delete";
        $obj -> base = "DELETE FROM " . $className :: $tableName;
        return $obj;
    }

    public static function create($date){
        $className = static :: class;
        $obj = factory :: factory($className);
        $obj -> type = "create";
        $field = "(";
        $value = "(";
        $count = 0;
        foreach($date as $key => $value_field){
            $count++;
            $field .= $key;
            $value .= "'" . $value_field . "'";
           if($count <count($date)){
                $field .= ",";
                $value .= ",";
            }
        }
        $field .=" ) ";
        $value .=" ) ";
        $obj -> base = "INSERT " . " INTO " . $className :: $tableName . $field  . " VALUES " . $value;
        return $obj;
    }

    public static function update($date){
        $className = static :: class;
        $obj = factory :: factory($className);
        $obj -> type = "update";
        $obj -> base = "UPDATE " . $className :: $tableName . " SET ";
        $count = count($date);
        foreach($date as $key => $value){
            $obj -> base .= $key . " = '" . $value ."' ";
            if($count == 1){
                break;
            }
            $count--;
            $obj -> base .= " , ";
        }
        return $obj;
    }

    public function subQuery(array $datas){
        $className = static :: class;
        $obj = factory :: factory($className);
        $obj -> type = "subQuery";
        foreach($datas as $alias => $filds){
            foreach($className :: $relatedTo as $tablee => $related){
                $obj -> base .= ',( '.$filds[0] :: select([$filds[1]]) -> from() -> where($className.'.'.$tablee , $tablee.'.'.$related[1]) -> getSql()." ) ".$alias;
            }
        }
        return $obj;
    }

    public function countQuery(array $datas , $x = null){
        $className = static :: class;
        $obj = factory :: factory($className);
        if($x != null){
            $obj -> x = $x;
        }
        foreach($datas as $alias => $tableName){
            foreach($obj :: $relatedTo as $key => $value){
                $obj -> countQuery = " ( ". $key :: count() -> from() -> where($className .'.'.$value[0] , $tableName[0].'.'.$value[1]) -> getSql() . " ) " . $alias;
            }
        }
        $obj -> type = "countQuery";
        return $obj;
    }

    public function join($join , string $datas){
        // $className = static :: class;
        // $obj = factory :: factory($className);
        // $obj -> type = "join";
        // $obj -> join = " LEFT JOIN ". $datas;
        // foreach($className :: $relatedTo as $value => $key){
        //     $obj -> base = $obj -> where($className.'.'.$value , $key[0].'.'.$key[1]) -> getSql();
        // }
        // return $obj;
 
        $className = static :: class;
        $obj = factory :: factory($className);
        $obj -> type = "join";
        //-------------{"RIGHT JOIN"}-------;
        //-------------{"INNER JOIN"}-------;
        $obj -> join = " $join JOIN ". $datas;
        return $obj;
    }

    public function belongsTo($className_category ,array $filds){
        $className_product = static :: class;
        $obj_product = factory :: factory($className_product);
        $obj_product -> type = "belongsTo";
        $className_product :: select($filds);
        foreach($className_product :: $relatedTo as $value => $key){
            $obj_product -> base .= $obj_product -> join('LEFT',$className_category) -> where($className_product.'.'.$key[0] , $key[0].'.'.$key[1]) -> getSql();
        }
        return $obj_product;
    }

    public function groupBy(array $datas){
        $className = static::class;
        $obj = factory :: factory($className);
        $obj -> groupBy = " GROUP BY ". implode('AND' , $datas);
        return $obj;
    }

    public function whidQuery($datas , array $table , $join){
        $className = static :: class;
        $obj_category = factory :: factory($className);
        $obj_product = factory :: factory($datas);
        $base = $obj_category -> base;
        $query = $obj_product -> countQuery($table) -> countQuery;
        $obj_category -> base .= ', '.$query;
        foreach($className :: $relatedTo as $key => $value){
            if($join == "INNER"){
                $obj_category -> groupBy([$value[1].'.'.$value[0]]);
            }
            $obj_category -> base .= $obj_category -> join($join , $datas) -> where($key.'.'.$value[1] , $value[1].'.'.$value[0]) -> getSql();
            if($join == "LEFT"){
                $obj_category -> base = $obj_category -> countQuery([' ' => ['product' , 'id']]) -> where($obj_category -> countQuery , 0) -> getSql();
            }
        }
        $obj_category -> type = "whidQuery";
        return $obj_category;
    }

    public function case($alias){
        $className = static :: class;
        $obj = factory :: factory($className);
        $obj -> type = "case";
        $obj -> base .= ',CASE product.point WHEN 1 THEN "بد" WHEN 2 THEN "خوب" WHEN 3 THEN "عالی" WHEN 4 THEN "لجند" ELSE "هیچی نیست" END '. $alias;
        $obj -> from();
        return $obj;
    }

    public function sort($type , $value){
        $className = static :: class;
        $obj = factory :: factory($className);
        $obj -> type = "sort";
        $table = $obj -> get();
        while($row = $table -> fetch_assoc()){
            $array []= $row;
        }
        for($i = 0 ; $i < count($array) ; $i++){
            for($j = $i ; $j < count($array) ; $j++){
                if($value === "desc" && $array[$i][$type] < $array[$j][$type]){
                    $min = $array[$i];
                    $array[$i] = $array[$j];
                    $array[$j] = $min;
                }
                if($value == "asc" && $array[$i][$type] > $array[$j][$type]){
                    $min = $array[$j];
                    $array[$j] = $array[$i];
                    $array[$i] = $min;
                }
            }
        }
        return $array;
    }

    public function where($field , $value , $operator = " = "){
        $className = static :: class;
        $obj = factory :: factory($className);
        $this -> where []= "$field $operator $value";
        return $obj;
    }

    public function from(){
        $className = static :: class;
        $obj = factory :: factory($className);
        $obj -> base .= " FROM " . $className :: $tableName;
        return $obj;
    }

    public function getSql(){
        $className = static :: class;
        $obj = factory :: factory($className);
        $crud = $obj -> base;
        if(!empty($this -> join)){
            $obj -> from();
            $crud = $obj -> join . " ON " . implode('AND' , $this -> where);
            $this -> where = [];
            $this -> join = '';
        }
        if(isset($obj -> groupBy)){
            $crud .= $obj -> groupBy;
            $obj -> groupBy = '';
        }
        if(!empty($obj -> where)){
            $crud .= " WHERE " . implode('AND', $this -> where);
        }
        $this -> where = [];

        if($obj -> countQuery && $obj -> x){
            $obj -> base .= ','.$obj -> countQuery;
            $obj -> from();
            $crud = $obj -> base;
            $obj -> countQuery = '';
        }
        if(isset($this -> limit)){
            $crud .= $this -> limit;
        }
        return $crud;
    }

    public function get(){
        $className = static :: class;
        $obj = factory :: factory($className);
        if($obj -> type == "update" || $obj -> type == "create" || $obj -> type == "delete"){
            $base = $obj -> getSql();
            $className :: $connection -> query($base);
        }
        if(in_array($obj -> type , ['subQuery'])){
            $obj -> from();
            return $className :: $connection -> query($obj -> base);
        }
        if(in_array($obj -> type , ['pagenate' , 'join' , 'sort' , 'belongsTo' , 'whidQuery' , 'countQuery'])){
            $base = $obj -> getSql();
            return $obj :: $connection -> query($base);
        }
        if(in_array($obj -> type , ['select' , 'find' , 'limit' , "case"])){
            $obj -> from();
            $base = $obj -> getSql();
            return $className :: $connection -> query($base);
        }
    }
}