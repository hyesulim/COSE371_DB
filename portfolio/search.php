<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>

<div class="container">
<?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query1 = "select * from dailyplan";
    $query2 = "select * from course_outcome natural join mycourse natural join dailyplan";
    $query3 = "select * from noncourse_outcome natural join mycategory natural join dailyplan";
    $query4 = "select * from letter natural join mycategory natural join dailyplan";
    
    
    if (array_key_exists("search_keyword", $_POST)) {  // array_key_exists() : Checks if the specified key exists in the array
        $search_keyword = $_POST["search_keyword"];
        $query1 =  $query1 . " where plan_content like '%$search_keyword%' or day like '%$search_keyword%' or date like '%$search_keyword%'";
        $query2 =  $query2 . " where course_name like '%$search_keyword%' or c_title like '%$search_keyword%' or c_content like '%$search_keyword%' or c_category like '%$search_keyword%' or date like '%$search_keyword%'";
        $query3 =  $query3 . " where nc_title like '%$search_keyword%' or nc_content like '%$search_keyword%' or category_name like '%$search_keyword%' or date like '%$search_keyword%'";
    	$query4 =  $query4 . " where letter_title like '%$search_keyword%' or letter_content like '%$search_keyword%' or category_name like '%$search_keyword%' or acceptance like '%$search_keyword%' or date like '%$search_keyword%'";
    }
    
    $res1 = mysqli_query($conn, $query1);
    $res2 = mysqli_query($conn, $query2);
    $res3 = mysqli_query($conn, $query3);
    $res4 = mysqli_query($conn, $query4);
    
    if (!$res1 or !$res2 or !$res3 or !$res4) {
         die('Query Error : ' . mysqli_error());
    }
?>
	<!-- daily_plan-->
	<a><h4>Daily Plan <br></br></h4></a>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Plan ID</th>
            <th>Date</th>
            <th>Day</th>
            <th>Added Date Time</th>
            <th>Function</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res1)) {
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
    
    <!-- course_outcome-->
	<a><h4>Course Outcome <br></br></h4></a>
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
        while ($row = mysqli_fetch_array($res2)) {
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
	
	<!-- noncourse_outcome-->
	<a><h4>Noncourse Outcome <br></br></h4></a>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>No.</th>
            <th>Date</th>
            <th>Category</th>
            <th>Title</th>
            <th>Added Date Time</th>
            <th>Function</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res3)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td><a href='dailyplan_view.php?date={$row['date']}'>{$row['date']}</a></td>";
            echo "<td>{$row['category_name']}</td>";
            echo "<td><a href='noncourse_outcome_view.php?nc_id={$row['nc_id']}'>{$row['nc_title']}</a></td>";
            echo "<td>{$row['nc_added_datetime']}</td>";
            echo "<td width='17%'>
                <a href='noncourse_outcome_form.php?nc_id={$row['nc_id']}'><button class='button primary small'>수정</button></a>
                 <button onclick='javascript:deleteConfirm({$row['nc_id']})' class='button danger small'>삭제</button>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
    <script>
        function deleteConfirm(nc_id) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "noncourse_outcome_delete.php?nc_id=" + nc_id;
            }else{   //취소
                return;
            }
        }
    </script>
    
    <!-- cover_letter-->
    <a><h4>Cover Letter<br></br></h4></a>
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
        while ($row = mysqli_fetch_array($res4)) {
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