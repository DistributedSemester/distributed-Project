<?php 
	if ($_SERVER['REQUEST_METHOD']== "GET")  {
		echo "it is GET";
	}elseif ($_SERVER['REQUEST_METHOD']== "POST") {
		if (isset($_POST['username']) && isset($_POST['password']))
		{
			if (isset($_POST['username']) && $_POST['username'] == "tee" && isset($_POST['password']) && $_POST['password'] == "tee") 
			{
			echo "correct";

			}
		}
		else
		{
			echo "incorrect";
		}
		
	}
 ?>