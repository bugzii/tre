<?

$mysqli = new mysqli('localhost', 'tre', '#Gicc?Qal?3@', 'tre');

$mysqli->set_charset("utf8");

$char = $_POST['character'];

$wztype = $_POST['wztype'];

$faction = $_POST['faction'];

$class = $_POST['class'];

$type = $_POST['type'];

$amount = round($_POST['amount']);

$url = $_POST['url'];

$patch = $_POST['patch'];

$sql = "insert into records

	(`character`, wztype, type, faction, `class`, amount, url, patch)

	values

	(?,?,?,?,?,?,?,?)

	";

if(!$stmt = $mysqli->prepare($sql))

	trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);

if(!$stmt->bind_param('sssssiss', $char,$wztype,$type,$faction,$class,$amount,$url,$patch))

	trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);

if(!$stmt->execute())

	trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);

$returnedid = $mysqli->insert_id;

echo "<div class='alert alert-success'>Your record was posted!</div>";
#	print_r($_POST);

?>

