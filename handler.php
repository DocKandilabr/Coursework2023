<?php
session_start();
require_once 'include/config.php';
$_SESSION['result'] = array();
//echo '<pre>';
//print_r($_POST);
//echo '</pre>';
// echo 'session';
// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';

if($_SESSION['query'] == 1){
   if ($_POST['children']==="") $_POST['children']="-1";
   if ($_POST['experience']==="") $_POST['experience']="-1";
   if ($_POST['age']==="") $_POST['age']="-1"; 
   if ($_POST['salary']==="") $_POST['salary']="-1"; 
   if($_POST['where'] == 1){
      $sql='SELECT `employee`.`crew_id` AS "id Бригади", `employee`.name AS "Повне ім`я", 
      `employee`.`work_start` AS "Дата початку роботи", `employee`.`sex` AS "Стать",
      `employee`.`birthday` AS "Дата народження",`employee`.`children` AS "Кількість дітей",
      `employee`.`salary` AS "Зарплата" from `employee`
      where ('.$_POST['experience'].'=-1 OR TIMESTAMPDIFF(YEAR, `employee`.`work_start`, CURDATE())='.$_POST['experience'].') AND 
      ('.$_POST['age'].'=-1 OR TIMESTAMPDIFF(YEAR, `employee`.`birthday`, CURDATE())='.$_POST['age'].') AND
      ('.$_POST['children'].'=-1 OR `employee`.`children`='.$_POST['children'].') AND
      ('.$_POST['salary'].'=-1 OR `employee`.`salary`='.$_POST['salary'].') AND
      ("'.$_POST['sex'].'"="-1" OR `employee`.`sex`="'.$_POST['sex'].'")';
      $results = mysqli_query($connection, $sql);
      while($result = mysqli_fetch_assoc($results))
      {
         $_SESSION['result'][] = $result;
      }
   }
   else if($_POST['where'] == 2){
      $sql='SELECT `employee`.`crew_id` AS "id Бригади", `employee`.name AS "Повне ім`я", 
      `employee`.`work_start` AS "Дата початку роботи", `employee`.`sex` AS "Стать",
      `employee`.`birthday` AS "Дата народження",`employee`.`children` AS "Кількість дітей",
      `employee`.`salary` AS "Зарплата" from `employee`
      where ('.$_POST['experience'].'=-1 OR TIMESTAMPDIFF(YEAR, `employee`.`work_start`, CURDATE())='.$_POST['experience'].') AND 
      ('.$_POST['age'].'=-1 OR TIMESTAMPDIFF(YEAR, `employee`.`birthday`, CURDATE())='.$_POST['age'].') AND
      ('.$_POST['children'].'=-1 OR `employee`.`children`='.$_POST['children'].') AND
      ('.$_POST['salary'].'=-1 OR `employee`.`salary`='.$_POST['salary'].') AND
      ("'.$_POST['sex'].'"="-1" OR `employee`.`sex`="'.$_POST['sex'].'") AND
      `employee`.`employee_id` in (select `division`.`division_chief_id` from `division`)';
      $results = mysqli_query($connection, $sql);
      while($result = mysqli_fetch_assoc($results)){
         $_SESSION['result'][] = $result;
      }
   }
   else {
      $sql='SELECT `employee`.`crew_id` AS "id Бригади", `employee`.name AS "Повне ім`я", 
      `employee`.`work_start` AS "Дата початку роботи", `employee`.`sex` AS "Стать",
      `employee`.`birthday` AS "Дата народження",`employee`.`children` AS "Кількість дітей",
      `employee`.`salary` AS "Зарплата" from `employee`
      where ('.$_POST['experience'].'=-1 OR TIMESTAMPDIFF(YEAR, `employee`.`work_start`, CURDATE())='.$_POST['experience'].') AND 
      ('.$_POST['age'].'=-1 OR TIMESTAMPDIFF(YEAR, `employee`.`birthday`, CURDATE())='.$_POST['age'].') AND
      ('.$_POST['children'].'=-1 OR `employee`.`children`='.$_POST['children'].') AND
      ('.$_POST['salary'].'=-1 OR `employee`.`salary`='.$_POST['salary'].') AND
      ("'.$_POST['sex'].'"="-1" OR `employee`.`sex`="'.$_POST['sex'].'") AND
      `employee`.`crew_id` in (select `crew`.`crew_id` from `crew` where `crew`.`division_type`="'.$_POST['where'].'")';
      $results = mysqli_query($connection, $sql);
      while($result = mysqli_fetch_assoc($results)){
         $_SESSION['result'][] = $result;
      }
   }
   header('Location: query.php?query=1');
}
else if($_SESSION['query'] == 2){
   if ($_POST['age']==="") $_POST['age']="-1"; 
   if ($_POST['average_salary']==="") $_POST['average_salary']="-1"; 
   $sql='SELECT `employee`.`crew_id` AS "id Бригади", `employee`.name AS "Повне ім`я", 
      `employee`.`work_start` AS "Дата початку роботи", `employee`.`sex` AS "Стать",
      `employee`.`birthday` AS "Дата народження",`employee`.`children` AS "Кількість дітей",
      `employee`.`salary` AS "Зарплата" from `employee`
      WHERE ('.$_POST['crew'].'=-1 OR `employee`.`crew_id`='.$_POST['crew'].') AND
      ("'.$_POST['division'].'"="-1" OR "'.$_POST['division'].'" in (select `crew`.`division_type` from `crew` where `crew`.`crew_id`=`employee`.`crew_id`)) AND
      ('.$_POST['schedule'].'=-1 OR '.$_POST['schedule'].' in (select `schedule2`.`schedule_id` from (select `schedule`.`schedule_id` from 
      `schedule` where `schedule`.`plane_id` in (select `plane`.`plane_id` from `plane` where (`plane`.`pilot_crew_id`=`employee`.`crew_id`) OR (`plane`.`engineering_crew_id`=`employee`.`crew_id`) OR (`plane`.`service_crew_id`=`employee`.`crew_id`) ) ) as `schedule2`)) AND
      ('.$_POST['age'].'=-1 OR TIMESTAMPDIFF(YEAR, `employee`.`birthday`, CURDATE())='.$_POST['age'].') AND
      ('.$_POST['average_salary'].'=-1 OR '.$_POST['average_salary'].' in (select AVG(`employee2`.`salary`) from `employee` as `employee2` where `employee`.`crew_id`=`employee2`.`crew_id`))';
   $results = mysqli_query($connection, $sql);
   while($result = mysqli_fetch_assoc($results)){
      $_SESSION['result'][] = $result;
   }
   //echo "Загальна кількість:".$results2["Загальна кількість"];
   header('Location: query.php?query=2');
}
else if($_SESSION['query'] == 3){
   if ($_POST['age']==="") $_POST['age']="-1"; 
   if ($_POST['salary']==="") $_POST['salary']="-1"; 
   if($_POST['med_check_up'] == -1) {
      $sql='SELECT `employee`.`crew_id` AS "id Бригади", `employee`.name AS "Повне ім`я", 
      `employee`.`work_start` AS "Дата початку роботи", `employee`.`sex` AS "Стать",
      `employee`.`birthday` AS "Дата народження",`employee`.`children` AS "Кількість дітей",
      `employee`.`salary` AS "Зарплата" from `employee`
      where  ('.$_POST['age'].'=-1 OR TIMESTAMPDIFF(YEAR, `employee`.`birthday`, CURDATE())='.$_POST['age'].') AND
      ('.$_POST['salary'].'=-1 OR `employee`.`salary`='.$_POST['salary'].') AND
      ("'.$_POST['sex'].'"="-1" OR `employee`.`sex`="'.$_POST['sex'].'") AND
      `employee`.`employee_id` in (select `pilot`.`employee_id` from `pilot`)'; 
      $results = mysqli_query($connection, $sql);
      while($result = mysqli_fetch_assoc($results)){
         $_SESSION['result'][] = $result;
      }
   }
   if($_POST['med_check_up'] == 1) {
      $sql='SELECT `employee`.`crew_id` AS "id Бригади", `employee`.name AS "Повне ім`я", 
      `employee`.`work_start` AS "Дата початку роботи", `employee`.`sex` AS "Стать",
      `employee`.`birthday` AS "Дата народження",`employee`.`children` AS "Кількість дітей",
      `employee`.`salary` AS "Зарплата" from `employee`
      where  ('.$_POST['age'].'=-1 OR TIMESTAMPDIFF(YEAR, `employee`.`birthday`, CURDATE())='.$_POST['age'].') AND
      ('.$_POST['salary'].'=-1 OR `employee`.`salary`='.$_POST['salary'].') AND
      ("'.$_POST['sex'].'"="-1" OR `employee`.`sex`="'.$_POST['sex'].'") AND
      `employee`.`employee_id` in (select `pilot`.`employee_id` from `pilot` 
      where `pilot`.`pilot_id` in (select `med_check_up`.`pilot_id` from `med_check_up` where `med_check_up`.`year`="'.$_POST['year'].'"))';
      $results = mysqli_query($connection, $sql);
      while($result = mysqli_fetch_assoc($results)){
         $_SESSION['result'][] = $result;
      }
   }
   if($_POST['med_check_up'] == 2) {
      $sql='SELECT `employee`.`crew_id` AS "id Бригади", `employee`.name AS "Повне ім`я", 
      `employee`.`work_start` AS "Дата початку роботи", `employee`.`sex` AS "Стать",
      `employee`.`birthday` AS "Дата народження",`employee`.`children` AS "Кількість дітей",
      `employee`.`salary` AS "Зарплата" from `employee`
      where  ('.$_POST['age'].'=-1 OR TIMESTAMPDIFF(YEAR, `employee`.`birthday`, CURDATE())='.$_POST['age'].') AND
      ('.$_POST['salary'].'=-1 OR `employee`.`salary`='.$_POST['salary'].') AND
      ("'.$_POST['sex'].'"="-1" OR `employee`.`sex`="'.$_POST['sex'].'") AND
      `employee`.`employee_id` in (select `pilot`.`employee_id` from `pilot` 
      where `pilot`.`pilot_id` not in (select `med_check_up`.`pilot_id` from `med_check_up` where `med_check_up`.`year`="'.$_POST['year'].'"))';
      $results = mysqli_query($connection, $sql);
      while($result = mysqli_fetch_assoc($results)){
         $_SESSION['result'][] = $result;
      }
   }
   header('Location: query.php?query=3');
}
else if($_SESSION['query'] == 4)
{
   if ($_POST['curr_time']==="") $_POST['curr_time']="-1"; 
   if ($_POST['num']==="") $_POST['num']="-1"; 
   $sql='SELECT * from `plane` where '.$_POST['num'].'=-1 OR '.$_POST['num'].' in (select count(`schedule_id`) from `schedule` where `schedule`.`plane_id`=`plane`.`plane_id`)';
   $results = mysqli_query($connection, $sql);
   while($result = mysqli_fetch_assoc($results)){
      $_SESSION['result'][] = $result;
   }
   header('Location: query.php?query=4');
}
else if($_SESSION['query'] == 5)
{
   if ($_POST['age']==="") $_POST['age']="-1"; 
   if ($_POST['start_time']==="" or $_POST['end_time']==="")
   {
      $sql='SELECT * from `plane` where  
   ('.$_POST['age'].'=-1 OR TIMESTAMPDIFF(YEAR, DATE(CONCAT(`plane`.`year`, "-01-01")), CURDATE())='.$_POST['age'].')';
   }
   else
   {
      $sql='SELECT * from `plane` where  
   ("'.$_POST['start_time'].'"="-1" OR "'.$_POST['end_time'].'"="-1" OR `plane`.`plane_id` in (select `tech_check_up`.`plane_id` from `tech_check_up` where `tech_check_up`.`date` between "'.$_POST['start_time'].'" and "'.$_POST['end_time'].'")) AND
   ('.$_POST['age'].'=-1 OR TIMESTAMPDIFF(YEAR, DATE(CONCAT(`plane`.`year`, "-01-01")), CURDATE())='.$_POST['age'].')';
   }
   $results = mysqli_query($connection, $sql);
   while($result = mysqli_fetch_assoc($results)){
      $_SESSION['result'][] = $result;
   }
   header('Location: query.php?query=5');
}
else if($_SESSION['query'] == 6)
{
   if ($_POST['price']==="") $_POST['price']="-1"; 
   if ($_POST['duration']==="") $_POST['duration']="-1"; 
   if ($_POST['start_point']==="") $_POST['start_point']="-1"; 
   if ($_POST['destination']==="" ) $_POST['destination']="-1";
   $sql='SELECT * from `schedule` where ('.$_POST['price'].'=-1 OR `schedule`.`ticket_price`='.$_POST['price'].') AND
   ("'.$_POST['start_point'].'"="-1" OR "'.$_POST['destination'].'"="-1" OR (("'.$_POST['start_point'].'" in (select `flight`.`starting_point` from `flight` where `flight`.`flight_id`=`schedule`.`flight_id`)) AND ("'.$_POST['destination'].'" in (select `flight`.`destination` from `flight` where `flight`.`flight_id`=`schedule`.`flight_id`)) ) ) AND
   ('.$_POST['duration'].'=-1 OR TIMESTAMPDIFF(MINUTE, `schedule`.`departure_datetime`, `schedule`.`arrival_datetime`)='.$_POST['duration'].')';
   $results = mysqli_query($connection, $sql) or die("Помилка".mysqli_error($connection));
   //echo $sql;
   //echo $results;
   while($result = mysqli_fetch_assoc($results)){
      $_SESSION['result'][] = $result;
   }
   header('Location: query.php?query=6');
}
else if($_SESSION['query'] == 7)
{
   if ($_POST['start_point']==="") $_POST['start_point']="-1"; 
   if ($_POST['destination']==="" ) $_POST['destination']="-1";
   if ($_POST['places']==="" ) $_POST['places']="-1";
   $sql='SELECT * from `schedule` where (`schedule`.`is_cancelled`=1) AND('.$_POST['places'].'=-1 OR (`schedule`.`num_of_places`-'.$_POST['places'].') in (select count(*) from `ticket` where `ticket`.`schedule_id`=`schedule`.`schedule_id`)) AND
   ("'.$_POST['start_point'].'"="-1" OR "'.$_POST['destination'].'"="-1" OR (("'.$_POST['start_point'].'" in (select `flight`.`starting_point` from `flight` where `flight`.`flight_id`=`schedule`.`flight_id`)) AND ("'.$_POST['destination'].'" in (select `flight`.`destination` from `flight` where `flight`.`flight_id`=`schedule`.`flight_id`)) ) )';
   $results = mysqli_query($connection, $sql) or die("Помилка".mysqli_error($connection));
   //echo $sql;
   //echo $results;
   while($result = mysqli_fetch_assoc($results)){
      $_SESSION['result'][] = $result;
   }
   header('Location: query.php?query=7');
}
else if($_SESSION['query'] == 8)
{
   if ($_POST['start_point']==="") $_POST['start_point']="-1"; 
   if ($_POST['destination']==="" ) $_POST['destination']="-1";
   if ($_POST['reason']==="" ) $_POST['reason']="-1";
   $sql='SELECT * from `schedule` where (`schedule`.`reason`!="") AND ("'.$_POST['reason'].'"="-1" OR "'.$_POST['reason'].'"=`schedule`.`reason`) AND
   ("'.$_POST['start_point'].'"="-1" OR "'.$_POST['destination'].'"="-1" OR (("'.$_POST['start_point'].'" in (select `flight`.`starting_point` from `flight` where `flight`.`flight_id`=`schedule`.`flight_id`)) AND ("'.$_POST['destination'].'" in (select `flight`.`destination` from `flight` where `flight`.`flight_id`=`schedule`.`flight_id`)) ) )';
   $results = mysqli_query($connection, $sql) or die("Помилка".mysqli_error($connection));
   //echo $sql;
   //echo $results;
   while($result = mysqli_fetch_assoc($results)){
      $_SESSION['result'][] = $result;
   }
   header('Location: query.php?query=8');
}
else if($_SESSION['query'] == 9)
{
   if ($_POST['duration']==="") $_POST['duration']="-1"; 
   if ($_POST['price']==="") $_POST['price']="-1";
   if ($_POST['departure_datetime']==="")
   {
      $sql='SELECT * from `schedule` where ('.$_POST['price'].'=-1 OR `schedule`.`ticket_price`='.$_POST['price'].') AND
      ('.$_POST['duration'].'=-1 OR TIMESTAMPDIFF(MINUTE, `schedule`.`departure_datetime`, `schedule`.`arrival_datetime`)='.$_POST['duration'].') AND
      (("'.$_POST['plane_type'].'"="-1") OR "'.$_POST['plane_type'].'" in (select `plane`.`plane_type` from `plane` where `plane`.`plane_id`=`schedule`.`plane_id`))';
   }
   else
   {
      $sql='SELECT * from `schedule` where ('.$_POST['price'].'=-1 OR `schedule`.`ticket_price`='.$_POST['price'].') AND
      ('.$_POST['duration'].'=-1 OR TIMESTAMPDIFF(MINUTE, `schedule`.`departure_datetime`, `schedule`.`arrival_datetime`)='.$_POST['duration'].') AND
      (("'.$_POST['plane_type'].'"="-1") OR "'.$_POST['plane_type'].'" in (select `plane`.`plane_type` from `plane` where `plane`.`plane_id`=`schedule`.`plane_id`)) AND
      ("'.$_POST['departure_datetime'].'"=`schedule`.`departure_datetime`)';
   }
   echo $sql;
   $results = mysqli_query($connection, $sql) or die("Помилка".mysqli_error($connection));
   //echo $results;
   while($result = mysqli_fetch_assoc($results)){
      $_SESSION['result'][] = $result;
   }
   header('Location: query.php?query=9');
}
else if ($_SESSION['query'] == 10)
{
   if ($_POST['plane_type']==="") $_POST['plane_type']="-1"; 
   if ($_POST['category']==="") $_POST['category']="-1";
   if ($_POST['destination']==="") $_POST['destination']="-1";
   $sql='SELECT * from `schedule` where ("'.$_POST['category'].'"="-1" OR "'.$_POST['category'].'" in (select `flight`.`category` from `flight` where `flight`.`flight_id`=`schedule`.`flight_id`)) AND
   ("'.$_POST['destination'].'"="-1" OR "'.$_POST['destination'].'" in (select `flight`.`destination` from `flight` where `flight`.`flight_id`=`schedule`.`flight_id`)) AND
   (("'.$_POST['plane_type'].'"="-1") OR "'.$_POST['plane_type'].'" in (select `plane`.`plane_type` from `plane` where `plane`.`plane_id`=`schedule`.`plane_id`))';
   echo $sql;
   $results = mysqli_query($connection, $sql) or die("Помилка".mysqli_error($connection));
   //echo $results;
   while($result = mysqli_fetch_assoc($results)){
      $_SESSION['result'][] = $result;
   }
   header('Location: query.php?query=10');
}
else if ($_SESSION['query'] == 11)
{
   if ($_POST['age']==="") $_POST['age']="-1";
   $sql='SELECT * from `passenger` where ('.$_POST['age'].'=-1 OR TIMESTAMPDIFF(YEAR, `passenger`.`birthdate`, CURDATE())='.$_POST['age'].') AND
   ("'.$_POST['sex'].'"="-1" OR `passenger`.`sex`="'.$_POST['sex'].'") AND
   ('.$_POST['schedule'].' in (select `ticket`.`schedule_id` from `ticket` where `ticket`.`passenger_id`=`passenger`.`passenger_id`)) AND
   ('.$_POST['baggage'].'=-1 OR '.$_POST['baggage'].' in (select `ticket`.`baggage_flag` from `ticket` where `ticket`.`passenger_id`=`passenger`.`passenger_id`))';
   echo $sql;
   $results = mysqli_query($connection, $sql) or die("Помилка".mysqli_error($connection));
   //echo $results;
   while($result = mysqli_fetch_assoc($results)){
      $_SESSION['result'][] = $result;
   }
   header('Location: query.php?query=11');
}
else if ($_SESSION['query'] == 12)
{
   if ($_POST['price']==="") $_POST['price']="-1";
   if ($_POST['start_point']==="") $_POST['start_point']="-1"; 
   if ($_POST['destination']==="" ) $_POST['destination']="-1";
   if ($_POST['departure_datetime']==="")
   {
      $sql='SELECT * from `ticket` where ('.$_POST['schedule'].'=-1 OR `ticket`.`schedule_id`='.$_POST['schedule'].') AND
      ('.$_POST['price'].'=-1 OR ('.$_POST['price'].' in (select `schedule`.`ticket_price` from `schedule` where `schedule`.`schedule_id`=`ticket`.`schedule_id`))) AND
      ("'.$_POST['start_point'].'"="-1" OR "'.$_POST['destination'].'"="-1" OR (("'.$_POST['start_point'].'" in (select `flight`.`starting_point` from `flight` where `flight`.`flight_id` in (select `schedule`.`flight_id` from `schedule` where `schedule`.`schedule_id`=`ticket`.`schedule_id`)) AND ("'.$_POST['destination'].'" in (select `flight`.`destination` from `flight` where `flight`.`flight_id` in (select `schedule`.`flight_id` from `schedule` where `schedule`.`schedule_id`=`ticket`.`schedule_id`))))))';
   }
   else
   {
      $sql='SELECT * from `ticket` where ('.$_POST['schedule'].'=-1 OR `ticket`.`schedule_id`='.$_POST['schedule'].') AND
      ('.$_POST['price'].'=-1 OR ('.$_POST['price'].' in (select `schedule`.`ticket_price` from `schedule` where `schedule`.`schedule_id`=`ticket`.`schedule_id`))) AND
      ("'.$_POST['start_point'].'"="-1" OR "'.$_POST['destination'].'"="-1" OR (("'.$_POST['start_point'].'" in (select `flight`.`starting_point` from `flight` where `flight`.`flight_id` in (select `schedule`.`flight_id` from `schedule` where `schedule`.`schedule_id`=`ticket`.`schedule_id`)) AND ("'.$_POST['destination'].'" in (select `flight`.`destination` from `flight` where `flight`.`flight_id` in (select `schedule`.`flight_id` from `schedule` where `schedule`.`schedule_id`=`ticket`.`schedule_id`)))))) AND
      ("'.$_POST['departure_datetime'].'" in (select `schedule`.`departure_datetime` from `schedule` where `schedule`.`schedule_id`=`ticket`.`schedule_id`))';
   }
   echo $sql;
   $results = mysqli_query($connection, $sql) or die("Помилка".mysqli_error($connection));
   //echo $results;
   while($result = mysqli_fetch_assoc($results)){
      $_SESSION['result'][] = $result;
   }
   header('Location: query.php?query=12');
}
else if ($_SESSION['query'] == 13)
{
   if ($_POST['price']==="") $_POST['price']="-1";
   if ($_POST['start_point']==="") $_POST['start_point']="-1"; 
   if ($_POST['destination']==="" ) $_POST['destination']="-1";
   if ($_POST['age']==="" ) $_POST['age']="-1";
   if ($_POST['date']==="")
   {
      $sql='SELECT * from `refunded_ticket` where ('.$_POST['schedule'].'=-1 OR `refunded_ticket`.`schedule_id`='.$_POST['schedule'].') AND
   ('.$_POST['price'].'=-1 OR ('.$_POST['price'].' in (select `schedule`.`ticket_price` from `schedule` where `schedule`.`schedule_id`=`refunded_ticket`.`schedule_id`))) AND
   ("'.$_POST['start_point'].'"="-1" OR "'.$_POST['destination'].'"="-1" OR (("'.$_POST['start_point'].'" in (select `flight`.`starting_point` from `flight` where `flight`.`flight_id` in (select `schedule`.`flight_id` from `schedule` where `schedule`.`schedule_id`=`refunded_ticket`.`schedule_id`)) AND ("'.$_POST['destination'].'" in (select `flight`.`destination` from `flight` where `flight`.`flight_id` in (select `schedule`.`flight_id` from `schedule` where `schedule`.`schedule_id`=`refunded_ticket`.`schedule_id`)))))) AND 
   ('.$_POST['age'].'=-1 OR '.$_POST['age'].' in (select TIMESTAMPDIFF(YEAR, `passenger`.`birthdate`, CURDATE()) from `passenger` where `refunded_ticket`.`passenger_id`=`passenger`.`passenger_id`)) AND
   ("'.$_POST['sex'].'"="-1" OR "'.$_POST['sex'].'" in (select `passenger`.`sex` from `passenger` where `refunded_ticket`.`passenger_id`=`passenger`.`passenger_id`))';
   }
   else 
   {
      $sql='SELECT * from `refunded_ticket` where ('.$_POST['schedule'].'=-1 OR `refunded_ticket`.`schedule_id`='.$_POST['schedule'].') AND
   ('.$_POST['price'].'=-1 OR ('.$_POST['price'].' in (select `schedule`.`ticket_price` from `schedule` where `schedule`.`schedule_id`=`refunded_ticket`.`schedule_id`))) AND
   ("'.$_POST['start_point'].'"="-1" OR "'.$_POST['destination'].'"="-1" OR (("'.$_POST['start_point'].'" in (select `flight`.`starting_point` from `flight` where `flight`.`flight_id` in (select `schedule`.`flight_id` from `schedule` where `schedule`.`schedule_id`=`refunded_ticket`.`schedule_id`)) AND ("'.$_POST['destination'].'" in (select `flight`.`destination` from `flight` where `flight`.`flight_id` in (select `schedule`.`flight_id` from `schedule` where `schedule`.`schedule_id`=`refunded_ticket`.`schedule_id`)))))) AND 
   ('.$_POST['age'].'=-1 OR '.$_POST['age'].' in (select TIMESTAMPDIFF(YEAR, `passenger`.`birthdate`, CURDATE()) from `passenger` where `refunded_ticket`.`passenger_id`=`passenger`.`passenger_id`)) AND
   ("'.$_POST['sex'].'"="-1" OR "'.$_POST['sex'].'" in (select `passenger`.`sex` from `passenger` where `refunded_ticket`.`passenger_id`=`passenger`.`passenger_id`)) AND
   ("'.$_POST['date'].'"="-1" OR `refunded_ticket`.`date`="'.$_POST['date'].'")';
   }
   echo $sql;
   $results = mysqli_query($connection, $sql) or die("Помилка".mysqli_error($connection));
   //echo $results;
   while($result = mysqli_fetch_assoc($results)){
      $_SESSION['result'][] = $result;
   }
   header('Location: query.php?query=13');
}
//echo '<pre>';
//print_r($_SESSION['result']);
//echo '</pre>';

?>