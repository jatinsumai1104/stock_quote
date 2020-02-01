<?php
require_once __DIR__ . "/../helper/requirements.php";
class TransactionHistory{
    private $table = "transaction_history";
    protected $di;
    public function __construct($di){
        $this->di = $di;
    }


    public function getHistory($user_id){
        try{
            $this->di->get('Database')->beginTransaction();
            $query = "SELECT * FROM transaction_history WHERE user_id = $user_id ORDER BY id DESC";
            
            $result = $this->di->get('Database')->rawQuery($query);

            $this->di->get('Database')->commit();
            return $result;
        }catch(Exception $e){
            $this->di->get('Database')->rollback();
        }
    }
    public function getOpenHistory($user_id){
        try{
            $this->di->get('Database')->beginTransaction();
            $query = "SELECT * FROM transaction_history WHERE user_id = $user_id AND transaction_status = 0 ORDER BY id DESC";
            
            $result = $this->di->get('Database')->rawQuery($query);

            $this->di->get('Database')->commit();
            return $result;
        }catch(Exception $e){
            $this->di->get('Database')->rollback();
        }
    }
    public function getClosedHistory($user_id){
        try{
            $this->di->get('Database')->beginTransaction();
            $query = "SELECT * FROM transaction_history WHERE user_id = $user_id AND transaction_status = 1 ORDER BY id DESC";
            
            $result = $this->di->get('Database')->rawQuery($query);

            $this->di->get('Database')->commit();
            return $result;
        }catch(Exception $e){
            $this->di->get('Database')->rollback();
        }
    }
}

?>