<?php
if (!empty($_GET["doc_action"])) {
  $doctorId = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';
  // $quantity = isset($_POST['quantity']) ? htmlspecialchars($_POST['quantity']) : '';
  $quantity = 1;
  switch ($_GET["doc_action"]) {
    case "add":
      if (!empty($quantity)) {
        $stmt = $db->prepare("SELECT * FROM doclist where doc_id= ?");
        $stmt->bind_param('i', $doctorId);
        $stmt->execute();
        $productDetails = $stmt->get_result()->fetch_object();
        $itemArray = array($productDetails->doc_id => array('title' => $productDetails->title, 'doc_id' => $productDetails->doc_id, 'quantity' => $quantity, 'fee' => $productDetails->fee));
        if (!empty($_SESSION["doc_item"])) {
          if (in_array($productDetails->doc_id, array_keys($_SESSION["doc_item"]))) {
            foreach ($_SESSION["doc_item"] as $k => $v) {
              if ($productDetails->doc_id == $k) {
                if (empty($_SESSION["doc_item"][$k]["quantity"])) {
                  $_SESSION["doc_item"][$k]["quantity"] = 0;
                }
                $_SESSION["doc_item"][$k]["quantity"] += $quantity;
              }
            }
          } else {
            $_SESSION["doc_item"] = $_SESSION["doc_item"] + $itemArray;
          }
        } else {
          $_SESSION["doc_item"] = $itemArray;
        }
      }
      break;

    case "remove":
      if (!empty($_SESSION["doc_item"])) {
        foreach ($_SESSION["doc_item"] as $k => $v) {
          if ($doctorId == $v['doc_id'])
            unset($_SESSION["doc_item"][$k]);
        }
      }
      break;

    case "empty":
      unset($_SESSION["doc_item"]);
      break;

    case "check":
      header("location:doc_checkout.php");
      break;
  }
}
