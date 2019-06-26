<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$c_id = $_POST['c_id'];
$c_title = $_POST['c_title'];
$c_category = $_POST['c_category'];
$c_content = $_POST['c_content'];
$course_id = $_POST['course_id'];
$date = $_POST['date'];

$ret = mysqli_query($conn, "update course_outcome set c_title = '$c_title', c_category = '$c_category', c_content = '$c_content', course_id = '$course_id', date = '$date' where c_id = $c_id");

if(!$ret)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 수정 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=course_outcome_list.php'>";
}

?>

