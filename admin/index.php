<?
#if($_SERVER['REMOTE_ADDR'] != '192.168.1.1' && )
if($_GET['pw'] != 'gj834gh93vh478gh34589gh')
	die('Get out');
$mysqli = new mysqli('localhost', 'tre', '#Gicc?Qal?3@', 'tre');
$mysqli->set_charset("utf8");
$sql = "select * from records where accepted = 0";
$res = $mysqli->query($sql);
$data = array();
while($f = $res->fetch_assoc())
{
	$id = $f['id'];
	$data[$id]['type'] = $f['type'];
	$data[$id]['character'] = $f['character'];
	$data[$id]['amount'] = $f['amount'];
	$data[$id]['url'] = $f['url'];
	$data[$id]['class'] = $f['class'];
	$data[$id]['patch'] = $f['patch'];
	$data[$id]['added'] = $f['added'];
	$data[$id]['wztype'] = $f['wztype'];
}
?>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<div class="container-fluid">
<?

echo "<table class=\"table table-striped table-bordered\">";
echo "<tr><th>Char<th>Amount<th>URL<th>Class<th>Patch<th>Date Added<th>Wztype<th>Comment<th>Approve<th>Reject";
foreach($data as $id => $value)
{
	echo "<tr id='$id'><td>{$value['character']}";
	echo "<td>";
	echo $value['amount'];
	echo "<td>";
	echo $value['url'];
	echo "<td>";
	echo $value['class'];
	echo "<td>";
	echo $value['patch'];
	echo "<td>";
	echo $value['added'];
	echo "<td>";
	echo $value['wztype'];
	echo "<td><input type='text' id='comments_$id' placeholder='Only sent for rejected'>";
	echo "<td><button type=button class='btn btn-danger delete' data-id='$id'>Reject</button>";
	echo "<td><button type=button class='btn btn-success approve' data-id='$id'>Approve</button>";
}
?>
</table>
<script src="jquery.min.js"></script>
<script>
$('.approve').click(function () {
	var id = $(this).attr("data-id");
	$.post( "ajax.php", { did: id, action: 1 })
	.done(function( data ) {
		alert( "Rejected with data: " + data );
		$('#'+id).remove();
        });
});
$('.delete').click(function () {
	var id = $(this).attr("data-id");
	var comment = $('#comments_'+id).val();
	$.post( "ajax.php", { did: id, com: comment, action: 2 })
	.done(function( data ) {
	 	alert( "Rejected with data: " + data );
		$('#'+id).remove();
        });
});
</script>
