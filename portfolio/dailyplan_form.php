<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "dailyplan_insert.php";

if (array_key_exists("plan_id", $_GET)) {
    $plan_id = $_GET["plan_id"];
    $query =  "select * from dailyplan where plan_id = $plan_id";
    $res = mysqli_query($conn, $query);
    $dailyplan = mysqli_fetch_array($res);
    if(!$dailyplan) {
        msg("플랜이 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "dailyplan_modify.php";
}

$day = array('MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN');



?>
    <div class="container">
        <form name="dailyplan_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="plan_id" value="<?=$dailyplan['plan_id']?>"/>
            <h3>Daily Plan <?=$mode?></h3>
            <p>
                <label for="date">Date</label>
                <input type="text" placeholder="날짜 입력" id="date" name="date" value="<?=$dailyplan['date']?>"/>
            </p>
            <p>
            	<label for="day">Day</label>
            	<select name="day" id="day">
            		<option value="-1">선택해 주십시오.</option>
            		<?php
            		foreach($day as $id) {
            			if($id == $dailyplan['day']){
            				echo "<option value='{$id}' selected>{$id}</option>";
            			} else {
            				echo "<option value='{$id}'>{$id}</option>";
            			}
            		}
            	?>
            	</select>
            </p>
            <p>
                <label for="plan_content">Content</label>
                <textarea placeholder="플랜 내용 입력" id="plan_content" name="plan_content" rows="10"><?=$dailyplan['plan_content']?></textarea>
            </p>

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("date").value == "") {
                        alert ("날짜를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("day").value == "-1") {
                        alert ("요일을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("plan_content").value == "") {
                        alert ("플랜 내용을 입력해 주십시오"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>