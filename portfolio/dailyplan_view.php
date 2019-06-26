<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("plan_id", $_GET)) {
    $plan_id = $_GET["plan_id"];
    $query = "select * from dailyplan where plan_id = '$plan_id'";
    $res = mysqli_query($conn, $query);
    $dailyplan = mysqli_fetch_assoc($res);
    if (!$dailyplan) {
        msg("플랜이 존재하지 않습니다.");
    }
}

else if (array_key_exists("date", $_GET)) {
    $date = $_GET["date"];
    $query = "select * from dailyplan where date = '$date'";
    $res = mysqli_query($conn, $query);
    $dailyplan = mysqli_fetch_assoc($res);
    if (!$dailyplan) {
        msg("플랜이 존재하지 않습니다.");
    }
}

?>
    <div class="container fullwidth">

        <h4>Daily Plan Details</h4>
        
        <p>
            <label for="plan_id">No.</label>
            <input readonly type="text" id="plan_id" name="plan_id" value="<?= $dailyplan['plan_id'] ?>"/>
        </p>
                
        <p>
            <label for="plan_added_datetime">Added Date Time</label>
            <input readonly type="text" id="plan_added_datetime" name="plan_added_datetime" value="<?= $dailyplan['plan_added_datetime'] ?>"/>
        </p>

        <p>
            <label for="date">Date</label>
            <input readonly type="text" id="date" name="date" value="<?= $dailyplan['date'] ?>"/>
        </p>

        <p>
            <label for="day">Day</label>
            <input readonly type="text" id="day" name="day" value="<?= $dailyplan['day'] ?>"/>
        </p>

        <p>
            <label for="plan_content">Content</label>
            <textarea readonly id="plan_content" name="plan_content" rows="10"><?= $dailyplan['plan_content'] ?></textarea>
        </p>
        
        

    </div>
<? include("footer.php") ?>