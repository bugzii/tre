<?
require_once('functions.php');
require_once('define.php');
$headers = define_headers();
$abb = abbreviations();
$classes = define_classes();
$types = array_keys($headers);
$data = array();
$i = 0;
foreach($types as $type)
{
	$values = array($types[$i]); #$accepted, $_GET['class'], $_GET['wztype'], $char, $faction);
	$sql = "select id, type, `character`, amount, url, faction, class, patch, wztype from records where type = ? and accepted in (";
	$accepted = isset($_GET['approved']) ? $_GET['approved'] : array(1);
	foreach($accepted as $value)
	{
		$sql .= "?,";
		$values[] = $value;
	}
	$sql = rtrim($sql, ',');
	$sql .= ") and faction like ? and `character` like ? ";
	$sql .= "and patch in (";
	$patch = isset($_GET['patch']) ? $_GET['patch'] : array('3.0');
	$accepted = isset($_GET['approved']) ? $_GET['approved'] : 1;
	$char = isset($_GET['char']) ? $_GET['char']."%" : '%';
	$faction = isset($_GET['faction']) ? $_GET['faction'] : '%';
	array_push($values, $faction);
	array_push($values, $char);
	foreach($patch as $pat)
	{
		$sql .= "?,";
		$values[] = $pat;
	}
	$sql = rtrim($sql, ',');
	$sql .= ') ';
	$sql .= " order by amount desc limit 10";
	#print_r($_GET);
	$res = mysqli_select_array($sql, $values);
	#echo"<pre>";print_r($values);
	foreach($res as $value)
	{
		$type = $value['type'];
		$id = $value['id'];
		$data[$type][$id]['character'] = $value['character'];
		$data[$type][$id]['amount'] = $value['amount'];
		$data[$type][$id]['url'] = $value['url'];
		$data[$type][$id]['faction'] = $value['faction'];
		$data[$type][$id]['class'] = $value['class'];
		$data[$type][$id]['patch'] = $value['patch'];
		$data[$type][$id]['wztype'] = $value['wztype'];
	}
	$i++;
}
foreach($data as $type=>$array)
{
	echo "<h2>".ucfirst($headers[$type])."</h2>\n";
?>
<table class="table table-striped">
	<tr><th>Character<th>Amount<th>Faction<th>Class
<?
	if(isset($_GET['patch'])) echo "<th>Patch";
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
		echo "</tr>\n";
	}
?>
</table>
<?
}
?>
