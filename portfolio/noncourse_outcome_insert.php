<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$nc_title = $_POST['nc_title'];
$nc_content = $_POST['nc_content'];
$category_id = $_POST['category_id'];
$date = $_POST['date'];

$ret = mysqli_query($conn, "insert into noncourse_outcome (nc_title, nc_content, category_id, date, nc_added_datetime) values('$nc_title', '$nc_content', '$category_id', '$date', NOW())");
if(!$ret)
{
	echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=noncourse_outcome_list.php'>";
}

?>

