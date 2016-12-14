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
  <title>Contact</title>
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
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">C’RAGE</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home<span class="sr-only">(current)</span></a></li>
        <li><a href="men.php">Men</a></li>
        <li><a href="men.php">Women</a></li>
        <li><a href="kids.php">Kids</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Product <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="smocks.php">Smocks</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="kente.php">Kente</a></li>
          </ul>
        </li>
        <li><a href="about.php">About Us</a></li>
        <li class="active"><a href="contact.php">Contact</a></li>
      </ul>
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#" data-toggle="modal" data-target="#mycart"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> My Cart <span class="badge"><?php ?></span></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> My Account<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#" data-toggle="modal" data-target="#loginmodal"> LogIn</a></li>

            <li role="separator" class="divider"></li>
            <li><a href="#" data-toggle="modal" data-target="#signupmodal">SignUp</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="modal fade" id="loginmodal">
          <div class="modal-dialog">
            <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="glyphicon glyphicon-lock"></span> Login</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
          <form role="form">
            <div class="form-group">
              <label for="usrname"><span class="glyphicon glyphicon-user"></span> Username</label>
              <input type="text" class="form-control" id="usrname" placeholder="Enter email">
            </div>
            <div class="form-group">
              <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
              <input type="password" class="form-control" id="psw" placeholder="Enter password">
            </div>
            <div class="checkbox">
              <label><input type="checkbox" value="" checked>Remember me</label>
            </div>
              <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-off"></span> Login</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
          <p>Not a member? <a href="#">Sign Up</a></p>
          <p>Forgot <a href="#">Password?</a></p>
        </div>
        </div>
          </div>
</div>
<div class="modal fade" id="signupmodal">
          <div class="modal-dialog">
            <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="glyphicon glyphicon-lock"></span> Sign Up</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
          <form action="#" method="POST">
            <div class="panel-body">
              <div id="hd"><h3>Sign up <small>Be a part of ...... today.</small></h3></div>

              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input name="fullname" type="text" class="form-control" placeholder="Full Name" aria-describedby="sizing-addon2" required oninvalid="this.setCustomValidity('enter your full name')" oninput="setCustomValidity('')" onblur="">
            </div>
            <br>
              <div class="input-group">
                <span class="input-group-addon"><b>@</b></span>
                <input id="email" name="email" type="email" class="form-control" placeholder="email" aria-describedby="sizing-addon2" required oninvalid="this.setCustomValidity('enter your email')" oninput="setCustomValidity('')" onblur="checkemail()">
            </div>
            <div id="e_status"></div>
            <br>
            <div class="form-inline">
              <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                  <input id="age" name="dob" type="date" class="form-control" placeholder="date of birth" aria-describedby="sizing-addon2" required oninvalid="this.setCustomValidity('select your date of birth')" oninput="setCustomValidity('')" onblur="">
              </div>
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                  <input name="tel" type="tel" class="form-control" placeholder="phone number" aria-describedby="sizing-addon2" required oninvalid="this.setCustomValidity('enter your phone number')" oninput="setCustomValidity('')" onblur="">
              </div>
              <div id="a_status"></div>
            </div>
            <br>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input id="username" name="username" type="text" class="form-control" placeholder="username" aria-describedby="sizing-addon2" required oninvalid="this.setCustomValidity('enter a prefered username')" oninput="setCustomValidity('')" value="" onblur="checkusername()">
            </div>
            <div id="u_status" ></div>
            <br>
            <div class="form-inline">
              <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                  <input id=password name="password" type="password" class="form-control" placeholder="password" aria-describedby="sizing-addon2" required oninvalid="this.setCustomValidity('enter a prefered password')" oninput="setCustomValidity('')" onblur="checkpassword()">
              </div>
                  <input id="cpassword" name="cpassword" type="password" class="form-control" placeholder="confirm password" aria-describedby="sizing-addon2" required oninvalid="this.setCustomValidity('confirm your password')" oninput="setCustomValidity('')" value="" onblur="confirmpassowrd()">

                  <div id="p_status"></div>
            </div>
            <br>
            <div class="">
                <button type="submit" class="btn btn-default btn-lg btn-block" id="ex">Sign up <i class="glyphicon glyphicon-"></i></button>
              </div>
              <br>
              </div>

            <div class="panel-footer">
              <p class="" style="color: grey;">You agree to our <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>, including <a href="#">Cookie Use</a> when you sign up to Charley&copy;. People will be able to find you by email, phone number, username and location.</p>
              <p><a href="#">What is all this?</a></p>
            </div>
        </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
          <p class="" style="color: grey;">Already have an Account? <a href="#">Log in now</a></p>
        </div>
        </div>
          </div>
</div>
    <div class="container">
        <div class="jumbotron">
                                  <h1>Contact Info</h1>
                                  <p>Address: Valley View University, Oyibi-Dodowa, Accra, Ghana.</p>
                                  <p>Telephone: 0248277795 & 0267878280</p>
                                  <p>Email: <a href="#">alpha@gmail.com</a></p>

                                  
           </div>
           <div class="row">
              <div class="tabbable" id="tabs">
                            <ul class="nav nav-tabs">
                                <li role="presentation" class="active"><a href="#tab1" data-toggle="tab">Comment</a></li>
                                <li role="presentation"><a href="#tab2" data-toggle="tab">FAQ</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab1">
                                  <form class="form">
                                    <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input name="fullname" type="text" class="form-control" placeholder="Full Name" aria-describedby="sizing-addon2" required oninvalid="this.setCustomValidity('enter your full name')" oninput="setCustomValidity('')" onblur="">
            </div>
                                    <div class="input-group form-inline">
                                      <span class="input-group-addon"><b>@</b></span>
                <input id="email" name="email" type="email" class="form-control" placeholder="email" aria-describedby="sizing-addon2" required oninvalid="this.setCustomValidity('enter your email')" oninput="setCustomValidity('')" onblur="checkemail()">
                                    </div>
                                    <div class="input-group form-inline">
                                      <span class="input-group-addon"><b>Comment</b></span>
                                      <textarea style="height:100px;" name="comment" class="form-control" placeholder="enter your comment" aria-describedby="sizing-addon2">  
                                      </textarea>
                                    </div>
                                    <div class="">
                <button type="submit" class="btn btn-primary btn-lg btn-block" id="ex">Submit<i class="glyphicon glyphicon-"></i></button>
              </div>
                                  </form>
                                </div>
                                <div class="tab-pane" id="tab2">
                                    <form method="post" class="form" action="">
                                        <div class="input-group form-inline">
                                           <span class="input-group-addon"><b>Questions</b></span>
                                           <select name="faq" class="form-control">
                                             <option value="1">1. How long does the product take to get to the destination?</option>
                                             <option value="2">2. Can I pay in foreign currency?</option>
                                             <option value="3">3. Is there a branch close to my area?</option>
                                             <option value="4">4. Can I buy the product and pay on a latter day?</option>
                                             <option value="5">5. Can I get a refund if the product doesn’t suit my specification?</option>
                                             <option value="6">6. Are my private detail secured?</option>
                                             <option value="7">7. What are the compensation given to me if the product doesn’t get to my doorstep?</option>
                                             <option value="8">8. Can my order be delivered internationally?</option>
                                             <option value="9">9. I'm looking for a specific item. How do I search for it?</option>
                                           </select>
                                        </div>
                                        <div class="input-group form-inline">
                                            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                                    
                                    </form>
                                    <?php 
                                        if (isset($_POST['submit'])) {
                                            if(empty($_POST["faq"])){
                                              echo "fill all fields";

                                              }else{
                                                $faq=$_POST['faq'];
                                                if($faq==1) {
                                                 echo "1. It depends on your location, but if it’s within the country it takes less than 3 days to get to the destination."; 
                                                }else if ($faq==2) {
                                                  echo "2.  Yes, you can pay in foreign currency because C’rage is not only for people within the country.";
                                                }else if ($faq==3) {
                                                  echo "3.  C’rage clothes has branches only in Kumasi and Great Accra .";
                                                }else if ($faq==4) {
                                                  echo "4.  No, c’rage clothes does not take money on a later date";
                                                }else if ($faq==5) {
                                                  echo "5.  Yes, C’rage give back refund when customer requirement are not met.";
                                                }else if ($faq==6) {
                                                  echo "6.  Yes, your personal details are protected from anyone outside the company from seeing it.";
                                                }else if ($faq==7) {
                                                  echo "7.  C’rage will refund you your money and give you a special gift on the next purchase.";
                                                }else if ($faq==8) {
                                                  echo "8.  Yes, C’rage can ship your product where ever you desire but only it will be charge on your bill";
                                                }else if ($faq==9) {
                                                  echo "9.  Yes, you can look for your suitable product with our search engines.";
                                                }

                                              }
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
      
  
  <footer>
    <div class="container">
        <div class="row">
          <div class="col-sm-2">
            <h6>Copyright &copy; 2016 Team Alpha</h6>
          </div>
          <div class="col-sm-4">
            <h6>About Us</h6>
            <p>C’rage clothes, your preferred home for quality Ghanaian smocks and kente cloths
At C’rage you get all that you are looking for at a very competitive and moderate price in the shortest possible time.
We offer free delivery for the first list of product you buy.
C’rage products are true expression of the culture of the people in Ghana.
All C’rage products can also be customized to suit the customer/client’s specification and taste.
Just describe or send a sample picture and it shall be done.
No fear with C’RAGE product.
</p>

          </div>
          <div class="col-sm-2">
            <h6>Navigation</h6>
            <ul class="unstyled">
              <li><a href="#">Home</a></li>
              <li><a href="#">Services</a></li>
              <li><a href="#">Product</a></li>
              <li><a href="#">Contact</a></li>
              <li><a href="#">About Us</a></li>
            </ul>
          </div>
          <div class="col-sm-2">
            <h6>Follow Us</h6>
            <ul class="unstyled">
              <li><a href="#">Twitter</a></li>
              <li><a href="#">Facebook</a></li>
              <li><a href="#">Google Plus</a></li>
            </ul>
          </div>
          <div class="col-sm-2">
             <h6>Coded with <span class="glyphicon glyphicon-heart"> by Team Alpha</span></h6>
          </div>
        </div>
    </div>
  </footer>
</body>
</html>
