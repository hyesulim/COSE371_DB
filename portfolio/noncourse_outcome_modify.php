<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$nc_id = $_POST['nc_id'];
$nc_title = $_POST['nc_title'];
$category_id = $_POST['category_id'];
$nc_content = $_POST['nc_content'];
$date = $_POST['date'];

$ret = mysqli_query($conn, "update noncourse_outcome set nc_title = '$nc_title', category_id = '$category_id', nc_content = '$nc_content', date = '$date' where nc_id = $nc_id");

if(!$ret)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 수정 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=noncourse_outcome_list.php'>";
}

?>

