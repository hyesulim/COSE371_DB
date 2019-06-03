<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("nc_id", $_GET)) {
    $nc_id = $_GET["nc_id"];
    $query = "select * from noncourse_outcome natural join mycategory where nc_id = $nc_id";
    $res = mysqli_query($conn, $query);
    $noncourse_outcome = mysqli_fetch_assoc($res);
    if (!$noncourse_outcome) {
        msg("대외활동이 존재하지 않습니다.");
    }
}
?>
    <div class="container fullwidth">

        <h4>Noncourse Outcome Details</h4>

        <p>
            <label for="nc_id">No.</label>
            <input readonly type="text" id="nc_id" name="nc_id" value="<?= $noncourse_outcome['nc_id'] ?>"/>
        </p>
        
        <p>
            <label for="nc_added_datetime">Added Date Time</label>
            <input readonly type="text" id="nc_added_datetime" name="nc_added_datetime" value="<?= $noncourse_outcome['nc_added_datetime'] ?>"/>
        </p>
        
        <p>
            <label for="date">Date</label>
            <input readonly type="text" id="date" name="date" value="<?= $noncourse_outcome['date'] ?>"/>
        </p>
        
        <p>
            <label for="category_name">Category</label>
            <input readonly type="text" id="category_name" name="category_name" value="<?= $noncourse_outcome['category_name'] ?>"/>
        </p>
        
        <p>
            <label for="nc_title">Title</label>
            <input readonly type="text" id="nc_title" name="nc_title" value="<?= $noncourse_outcome['nc_title'] ?>"/>
        </p>

        <p>
            <label for="nc_content">Content</label>
            <textarea readonly id="nc_content" name="nc_content" rows="10"><?= $noncourse_outcome['nc_content'] ?></textarea>
        </p>

    </div>
<? include("footer.php") ?>