<?php ?>

<html>
    <head>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    </head>
    
    
<body>
<div class="container">
<div class="row">
    <h2>Welcome, You are successfully logged in. </h2>
    <div class="col-sm-4">
       
    </div>
</div></div>

<div class="container">
    <h4>Select Recharge Amount</h4>
<div class="row">

 <div class="col-md-6 col-sm-6 col-xs-12">
<form class="form-group" action="/vendor/bitpay/php-client/examples/tutorial/003_createInvoice.php" method="POST" style="display: -webkit-box;">
<select class="form-control" name="Amount" style="width: 50%;">
 <option selected value="">Select the amount</option>
<option value="1">$1</option>
<option value="1.4">$1.4</option>
<option value="2">$2</option>
</select>
<input class="btn btn-primary" type="submit" name="submit" value="Recharge Now" style="
    margin-left: 10px;" />
</form>

</div>

<div class="">
    
    


<?php


if(!empty($_POST['Amount'])){
  $sql = "INSERT INTO Mypay (Amount) VALUES ('$_POST[Amount]')";
    
}






//$url = 'http://sitenow.host/vendor/bitpay/php-client/examples/tmp/ipn.php';

//$data = file_get_contents($url);

//$character = json_decode($data, true);


//$money = $character['price'];


//$query = "INSERT INTO Mypay (money) VALUES('$money')";

//if(!mysql_query($query, $conn)) { die('Error : Query Not Executed. Please Fix

//the Issue! ' . mysql_error()); } else{ echo "Data Inserted Successully!!!"; }



?>
    
</div> 



</div></div>
</body>
</html>

