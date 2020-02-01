<?php
require_once __DIR__ . "/../helper/requirements.php";
class Stock
{
    private $table = "";
    protected $di;
    public function __construct($di)
    {
        $this->di = $di;
    }

    
    

    public function saveStock($data){
      try {
          $this->di->get("Database")->beginTransaction();
          $assoc_array =[];
          $assoc_array["user_id"]  = $this->di->get("Session")->getSession("user_id");
          $assoc_array["quantity"] = $data["quantity"];
          $assoc_array["stock_name"] = $data["stock_name"];
          if($data["transaction_period"] == "Intraday"){
          $stock_intraday_id = $this->di->get("Database")->insert("stock_intraday", $assoc_array);
          }else{
            $stock_delivery_id = $this->di->get("Database")->insert("stock_delivery", $assoc_array);  
          }

          $assoc_array =  [];
          $assoc_array["user_id"]  = $this->di->get("Session")->getSession("user_id");
          $assoc_array["stock_name"] = $data["stock_name"];

          
          $this->di->get("Database")->commit();
          Session::setSession("edit", "Delete product success");
      } catch (Exception $e) {
          $this->di->get("Database")->rollback();
          Session::setSession("edit", "Delete product error");
      }
  }

}
?>
