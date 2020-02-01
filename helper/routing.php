<?php

require_once "init.php";

// Routing Template
// if (isset($_POST['check_button'])) {
//     if (Util::verifyCSRF($_POST)) {
//         $di->get("CLASS_NAME")->FUNCTION_CALL($_POST);
//         Util::redirect("AFTER_SUCCESS_PAGE");
//     }else{
//         Session::setSession("csrf", "CSRF error");
//         Util::redirect("login");
//     }
// }


//Add Watch List
if (isset($_POST['add_watch_list'])) {
  // var_dump($_POST);
    if (Util::verifyCSRF($_POST)) {
        $di->get("WatchList")->addWatchList($_POST);
        Util::redirect("index");
    }else{
        Session::setSession("csrf", "CSRF error");
        Util::redirect("login");
    }
}

//Auth Routings
if (isset($_POST['login_details'])) {
  if (isset($_POST['csrf_token']) && isset($_SESSION["csrf_token"]) && $_POST['csrf_token'] == Session::getSession("csrf_token")) {
      $di->get("Auth")->login($_POST);
  } else {
      Util::redirect("login");
  }
}

if (isset($_POST['register_button'])) {
  $di->get("Auth")->register($_POST);
}

if (isset($_POST['logout'])){
  Session::destroySession();
  if(isset($_COOKIE['token'])){
      unset($_COOKIE['token']);
      unset($_COOKIE['user_id']);
  }
  Util::redirect("login");
}

if (isset($_POST['saveStock'])) {
  $di->get("Stock")->saveStock($_POST);

