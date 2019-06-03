<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from dailyplan";
    if (array_key_exists("search_keyword", $_POST)) {  // array_key_exists() : Checks if the specified key exists in the array
        $search_keyword = $_POST["search_keyword"];
        $query =  $query . " where plan_content like '%$search_keyword%'";
    
    }
    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    ?>
    
    <p><a href='dailyplan_form.php'><button class='button primary small'>Daily Plan Insert</button></a></p>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>No.</th>
            <th>Date</th>
            <th>Day</th>
            <th>Added Date Time</th>
            <th>Function</th>
            <!--<th>기능</th>-->
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td><a href='dailyplan_view.php?plan_id={$row['plan_id']}'>{$row['date']}</a></td>";
            echo "<td>{$row['day']}</td>";
            echo "<td>{$row['plan_added_datetime']}</td>";
            echo "<td width='17%'>
                <a href='dailyplan_form.php?plan_id={$row['plan_id']}'><button class='button primary small'>수정</button></a>
                 <button onclick='javascript:deleteConfirm({$row['plan_id']})' class='button danger small'>삭제</button>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
    <script>
        function deleteConfirm(plan_id) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "dailyplan_delete.php?plan_id=" + plan_id;
            }else{   //취소
                return;
            }
        }
    </script>
</div>
<? include("footer.php") ?>
