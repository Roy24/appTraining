<?PHP

require_once __DIR__ ."/include_pdo.php";
$adb = new adb();

if($_GET && !empty($_GET['keyword'])) {
	echo $adb->aSearchQuery($_GET['keyword']);	
}

?>
