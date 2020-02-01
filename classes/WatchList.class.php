<?php
require_once __DIR__ . "/../helper/requirements.php";
class WatchList
{
    private $table = "watch_list";
    protected $di;
    public function __construct($di)
    {
        $this->di = $di;
    }

    public function addWatchList($data){
      try {
          // Begin Transaction
          $this->di->get("Database")->beginTransaction();
          $assoc_array = ["watch_list_name" => $data['name'], "user_id"=>Session::getSession("user_id")];
          $category_id = $this->di->get("Database")->insert($this->table, $assoc_array);
          $this->di->get("Database")->commit();
          // end transaction
          Session::setSession("add", "Add Category success");
      } catch (Exception $e) {
          $this->di->get("Database")->rollback();
          Session::setSession("add", "Add Category error");
      }
    }

    public function getAllWatchList(){
      return $this->di->get("Database")->readData($this->table, ["*"], "deleted = 0");
    }

    public function update($data){
      $validation = $this->validateData($data);

      if (!$validation->fails()) {
          try{
            $this->di->get("Database")->beginTransaction();
            $assoc_array["name"] = $data["name"];
            $this->di->get("Database")->update($this->table, $assoc_array, "id={$data['category_id']}");
            $this->di->get("Database")->commit();
            Session::setSession("edit", "Edit Category success");
          }catch(Exception $e){
            $this->di->get("Database")->rollback();
            Session::setSession("edit", "Edit Category error");
          }
      }else{
        Session::setSession("validation", "Category Validation error");
      }
    }


    public function addStock($watch_list_id , $stock_name){
      try{
        $this->di->get("Database")->beginTransaction();
        $query = "INSERT INTO watch_list_stock(watch_list_id,stock_name) VALUES('$watch_list_id','$stock_name')";
        $this->di->get("Database")->query($query);
        $this->di->get("Database")->commit();
      }catch(Exception $e){
        $this->di->get("Database")->rollback();
      }      
    }
    

    public function delete($data){
      try {
          $this->di->get("Database")->beginTransaction();
          
          $this->di->get("Database")->delete($this->table, "id = " . $data['id']);
          
          $this->di->get("Database")->commit();
          Session::setSession("edit", "Delete product success");
      } catch (Exception $e) {
          $this->di->get("Database")->rollback();
          Session::setSession("edit", "Delete product error");
      }
  }


  public function getStocksNameByID($id){
    return $this->di->get("Database")->readData("watch_list_stock", ["stock_name"], "watch_list_id = $id");
  }

}
?>
