<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$plan_id = $_GET['plan_id'];

$res1 =  mysqli_fetch_array(mysqli_query($conn, "select date from dailyplan where plan_id = $plan_id"));
$date_before_modification = $res1['date'];

$res2 = mysqli_fetch_array(mysqli_query($conn, "select count(*) from course_outcome where date = '$date_before_modification'"));
$course_outcome_num = $res2['count(*)'];

$res3 = mysqli_fetch_array(mysqli_query($conn, "select count(*) from noncourse_outcome where date = '$date_before_modification'"));
$noncourse_outcome_num = $res3['count(*)'];

$res4 = mysqli_fetch_array(mysqli_query($conn, "select count(*) from letter where date = '$date_before_modification'"));
$letter_num = $res4['count(*)'];

if (!$res1 or !$res2 or !$res3 or !$res4) 
{
    die('Query Error : ' . mysqli_error());
}



$num = 0;
$num = $course_outcome_num + $noncourse_outcome_num + $letter_num;

if($num!=0) // 수정하기 전 date 를 참조하는 course_outcome, noncourse_outcome, letter 가 있는 경우
{
	msg('이 date 를 참조하는 course outcome, noncourse outcome, cover letter 가 있어 plan을 삭제할 수 없습니다.');
}

$ret = mysqli_query($conn, "delete from dailyplan where plan_id = $plan_id");

if(!$ret)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 삭제 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=dailyplan_list.php'>";
}

?>

