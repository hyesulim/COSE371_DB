<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("letter_id", $_GET)) {
    $letter_id = $_GET["letter_id"];
    $query = "select * from letter natural join mycategory where letter_id = $letter_id";
    $res = mysqli_query($conn, $query);
    $letter = mysqli_fetch_assoc($res);
    if (!$letter) {
        msg("자기소개서가 존재하지 않습니다.");
    }
}
?>
    <div class="container fullwidth">

        <h4>Cover Letter Details</h4>

        <p>
            <label for="letter_id">No.</label>
            <input readonly type="text" id="letter_id" name="letter_id" value="<?= $letter['letter_id'] ?>"/>
        </p>
                
        <p>
            <label for="letter_added_datetime">Added Date Time</label>
            <input readonly type="text" id="letter_added_datetime" name="letter_added_datetime" value="<?= $letter['letter_added_datetime'] ?>"/>
        </p>
        
        <p>
            <label for="letter_title">Title</label>
            <input readonly type="text" id="letter_title" name="letter_title" value="<?= $letter['letter_title'] ?>"/>
        </p>
        
        <p>
            <label for="date">Date</label>
            <input readonly type="text" id="date" name="date" value="<?= $letter['date'] ?>"/>
        </p>
        
        <p>
            <label for="category_name">Category</label>
            <input readonly type="text" id="category_name" name="category_name" value="<?= $letter['category_name'] ?>"/>
        </p>
        
        <p>
            <label for="acceptance">Acceptance</label>
            <input readonly type="text" id="acceptance" name="acceptance" value="<?= $letter['acceptance'] ?>"/>
        </p>

        <p>
            <label for="letter_content">Content</label>
            <textarea readonly id="letter_content" name="letter_content" rows="10"><?= $letter['letter_content'] ?></textarea>
        </p>

    </div>
<? include("footer.php") ?>