<!DOCTYPE html>
<html lang='ko'>
<head>
    <title>portfolio</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
</head>
<body>
<form action="search.php" method="post">
    <div class='navbar fixed'>
        <div class='container'>
            <a class='pull-left title' href="index.php">PORTFOLIO</a>
            <ul class='pull-right'>
                <li>
                    <input type="text" name="search_keyword" placeholder="Search">
                </li>
                <li><a href='dailyplan_list.php'>Daily Plan</a></li>
                <li><a href='course_outcome_list.php'>Course Outcome</a></li>
                <li><a href='noncourse_outcome_list.php'>Noncourse Outcome</a></li>
                <li><a href='letter_list.php'>Cover Letter</a></li>
                <!--<li><a href='mycourse_list.php'>Course Info.</a></li>
                <li><a href='mycategory_list.php'>Category Info.</a></li>-->
                <li><a href='site_info.php'>Site Info.</a></li>
            </ul>
        </div>
    </div>
</form>
