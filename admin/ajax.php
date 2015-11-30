<?
$mysqli = new mysqli('localhost', 'tre', '#Gicc?Qal?3@', 'tre');
$mysqli->set_charset("utf8");
print_r($_POST);
$comments = (isset($_POST['com'])) ? $_POST['com'] : '';
$yn = $_POST['action'];
$id = $_POST['did'];
$sql = "update records set accepted = ?, comment = ? where id = ?";
if(!$stmt = $mysqli->prepare($sql))
	trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
if(!$stmt->bind_param('isi', $yn, $comments, $id)) 
	trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
if(!$stmt->execute())
	trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
?>
