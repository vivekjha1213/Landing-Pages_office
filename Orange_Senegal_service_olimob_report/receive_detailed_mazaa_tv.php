<head>
  <title> Orange_Senegal_service_olimob </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<?php
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=download.xls');
?>
<?php
include("Connection.php");
$from=$_POST['excelfrom'];
$to=$_POST['excelto'];

$sql3="SELECT status,count(status) as counter From senegalOrangePinVerify where DATE(date) between '$from' and '$to' group by status";
$result3 = $mysqli->query($sql3);
//exit();
?>
<div class="container" >
<table class="table table-striped">
    <thead>
    <tr>
  <th>STATUS</th>
  <th>COUNT</th>
    </tr>
    </thead>
    <tbody>
<?php
while($row3=$result3->fetch_array())
{ ?>
    <td><?php echo $row3['status']; ?></td>
    <td><?php echo $row3['counter']; ?></td>
    </tbody>
<?php

} ?>
</table>
</div>
<br>
<?php
 $sql1="SELECT * From senegalOrangePinVerify where DATE(date) between '$from' and '$to' order by date desc";
//exit();
//exit();
$result = $mysqli->query($sql1);
// SELECT distinct msisdn,status From mis_listener where time_india
// -> between '2020-04-01' and '2020-04-16'and country='th' group by msisdn;
//echo $result->num_rows;
//exit();
if ($result->num_rows > 0) {
 ?>
  <div class="container">
  <h2>Datewise Numbers Successfully Done.</h2>
<table class="table table-striped">
    <thead>
    <tr>
    <th>S.NO</th>
  <!--<th>TOKEN</th>-->
  <th>MSISDN</th>
  <!--<th>PIN</th>-->
  <th>RESULT</th>
  <!--<th>SUBSCRIPTION-RESULT</th>-->
  <th>STATUS</th>
  <th>DATE</th>
    </tr>
    </thead>
    <tbody>

    <?php
    $sno=0;
    while($row3=$result->fetch_array())
    { $sno++;
      ?>
    <tr>
    <td><?php echo $sno; ?></td>
    <td><?php echo $row3['msisdn']; ?></td>
    <td><?php echo $row3['otp']; ?></td>
    <td><?php echo $row3['result'];?></td>
    <td><?php echo $row3['status'];?></td>
    <td><?php echo $row3['transactionId'];?></td>
    <td><?php echo $row3['indiaTimeZone'];?></td>
    <td><?php echo $row3['serviceTimeZone'];?></td>
    </tr>
  
    <?php }?>
   </tbody>

   </table>
   </div>


<?php }
else
{
    echo "0 results";
}


?>
