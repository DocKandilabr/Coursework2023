<?php
session_start();
require_once 'include/config.php';
$_SESSION['divisions'] = array();
$_SESSION['crews'] = array();
$_SESSION['schedules'] = array();
$_SESSION['types'] = array();
$_SESSION['category'] = array();
if($_GET['query'] == 1){
   $_SESSION['query'] = 1;
   $sql = 'SELECT `division_type` FROM `division`';
   $floors = mysqli_query($connection, $sql);
   while($floor = mysqli_fetch_assoc($floors)){
      $_SESSION['divisions'][] = $floor['division_type'];
   }
}
if($_GET['query'] == 2){
   $_SESSION['query'] = 2;
   $sql = 'SELECT `crew_id` FROM `crew` ORDER BY `crew_id`';
   $crews = mysqli_query($connection, $sql);
   while($crew = mysqli_fetch_assoc($crews)){
      $_SESSION['crews'][] = $crew['crew_id'];
   }
}
if($_GET['query'] == 2){
   $sql = 'SELECT `division_type` FROM `division`';
   $divisions = mysqli_query($connection, $sql);
   while($division = mysqli_fetch_assoc($divisions)){
      $_SESSION['divisions'][] = $division['division_type'];
   }
}
if($_GET['query'] == 2){
   $sql = 'SELECT `schedule_id` FROM `schedule` ORDER BY `schedule_id`';
   $flights = mysqli_query($connection, $sql);
   while($flight = mysqli_fetch_assoc($flights)){
      $_SESSION['schedules'][] = $flight['schedule_id'];
   }
}
if($_GET['query'] == 3){
   $_SESSION['query'] = 3;
}
if($_GET['query'] == 4){
   $_SESSION['query'] = 4;
}
if($_GET['query'] == 5){
   $_SESSION['query'] = 5;
}
if($_GET['query'] == 6){
   $_SESSION['query'] = 6;
}
if($_GET['query'] == 7){
   $_SESSION['query'] = 7;
}
if($_GET['query'] == 8){
   $_SESSION['query'] = 8;
}
if($_GET['query'] == 9){
   $_SESSION['query'] = 9;
   $sql = 'SELECT DISTINCT(`plane_type`) FROM `plane`';
   $types = mysqli_query($connection, $sql);
   while($type = mysqli_fetch_assoc($types)){
      $_SESSION['types'][] = $type['plane_type'];
      //echo $type['plane_type'];
   }
}
if($_GET['query'] == 10){
   $_SESSION['query'] = 10;
   $sql = 'SELECT DISTINCT(`plane_type`) FROM `plane`';
   $types = mysqli_query($connection, $sql);
   while($type = mysqli_fetch_assoc($types)){
      $_SESSION['types'][] = $type['plane_type'];
      //echo $type['plane_type'];
   }
   $sql = 'SELECT `name` FROM `category`';
   $types = mysqli_query($connection, $sql);
   while($type = mysqli_fetch_assoc($types)){
      $_SESSION['category'][] = $type['name'];
      //echo $type['plane_type'];
   }
}
if($_GET['query'] == 11){
   $_SESSION['query'] = 11;
   $sql = 'SELECT `schedule_id` FROM `schedule` ORDER BY `schedule_id`';
   $flights = mysqli_query($connection, $sql);
   while($flight = mysqli_fetch_assoc($flights)){
      $_SESSION['schedules'][] = $flight['schedule_id'];
   }
}
if($_GET['query'] == 12){
   $_SESSION['query'] = 12;
   $sql = 'SELECT `schedule_id` FROM `schedule` ORDER BY `schedule_id`';
   $flights = mysqli_query($connection, $sql);
   while($flight = mysqli_fetch_assoc($flights)){
      $_SESSION['schedules'][] = $flight['schedule_id'];
   }
}
if($_GET['query'] == 13){
   $_SESSION['query'] = 13;
   $sql = 'SELECT `schedule_id` FROM `schedule` ORDER BY `schedule_id`';
   $flights = mysqli_query($connection, $sql);
   while($flight = mysqli_fetch_assoc($flights)){
      $_SESSION['schedules'][] = $flight['schedule_id'];
   }
}
// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';
// echo '<pre>';
// print_r($_SESSION['floor']);
// echo '</pre>';
// echo '<pre>';
// print_r($_SESSION['coating']);
// echo '</pre>';
// echo '<pre>';
// print_r($_SESSION['result'][0]);
// echo '</pre>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <!-- <link rel="stylesheet" href="index.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->
</head>
<body>
   <div class="main">
      <div class="back">
         <a class="btn btn-primary menu__link" href="../menu.php">На головну</a>
      </div>
      <?php
         if($_GET['query'] == 1){
      ?>
      <div class="configuration">
         <form method="POST" action="handler.php" class="form">
            <label class="label" for="where">Виберіть серед кого буде проводитись вибір:</label> <br>
            <select class="form-select select" name="where">
               <option value="1">всі працівники</option>
               <option value="2">начальники відділів</option>
               <?php
               for($i = 0; $i < count($_SESSION['divisions']); $i++){
               ?>
               <option value="<?= $_SESSION['divisions'][$i]?>"><?= $_SESSION['divisions'][$i] ?></option>
               <?php
               }
               ?>
            </select> <br>
            <p>Стаж: </p>
            <input type="number" name="experience"/>
            <p>Вік: </p>
            <input type="number" name="age"/>
            <p>Кількість дітей: </p>
            <input type="number" name="children"/>
            <p>Зарплата: </p>
            <input type="number" name="salary"/> <br> <br>
            <label> Стать: </label> <br> 
            <select class="form-select select" name="sex" >
               <option value="-1"></option>
               <option value="чоловіча">чоловіча</option>
               <option value="жіноча">жіноча</option>
            </select> <br> <br>
            <input class="btn btn-success submit" type="submit" value="Знайти">
         </form>
      </div>
      <?php
         }
         else if($_GET['query'] == 2){
      ?>
         <div class="configuration">
            <form method="POST" action="handler.php" class="form">
               <label class="label">Виберіть номер бригади:</label><br>
               <select class="form-select select" name="crew">
               <option value="-1"></option>
                  <?php
                     for($i = 0; $i < count($_SESSION['crews']); $i++){
                  ?>
                  <option value="<?=$_SESSION['crews'][$i]?>"><?=$_SESSION['crews'][$i]?></option>
                  <?php
                     }
                  ?>
               </select><br>
               <label class="label">Виберіть відділ:</label><br>
               <select class="form-select select" name="division">
                  <option value="-1"></option>
                  <?php
                  for($i = 0; $i < count($_SESSION['divisions']); $i++){
                  ?>
                  <option value="<?= $_SESSION['divisions'][$i]?>"><?= $_SESSION['divisions'][$i]?></option>
                  <?php
                  }
                  ?>
               </select><br>
               <label class="label">Виберіть номер рейсу:</label><br>
               <select class="form-select select" name="schedule">
                  <option value="-1"></option>
                  <?php
                  for($i = 0; $i < count($_SESSION['schedules']); $i++){
                  ?>
                  <option value="<?= $_SESSION['schedules'][$i]?>"><?= $_SESSION['schedules'][$i]?></option>
                  <?php
                  }
                  ?>
               </select> <br>
               <p>Вік: </p>
               <input type="number" name="age"/>
               <p>Середня зарплата по бригаді: </p>
               <input type="number" name="average_salary"/> <br> <br>
               <input class="btn btn-success submit" type="submit" value="Знайти">
            </form>
         </div>
      <?php
         }
         else if($_GET['query'] == 3){
      ?>
         <div class="configuration">
            <form method="POST" action="handler.php" class="form">
               <label class="label" for="med_check_up">Пройшли медогляд:</label>
               <select class="form-select select" name="med_check_up">
                  <option value="-1"></option>
                  <option value="1">Так</option>
                  <option value="2">Ні</option>
               </select>
               <p>у цьому році: </p>
               <input type="number" name="year"/> <br>
               <p>Вік: </p>
               <input type="number" name="age"/>
               <p>Зарплата: </p>
               <input type="number" name="salary"/> <br>
               <label> Стать: </label> <br> 
               <select class="form-select select" name="sex" >
                  <option value="-1"></option>
                  <option value="чоловіча">чоловіча</option>
                  <option value="жіноча">жіноча</option>
               </select> <br> <br>
               <input class="btn btn-success submit" type="submit" value="Знайти">
            </form>
         </div>
      <?php 
         }
      else if ($_GET['query'] == 4)
      {
         ?>
         <div class="configuration">
            <form method="POST" action="handler.php" class="form">
               <p>Введіть кількість скоєних рейсів: </p>
               <input type="number" name="num"/> <br> <br>
               <input class="btn btn-success submit" type="submit" value="Знайти">
            </form>
         </div>
      <?php 
      }
      else if ($_GET['query'] == 5)
      {
         ?>
         <div class="configuration">
            <form method="POST" action="handler.php" class="form">
               <p>Введіть початковий час: </p>
               <input type="datetime-local" name="start_time"/> <br> <br>
               <p>Введіть кінцевий час: </p>
               <input type="datetime-local" name="end_time"/> <br> <br>
               <p>Введіть вік: </p>
               <input type="number" name="age"/> <br> <br>
               <input class="btn btn-success submit" type="submit" value="Знайти">
            </form>
         </div>
      <?php 
      }
      else if ($_GET['query'] == 6)
      {
         ?>
         <div class="configuration">
            <form method="POST" action="handler.php" class="form">
               <p>Введіть початкову точку маршруту: </p>
               <input type="text" name="start_point"/> <br> <br>
               <p>Введіть місце призначення: </p>
               <input type="text" name="destination"/> <br> 
               <p>Введіть тривалість перельоту в хвилинх: </p>
               <input type="number" name="duration"/> <br>
               <p>Введіть ціну квитка: </p>
               <input type="number" name="price"/> <br>  <br>
               <input class="btn btn-success submit" type="submit" value="Знайти">
            </form>
         </div>
      <?php 
      }
      else if ($_GET['query'] == 7)
      {
         ?>
         <div class="configuration">
            <form method="POST" action="handler.php" class="form">
               <p>Введіть початкову точку маршруту: </p>
               <input type="text" name="start_point"/> <br>
               <p>Введіть місце призначення: </p>
               <input type="text" name="destination"/> <br> 
               <p>Введіть кількість незатребуваних місць: </p>
               <input type="number" name="places"/> <br>  <br>
               <input class="btn btn-success submit" type="submit" value="Знайти">
            </form>
         </div>
      <?php 
      }
      else if ($_GET['query'] == 8)
      {
         ?>
         <div class="configuration">
            <form method="POST" action="handler.php" class="form">
               <p>Введіть початкову точку маршруту: </p>
               <input type="text" name="start_point"/> <br>
               <p>Введіть місце призначення: </p>
               <input type="text" name="destination"/> <br> 
               <p>Введіть причину затримки: </p>
               <input type="text" name="reason"/> <br>  <br>
               <input class="btn btn-success submit" type="submit" value="Знайти">
            </form>
         </div>
      <?php 
      }
      else if ($_GET['query'] == 9)
      {
         ?>
         <div class="configuration">
            <form method="POST" action="handler.php" class="form">
               <label class="label">Виберіть тип літака:</label><br>
               <select class="form-select select" name="plane_type">
                  <option value="-1"></option>
                  <?php
                  for($i = 0; $i < count($_SESSION['types']); $i++){
                  ?>
                  <option value="<?= $_SESSION['types'][$i]?>"><?= $_SESSION['types'][$i]?></option>
                  <?php
                  }
                  ?>
               </select> <br>
               <p>Введіть тривалість перельоту в хвилинх: </p>
               <input type="number" name="duration"/> <br>
               <p>Введіть ціну квитка: </p>
               <input type="number" name="price"/> <br> 
               <p>Введіть час вильоту: </p>
               <input type="datetime-local" name="departure_datetime"/> <br>  <br>
               <input class="btn btn-success submit" type="submit" value="Знайти">
               
            </form>
         </div>
      <?php 
      }
      else if ($_GET['query'] == 10)
      {
         ?>
         <div class="configuration">
            <form method="POST" action="handler.php" class="form">
               <label class="label">Виберіть категорію рейсу:</label><br>
               <select class="form-select select" name="category">
                  <option value="-1"></option>
                  <?php
                  for($i = 0; $i < count($_SESSION['category']); $i++){
                  ?>
                  <option value="<?= $_SESSION['category'][$i]?>"><?= $_SESSION['category'][$i]?></option>
                  <?php
                  }
                  ?>
               </select> <br>
               <label class="label">Виберіть тип літака:</label><br>
               <select class="form-select select" name="plane_type">
                  <option value="-1"></option>
                  <?php
                  for($i = 0; $i < count($_SESSION['types']); $i++){
                  ?>
                  <option value="<?= $_SESSION['types'][$i]?>"><?= $_SESSION['types'][$i]?></option>
                  <?php
                  }
                  ?>
               </select> <br>
               <p>Введіть місце призначення: </p>
               <input type="text" name="destination"/> <br>  <br>
               <input class="btn btn-success submit" type="submit" value="Знайти">
               
            </form>
         </div>
      <?php 
      }
      else if ($_GET['query'] == 11)
      {
         ?>
         <div class="configuration">
            <form method="POST" action="handler.php" class="form">
               <label class="label">Виберіть номер рейсу:</label><br>
               <select class="form-select select" name="schedule">
                  <?php
                  for($i = 0; $i < count($_SESSION['schedules']); $i++){
                  ?>
                  <option value="<?= $_SESSION['schedules'][$i]?>"><?= $_SESSION['schedules'][$i]?></option>
                  <?php
                  }
                  ?>
               </select> <br>
               <label class="label">Виберіть чи здавались речі в багаж:</label><br>
               <select class="form-select select" name="baggage">
                  <option value="-1"></option>
                  <option value="1">Здавались</option>
                  <option value="0">Не здавались</option>
               </select> <br>
               <label> Стать: </label> <br> 
               <select class="form-select select" name="sex" >
                  <option value="-1"></option>
                  <option value="чоловіча">чоловіча</option>
                  <option value="жіноча">жіноча</option>
               </select> 
               <p>Вік: </p>
               <input type="number" name="age"/><br> <br>
               <input class="btn btn-success submit" type="submit" value="Знайти">
               
            </form>
         </div>
      <?php 
      }
      else if ($_GET['query'] == 12)
      {
         ?>
         <div class="configuration">
            <form method="POST" action="handler.php" class="form">
               <label class="label">Виберіть номер рейсу:</label><br>
               <select class="form-select select" name="schedule">
                  <option value="-1"></option>
                  <?php
                  for($i = 0; $i < count($_SESSION['schedules']); $i++){
                  ?>
                  <option value="<?= $_SESSION['schedules'][$i]?>"><?= $_SESSION['schedules'][$i]?></option>
                  <?php
                  }
                  ?>
               </select> <br>
               <p>Введіть початкову точку маршруту: </p>
               <input type="text" name="start_point"/> <br>
               <p>Введіть місце призначення: </p>
               <input type="text" name="destination"/> <br> 
               <p>Введіть ціну квитка: </p>
               <input type="number" name="price"/> <br> 
               <p>Введіть час вильоту: </p>
               <input type="datetime-local" name="departure_datetime"/> <br>  <br>
               <input class="btn btn-success submit" type="submit" value="Знайти">
               
            </form>
         </div>
      <?php 
      }
      else if ($_GET['query'] == 13)
      {
         ?>
         <div class="configuration">
            <form method="POST" action="handler.php" class="form">
               <label class="label">Виберіть номер рейсу:</label><br>
               <select class="form-select select" name="schedule">
                  <option value="-1"></option>
                  <?php
                  for($i = 0; $i < count($_SESSION['schedules']); $i++){
                  ?>
                  <option value="<?= $_SESSION['schedules'][$i]?>"><?= $_SESSION['schedules'][$i]?></option>
                  <?php
                  }
                  ?>
               </select> <br>
               <p>Введіть початкову точку маршруту: </p>
               <input type="text" name="start_point"/> <br>
               <p>Введіть місце призначення: </p>
               <input type="text" name="destination"/> <br> 
               <p>Введіть ціну квитка: </p>
               <input type="number" name="price"/> <br>
               <label> Стать: </label> <br> 
               <select class="form-select select" name="sex" >
                  <option value="-1"></option>
                  <option value="чоловіча">чоловіча</option>
                  <option value="жіноча">жіноча</option>
               </select> 
               <p>Вік: </p>
               <input type="number" name="age"/><br>
               <p>День здачі квитка: </p>
               <input type="date" name="date"/><br> <br> 
               <input class="btn btn-success submit" type="submit" value="Знайти">
               
            </form>
         </div>
      <?php 
      }
      ?>
      <?php if(count($_SESSION['result']) > 0){ ?>
      <div>Загальна кількість: <?=count($_SESSION['result'])?></div>
      <div class="result">
         <table class="table table-striped table-dark">
            <thead>
               <tr>
                  <?php foreach($_SESSION['result'][0] as $key => $result){ ?>
                     <th scope="col"><?= $key ?></th>
                  <?php } ?>
               </tr>
            </thead>
            <tbody>
               <?php foreach($_SESSION['result'] as $result){ ?>
                  <tr>
                     <?php
                     foreach($result as $value ){
                     ?>
                     <td><?= $value ?></td>
                     <?php
                     }
                     ?>
                  </tr>
               <?php } ?>
            </tbody>
         </table>
      </div>
      <?php }else{ ?>
         <div class="non-table">Таблиця порожня</div>
         <?php } ?>
   </div>
   <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
   <script>
      let type = 1;
      console.log('type: ', type);
      $('#build').on('change', function (){
         $('.specific' + type).css('display', 'none');
         type = $('#build').val();
         $('.specific' + type).css('display', 'block');
      });
   </script>
</body>
</html>

<?php
$_SESSION['result'] = array();
?>