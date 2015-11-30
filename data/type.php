<?
require_once('functions.php');
require_once('define.php');
$headers = define_headers();
$abb = abbreviations();
$classes = define_classes();
$types = array_keys($headers);
$data = array();
foreach($classes as $key => $value)
{
	$type = $_GET['type'];
	$accepted = isset($_GET['approved']) ? $_GET['approved'] : 1;
	$values = array($type,$accepted);
	$sql = "select id, type, `character`, amount, url, faction, class, patch, wztype from records where type = ? and accepted like ? and wztype in (";
	if(is_array($_GET['wztype']))
	{
		foreach($_GET['wztype'] as $value)
		{
			$sql .= "?,";
			$values[] = $value;
		}
	}
	elseif($_GET['wztype'] != '')
	{
		
		$values[] = isset($_GET['wztype']) ? $_GET['wztype'] : '%';
		$sql .= "?,";
	}
	$sql = rtrim($sql, ',');
	$sql .= ') ';
	$sql .= " and class = ? and `character` like ? and faction like ? ";
	$sql .= "and patch in (";
	$patch = isset($_GET['patch']) ? $_GET['patch'] : array('3.0');
	$char = isset($_GET['char']) ? $_GET['char'] : '%';
	$faction = isset($_GET['faction']) ? $_GET['faction'] : '%';
	array_push($values, $key, $char, $faction);
	foreach($patch as $pat)
	{
		$sql .= "?,";
		$values[] = $pat;
	}
	$sql = rtrim($sql, ',');
	$sql .= ') ';
	$sql .= " order by amount desc limit 10";
	#echo "<pre>";echo $sql;print_r($values);
	#echo "<pre>$sql";print_r($values);echo"</pre>";
	$res = mysqli_select_array($sql, $values);
	foreach($res as $value)
	{
		$type = $value['type'];
		$class = $value['class'];
		$id = $value['id'];
		$data[$class][$id]['character'] = $value['character'];
		$data[$class][$id]['amount'] = $value['amount'];
		$data[$class][$id]['url'] = $value['url'];
		$data[$class][$id]['faction'] = $value['faction'];
		$data[$class][$id]['class'] = $value['class'];
		$data[$class][$id]['patch'] = $value['patch'];
		$data[$class][$id]['wztype'] = $value['wztype'];
	}
}
foreach($data as $key=>$array)
{
	echo "<h2>".$classes[$key][0]." / ".$classes[$key][1]."</h2>\n";
?>
<table class="table table-striped">
	<tr><th>Character<th>Amount<th>Faction<th>Class
<?
	if(isset($_GET['patch'])) echo "<th>Patch";
	if(isset($_GET['wztype'])) echo "<th>Wztype";
?>
	</tr>
<?
	foreach($array as $id => $values)
	{
		echo "	<tr><td>{$values['character']}<td><a class='fancybox' href='{$values['url']}'>{$values['amount']}</a><td><i class='";
		$faction = $values['faction'];
		echo $abb[$faction];
		echo "'></i>";
		echo "<td>";
		$tempc = $values['class'];
		if($values['faction'] == 'rep')
			$class = $classes[$tempc][0];
		else
			$class = $classes[$tempc][1];
		echo $class;
		if(isset($_GET['patch'])) 
		{
			echo "<td>";
			Switch($values['patch'])
			{
				case '2.0':
					echo '2.0-2.3';
					break;
				case '2.4':
					echo '2.4-2.10';
					break;
				case '3.0':
					echo '3.0->';
					break;
				default:
					echo "You gun broke it";
			}
		}
		if(isset($_GET['wztype']))
		{
			echo "<td>".ucfirst($_GET['wztype']);
		}
		echo "</tr>\n";
	}
?>
</table>
<?
}
?>
