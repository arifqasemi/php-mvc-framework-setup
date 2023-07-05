<?php
namespace App\Core;

class Model extends Database
{

    public function insert($data){

        $key = array_keys($data);
        if($this->allowedColumn){
            foreach($data as $key => $value){
                if(!in_array($key,$this->allowedColumn)){
                    unset($data[$key]);
                }
            }
          }
      
        if($data){
           
            $query = "insert into ".$this->table. " "."(" .implode(',',$key) .") values(:".implode(',:',$key).")";
            // print_r($query);
            $this->query($query,$data);
        }

    }



    public function update($id,$data){

         $query = "update ".$this->table." set ";
        foreach($data as $key => $value){
            $query .= $key ." =:".$key. ",";
        }
        $query = trim($query,",");
        $query .=" where id = :id";
        $data['id']= $id;
        $this->query($query,$data);
        // print_r($query);
    }


    public function where($data){


        $query = "select * from ".$this->table. " where ";
        foreach($data as $key => $value){
            $query .= $key ." =:".$key. "&&";
        }

        $query = trim($query,"&&");
        $res = $this->query($query,$data);

        return $res;

    }


    public function first($data){

        $query ="select * from ".$this->table." where ";
        foreach($data as $key =>$value){
            $query .= $key."=:".$key. " && ";
        }
        $query = trim($query,"&& ");
        $query .= " order by id $this->order limit 1";
    
        $res = $this->query($query,$data);
        if(is_array($res))
            {
        return $res[0];
            }
    }


    public function findAll(){

        $query ="select * from ".$this->table;
       
    
        $res = $this->query($query);
        return $res;
        
    }

}