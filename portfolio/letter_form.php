<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "letter_insert.php";

if (array_key_exists("letter_id", $_GET)) {
    $letter_id = $_GET["letter_id"];
    $query =  "select * from letter natural join mycategory natural join dailyplan where letter_id = $letter_id";
    $res = mysqli_query($conn, $query);
    $letter = mysqli_fetch_array($res);
    if(!$letter) {
        msg("자기소개서가 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "letter_modify.php";
}

$category = array();

$query = "select * from mycategory";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
	$category[$row['category_id']] = $row['category_name'];
}

$acceptance = array('합격', '불합격', '미정');

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
        <form name="letter_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="letter_id" value="<?=$letter['letter_id']?>"/>
            <h4>Cover Letter Details <?=$mode?></h4>
            <p>
                <label for="letter_title">Title</label>
                <input type="text" placeholder="제목 입력" id="letter_title" name="letter_title" value="<?=$letter['letter_title']?>"/>
            </p>
            
             <p>
                <label for="date">Date</label>
                <select name="date" id="date">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($date as $id) {
                            if($id == $letter['date']){
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
            			if($id == $letter['category_id']){
            				echo "<option value='{$id}' selected>{$name}</option>";
            			} else {
            				echo "<option value='{$id}'>{$name}</option>";
            			}
            		}
            	?>
            	</select>
            </p>
            
            <p>
                <label for="acceptance">Acceptance</label>
            	<select name="acceptance" id="acceptance">
            		<option value="-1">선택해 주십시오.</option>
            		<?php
            		foreach($acceptance as $key) {
            			if($key === $letter['acceptance']){
            				echo "<option value='{$key}' selected>{$key}</option>";
            			} else {
            				echo "<option value='{$key}'>{$key}</option>";
            			}
            		}
            	?>
            	</select>
            </p>
            
            <p>
                <label for="letter_content">Content</label>
                <textarea placeholder="자기소개서 내용 입력" id="letter_content" name="letter_content" rows="10"><?=$letter['letter_content']?></textarea>
            </p>
            
            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("letter_title").value == "") {
                        alert ("제목을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("date").value == "-1") {
                        alert ("날짜를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("category_id").value == "-1") {
                        alert ("분류를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("acceptance").value == "-1") {
                        alert ("합격여부를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("letter_content").value == "") {
                        alert ("자기소개서 내용을 입력해 주십시오"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>