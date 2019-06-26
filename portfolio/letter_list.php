<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from letter natural join mycategory natural join dailyplan";
    if (array_key_exists("search_keyword", $_POST)) {  // array_key_exists() : Checks if the specified key exists in the array
        $search_keyword = $_POST["search_keyword"];
        $query =  $query . " where letter_title like '%$search_keyword%' or letter_content like '%$search_keyword%' or letter_category like '%$search_keyword%'";
    
    }
    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    ?>
    <p><a href='mycategory_list.php'>Category Info.</a></p>
    <p><a href='letter_form.php'><button class='button primary small'>Cover Letter Insert</button></a></p>
    
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>No.</th>
            <th>Date</th>
            <th>Category</th>
            <th>Title</th>
            <th>Acceptance</th>
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
            echo "<td><a href='dailyplan_view.php?date={$row['date']}'>{$row['date']}</a></td>";
            echo "<td>{$row['category_name']}</td>";
            echo "<td><a href='letter_view.php?letter_id={$row['letter_id']}'>{$row['letter_title']}</a></td>";
            echo "<td>{$row['acceptance']}</td>";
            echo "<td>{$row['letter_added_datetime']}</td>";
            echo "<td width='17%'>
                <a href='letter_form.php?letter_id={$row['letter_id']}'><button class='button primary small'>수정</button></a>
                 <button onclick='javascript:deleteConfirm({$row['letter_id']})' class='button danger small'>삭제</button>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
    <script>
        function deleteConfirm(letter_id) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "letter_delete.php?letter_id=" + letter_id;
            }else{   //취소
                return;
            }
        }
    </script>
</div>
<? include("footer.php") ?>
