<?PHP
require_once("./alpha/include_pdo.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title>App testing field</title>
      <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css" />
      <script type='text/javascript' src='scripts/gen_validatorv31.js'></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

	<style type="text/css">
		#main {
    position: absolute;
    width: 70%;
    left:15%;
    top:0;
    height:100%;
    background: #e3dfd7;
    overflow-y: hidden;
}
#header { padding: 20px;}
#header h1 {
    color:#222222;
}
#content {
    height: inherit;
    background: #ebebeb;
    width: 100%;
    padding:20px;
    box-sizing: border-box;
}
#content input {
    width: 100%;
    font-size:20px;
    color: #424242;
    padding:10px;
}
#results{
    width:100%;
    display: none;
    bordder-bottom:1px solid black;
    bordder-left:1px solid black;
    bordder-right:1px solid black;
}
#results #item {
    box-sizing: border-box;
    padding:10px;
    font-size:18px;
    width: 100%;
    background: white;
    border-bottom:1px solid #bdbdbd;
}
</style>

<script>
    $(document).ready(function () {
        $("#searchbox").on('keyup',function () {
            var key = $(this).val();
			var kl = key.length;
			if (kl < 3) {
				$("#results").html("");
			} else {
            $.ajax({
                url:'alpha/app_result.php',
                type:'GET',
                data:'keyword='+key,
                beforeSend:function () {
                   // $("#results").slideUp('fast');
                },
                success:function (data) {
                    $("#results").html(data);
                    $("#results").slideDown('fast');
                }
            });
			}
        });
    });
</script>

</head>
<body>

<?php
echo "test <br />";
$adb = new adb();

	if ($adb->DBLogin()) {
		echo "youhou <br />";
	} else {
		echo "fuck <br />";
	}
	/*$adb->aSearchQuery();
	if ($adb->aSearchQuery() != false) {
		echo $adb->aSearchQuery();
	} else {
		echo "not in da place...<br />";
		echo $adb->aSearchQuery();
	}*/
	echo $adb->aSearchQuery("bot");
?>

<div id="main">
    <div id="header"><h1>Find Names</h1></div>
    <div id="content">
        <input type="search" name="keyword" placeholder="Search Names" id="searchbox">
        <div id="results"></div>
    </div>
</div>

</body>
</html>
