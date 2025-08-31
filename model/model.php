<?php

class model extends mainDB{
    protected $type;
    protected $base;
    protected $where;
    protected $limit;
    protected $join;
    protected $countQuery;
    protected $groupBy;
    // protected $ifnull;
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
        $className = static :: class;
        $id = implode("",$id);
        return $this -> select() -> where(["id" , $id , '=']) -> get();
    }

    protected function limit($sort){
        $sort = implode("",$sort);
        if($sort[0] < $sort[1]){
            $end = $sort[0];
            $limit = $sort[1] - $sort[0];
            $this -> limit = " LIMIT " . $end . " , " . $limit;
        }else if($sort[0] > $sort[1]){
            $limit = $sort[0] - $sort[1];
            $this -> limit = " LIMIT " . $sort[1] . " , " . $limit;
        }
        return $this -> select() -> get();
    }

    protected function pagenate(){
        $key = $_SERVER['REQUEST_URI'];
        $uriArray = explode("/" , $key);
        $id = $uriArray[4];
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
        $id = implode("",$id);
        $this -> where(["id" , $id , "="]) -> get();
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

    protected function countQuery(array $datas , $x = null){
        if($x != null){
            $this -> x = $x;
        }
        foreach($datas as $alias => $tableName){
            foreach($this -> relatedTo as $key => $value){
                $this -> countQuery = '('. (new $key) -> count() -> from() -> where([$this -> tableName .'.'.$value[0] , $tableName[0].'.'.$value[1] , "="]) -> getSql() . " ) " . $alias;
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
        $base = $this -> base;
        $query = $this -> countQuery($datas[1]) -> countQuery;
        $count = $this -> base .= ','. $query;
        foreach($this -> relatedTo as $key => $value){
            if($datas[2] == "INNER"){
                $this -> groupBy([$value[1].'.'.$value[0]]);
            }
            // var_dump($this -> base);
            $this -> base .= $this -> join($datas[2] , $datas[0]) -> where([$key.'.'.$value[1] , $value[1].'.'.$value[0] , "="]) -> getSql();
            if($datas[2] == "LEFT"){
                $this -> base = $this -> countQuery([' ' => ['product' , 'id']]) -> where($this -> countQuery , 0) -> getSql();
            }
        }
        $this -> type = "whidQuery";
        return $this -> get();
    }

    // protected function if($join , $datas , $filds , $description , $alias){
    //     $className = static :: class;
    //     $obj = factory :: factory($className);
    //     $obj -> base .= $obj -> ifNULL($datas , $filds , $description , $alias) -> ifnull;
    //     foreach($obj :: $relatedTo as $key => $value){
    //         $obj -> base .= $obj -> join($join , $datas) -> where($key .'.'. $value[1] , $value[1] .'.'. $value[0]) ->  getSql();
    //     }
    //     $obj -> type = "if";
    //     return $obj;
    // }

    protected function case($alias){
        $this -> type = "case";
        $this -> base .= ',CASE product.point WHEN 1 THEN "بد" WHEN 2 THEN "خوب" WHEN 3 THEN "عالی" WHEN 4 THEN "لجند" ELSE "هیچی نیست" END '. implode('',$alias);
        return $this;
    }

    // protected function ifNULL($dates , $fild , $description , $alias){
    //     $className = static :: class;
    //     $obj = factory :: factory($className);
    //     $obj -> base .= " ,IFNULL". "( " . $dates .'.'. $fild .' , '. $description ." )" . $alias;
    //     return $obj;
    // }

    // protected function orderBy($alias , $sort){
    //     $className = static :: class;
    //     $obj = factory :: factory($className);
    //     $obj -> type = "orderBy";
    //     $obj -> orderBy = " ORDER BY " . $alias . $sort;
    //     return $obj;
    // }

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
            $this -> where = [];
            $this -> join = '';
        }

        // if($this -> type == "orderBy"){
        //     $obj -> base .= ' ,'. $obj -> countQuery;
        //     $obj -> from();
        //     $obj -> base .= $obj -> orderBy;
        //     $crud = $obj -> base;
        // }
        // if(isset($obj -> groupBy)){
        //     $crud .= $obj -> groupBy;
        //     $obj -> groupBy = '';
        // }

        if($this -> countQuery && $this -> x){
            $this -> base .= ','.$this -> countQuery;
            $this -> from();
            $crud = $this -> base;
            $this -> countQuery = '';
        }

        if(isset($this -> where)){
            $crud .= " WHERE " . implode('AND', $this -> where);
            $this -> where = [];
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

        // if(in_array($this -> type , ['pagenate'])){// , 'join' , 'sort' , 'belongsTo' , 'whidQuery' , 'countQuery' , "if" , "orderBy"
        //     $base = $obj -> getSql();
        //     return $obj :: $connection -> query($base);
        // }

        if(in_array($this -> type , ['countQuery' , 'whidQuery'])){
            $base = $this -> getSql();
            $base = $this -> fetchassoc($base);
            return $this -> connection -> query($base);
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