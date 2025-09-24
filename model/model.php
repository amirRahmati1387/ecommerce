<?php

class model extends mainDB{
    protected $type;
    protected $base;
    protected $where;
    protected $limit;
    protected $join;
    protected $countQuery;
    protected $groupBy;
    protected $ifnull;
    protected $orderBy;
    protected $x = '';

    protected function select($fields = null){
        if($fields == null){
            $fields = ['*'];
        }
        $this -> type = "select";
        $this -> base = "SELECT " . implode("," , $fields);
        return $this;
    }

    protected function find($id){
        $id = implode("",$id);
        return $this -> select() -> where(["id" , $id , '=']) -> get();
    }

    protected function limit($sort){
        $sort = implode("",$sort);
        if($sort[0] < $sort[1]){
            $end = $sort[0];//❌
            $limit = $sort[1] - $sort[0];
            $this -> limit = " LIMIT " . $end . " , " . $limit;
        }
        if($sort[0] > $sort[1]){
            $limit = $sort[0] - $sort[1];
            $this -> limit = " LIMIT " . $sort[1] . " , " . $limit;
        }
        return $this -> select() -> get();
    }

    protected function pagenate(){
        $key = $_SERVER['REQUEST_URI'];
        $uriArray = explode("/" , $key);
        // $id = $uriArray[4];
        $this -> select();
        $this -> type = "pagenate";
        if($uriArray[3] === "page"){
            $id = $uriArray[4];
            $end = ($id - 1) * 5;
            $this -> limit = " LIMIT " . $end . " , " . 5;
        }
        return $this -> get();
    }

    protected function count(){
        return $this -> select(['COUNT(*)']);
    }

    protected function all(){
        return $this -> select() -> get();
    }

    protected function delete($id){
        $this -> type = "delete";
        $this -> base = "DELETE ";
        $this -> where(["id" , $id[0] , "="]) -> get();
    }

    protected function create($date){
        $this -> type = "create";
        $field = "(";
        $value = "(";
        $count = 0;
        foreach($date[0] as $key => $value_field){
            $count++;
            $field .= $key;
            $value .= "'" . $value_field . "'";
           if($count <count($date[0])){
                $field .= ",";
                $value .= ",";
            }
        }
        $field .=" ) ";
        $value .=" ) ";
        $this -> base = "INSERT " . " INTO " . $this -> tableName . $field  . " VALUES " . $value;
        $this -> get();
    }

    protected function update($date){
        $this -> type = "update";   
        $this -> base = "UPDATE " . $this -> tableName . " SET ";
        $count = count($date[0]);
        foreach($date[0] as $key => $value){
            $this -> base .= $key . " = '" . $value ."' ";
            if($count == 1){
                break;
            }
            $count--;
            $this -> base .= " , ";
        }
        $this -> where(["id" ,$date[0]['id'] , "="]) -> get();
    }

    // protected function subQuery(array $datas){
    //     $className = static :: class;
    //     $obj = factory :: factory($className);
    //     $obj -> type = "subQuery";
    //     foreach($datas as $alias => $filds){
    //         foreach($className :: $relatedTo as $tablee => $related){
    //             $obj -> base .= ',( '.$filds[0] :: select([$filds[1]]) -> from() -> where($className.'.'.$tablee , $tablee.'.'.$related[1]) -> getSql()." ) ".$alias;
    //         }
    //     }
    //     return $obj;
    // }

    protected function countQuery(array $datas){
        if(isset($datas[1])){
            // $this -> x = $datas;
            $datas = $datas[0];
        }
        foreach($datas as $alias => $tableName){
            foreach($this -> relatedTo as $key => $value){
                $this -> countQuery = '('. (new $key) -> count() -> from() -> where([$key .'.'.$value[1] , $value[1].'.'.$value[0] , "="]) -> getSql() . " ) " . $alias;
            }
        }
        $this -> type = "countQuery";
        return $this;
    }

    protected function join($join , string $datas){
        $this -> type = "join";
        $this -> join = " $join JOIN ". $datas;
        return $this;
    }

    // protected function belongsTo($className_category ,array $filds){
    //     $className_product = static :: class;
    //     $obj_product = factory :: factory($className_product);
    //     $obj_product -> type = "belongsTo";
    //     $className_product :: select($filds);
    //     foreach($className_product :: $relatedTo as $value => $key){
    //         $obj_product -> base .= $obj_product -> join('LEFT',$className_category) -> where($className_product.'.'.$key[0] , $key[0].'.'.$key[1]) -> getSql();
    //     }
    //     return $obj_product;
    // }

    protected function groupBy(array $datas){
        $this -> groupBy = " GROUP BY ". implode('AND' , $datas);
        return $this;
    }

    protected function whidQuery($datas){
        $query = $this -> countQuery($datas[1]) -> countQuery;
        $this -> base .= ','. $query;
        foreach($this -> relatedTo as $key => $value){
            if($datas[2] == "INNER"){
                $this -> groupBy([$value[1].'.'.$value[0]]);
            }
            $this -> base .= $this -> join($datas[2] , $datas[0]) -> where([$key.'.'.$value[1] , $value[1].'.'.$value[0] , "="]) -> getSql();
            if($datas[2] == "LEFT"){
                $this -> base = $this -> countQuery([' ' => ['product' , 'id']]) -> where([$this -> countQuery , 0 , "="]) -> getSql();
            }
        }
        $this -> type = "whidQuery";
        return $this -> get();
    }

    protected function if($datas){//$join , $datas , $filds , $description , $alias
        $this -> base .= $this -> ifNULL($datas[1] , $datas[2] , $datas[3] , $datas[4]) -> ifnull;
        foreach($this -> relatedTo as $key => $value){
            $this -> base .= $this -> join($datas[0] , $datas[1]) -> where([$key .'.'. $value[1] , $value[1] .'.'. $value[0] , "="]) ->  getSql();
        }
        $this -> type = "if";
        return $this -> get();
    }

    protected function case($alias){
        $this -> type = "case";
        $this -> base .= ',CASE product.point WHEN 1 THEN "بد" WHEN 2 THEN "خوب" WHEN 3 THEN "عالی" WHEN 4 THEN "لجند" ELSE "هیچی نیست" END '. implode('',$alias);
        return $this;
    }

    protected function ifNULL($dates , $fild , $description , $alias){
        $this -> base .= " ,IFNULL". "( " . $dates .'.'. $fild .' , '. $description ." )" . $alias;
        return $this;
    }

    protected function orderBy($orderBy){
        $this -> type = "orderBy";
        $this -> orderBy = " ORDER BY " . $orderBy[0] . $orderBy[1];
        return $this -> get();
    }

    protected function sort($sort){
        $array = $this -> get();
        $type = $sort[0];
        $value = $sort[1];
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

    protected function where($field){
        $this -> where []= "$field[0] $field[2] $field[1]";
        return $this;
    }

    protected function from(){
        $this -> base .= " FROM " . $this -> tableName;
        return $this;
    }

    protected function fetchassoc($table){
        for($i = 0 ; $i  < $table -> num_rows ; $i++){
            $array []= $table -> fetch_assoc();
        }
        return $array;
    }

    protected function getSql(){
        $crud = $this -> base;
        if(isset($this -> join)){
            $this -> from();
            $crud = $this -> join . " ON " . implode('AND' , $this -> where);
            $this -> where = null;
            $this -> join = null;
        }
        if($this -> type == "orderBy"){
            $this -> base .= ' ,'. $this -> countQuery;
            $this -> from();
            $this -> base .= $this -> orderBy;
            $crud = $this -> base;
        }
        if(isset($this -> groupBy)){
            $crud .= $this -> groupBy;
            $this -> groupBy = null;
        }

        // if($this -> countQuery && $this -> x){
        //     $this -> base .= ','.$this -> countQuery;
        //     $this -> from();
        //     $crud = $this -> base;
        //     $this -> countQuery = '';
        // }

        if(isset($this -> where)){
            $crud .= " WHERE " . implode('AND', $this -> where);
            $this -> where = null;
        }
        if(isset($this -> limit)){
            $crud .= $this -> limit;
            $this -> limit = '';
        }
        return $crud;
    }

    protected function get(){
        // if(in_array($obj -> type , ['subQuery'])){
        //     $obj -> from();
        //     return $className :: $connection -> query($obj -> base);
        // }

        // if(in_array($this -> type , ['pagenate'])){// , 'join' , 'sort' , 'belongsTo' , 'whidQuery' , 'countQuery'
        //     $base = $obj -> getSql();
        //     return $obj :: $connection -> query($base);
        // }

        if(in_array($this -> type , ['countQuery' , 'whidQuery' , 'orderBy' , 'if'])){
            $crud = $this -> getSql();
            $base = $this -> connection -> query($crud);
            return $this -> fetchassoc($base);
        }
        if(in_array($this -> type , ['select' , 'limit' , 'pagenate' , 'delete' , 'create' , 'update' , 'case'])){
            if($this -> type == "create" || $this -> type == "update"){
                $base = $this -> getSql();
                $this -> connection -> query($base);
                return;
            }
            $base = $this -> from() -> getSql();
            if($this -> type == "delete"){
                $this -> connection -> query($base);
                return;
            }
            $table = $this -> connection -> query($base);
            return $this -> fetchassoc($table);
        }
    }
}