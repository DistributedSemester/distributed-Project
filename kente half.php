<?php
session_start();
require_once("dbconnect.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
  case "add":
    if(!empty($_POST["quantity"])) {
      $productByCode = $db_handle->runQuery("SELECT * FROM product_tbl WHERE code='" . $_GET["code"] . "'");
      $itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"]));
      
      if(!empty($_SESSION["cart_item"])) {
        if(in_array($productByCode[0]["code"],$_SESSION["cart_item"])) {
          foreach($_SESSION["cart_item"] as $k => $v) {
              if($productByCode[0]["code"] == $k)
                $_SESSION["cart_item"][$k]["quantity"] = $_POST["quantity"];
          }
        } else {
          $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
        }
      } else {
        $_SESSION["cart_item"] = $itemArray;
      }
    }
  break;
  case "remove":
    if(!empty($_SESSION["cart_item"])) {
      foreach($_SESSION["cart_item"] as $k => $v) {
          if($_GET["code"] == $k)
            unset($_SESSION["cart_item"][$k]);        
          if(empty($_SESSION["cart_item"]))
            unset($_SESSION["cart_item"]);
      }
    }
  break;
  case "empty":
    unset($_SESSION["cart_item"]);
  break;  
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Kente</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<!-- Custom CSS -->
<link rel="stylesheet" type="text/css" href="styles.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  
  
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>

</head>
<body style="padding-top:70px">
<div class="modal fade" id="mycart">
          <div class="modal-dialog">
            <!-- Modal content-->
          <div class="modal-content">
          <div class="modal-header" style="padding:35px 50px;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4><span class="glyphicon glyphicon-shopping-cart"></span>My Cart</h4>
          </div>
          <div class="modal-body" style="padding:40px 50px;">
            <?php
            
            ?> 
              <table class="table">
                    <tbody>
                      <th><strong>Name</strong></th>
                      <th><strong>Code</strong></th>
                      <th><strong>Quantity</strong></th>
                      <th><strong>Price</strong></th>
                      <th><strong>Action</strong></th>
                      <tr></tr>
                    </tbody> 
              <?php
                if(isset($_SESSION["cart_item"])){
                $item_total = 0;  
                foreach ($_SESSION["cart_item"] as $item){
              ?>
                    <tr>
                    <td><strong><?php echo $item["name"]; ?></strong></td>
                    <td><?php echo $item["code"]; ?></td>
                    <td><?php echo $item["quantity"]; ?></td>
                    <td align=center><?php echo "&#8373;".$item["price"]; ?></td>
                    <td><a href="index.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction">Remove Item</a></td>
                    </tr>
                    <?php
                    $item_total += ($item["price"]*$item["quantity"]);
                }
              }else{ echo "Cart Empty";}
            ?>
            <td colspan="5" align=right><strong>Total:</strong> 
            <?php 
              if(!isset($item_total)){
                $item_total=0.00;
              }
             echo "&#8373;".$item_total; 
            ?>
            </td>
            </table>
          </div>
          <div class="modal-footer">
          <a href="index.php?action=empty" role="button" class="btn btn-danger btn-default pull-left"><span class="glyphicon glyphicon-remove"></span>Empty Cart</a>
          <button type="submit" class="btn btn-success btn-default pull-right"><span class="glyphicon glyphicon-off"></span> Pay</button>
          </div>
          </div>
          </div>
</div>