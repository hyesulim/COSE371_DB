<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from course_outcome natural join mycourse natural join dailyplan";
    if (array_key_exists("search_keyword", $_POST)) {  // array_key_exists() : Checks if the specified key exists in the array
        $search_keyword = $_POST["search_keyword"];
        $query =  $query . " where c_title like '%$search_keyword%' or c_content like '%$search_keyword%' or c_category like '%$search_keyword%'";
    
    }
    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    ?>
    <p><a href='mycourse_list.php'>Course Info.</a></p>
    <p><a href='course_outcome_form.php'><button class='button primary small'>Course Outcome Insert</button></a></p>
    
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>No.</th>
            <th>Course</th>
            <th>Date</th>
            <th>Title</th>
            <th>Added Date Time</th>
            <th>Function</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td><a href='mycourse_view.php?course_id={$row['course_id']}'>{$row['course_name']}</a></td>";
            echo "<td><a href='dailyplan_view.php?date={$row['date']}'>{$row['date']}</a></td>";
            echo "<td><a href='course_outcome_view.php?c_id={$row['c_id']}'>{$row['c_title']}</a></td>";
            echo "<td>{$row['c_added_datetime']}</td>";
            echo "<td width='17%'>
                <a href='course_outcome_form.php?c_id={$row['c_id']}'><button class='button primary small'>수정</button></a>
                 <button onclick='javascript:deleteConfirm({$row['c_id']})' class='button danger small'>삭제</button>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
    <script>
        function deleteConfirm(c_id) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "course_outcome_delete.php?c_id=" + c_id;
            }else{   //취소
                return;
            }
        }
    </script>
</div>
<? include("footer.php") ?>
