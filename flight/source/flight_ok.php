<?php
include '../../common_lib/createLink_db.php';
session_start();

if(!empty($_SESSION['id'])){
    $id = $_SESSION['id'];
}else{
    $id = "?";
}

if(!empty($_GET['fly'])){
    $fly = $_GET['fly'];
}else{
    $fly = "?";
} 
if(!empty($_GET['start'])){
    $start = $_GET['start'];
}else{
    $start = "?";
}
if(!empty($_GET['back'])){
    $back = $_GET['back'];
}else{
    $back = "?";
}
if(!empty($_GET['adult_num'])){
    $adult_num = $_GET['adult_num'];
}else{
    $adult_num = "?";
}
if(!empty($_GET['child_num'])){
    $child_num = $_GET['child_num'];
}else{
    $child_num = "?";
}
if(!empty($_GET['baby_num'])){
    $baby_num = $_GET['baby_num'];
}else{
    $baby_num = "?";
}
if(!empty($_POST['start_check'])){
    $start_check = $_POST['start_check'];
}else{
    $start_check = "?";
}
if(!empty($_POST['back_check'])){
    $back_check = $_POST['back_check'];
}else{
    $back_check = "?";
}


echo $start_check ,$back_check, $fly, $start, $back;
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<link type="text/css" rel="stylesheet" href="../../common_css/index_css3.css?var=1">
<link type="text/css" rel="stylesheet" href="../css/ticket1.css?var=1">
<link rel="stylesheet" href="//code.jquery.com/ui/1.8.18/themes/base/jquery-ui.css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="//code.jquery.com/ui/1.8.18/jquery-ui.min.js"></script>

<script type="text/javascript">
function updateReserveNum(url){
		alert('예매되었습니다.');
		location.href=url;	
}

function flight_back_page(){	
	history.go(-1);    	
}


</script>
</head>
<body>
<header>
<?php include_once '../../common_lib/top_login2.php';?>
</header>
<nav id="top">
<?php include_once '../../common_lib/main_menu2.php';?>
</nav>
<h1 style="margin:0 auto; text-align: center">FLIGHT TICKETING</h1><br>
<div id="ticket_box0">
<p>
<br><hr id="hr1"><br><br>
&nbsp;1. 여정 선택  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
2. 항공편 선택  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
3. 결과 조회  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
4. 좌석 확인  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<p>
<table width='550' border='0' height='18' cellspacing='5' cellpadding='0'>
<tr>
<?php
   echo "
        <td width='25%' bgcolor= '#dddddd'></td>
        <td width='25%' bgcolor='#dddddd' height=5></td>
        <td width='25%' bgcolor='gray' height=5></td>
        <td width='25%' bgcolor='#dddddd' height=5></td>";
?>
</tr>
</table><br>
<hr id="hr1">
<?php 
/* $round_total_price = $start_flight_price + $back_flight_price; */
?>
<?php 

if($fly == 'round'){    ////왕복
    
    if($start_check == "low_price_start" && $back_check == "low_price_back"){
        //최저가 티켓
        $sql = "select * from flight_one_way where flight_price =
(select min(flight_price) from flight_one_way where flight_start = '$start' and flight_back = '$back')";
        $result1 = mysqli_query($con,$sql) or die("실패원인1 : ".mysqli_error($con));
        $row = mysqli_fetch_array($result1);
        $start_flight_price = $row[flight_price];
        $start_flight_start = $row[flight_start];
        $start_flight_back = $row[flight_back];
        $start_fly_start_date = $row[fly_start_date];
        $start_fly_start_time = $row[fly_start_time];
        $start_fly_back_time = $row[fly_back_time];
        $start_fly_time = $row[fly_time];
        $start_flight_ap_num = $row[flght_ap_num];
        
        $sql = "select * from flight_one_way where flight_price =
(select min(flight_price) from flight_one_way where flight_start = '$back' and flight_back = '$start')";
        $result2 = mysqli_query($con,$sql) or die("실패원인2 : ".mysqli_error($con));
        $row = mysqli_fetch_array($result2);
        $back_flight_price = $row[flight_price];
        $back_flight_start = $row[flight_start];
        $back_flight_back = $row[flight_back];
        $back_fly_start_date = $row[fly_start_date];
        $back_fly_start_time = $row[fly_start_time];
        $back_fly_back_time = $row[fly_back_time];
        $back_fly_time = $row[fly_time];
        $back_flight_ap_num = $row[flght_ap_num];
    }else if($start_check == "low_price_start" && $back_check != "low_price_back"){
        //최저가 티켓
        $sql = "select * from flight_one_way where flight_price =
(select min(flight_price) from flight_one_way where flight_start = '$start' and flight_back = '$back')";
        $result1 = mysqli_query($con,$sql) or die("실패원인3 : ".mysqli_error($con));
        $row = mysqli_fetch_array($result1);
        $start_flight_price = $row[flight_price];
        $start_flight_start = $row[flight_start];
        $start_flight_back = $row[flight_back];
        $start_fly_start_date = $row[fly_start_date];
        $start_fly_start_time = $row[fly_start_time];
        $start_fly_back_time = $row[fly_back_time];
        $start_fly_time = $row[fly_time];
        $start_flight_ap_num = $row[flght_ap_num];
        //-----------------------------------------------------------------
        $back_recordnum = substr($back_check, 4);      //귀국편 선택한 티켓 번호
        
        $sql = "select * from flight_one_way where flight_start = '$back' and flight_back = '$start' and recordNum = '$back_recordnum' ";
        
        $result2 = mysqli_query($con,$sql) or die("실패원인4: ".mysqli_error($con));
        $row = mysqli_fetch_array($result2);
        $back_flight_price = $row[flight_price];
        $back_flight_start = $row[flight_start];
        $back_flight_back = $row[flight_back];
        $back_fly_start_date = $row[fly_start_date];
        $back_fly_start_time = $row[fly_start_time];
        $back_fly_back_time = $row[fly_back_time];
        $back_fly_time = $row[fly_time];
        $back_flight_ap_num = $row[flght_ap_num];
    }else if($start_check != "low_price_start" && $back_check == "low_price_back"){
        $start_recordnum = substr($start_check, 5);      //출국편 선택한 티켓 번호
        
        $sql = "select * from flight_one_way where flight_start= '$start' and flight_back='$back' and recordNum = '$start_recordnum' ";
        
        $result1 = mysqli_query($con,$sql) or die("실패원인5: ".mysqli_error($con));
        
        $row = mysqli_fetch_array($result1);
        $start_flight_price = $row[flight_price];
        $start_flight_start = $row[flight_start];
        $start_flight_back = $row[flight_back];
        $start_fly_start_date = $row[fly_start_date];
        $start_fly_start_time = $row[fly_start_time];
        $start_fly_back_time = $row[fly_back_time];
        $start_fly_time = $row[fly_time];
        $start_flight_ap_num = $row[flght_ap_num];
        //-----------------------------------------------------------------
        $sql = "select * from flight_one_way where flight_price =
(select min(flight_price) from flight_one_way where flight_start = '$back' and flight_back = '$start')";
        $result2 = mysqli_query($con,$sql) or die("실패원인6 : ".mysqli_error($con));
        $row = mysqli_fetch_array($result2);
        $back_flight_price = $row[flight_price];
        $back_flight_start = $row[flight_start];
        $back_flight_back = $row[flight_back];
        $back_fly_start_date = $row[fly_start_date];
        $back_fly_start_time = $row[fly_start_time];
        $back_fly_back_time = $row[fly_back_time];
        $back_fly_time = $row[fly_time];
        $back_flight_ap_num = $row[flght_ap_num];
        
    }else{
        $start_recordnum = substr($start_check, 5);      //출국편 선택한 티켓 번호
        
        $sql = "select * from flight_one_way where flight_start= '$start' and flight_back='$back' and recordNum = '$start_recordnum' ";
        
        $result1 = mysqli_query($con,$sql) or die("실패원인7: ".mysqli_error($con));
        
        $row = mysqli_fetch_array($result1);
        $start_flight_price = $row[flight_price];
        $start_flight_start = $row[flight_start];
        $start_flight_back = $row[flight_back];
        $start_fly_start_date = $row[fly_start_date];
        $start_fly_start_time = $row[fly_start_time];
        $start_fly_back_time = $row[fly_back_time];
        $start_fly_time = $row[fly_time];
        $start_flight_ap_num = $row[flght_ap_num];
        
        $back_recordnum = substr($back_check, 4);      //귀국편 선택한 티켓 번호
        
        $sql = "select * from flight_one_way where flight_start = '$back' and flight_back = '$start' and recordNum = '$back_recordnum' ";
        
        $result2 = mysqli_query($con,$sql) or die("실패원인8: ".mysqli_error($con));
        $row = mysqli_fetch_array($result2);
        $back_flight_price = $row[flight_price];
        $back_flight_start = $row[flight_start];
        $back_flight_back = $row[flight_back];
        $back_fly_start_date = $row[fly_start_date];
        $back_fly_start_time = $row[fly_start_time];
        $back_fly_back_time = $row[fly_back_time];
        $back_fly_time = $row[fly_time];
        $back_flight_ap_num = $row[flght_ap_num];
    }
    
    
    $total_flight_price = ($start_flight_price*$adult_num)+($start_flight_price*0.5*$child_num)+($start_flight_price*0.3* $baby_num)+
    ($back_flight_price*$adult_num)+($back_flight_price*0.5*$child_num)+($back_flight_price*0.3* $baby_num);
   
    
    $total_flight_price = number_format($total_flight_price);   //콤마찍기
    $start_flight_price =number_format($start_flight_price);
    $back_flight_price =number_format($back_flight_price);

    ?>

<?php
$reservation_str = "";
for($i=0;$i<4;$i++) { 
    $capi = rand()%26+65;
    $reservation_str .= chr($capi);
}
$reservation_num = mt_rand(1000, 9999);

$reservation_number = $reservation_str . $reservation_num;


if($adult_num == "없음"){
    $adult_num = "0";
}
if($child_num == "없음" ){
    $child_num = "0";
}
if($baby_num == "없음"){
    $baby_num ="0";
}
$rs_cnt = $adult_num + $child_num + $baby_num;
?>

   


  <div id='select_ticket'><span style='font-size:15pt;'>결제 금액<br></span></div>
  <div id="selected_flight3">총 결제금액 : <?= $total_flight_price?>  원
  <span style='font-size:12pt;'>(성인 : <?= $adult_num ?> 명 + 어린이 : <?= $child_num ?> 명 + 유아 : <?= $baby_num ?> 명)<br></span>
   </div>

<div id="select_ticket"><span style='font-size:15pt;'><br><br>예약 번호</span><br></div>
<hr id="hr1"><br>
 <div id="selected_flight3">예약번호  : <?= $reservation_number ?></div>
<div id="select_ticket"><span style='font-size:15pt;'><br><br>예매 확인</span><br></div>
<hr id="hr1"><br>
<div id="flight_ok_box" >


 <table id='row_flight'  style="margin-top:30px;">
    <tr id='row_flight_tr1'>
    <td colspan='4'><?= $start_flight_start ?> >>>> <?= $back_flight_start ?></td>
    </tr>
    <tr id='row_flight_tr2'>
    <td colspan='4'><?= $start_fly_start_date ?> | <?= $start_fly_start_time ?> - <?= $start_fly_back_time ?> | <?= $start_fly_time ?> | 직항편</td>
    </tr>
    <tr id='row_flight_tr3'>
    <td colspan="2" style='padding-left:30px;'><?= $start_flight_start ?><br><?= $start_fly_start_time ?></td>
    <td>>>>></td>
    <td><?= $back_flight_start ?><br><?= $start_fly_back_time ?></td>
    </tr>
    <tr id='row_flight_tr4'>
    <td colspan='4'> 항공편 운임 : <?= $start_flight_price ?> 원</td>
    </tr>
    </table>

	<table id='row_flight1' style="margin-top:30px;">
    <tr id='row_flight_tr1'>
    <td colspan='4'><?= $back_flight_start ?> >>>> <?= $start_flight_start ?></td>
    </tr>
    <tr id='row_flight_tr2'>
    <td colspan='4'><?= $back_fly_start_date ?> | <?= $back_fly_start_time ?> - <?= $back_fly_back_time ?> | <?= $back_fly_time ?> | 직항편</td>
    </tr>
    <tr id='row_flight_tr3'>
    <td colspan='2' style='padding-left:30px;'><?= $back_flight_start ?><br><?= $back_fly_start_time ?></td>
    <td>>>>></td>
    <td><?= $start_flight_start ?><br><?= $back_fly_start_time ?></td>
    </tr>
    <tr id='row_flight_tr4'>
    <td colspan='4'>항공편 운임 : <?= $back_flight_price ?> 원</td>
    </tr>
    </table><br><br><br><br>
    
  
  <div id="button_div1">

  <a href="#" onclick="updateReserveNum('update_reserve_num.php?rs_num=<?=$reservation_number?>&total_price=<?=$total_flight_price?>&anum=<?=$adult_num?>&cnum=<?=$child_num?>&bnum=<?=$baby_num?>&start_check=<?= $start_check?>&back_check=<?= $back_check?>&start=<?= $start?>&back=<?= $back?>&fly=<?=$fly?>')">
  <input type="button" id="select_ok" value="완료" style=''>
  </a>
  <input type="button" id="select_ok" value="취소" style='' onclick="flight_back_page()">
  </div>
    
</div>
</div>
<?php  
}else{      //편도

    if($start_check == "low_price_start"){
        //최저가 티켓
        $sql = "select * from flight_one_way where flight_price =
(select min(flight_price) from flight_one_way where flight_start = '$start' and flight_back = '$back')";
        $result1 = mysqli_query($con,$sql) or die("실패원인1 : ".mysqli_error($con));
        $row = mysqli_fetch_array($result1);
        $start_flight_price = $row[flight_price];
        $start_flight_start = $row[flight_start];
        $start_flight_back = $row[flight_back];
        $start_fly_start_date = $row[fly_start_date];
        $start_fly_start_time = $row[fly_start_time];
        $start_fly_back_time = $row[fly_back_time];
        $start_fly_time = $row[fly_time];
        $start_flight_ap_num = $row[flght_ap_num];

    }else{
        $start_recordnum = substr($start_check, 5);      //출국편 선택한 티켓 번호
        
        $sql = "select * from flight_one_way where flight_start= '$start' and flight_back='$back' and recordNum = '$start_recordnum' ";
        
        $result1 = mysqli_query($con,$sql) or die("실패원인7: ".mysqli_error($con));
        
        $row = mysqli_fetch_array($result1);
        $start_flight_price = $row[flight_price];
        $start_flight_start = $row[flight_start];
        $start_flight_back = $row[flight_back];
        $start_fly_start_date = $row[fly_start_date];
        $start_fly_start_time = $row[fly_start_time];
        $start_fly_back_time = $row[fly_back_time];
        $start_fly_time = $row[fly_time];
        $start_flight_ap_num = $row[flght_ap_num];
    }
    
    
    $total_flight_price = ($start_flight_price*$adult_num)+($start_flight_price*0.5*$child_num)+($start_flight_price*0.3* $baby_num);
    $total_flight_price = floor($total_flight_price)- ($total_flight_price % 10); //1의 자리이하 절삭
    
    $total_flight_price = number_format($total_flight_price);   //콤마찍기
    $start_flight_price =number_format($start_flight_price);
  
    ?>

<?php
$reservation_str = "";
for($i=0;$i<4;$i++) { 
    $capi = rand()%26+65;
    $reservation_str .= chr($capi);
}
$reservation_num = mt_rand(1000, 9999);

$reservation_number = $reservation_str . $reservation_num;


if($adult_num == "없음"){
    $adult_num = "0";
}
if($child_num == "없음" ){
    $child_num = "0";
}
if($baby_num == "없음"){
    $baby_num ="0";
}
$rs_cnt = $adult_num + $child_num + $baby_num;
?>

   


  <div id='select_ticket'><span style='font-size:15pt;'>결제 금액<br></span></div>
  <div id="selected_flight3">총 결제금액 : <?= $total_flight_price?>  원
  <span style='font-size:12pt;'>(성인 : <?= $adult_num ?> 명 + 어린이 : <?= $child_num ?> 명 + 유아 : <?= $baby_num ?> 명)<br></span>
   </div>

<div id="select_ticket"><span style='font-size:15pt;'><br><br>예약 번호</span><br></div>
<hr id="hr1"><br>
 <div id="selected_flight3">예약번호  : <?= $reservation_number ?></div>
<div id="select_ticket"><span style='font-size:15pt;'><br><br>예매 확인</span><br></div>
<hr id="hr1"><br>
<div id="flight_ok_box" >



 <table id='row_flight'  style="margin-top:30px;">
    <tr id='row_flight_tr1'>
    <td colspan='4'><?= $start_flight_start ?> >>>> <?= $start_flight_back ?></td>
    </tr>
    <tr id='row_flight_tr2'>
    <td colspan='4'><?= $start_fly_start_date ?> | <?= $start_fly_start_time ?> - <?= $start_fly_back_time ?> | <?= $start_fly_time ?> | 직항편</td>
    </tr>
    <tr id='row_flight_tr3'>
    <td colspan="2" style='padding-left:30px;'><?= $start_flight_start ?><br><?= $start_fly_start_time ?></td>
    <td>>>>></td>
    <td><?= $start_flight_back ?><br><?= $start_fly_back_time ?></td>
    </tr>
    <tr id='row_flight_tr4'>
    <td colspan='4'> 항공편 운임 : <?= $start_flight_price ?> 원</td>
    </tr>
    </table>

	
    </div>
  
  <div id="button_div1">
   
  <a href="#" onclick="updateReserveNum('update_reserve_num.php?rs_num=<?=$reservation_number?>&total_price=<?=$total_flight_price?>&anum=<?=$adult_num?>&cnum=<?=$child_num?>&bnum=<?=$baby_num?>&start_check=<?= $start_check?>&back_check=<?= $back_check?>&start=<?= $start?>&back=<?= $back?>&fly=<?=$fly?>')">
  <input type="button" id="select_ok" value="완료" style=''>
  </a>
  <input type="button" id="select_ok" value="취소" style='' onclick="flight_back_page()">
  </div>
    
</div>

    
<?php
}
?>


<footer>
<?php include_once '../../common_lib/footer2.php';?>
</footer>

</body>
</html>