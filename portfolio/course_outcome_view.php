<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("c_id", $_GET)) {
    $c_id = $_GET["c_id"];
    $query = "select * from course_outcome natural join mycourse where c_id = $c_id";
    $res = mysqli_query($conn, $query);
    $course_outcome = mysqli_fetch_assoc($res);
    if (!$course_outcome) {
        msg("학습성과가 존재하지 않습니다.");
    }
}
?>
    <div class="container fullwidth">

        <h4>Course Outcome Details</h4>

        <p>
            <label for="c_id">No.</label>
            <input readonly type="text" id="c_id" name="c_id" value="<?= $course_outcome['c_id'] ?>"/>
        </p>
                
        <p>
            <label for="c_added_datetime">Added Date Time</label>
            <input readonly type="text" id="c_added_datetime" name="c_added_datetime" value="<?= $course_outcome['c_added_datetime'] ?>"/>
        </p>
        
        <p>
            <label for="c_title">Title</label>
            <input readonly type="text" id="c_title" name="c_title" value="<?= $course_outcome['c_title'] ?>"/>
        </p>
        
        <p>
            <label for="date">Date</label>
            <input readonly type="text" id="date" name="date" value="<?= $course_outcome['date'] ?>"/>
        </p>
        
        <p>
            <label for="c_category">Category</label>
            <input readonly type="text" id="c_category" name="c_category" value="<?= $course_outcome['c_category'] ?>"/>
        </p>

        <p>
            <label for="course_name">Course Name</label>
            <input readonly type="text" id="course_name" name="course_name" value="<?= $course_outcome['course_name'] ?>"/>
        </p>

        <p>
            <label for="c_content">Content</label>
            <textarea readonly id="c_content" name="c_content" rows="10"><?= $course_outcome['c_content'] ?></textarea>
        </p>

    </div>
<? include("footer.php") ?>