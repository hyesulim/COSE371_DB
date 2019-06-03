<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$letter_title = $_POST['letter_title'];
$letter_content = $_POST['letter_content'];
$acceptance = $_POST['acceptance'];
$category_id = $_POST['category_id'];
$date = $_POST['date'];

$ret = mysqli_query($conn, "insert into letter (letter_title, letter_content, acceptance, category_id, date, letter_added_datetime) values('$letter_title', '$letter_content', '$acceptance', '$category_id', '$date', NOW())");
if(!$ret)
{
	echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=letter_list.php'>";
}

?>

