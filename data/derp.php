<?
	require_once('define.php');
	require_once('functions.php');
	$types = array_keys($headers);
	$abb = abbreviations();
	$classes = define_classes();
	$headers = define_headers();
	$types = array_keys($headers);
        $sql = "";
        foreach($types as $type)
        {
                $sql .= "(select * from records where type = '$type' and accepted = 1 order by amount desc limit 10) union ";
        }
        $sql = substr($sql, 0, -6);
        $res = $mysqli->query($sql);
        while($f = $res->fetch_assoc())
        {
                $id = $f['id'];
                $type = $f['type'];
                $character = $f['character'];
                $amount = $f['amount'];
                $url = $f['url'];
                $accepted = $f['accepted'];
                $faction = $f['faction'];
                $class = $f['class'];
                $patch = $f['patch'];
                $wztype = $f['wztype'];
                $added = $f['added'];
                $comment = $f['comment'];
                $data[$type][$id] = array('character' => $character, 'amount' => $amount, 'faction' => $faction, 'class' => $class, 'url' => $url, 'wztype' => $wztype, 'patch' => $patch);
        }
        foreach($data as $type=>$array)
        {
                echo "<h2>".ucfirst($headers[$type])."</h2>";
?>
        <table class="table table-striped">
                <tr><th>Character<th>Amount<th>Faction<th>Class<th>WZtype<th>Patch</tr>
<?
                foreach($array as $id => $values)
                {
			echo "<tr><td style='width:30%'>{$values['character']}<td><a href='".$values['url']."' class='fancybox'>{$values['amount']}</a><td>";
			$faction = $values['faction'];
			echo "<i class='";
			echo $abb[$faction];
			echo "'></i>";
			echo "<td>";
			$tempc = $values['class'];
			if($values['faction'] == 'rep')
				$class = $classes[$tempc][0];
			else
				$class = $classes[$tempc][1];
			echo $class;
			echo "<td>".ucfirst($values['wztype']);
			echo "<td>".$values['patch']."+";
                }
?>
        </table>
<?
	}
?>
