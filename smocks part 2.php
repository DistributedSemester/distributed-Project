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
        <div class="container-fluid">
          <div class="page-header">
            <h1>Smocks</h1>
          </div>
          <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10">
      <div class="row">
              <?php
              $product_array = $db_handle->runQuery("SELECT * FROM `product_tbl` WHERE `type`='smock' ORDER BY id ASC");
              if (!empty($product_array)) { 
                foreach($product_array as $key=>$value){
              ?>
              <div class="col-md-4"> 
              <div class="thumbnail">
                  <img src="<?php echo $product_array[$key]["image"]; ?>" alt="load">
                  <div class="label label-success price"><span class="glyphicon glyphicon-tag"></span> <sup>&#8373;</sup><?php echo $product_array[$key]["price"]; ?></div>
                  <div class="caption">
                    <h3><?php echo $product_array[$key]["name"]; ?></h3>
                    <form role="form" action="index.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>" method="post">
                      <div class="row">
                        <input class="form-control" type="text" name="quantity" value="1" size="2" /><input type="submit" value="Add to cart" class="form-control"/>
                      </div>
                    </form>
                  </div>
              </div>
              </div>
              <?php
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
              <li><a href="index.php">Home</a></li>
              <li><a href="services.php">Services</a></li>
              <li><a href="product.php">Product</a></li>
              <li><a href="contact.php">Contact</a></li>
              <li><a href="about.php">About Us</a></li>
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
