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
              $query = "SELECT * from stock_intraday where stock_name = '{$data["stock_name"]}' AND user_id={$assoc_array["user_id"]}";
              $res = $this->di->get("Database")->rawQuery($query);
              if(count($res)>0){
                  
                  $new_quantity = $res[0]["quantity"]+$assoc_array["quantity"];
                  
                $res = $this->di->get("Database")->update("stock_intraday",["quantity"=>$new_quantity],"user_id={$assoc_array["user_id"]} and stock_name = '{$data["stock_name"]}'");
              
              }else{
                   $stock_intraday_id = $this->di->get("Database")->insert("stock_intraday", $assoc_array);
              }
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
              $query = "SELECT * from stock_delivery where stock_name = '{$data["stock_name"]}' AND user_id={$assoc_array["user_id"]}";
              $res = $this->di->get("Database")->rawQuery($query);
              if(count($res)>0){
                  $new_quantity = $res["quantity"]+$assoc_array["quantity"];
                  $res = $this->di->get("Database")->update("stock_delivery",["quantity"=>$new_quantity],"user_id={$assoc_array["user_id"]} and stock_name = '{$data["stock_name"]}'");
            }else{
              $stock_delivery_id = $this->di->get("Database")->insert("stock_delivery", $assoc_array);
            }
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
            $query="SELECT * FROM money WHERE user_id={$assoc_array['user_id']}";
            $res = $this->di->get("Database")->rawQuery($query);
            $new_balance = $res[0]["balance"] - $assoc_array["price"];
          //   echo $res[0]["balance"];
          //   echo $assoc_array["price"];
          if($new_balance > 0 ){
            $res = $this->di->get("Database")->update("money",["balance"=>$new_balance],"user_id={$assoc_array["user_id"]}");
          }else{
              Session::setSession("insufficentBalance", "Don't have enough balance");
          }
            $this->di->get("Database")->commit();
            Session::setSession("saveStock", "Stock save success");
        } catch (Exception $e) {
            $this->di->get("Database")->rollback();
            Session::setSession("saveStock", "Stock save error");
        }
    }
  

    public function getStocksQuantity($user_id){
        $res = [];
        $query = "SELECT *, 'intraday' as delivery_type FROM stock_intraday WHERE user_id = $user_id";
        $temp = $this->di->get("Database")->rawQuery($query);
        if(count($temp) != 0){
            $res = $temp;
        }
        $query = "SELECT *, 'delivery' as delivery_type FROM stock_delivery WHERE user_id = $user_id";
        $temp = $this->di->get("Database")->rawQuery($query);
        if(count($temp) != 0){
            if(count($res) == 0){
                $res = $temp;
            }else{
                array_push($res, $temp);
            }
        }
        
        return $res;
    }


  public function sellStock($data){
    try {
        $this->di->get("Database")->beginTransaction();
        $assoc_array["user_id"]  = Session::getSession("user_id");
        if($data["order_type"] == "Intraday"){
            $query = "SELECT * FROM stock_intraday WHERE user_id={$assoc_array['user_id']} and stock_name = '{$data["stock_name"]}'";
            $res = $this->di->get("Database")->rawQuery($query);
            $new_quantity = $res[0]["quantity"]-$data["sell_quantity"]; 
            if($new_quantity > 0){  
            $res = $this->di->get("Database")->update("stock_intraday",["quantity"=>$new_quantity],"user_id={$assoc_array["user_id"]} and stock_name = '{$data["stock_name"]}'");
            }else{
                Session::setSession("sellStockFail", "Not enough quantity to sell");
            }
        }else{
            $query = "SELECT * FROM stock_delivery WHERE user_id={$assoc_array['user_id']} and stock_name = '{$data["stock_name"]}'";
            $res = $this->di->get("Database")->rawQuery($query);
            $new_quantity = $res[0]["quantity"]-$data["sell_quantity"];   
            if($new_quantity > 0){  
                $res = $this->di->get("Database")->update("stock_delivery",["quantity"=>$new_quantity],"user_id={$assoc_array["user_id"]} and stock_name = '{$data["stock_name"]}'");
                }else{
                    Session::setSession("sellStockFail", "Not enough quantity to sell");
                }
        }

        $query="SELECT * FROM money WHERE user_id={$assoc_array['user_id']}";
          $res = $this->di->get("Database")->rawQuery($query);
          $new_balance = $res[0]["balance"] + $data["sell_quantity"]*$data["realtime_price"];
          echo $new_balance;
          
          $res = $this->di->get("Database")->update("money",["balance"=>$new_balance],"user_id={$assoc_array["user_id"]}");

          $this->di->get("Database")->commit();
          //die();
        Session::setSession("sellStockSuccess", "Stock sell success");
    } catch (Exception $e) {
        $this->di->get("Database")->rollback();
        Session::setSession("sellStockFailed", "some shitty error");
    }
  }

}
?>
