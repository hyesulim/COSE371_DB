<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$plan_id = $_POST['plan_id'];
$date = $_POST['date']; 
$day = $_POST['day'];
$plan_content = $_POST['plan_content'];

$res1 =  mysqli_fetch_array(mysqli_query($conn, "select date from dailyplan where plan_id = $plan_id"));
$date_before_modification = $res1['date'];

$res2 = mysqli_fetch_array(mysqli_query($conn, "select count(*) from course_outcome where date = '$date_before_modification'"));
$course_outcome_num = $res2['count(*)'];

$res3 = mysqli_fetch_array(mysqli_query($conn, "select count(*) from noncourse_outcome where date = '$date_before_modification'"));
$noncourse_outcome_num = $res3['count(*)'];

$res4 = mysqli_fetch_array(mysqli_query($conn, "select count(*) from letter where date = '$date_before_modification'"));
$letter_num = $res4['count(*)'];

$double_query = "select * from dailyplan where date = '$date'";
$double_res = mysqli_query($conn, $double_query);
$double_count = mysqli_num_rows($double_res);

if (!$res1 or !$res2 or !$res3 or !$res4) 
{
    die('Query Error : ' . mysqli_error());
}


$num = 0;
$num = $course_outcome_num + $noncourse_outcome_num + $letter_num;


// date 를 수정하려고 하는 경우, 아닌 경우

if($date != $date_before_modification) // date 를 수정하려고 하는경우
{
	if($num!=0) // 수정하기 전 date 를 참조하는 course_outcome, noncourse_outcome, letter 가 있는 경우
	{
		msg('수정하기 전 date 를 참조하는 course outcome, noncourse outcome, cover letter 가 있어 date 를 수정할 수 없습니다.');
	}
	else // 수정하기 전 date 를 참조하는 course_outcome, noncourse_outcome, letter 가 없는 경우
	{
		if($double_count != 0){ 
			// 수정하기 전 date 를 참조하는 course_outcome, noncourse_outcome, letter 가 없지만, 
			// 이미 해당 날짜의 플랜이 존재하는 경우. 
			msg("해당 날짜에 대한 플랜은 이미 존재합니다! 다른 날짜로 수정해주세요:)");
		}
		else{
			// date 수정 가능.
			$ret = mysqli_query($conn, "update dailyplan set date = '$date', day = '$day', plan_content= '$plan_content' where plan_id = $plan_id");
		
			if(!$ret)
			{
			    msg('Query Error : '.mysqli_error($conn));
			}
			else
			{
			    s_msg ('성공적으로 수정 되었습니다');
			    echo "<meta http-equiv='refresh' content='0;url=dailyplan_list.php'>";
			}
		}
	}
}

else // date 를 수정하지 않는 경우
{
	$ret = mysqli_query($conn, "update dailyplan set date = '$date', day = '$day', plan_content= '$plan_content' where plan_id = $plan_id");
		
		if(!$ret)
		{
		    msg('Query Error : '.mysqli_error($conn));
		}
		else
		{
		    s_msg ('성공적으로 수정 되었습니다');
		    echo "<meta http-equiv='refresh' content='0;url=dailyplan_list.php'>";
		}
}


?>

