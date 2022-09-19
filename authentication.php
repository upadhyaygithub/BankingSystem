<?php
include("connected.php");



if(isset($_POST['submit']))
{   
   $from = $_POST['from'];

   // THIS SNIPPET SHOULD BE UNCOMMENTED AFTER AUTHENTICATION PART

   //$from= $_SESSION['id'];


    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $from_query = "SELECT * from accounts where id=$from";
    $from_result = mysqli_query($conn,$from_query);
    $from_rows = mysqli_fetch_array($from_result); // returns array or output of user from which the amount is to be transferred.

    $to_query = "SELECT * from accounts where id=$to";
    $to_result = mysqli_query($conn,$to_query);
    $to_rows = mysqli_fetch_array($to_result);



    // constraint to check input of negative value by user
    if (($amount)<0)
   {
        echo '<script type="text/javascript">';
        echo ' alert("Oops! Negative values cannot be transferred")';  // showing an alert box.
        echo '</script>';
    }



    // constraint to check insufficient balance.
    else if($amount > $from_rows['amount']) 
    {

        echo '<script type="text/javascript">';
        echo ' alert("Bad Luck! Insufficient Balance")';  // showing an alert box.
        echo '</script>';
    }



    // constraint to check zero values
    else if($amount == 0){

         echo "<script type='text/javascript'>";
         echo "alert('Oops! Zero value cannot be transferred')";
         echo "</script>";
     }


    else {

                // deducting amount from sender's account
                $newamount = $from_rows['amount'] - $amount;
                $from_update_query = "UPDATE accounts set amount=$newamount where id=$from";
                if(mysqli_query($conn,$from_update_query)){
                    echo "amount deducted succesfully ";
                }


                // adding amount to reciever's account
                $incr_amount = $to_rows['amount'] + $amount;
                $to_update_query = "UPDATE accounts set amount=$incr_amount where id=$to";
                if(mysqli_query($conn,$to_update_query)){
                    echo "amount debited succesfully ";
                }

                $sender_username = $from_rows['username'];
                $receiver_username = $to_rows['username'];
                $transaction_query = "INSERT INTO transaction(`sender_username`, `receiver_username`, `balance`) VALUES ('$sender_username','$receiver_username','$amount')";
                $transaction_result=mysqli_query($conn,$transaction_query);

                if($transaction_result){
                    
                     echo "<script> alert('Hurray! Transaction is Successful');
                                     
                                     window.location='transactiontable.php';
                                     
                           </script>";
                         

                }
                
                else{
                    echo "<script> alert('Oops! Transaction cannot be inserted');
                    window.location='transactions.php';
                     </script>";

                }

               // $newamount= 0;
                $amount =0;
        }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<!-- Navigation bar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Spark Bank:)  </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.html">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="table.php">User</a>
       
</div>


      </ul>

    </div>
  </div>
</nav>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Easy Money Transfer</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/table.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">

    <style type="text/css">



		button{
			border:none;
			background: #d9d9d9;
		}
	    button:hover{
			background-color:#777E8B;
			transform: scale(1.1);
			color:white;
		}

    </style>
</head>

<body style="background-color : #00008B ;">


	<div class="container">
        <h2 class="text-center pt-4" style="color : white;">Easy Money Transfer</h2>
            <?php
                include("connected.php");
                $sid=9999;
                $sql = "SELECT * FROM  accounts where id='$sid'";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error : ".$sql."<br>".mysqli_error($conn);
                }
                $rows=mysqli_fetch_assoc($result);

                
            ?>
            
            
            <form method="post" username="tcredit" class="tabletext" ><br>
            
        <!-- <div>
             
                
                    <table class="table table-striped table-condensed table-bordered">
                        <tr style="color : white;">
                            <th class="text-center">id</th>
                            <th class="text-center">username</th>
                            <th class="text-center">accountnumber</th>
                            <th class="text-center">amount</th>
                            <th class="text-center">branch</th>
                        </tr>
                        
                        <tr style="color : white;">
                            <td class="py-1"><?php echo $rows['id'] ?></td>
                            <td class="py-1"><?php echo $rows['username'] ?></td>
                            <td class="py-1"><?php echo $rows['accountnumber'] ?></td>
                            <td class="py-1"><?php echo $rows['amount'] ?></td>
                            <td class="py-1"><?php echo $rows['branch'] ?></td>
                        </tr>
                    </table>
                    
              
                
         </div>-->
        
        
        <br> <label style="color : white;"><b>Transfer from:</b></label>
        <select name="from" class="form-control" required>
            <option value="" disabled selected>Choose username</option>
            <?php
                 include("connected.php");
                    $sid=99999;
                $sql = "SELECT * FROM accounts where id!='$sid'";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error ".$sql."<br>".mysqli_error($conn);
                }
                while($rows = mysqli_fetch_assoc($result)) {
            ?>
                <option class="table" value="<?php echo $rows['id'];?>" >

                    <?php echo $rows['username'] ;?> (amount: 
                    <?php echo $rows['amount'] ;?> ) 

                </option>
            <?php 
                } 
            ?>
            <div>
        </select><br><br>
        <label style="color : white;"><b>Transfer To:</b></label>
        <select name="to" class="form-control" required>
            <option value="" disabled selected>Choose username</option>
            <?php
                // include("connected.php");
                $sid=9999;
                $sql = "SELECT * FROM accounts where id!='$sid'";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error ".$sql."<br>".mysqli_error($conn);
                }
                while($rows = mysqli_fetch_assoc($result)) {
            ?>
                <option class="table" value="<?php echo $rows['id'];?>" >

                    <?php echo $rows['username'] ;?> (amount: 
                    <?php echo $rows['amount'] ;?> ) 

                </option>
            <?php 
                } 
            ?>
            <div>
        </select>
        <br>
        <br>
            <label style="color : white;"><b>Amount:</b></label>
            <input type="number" class="form-control" name="amount" required>   
            <br><br>
                <div class="text-center" >
            <button class="btn mt-3" name="submit" type="submit" id="myBtn" >Transfer Money</button>
            </div>
        </form>
    </div>
    
    <footer class="text-center mt-5 py-2 "style="color : white;">
            <p>&copy 2022 <b>Umang Upadhyay</b> <br> SparkBank:)</p>
    </footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>