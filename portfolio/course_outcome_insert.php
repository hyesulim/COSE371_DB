<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$c_title = $_POST['c_title'];
$c_content = $_POST['c_content'];
$course_id = $_POST['course_id'];
$c_category = $_POST['c_category'];
$date = $_POST['date'];

$ret = mysqli_query($conn, "insert into course_outcome (c_title, c_content, course_id, c_category, date, c_added_datetime) values('$c_title', '$c_content', '$course_id', '$c_category', '$date', NOW())");
if(!$ret)
{
	echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=course_outcome_list.php'>";
}

?>

