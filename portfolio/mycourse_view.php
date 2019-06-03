<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("course_id", $_GET)) {
    $course_id = $_GET["course_id"];
    $query = "select * from mycourse where course_id = '$course_id'";
    $res = mysqli_query($conn, $query);
    $mycourse = mysqli_fetch_assoc($res);
    if (!$mycourse) {
        msg("코스가 존재하지 않습니다.");
    }
}
?>
    <div class="container fullwidth">

        <h4>Course Details</h4>
        
        <p>
            <label for="course_id">Course ID</label>
            <input readonly type="text" id="course_id" name="course_id" value="<?= $mycourse['course_id'] ?>"/>
        </p>
                
        <p>
            <label for="course_name">Course Name</label>
            <input readonly type="text" id="course_name" name="course_name" value="<?= $mycourse['course_name'] ?>"/>
        </p>

        <p>
            <label for="year">Year</label>
            <input readonly type="text" id="year" name="year" value="<?= $mycourse['year'] ?>"/>
        </p>

        <p>
            <label for="semester">Semester</label>
            <input readonly type="text" id="semester" name="semester" value="<?= $mycourse['semester'] ?>"/>
        </p>
        
        <p>
            <label for="grade">Grade</label>
            <input readonly type="text" id="grade" name="grade" value="<?= $mycourse['grade'] ?>"/>
        </p>


    </div>
<? include("footer.php") ?>