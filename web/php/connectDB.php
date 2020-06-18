<?php
   $host="127.0.0.1";
   $username = "root";
   $password = "123456";
   $databaseName = "deliverroom";

  $dbc = mysqli_connect($host, $username, $password, $databaseName); 
  // Retrieve the user data from MySQL
  $query = "select * from bed";
  $query2 = "SELECT bed.bed_id,maternal.name FROM maternal , bed WHERE maternal.mat_id = bed.mat_id";
  $query3 = "SELECT bed.bed_id ,nurse.name FROM nurse , bed WHERE bed.nur_id = nurse.nur_id ORDER BY bed_id";

  $data = mysqli_query($dbc, $query);
  $data2 = mysqli_query($dbc, $query2);
  $data3 = mysqli_query($dbc, $query3);
  $row2=$data2->fetch_row();
  $row3=$data3->fetch_row();
  // $rowa = mysqli_fetch_array($data);
  while($row=$data->fetch_row()){
  echo "<tr>";
  echo "<td> ".$row[0]."</td>";
  echo "<td>".$row[1]."</td>";
  echo "<td>".$row[2]."</td>";
  echo "<td>".$row[3]."</td>";
  if($row[0]==$row2[0]){
  echo "<td>".$row2[1]."</td>";
  $row2=$data2->fetch_row();
  }//
  else{echo "<td></td>";}
  if($row[0]==$row3[0]){
  echo "<td>".$row3[1]."</td>";
  $row3=$data3->fetch_row();
  }//
  else{echo "<td></td>";
}
  echo "</tr>";
  }
  mysqli_close($dbc);
?>