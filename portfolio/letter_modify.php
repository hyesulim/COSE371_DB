<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$letter_id = $_POST['letter_id'];
$letter_title = $_POST['letter_title'];
$letter_content = $_POST['letter_content'];
$acceptance = $_POST['acceptance'];
$category_id = $_POST['category_id'];
$date = $_POST['date'];

$ret = mysqli_query($conn, "update letter set letter_title = '$letter_title', category_id = '$category_id', letter_content = '$letter_content', acceptance = '$acceptance', date = '$date' where letter_id = $letter_id");

if(!$ret)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 수정 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=letter_list.php'>";
}

?>