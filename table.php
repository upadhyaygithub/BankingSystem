<?php
include("userinvike.php");
error_reporting(0);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>User Details></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    </head>
 <body background = "anders-jilden-AkUR27wtaxs-unsplash.jpg">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">SparkBank</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
        <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
        </li>
      <li class="nav-item">
        <a class="nav-link" href="About.html">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="table.php">User</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.html">LogOut</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="transactiontable.php">Transaction</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="userinformation.html">userinformation</a>
      </li>
      


   
      </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
  <div>
      <h3 class="text-center py-4">User Details.!</h3>
    </div>

<div class="container">
 <div class="row">
   <div class="col-sm-11">
    <?php echo $deleteMsg??''; ?>
    <div class="table-responsive">
      <table class="table table-bordered">
       <thead><tr><th>id</th>
         <th>username</th>
         <th>accountnumber</th>
         <th>amount</th>
         <th>branch</th>
        
    </thead>
    <tbody>
  <?php
      if(is_array($fetchData)){      
      $id=1;
      foreach($fetchData as $data){
    ?>
      <tr>
      <td><?php echo $id; ?></td>
      <td><?php echo $data['username']??''; ?></td>
      <td><?php echo $data['accountnumber']??''; ?></td>
      <td><?php echo $data['amount']??''; ?></td>
      <td><?php echo $data['branch']??''; ?></td>

     
     </tr>
     <?php
      $id++;}}else{ 
        ?>
      <tr>
        <td colspan="11">
    <?php echo $fetchData; ?>
  </td>
    <tr>
    <?php
    }?>
    </tbody>
     </table>
   </div>
</div>
</div>
</div>

<footer>
  <p class="p-3 bg-dark text-white text-center">@SparkBank</p>
</footer>

</body>
</html>