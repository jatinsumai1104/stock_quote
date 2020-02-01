<?php

class User{
    private $table = "user";
    protected $di;
    public function __construct($di){
        $this->di = $di;
    }

    function getBalance($user_id){
        try{
            $this->di->get("Database")->beginTransaction();
            $query = "SELECT balance FROM money WHERE user_id = '$user_id'";
            $result = $this->di->get("Database")->rawQuery($query);
            return $result;
        }catch(Exception $e){
            $this->di-get("Database")->rollback();
        }
    }
}



?>