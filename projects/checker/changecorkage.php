<?php

		$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = '';
		$connection = mysqli_connect($dbhost,$dbuser,$dbpass,'aml_db');
			
		if(! $connection){
			die('Could not Connect to Database' . mysql_error());
		}


 		if(isset($_POST['changecorkage'])){

 		$varid = $_POST['id'];
 		$varname = $_POST['newdesc'];

		$vartable = $_POST['ordertable']; 
		$varwaiter = $_POST['orderwaiter']; 
		$varcode= $_POST['ordercode'];
		$vartype = $_POST['ordertype'];

		$varchange = $_POST['varchange'];
	    $varprice = $_POST['newprice']; 
	   $varnewquantity = $_POST['varnewquantity']; 
	    $varoldquantity = $_POST['varoldquantity']; 
	    $varpriority = '1'; 

	    $vartprice = $varprice * $varoldquantity;

	    $varquantity = $varoldquantity - $varnewquantity;


		//dbnames
		$vardb = $_POST['vardb'];
		$vardbquantity = $_POST['vardbquantity'];
		$vardbid = $_POST['vardbid'];
		$vardbname = $_POST['vardbname'];
		$vardbtable = $_POST['vardbtable'];
		$vardbcode = $_POST['vardbcode'];
		$vardbprice = $_POST['vardbprice'];
		$vardbwaiter = $_POST['vardbwaiter'];
		$vardbdate= $_POST['vardbdate'];
		$vardbtime = $_POST['vardbtime'];
		$vardbtype = $_POST['vardbtype'];
		$vardbtotalprice = $_POST['vardbtotalprice'];
		$vardbpriority = $_POST['vardbpriority'];
			

	if ($varoldquantity != $varnewquantity) { // if change some
			    	$varoldquantity = $varoldquantity - $varnewquantity ;
			    	$vartprice = $varnewquantity * $varmprice;
			    	$varnewtprice = $varoldquantity * $varprice;

			    if($varchange == 'order'){

			    			
			    	$sql = "INSERT INTO $vardb ($vardbcode, $vardbtable, $vardbwaiter, $vardbtime, $vardbdate, $vardbquantity, $vardbname, $vardbprice ,$vardbtype, $vardbtotalprice, $vardbpriority) VALUES ('$varcode', '$vartable', '$varwaiter',  NOW(),       NOW(), '$varnewquantity', '$varmname', '$varmprice' ,'$vartype', '$vartprice', '$varpriority');";

					$sql1 = "UPDATE $vardb SET $vardbquantity = '$varoldquantity', $vardbprice = '$varprice', $vardbtotalprice = '$varnewtprice', $vardbpriority = '$varpriority'  WHERE $vardbid = $varid";

					   	if ($connection->query($sql) === TRUE && $connection->query($sql1) === TRUE ) {

							echo '<script> window.top.location.reload(); </script>';
						} else {
							echo "Error updating record: " . $connection->error;
						}
						
					}else{

						$sql = "INSERT INTO $vardb ($vardbcode, $vardbtable, $vardbwaiter, $vardbtime, $vardbdate, $vardbquantity, $vardbname, $vardbprice ,$vardbtype, $vardbtotalprice, $vardbpriority) VALUES ('$varcode', '$vartable', '$varwaiter',  NOW(),       NOW(), '$varnewquantity', '$varmname', '$varmprice' ,'$vartype', '$vartprice', '$varpriority');";

							$sql1 = "UPDATE served_db SET served_quantity = '$varoldquantity', served_price ='$varprice', served_tprice = '$vartprice', served_tprice = '$varpriority' WHERE served_id = $varid";

					   		if ($connection->query($sql) === TRUE && $connection->query($sql1) === TRUE) {
								echo '<script> window.top.location.reload(); </script>';
							}else {
								echo "Error updating record: " . $connection->error;
							}
					}
	    }else{  // if change all
	    	$varoldquantity = $varoldquantity - $varnewquantity ;
			    	$vartprice = $varnewquantity * $varmprice;
			    	$varnewtprice = $varoldquantity * $varprice;

	    	if($varchange == 'order'){
		    	$varoldquantity = $varoldquantity; 
		    	$vartprice = $varnewquantity * $varmprice;

	    			 $sql = "UPDATE $vardb SET $vardbname = '$varmname' , $vardbquantity = '$varoldquantity', $vardbprice = '$varmprice', $vardbtotalprice = '$vartprice' , $vardbpriority = '$varpriority' WHERE $vardbid = $varid";

				    if ($connection->query($sql) === TRUE) {
					    echo '<script> window.top.location.reload(); </script>';
					}else{
					    echo "Error updating record: " . $connection->error;
					}

				}else{

					$sql = "INSERT INTO $vardb ($vardbcode, $vardbtable, $vardbwaiter, $vardbtime, $vardbdate, $vardbquantity, $vardbname, $vardbprice ,$vardbtype, $vardbtotalprice, $vardbpriority) VALUES ('$varcode', '$vartable', '$varwaiter',  NOW(),       NOW(), '$varnewquantity', '$varname', '$varprice' ,'$vartype', '$vartprice', '$varpriority');";

							$sql1 = "DELETE FROM served_db WHERE served_id = $varid";

					   		if ($connection->query($sql) === TRUE && $connection->query($sql1) === TRUE) {
								echo '<script> window.top.location.reload(); </script>';
							}else {
								echo "Error updating record: " . $connection->error;
							}
				}
		}

		mysqli_close($connection);
		}
?>