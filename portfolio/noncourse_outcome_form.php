<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "noncourse_outcome_insert.php";

if (array_key_exists("nc_id", $_GET)) {
    $nc_id = $_GET["nc_id"];
    $query =  "select * from noncourse_outcome natural join mycategory where nc_id = $nc_id";
    $res = mysqli_query($conn, $query);
    $noncourse_outcome = mysqli_fetch_array($res);
    if(!$noncourse_outcome) {
        msg("대외 활동이 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "noncourse_outcome_modify.php";
}

$category = array();
$query = "select * from mycategory";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
	$category[$row['category_id']] = $row['category_name'];
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
        <form name="noncourse_outcome_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="nc_id" value="<?=$noncourse_outcome['nc_id']?>"/>
            <h4>Noncourse Outcome Details <?=$mode?></h4>

            <p>
                <label for="nc_title">Title</label>
                <input type="text" placeholder="제목 입력" id="nc_title" name="nc_title" value="<?=$noncourse_outcome['nc_title']?>"/>
            </p>
            <p>
                <label for="date">Date</label>
                <select name="date" id="date">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($date as $id) {
                            if($id == $noncourse_outcome['date']){
                                echo "<option value='{$id}' selected>{$id}</option>";
                            } else {
                                echo "<option value='{$id}'>{$id}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            <p>
            	<label for="category_id">Category</label>
            	<select name="category_id" id="category_id">
            		<option value="-1">선택해 주십시오.</option>
            		<?php
            		foreach($category as $id => $name) {
            			if($id == $noncourse_outcome['category_id']){
            				echo "<option value='{$id}' selected>{$name}</option>";
            			} else {
            				echo "<option value='{$id}'>{$name}</option>";
            			}
            		}
            	?>
            	</select>
             </p>
             <p>
                <label for="nc_content">Content</label>
                <textarea placeholder="대외활동 내용 입력" id="nc_content" name="nc_content" rows="10"><?=$noncourse_outcome['nc_content']?></textarea>
             </p>
            
             <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                     if(document.getElementById("nc_title").value == "") {
                        alert ("제목을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("category_id").value == "-1") {
                        alert ("분류를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("date").value == "-1") {
                        alert ("날짜를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("nc_content").value == "") {
                        alert ("대외활동 내용을 입력해 주십시오"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>