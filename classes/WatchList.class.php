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

}
?>
