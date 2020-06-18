<?php 

  require_once('connect.php');

  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
  // Retrieve the user data from MySQL
  $query = "select bed.state,maternal.name,maternal.age,maternal.condition,maternal.date,maternal.picture FROM
            bed LEFT JOIN maternal on bed.mat_id=maternal.mat_id where bed.bed_id='05'";
  $data = mysqli_query($dbc, $query);

  $row = mysqli_fetch_array($data);
  if(mysqli_num_rows($data)==1){
    $state = $row['state'];
    $name = $row['name'];
    $age = $row['age'];
    $condition = $row['condition'];
    $date = $row['date'];
    $picture = $row['picture'];
  }
  if($state=="空闲") $picture="picture2.png";
  echo("<div class='bedInfo'>");
    echo ("<div class='photoPane'>");
       echo("<img src='images/".$picture."' alt='...' id='05'>");
    echo("</div>");
    echo("<hr id='hr3'>");
    echo("<p>05床</p>");
  echo("</div>");
  echo("<div class='patientInfo' id='patientInfo1'>");
    echo ("<P>状态: ".$state."</p>");
    echo ("<P>姓名: ".$name."</p>");
    echo ("<P>年龄: ".$age."</p>");
    echo ("<P>情况: ".$condition."</p>");
    echo ("<P>日期: ".$date."</p>");
  echo("</div>");

?>