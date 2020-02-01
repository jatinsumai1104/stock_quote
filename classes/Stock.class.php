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
          $assoc_array["user_id"]  = Session::getSession("user_id");
          $assoc_array["quantity"] = $data["quantity"];
          $assoc_array["stock_name"] = $data["stock_name"];
          if($data["transaction_period"] == "Intraday"){
          $stock_intraday_id = $this->di->get("Database")->insert("stock_intraday", $assoc_array);
                if($data["order_type"] == "Market"){
                    $assoc_array["transaction_status"] = 1;
                    if($data["order_complexity"] == "Simple"){
                        $assoc_array["order_complexity"] = 0;   
                    }else{
                        $assoc_array["order_complexity"] = 1;   
                    }
                    $assoc_array["intra_delivery"] = 0;
                    $assoc_array["transaction_price_type"] = 1;
                    $assoc_array["buy_sell"] = 0;
                    $assoc_array["price"] = $data["quantity"]*$data["stock_price"];
                    $assoc_array["transaction_date"] = date("Y-m-d");
                 $stock_intraday_id = $this->di->get("Database")->insert("transaction_history", $assoc_array); 
                }else{
                    //LIMIT daal raha hu
                    $assoc_array["transaction_status"] = 0;
                    if($data["order_complexity"] == "Simple"){
                        $assoc_array["order_complexity"] = 0;   
                    }else{
                        $assoc_array["order_complexity"] = 1;   
                    }
                    
                    $assoc_array["intra_delivery"] = 0;
                    $assoc_array["transaction_price_type"] = 0;
                    $assoc_array["buy_sell"] = 0;
                    $assoc_array["transaction_date"] = date("Y-m-d");
                    $assoc_array["price"] = $data["quantity"]*$data["trigger_quantity"];
                    
                 $stock_intraday_id = $this->di->get("Database")->insert("transaction_history", $assoc_array); 
                }
          }else{
            $stock_delivery_id = $this->di->get("Database")->insert("stock_delivery", $assoc_array);
            if($data["order_type"] == "Market"){
                $assoc_array["transaction_status"] = 1;
                if($data["order_complexity"] == "Simple"){
                    $assoc_array["order_complexity"] = 0;   
                }else{
                    $assoc_array["order_complexity"] = 1;   
                }
                $assoc_array["intra_delivery"] = 1;
                $assoc_array["transaction_price_type"] = 1;
                $assoc_array["buy_sell"] = 0;
                $assoc_array["price"] = $data["quantity"]*$data["stock_price"];
                $assoc_array["transaction_date"] = date("Y-m-d");
             $stock_intraday_id = $this->di->get("Database")->insert("transaction_history", $assoc_array); 
            }else{
                //LIMIT daal raha hu
                $assoc_array["transaction_status"] = 0;
                if($data["order_complexity"] == "Simple"){
                    $assoc_array["order_complexity"] = 0;   
                }else{
                    $assoc_array["order_complexity"] = 1;   
                }
                
                $assoc_array["intra_delivery"] = 1;
                $assoc_array["transaction_price_type"] = 0;
                $assoc_array["buy_sell"] = 0;
                $assoc_array["price"] = $data["quantity"]*$data["trigger_quantity"];
                $assoc_array["transaction_date"] = date("Y-m-d");
             $stock_intraday_id = $this->di->get("Database")->insert("transaction_history", $assoc_array); 
            }  
          }

          
          $this->di->get("Database")->commit();
          Session::setSession("saveStock", "Stock save success");
      } catch (Exception $e) {
          $this->di->get("Database")->rollback();
          Session::setSession("saveStock", "Stock save error");
      }
  }

}
?>
