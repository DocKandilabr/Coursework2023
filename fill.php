<?php
session_start();
require_once 'include/config.php';
$division_types=array('диспетчери', 'касири', 'працівники довідникової служби', 'працівники служби безпеки');
$important_division_types=array('пілоти','техніки','обслуговуючий персонал');
$malenames = array(
    "Андрій",
    "Богдан",
    "Вадим",
    "Валентин",
    "Василь",
    "Віктор",
    "Владислав",
    "Григорій",
    "Данило",
    "Дмитро",
    "Іван",
    "Ігор",
    "Кирило",
    "Максим",
    "Микола",
    "Олександр",
    "Олексій",
    "Павло",
    "Роман",
    "Сергій",
    "Тарас",
    "Юрій",
    "Ярослав"
);
$malesurnames = array(
    "Андрухович",
    "Бабенко",
    "Балабан",
    "Білоус",
    "Бондаренко",
    "Василенко",
    "Волошин",
    "Гончаренко",
    "Дмитренко",
    "Зайцев",
    "Іваненко",
    "Коваленко",
    "Кравченко",
    "Кузьменко",
    "Лебедєв",
    "Мельник",
    "Нестеренко",
    "Олійник",
    "Петренко",
    "Романенко",
    "Савченко",
    "Сідоренко",
    "Ткаченко"
);
$malepatronymics = array(
    "Андрійович",
    "Богданович",
    "Вадимович",
    "Валентинович",
    "Васильович",
    "Вікторович",
    "Владиславович",
    "Григорійович",
    "Данилович",
    "Дмитрович",
    "Іванович",
    "Ігорович",
    "Кирилович",
    "Максимович",
    "Миколайович",
    "Олександрович",
    "Олексійович",
    "Павлович",
    "Романович",
    "Сергійович",
    "Тарасович",
    "Юрійович",
    "Ярославович"
);

$femalenames = [
    "Анна",
    "Богдана",
    "Валентина",
    "Вікторія",
    "Ганна",
    "Дарина",
    "Діана",
    "Єва",
    "Жанна",
    "Злата",
    "Ірина",
    "Катерина",
    "Ксенія",
    "Лариса",
    "Марія",
    "Наталія",
    "Оксана",
    "Поліна",
    "Роксолана",
    "Світлана",
    "Тетяна",
    "Уляна",
    "Юлія"
];

$femalesurnames = [
    "Андрухів",
    "Бабенко",
    "Балабан",
    "Білоус",
    "Бондаренко",
    "Василенко",
    "Волошина",
    "Гончаренко",
    "Дмитренко",
    "Зайцева",
    "Іваненко",
    "Коваленко",
    "Кравченко",
    "Кузьменко",
    "Лебедєва",
    "Мельник",
    "Нестеренко",
    "Олійник",
    "Петренко",
    "Романенко",
    "Савченко",
    "Сідоренко",
    "Ткаченко"
];

$femalepatronymics = [
    "Андріївна",
    "Богданівна",
    "Вадимівна",
    "Валентинівна",
    "Василівна",
    "Вікторівна",
    "Владиславівна",
    "Григоріївна",
    "Данилівна",
    "Дмитрівна",
    "Іванівна",
    "Ігорівна",
    "Кирилівна",
    "Максимівна",
    "Миколаївна",
    "Олександрівна",
    "Олексіївна",
    "Павлівна",
    "Романівна",
    "Сергіївна",
    "Тарасівна",
    "Юріївна",
    "Ярославівна"
];
function generateRandomDate($start, $end) {
    $startTimestamp = strtotime($start);
    $endTimestamp = strtotime($end);
    $randomTimestamp = mt_rand($startTimestamp, $endTimestamp);
    return date("Y-m-d", $randomTimestamp);
}
function generateRandomDateTime($start, $end) {
    $startTimestamp = strtotime($start);
    $endTimestamp = strtotime($end);
    $randomTimestamp = mt_rand($startTimestamp, $endTimestamp);
    return date("Y-m-d h:i:s", $randomTimestamp);
}
/* for($i=0;$i<3;$i++)
{
    for ($j=0;$j<10;$j++) {
        for ($k=0;$k<2;$k++) {
            $name=$malenames[array_rand($malenames)];
            $surname=$malesurnames[array_rand($malesurnames)];
            $patronymic=$malepatronymics[array_rand($malepatronymics)];
            $full_name=$surname." ".$name." ".$patronymic;
            $sql = 'INSERT INTO `employee` (`crew_id`,`name`,`work_start`,`sex`,`birthday`,`children`,`salary`) values ('.(12+10*$i+$j).',"'.$full_name.'",
            "'.generateRandomDate("1982-01-01","2000-01-01").'", "чоловіча", "'.generateRandomDate("1960-01-01","2000-01-01").'",'.rand(0,5).','.rand(10000,100000).');';
            $fl=mysqli_query($connection, $sql);
        }
        for ($k=0;$k<2;$k++) {
            $name=$femalenames[array_rand($femalenames)];
            $surname=$femalesurnames[array_rand($femalesurnames)];
            $patronymic=$femalepatronymics[array_rand($femalepatronymics)];
            $full_name=$surname." ".$name." ".$patronymic;
            $sql = 'INSERT INTO `employee` (`crew_id`,`name`,`work_start`,`sex`,`birthday`,`children`,`salary`) values ('.(12+10*$i+$j).',"'.$full_name.'",
        "'.generateRandomDate("1982-01-01","2000-01-01").'", "жіноча", "'.generateRandomDate("1960-01-01","2000-01-01").'",'.rand(0,5).','.rand(10000,100000).');';
            $fl=mysqli_query($connection, $sql);
        }
    }
}  */
/* for ($i=31;$i<=70;$i++)
{
    for ($j=2000;$j<=2023;$j++)
    {
        $fl=rand(0,1);
        if ($fl==1) {
            $sql = 'INSERT INTO `med_check_up` (`pilot_id`,`year`) values ('.$i.','.$j.')';
            mysqli_query($connection, $sql);
        }
    }
} */
/* $plane_types=array('надзвуковий','широкофюзеляжний','вузькофюзеляжний');
for ($i=0;$i<10;$i++)
{
    $type=$plane_types[array_rand($plane_types)];
    $sql = 'INSERT INTO `plane` (`year`,`plane_type`,`pilot_crew_id`,`engineering_crew_id`,`service_crew_id`) values ("'.rand(1980,2020).'","'.$type.'",
        '.(13+$i).', '.(23+$i).', '.(33+$i).');';
    $fl=mysqli_query($connection, $sql) or die("Помилка" . mysqli_error($connection));
    echo $fl;
} */
/* for ($i=2;$i<=11;$i++)
{
    for ($j=0;$j<10;$j++)
    {
        $fl=generateRandomDate("2000-01-01","2023-01-01");
        echo $fl;
        $sql = 'INSERT INTO `tech_check_up` (`plane_id`,`date`) values ('.$i.',"'.$fl.'")';
        $res=mysqli_query($connection, $sql) or die("Помилка" . mysqli_error($connection));
        echo $res;
    }
} */
/* for ($i=2;$i<=11;$i++)
{
    $rng=rand(1,10);
    for ($j=0;$j<$rng;$j++)
    {
        $start=generateRandomDate("2000-01-01","2023-01-01");
        $end=date("Y-m-d",mt_rand(strtotime($start), strtotime("2023-01-01")));
        $sql = 'INSERT INTO `repair` (`plane_id`,`start_date`,`end_date`) values ('.$i.',"'.$start.'","'.$end.'")';
        $res=mysqli_query($connection, $sql) or die("Помилка" . mysqli_error($connection));
        echo $res;
    }
} */
/* for ($i=0;$i<100;$i++)
{
    $name=$malenames[array_rand($malenames)];
    $surname=$malesurnames[array_rand($malesurnames)];
    $patronymic=$malepatronymics[array_rand($malepatronymics)];
    $full_name=$surname." ".$name." ".$patronymic;
    $sql = 'INSERT INTO `passenger` (`name`,`passport`,`foreign_passport`,`sex`,`birthdate`) values 
    ("'.$full_name.'","'.rand(100000,9999999).'", "'.rand(100000,9999999).'", "чоловіча", "'.generateRandomDate("1960-01-01","2000-01-01").'");';
    $res=mysqli_query($connection, $sql) or die("Помилка" . mysqli_error($connection));
    echo $res;
    $name=$femalenames[array_rand($femalenames)];
    $surname=$femalesurnames[array_rand($femalesurnames)];
    $patronymic=$femalepatronymics[array_rand($femalepatronymics)];
    $full_name=$surname." ".$name." ".$patronymic;
    $sql = 'INSERT INTO `passenger` (`name`,`passport`,`foreign_passport`,`sex`,`birthdate`) values 
    ("'.$full_name.'","'.rand(100000,9999999).'","'.rand(100000,9999999).'", "жіноча", "'.generateRandomDate("1960-01-01","2000-01-01").'");';
    $res=mysqli_query($connection, $sql) or die("Помилка" . mysqli_error($connection));
    echo $res;
} */
/* $id1=19;
$id2=20;
$end="2000-01-01";
$delay=array("","погодні умови","технічні несправності");
$cnt=180;
$plane=11;
for ($i=0;$i<10;$i++)
{   $start=date("Y-m-d",strtotime($end." +2 years"));
    $end=date("Y-m-d h:i:s",strtotime($start." +250 minutes"));
    if (rand(1,10)==1)
    {
        $cancel=1;
    }
    else
    {
        $cancel=0;    
    }
    $reason=$delay[array_rand($delay)];
    $num=50;
    $price=rand(10,50)*100;
    $sql = 'INSERT INTO `schedule` (`plane_id`,`flight_id`,`departure_datetime`,`arrival_datetime`,`is_cancelled`, `ticket_price`, `num_of_places`, `reason`) values 
    ('.$plane.','.$id1.', "'.$start.'", "'.$end.'",'.$cancel.','.$price.' ,'.$num.',"'.$reason.'");';
    $res=mysqli_query($connection, $sql) or die("Помилка" . mysqli_error($connection));
    echo $res;
    $cnt++;
    for ($j=1;$j<=$num;$j++)
    {   
        if (rand(1,10)<8)
        {
            $pass=rand(1,200);
            $sql = 'INSERT INTO `ticket` (`schedule_id`,`passenger_id`,`num_place`,`baggage_flag`) values 
            ('.$cnt.', '.$pass.', '.$j.','.rand(0,1).');';
            $res=mysqli_query($connection, $sql) or die("Помилка" . mysqli_error($connection));
            echo $res;
        }
        if (rand(1,10)<3)
            {
                $pass=rand(1,200);
                $sql = 'INSERT INTO `refunded_ticket` (`schedule_id`,`passenger_id`,`num_place`,`date`) values 
                ('. $cnt.', '.$pass.', '.$j.',"'.generateRandomDate("2000−01−01",$start).'");';
                $res=mysqli_query($connection, $sql) or die("Помилка" . mysqli_error($connection));
                echo $res;
            }
    }
    
    $start=date("Y-m-d", strtotime($end." +1 day"));
    $end=date("Y-m-d h:i:s",strtotime($start." +250 minutes"));
    if (rand(1,10)==1)
    {
        $cancel=1;
    }
    else
    {
        $cancel=0;    
    }
    $reason=$delay[array_rand($delay)];
    $num=50;
    $price=rand(10,50)*100;
    $sql = 'INSERT INTO `schedule` (`plane_id`,`flight_id`,`departure_datetime`,`arrival_datetime`,`is_cancelled`, `ticket_price`, `num_of_places`, `reason`) values 
    ('.$plane.','.$id2.', "'.$start.'", "'.$end.'",'.$cancel.','.$price.' ,'.$num.',"'.$reason.'");';
    $res=mysqli_query($connection, $sql) or die("Помилка" . mysqli_error($connection));
    echo $res;
    $cnt++;
    for ($j=1;$j<=$num;$j++)
    {   
        if (rand(1,10)<8)
        {
            $pass=rand(1,200);
            $sql = 'INSERT INTO `ticket` (`schedule_id`,`passenger_id`,`num_place`,`baggage_flag`) values 
            ('.$cnt.', '.$pass.', '.$j.','.rand(0,1).');';
            $res=mysqli_query($connection, $sql) or die("Помилка" . mysqli_error($connection));
            echo $res;
        }
        if (rand(1,10)<3)
            {
                $pass=rand(1,200);
                $sql = 'INSERT INTO `refunded_ticket` (`passenger_id`,`schedule_id`,`num_place`,`date`) values 
                ('.$pass.','.$cnt.', '.$j.',"'.generateRandomDate("2000−01−01",$start).'");';
                $res=mysqli_query($connection, $sql) or die("Помилка" . mysqli_error($connection));
                echo $res;
            }
    }
} */
/* for ($id=2;$id<=150;$id++)
{
    $sal=rand(1,100)*1000;
    $sql='UPDATE `employee` set `salary`='.$sal.' where `employee_id`='.$id; 
    $res=mysqli_query($connection, $sql) or die("Помилка" . mysqli_error($connection));
    echo $res;
} */
/* for ($id=2;$id<=150;$id++)
{
    $birthday=generateRandomDate("1960-01-01","2000-01-01");
    $workday=generateRandomDate("".$birthday." +22 years","2023-01-01");
    $sql='UPDATE `employee` set `birthday`="'.$birthday.'", `work_start`="'.$workday.'" where `employee_id`='.$id; 
    $res=mysqli_query($connection, $sql) or die("Помилка" . mysqli_error($connection));
    echo $res;
} */
?>