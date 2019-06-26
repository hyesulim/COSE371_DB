<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "course_outcome_insert.php";

if (array_key_exists("c_id", $_GET)) {
    $c_id = $_GET["c_id"];
    $query =  "select * from course_outcome where c_id = $c_id";
    $res = mysqli_query($conn, $query);
    $course_outcome = mysqli_fetch_array($res);
    if(!$course_outcome) {
        msg("학습성과가 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "course_outcome_modify.php";
}

$course_id = array();

$query = "select * from mycourse";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $course_id[$row['course_id']] = $row['course_name'];
}

$date = array();
$index = 0;
$query = "select * from dailyplan";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $date[$index] = $row['date'];
    $index++;
}



?>
    <div class="container">
        <form name="course_outcome_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="c_id" value="<?=$course_outcome['c_id']?>"/>
            <h4>Course Outcome Details <?=$mode?></h4>
            <p>
                <label for="course_id">Course</label>
                <select name="course_id" id="course_id">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($course_id as $id => $name) {
                            if($id == $course_outcome['course_id']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            <p>
                <label for="c_title">Title</label>
                <input type="text" placeholder="제목 입력" id="c_title" name="c_title" value="<?=$course_outcome['c_title']?>"/>
            </p>
            
            <p>
                <label for="date">Date</label>
                <select name="date" id="date">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($date as $id) {
                            if($id == $course_outcome['date']){
                                echo "<option value='{$id}' selected>{$id}</option>";
                            } else {
                                echo "<option value='{$id}'>{$id}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            
            <p>
                <label for="c_category">Category</label>
                <input type="text" placeholder="분류 입력" id="c_category" name="c_category" value="<?=$course_outcome['c_category']?>"/>
            </p>
            <p>
                <label for="c_content">Content</label>
                <textarea placeholder="학습성과 내용 입력" id="c_content" name="c_content" rows="10"><?=$course_outcome['c_content']?></textarea>
            </p>
            
            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("course_id").value == "-1") {
                        alert ("과목을 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("c_title").value == "") {
                        alert ("제목을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("c_cateogry").value == "") {
                        alert ("분류를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("c_content").value == "") {
                        alert ("학습성과 내용을 입력해 주십시오"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>