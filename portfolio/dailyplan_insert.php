<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$date = $_POST['date'];
$day = $_POST['day'];
$plan_content = $_POST['plan_content'];

$double_query = "select * from dailyplan where date = '$date'";
$double_res = mysqli_query($conn, $double_query);
$double_count = mysqli_num_rows($double_res);

if($double_count != 0){
   msg("해당 날짜에 대한 플랜은 이미 존재합니다! 다른 날짜를 작성해주세요:)");
}

else{
	
	$ret = mysqli_query($conn, "insert into dailyplan (date, day, plan_content, plan_added_datetime) values('$date', '$day', '$plan_content',  NOW())");
   
	if(!$ret)
	{
		echo mysqli_error($conn);
	    msg('Query Error : '.mysqli_error($conn));
	}
	else
	{
	    s_msg ('성공적으로 입력 되었습니다');
	    echo "<meta http-equiv='refresh' content='0;url=dailyplan_list.php'>";
	}
}

?>

