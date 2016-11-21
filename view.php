<?php

include "module.db.php";

$reply = $module->db->in('yonsei_admission_verification')
                    ->select('*')
                    ->goAndGetAll();


if ($_GET['p'] != "goddongsoo") {
	die("비밀번호가 틀렸습니다.");
}


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
  </head>
  <body>

  <table class="table">
  <thead>
    <tr>
      <th>#</th>
      <th>이름</th>
      <th>수험번호</th>
      <th>생년월일</th>
      <th>이메일</th>
      <th>등록 시간</th>
    </tr>
  </thead>
  <tbody>

  <?php

  for ($i = 0; $i < count($reply); $i++) {
	$row = $reply[$i];
	echo "<tr>";

	echo '<th scope="row">'.$row['no'].'</th>';
	echo '<td>'.base64_decode($row['name']).'</td>';
	echo '<td>'.$row['application_no'].'</td>';
	echo '<td>'.$row['birthdate'].'</td>';
	echo '<td>'.$row['email'].'</td>';
	echo '<td>'.$row['timestamp'].'</td>';
	echo "</tr>";
  }

  ?>
	</tbody>
  </body>
</html>