<?
function define_headers()
{
	$headers = array();
	$headers['dps'] = "Damage Per Second";
	$headers['totdmg'] = "Total Damage done";
	$headers['hps'] = "Healing Per Second";
	$headers['totheal'] = "Total Healing done";
	$headers['bigheal'] = "Biggest heal";
	$headers['prot'] = "Total Protection done";
	$headers['protlife'] = "Protection in one life";
	$headers['totdmgtak'] = "Total Damage Taken";
	$headers['obj'] = "Most objective points";
	$headers['bighit'] = "Biggest hit";
	$headers['solo'] = "Solokills";
	return $headers;
}
function define_classes()
{
	$class = array();
	$class['senmar'][] = 'Sentinel';
	$class['senmar'][] = 'Marauder';
	$class['gunsni'][] = 'Gunslinger';
	$class['gunsni'][] = 'Sniper';
	$class['scoope'][] = 'Scoundrel';
	$class['scoope'][] = 'Operative';
	$class['sagsor'][] = 'Sage';
	$class['sagsor'][] = 'Sorcerer';
	$class['guajug'][] = 'Guardian';
	$class['guajug'][] = 'Juggernaut';
	$class['commer'][] = 'Mercenary';
	$class['commer'][] = 'Commando';
	$class['shaass'][] = 'Shadow';
	$class['shaass'][] = 'Assassin';
	$class['vanpow'][] = 'Vanguard';
	$class['vanpow'][] = 'Powertech';
	return $class;
}
function abbreviations()
{
	$abb = array();
	$abb['imp'] = 'fa fa-empire';
	$abb['rep'] = 'fa fa-rebel';
	return $abb;
}
?>
