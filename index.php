
<?
$mysqli = new mysqli('localhost', 'tre', '#Gicc?Qal?3@', 'tre');
$mysqli->set_charset("utf8");
require_once('functions.php');
$headers = define_headers(); 
$abb = abbreviations();
$classes = define_classes();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <link href="font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="js/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
    <title>TRE Records - <? if(isset($_GET['inc'])) echo ucfirst($_GET['inc']); else echo "Home";?></title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="style.css" rel="stylesheet">

  </head>

  <body>
    <div class="container">
      <div class="header">
        <nav>
	  <ul class="nav nav-pills pull-right">
	    <li class="dropdown">
	     <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">By Class<span class="caret"></span></a>
              <ul class="dropdown-menu multi-level" role="menu">
			  <? foreach($classes as $key => $value) { 
					$class = implode(' / ', $value); 
					echo "<li><a href=\"index.php?inc=class&class=$key\">$class</a>\n"; } ?>
		</ul>
            </li>
	    <li class="dropdown">
	     <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">By Type<span class="caret"></span></a>
              <ul class="dropdown-menu multi-level" role="menu">
			  <? foreach($headers as $key => $value) { 
					$class = $value; 
					echo "<li><a href='index.php?inc=type&type=$key'>$class</a>\n";					
					} 
				
					?>
		</ul>
            </li>
	    <li class="dropdown">
	     <!--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Records <span class="caret"></span></a>-->
              <ul class="dropdown-menu multi-level" role="menu">
                <li class="dropdown-header">Warzones</li>
                <!--<li class="hidepop"><a href="#">Warzone overview</a></li>-->
		<li class="popmenu" data-url-f="index.php?inc=class&amp;class=" data-url-l="&amp;wztype=warzone" data-what="class"><a tabindex="-1" href="#">By Class</a>
		<li class="popmenu" data-url-f="index.php?inc=type&amp;type=" data-url-l="&amp;wztype=warzone" data-what="type"><a tabindex="-1" href="#">By Type</a>
                <li class="divider"></li>
                <li class="dropdown-header">Arenas</li>
                <!--<li class='hidepop'><a href="#">Arena overview</a></li>-->
		<li class="popmenu" data-url-f="index.php?inc=class&amp;class=" data-url-l="&amp;wztype=arena" data-what="class"><a tabindex="-1" href="#">By Class</a>
		<li class="popmenu" data-url-f="index.php?inc=type&amp;type=" data-url-l="&amp;wztype=arena" data-what="type"><a tabindex="-1" href="#">By Type</a>
		</ul>
            </li>
            <li role="presentation"><a href="index.php?inc=add">Submit Record</a></li>
	    <li class="dropdown">
	     <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">External Links <span class="caret"></span></a>
              <ul class="dropdown-menu multi-level" role="menu">
		<li><a href="http://swtor.com">SWTor.com</a>
		<li><a href="http://www.swtor.com/community/forumdisplay.php?f=387">TRE Forums</a>
		<li><a href="http://redeclipse.eu">Redeclipse.eu</a>
		</ul>
            </li>
          </ul>
        </nav>
        <a href="index.php"><h3 class="text-muted">TRE PvP Records</h3></a>
      </div>

      <div class="jumbotron">
		<p class="lead">This website contains an overview of the top players on TRE. If you're of the belief that numbers != amaze, this is not the site for you.</p>
        <p><a class="btn btn-lg btn-success" href="index.php?inc=add" role="button">Submit your record!</a></p>
      </div>
<?
if(!isset($_GET['inc']))
	$_GET['inc'] = 'home';
if(isset($_GET['inc']) && ($_GET['inc'] == 'type' || $_GET['inc'] == 'class' || $_GET['inc'] == 'home'))
{
?>
      <div class="well">
	<form class="form-horizontal" role="form">
  <div class="form-group">
    <div class="col-sm-offset-1 col-sm-3">
    <b>Patch</b>
      <div class="checkbox">
        <label>
          <input type="checkbox" name="patch[]" value="2.0"> 2.0-2.3
        </label>
      </div>
      <div class="checkbox">
        <label>
          <input type="checkbox" name="patch[]" value="2.4"> 2.4-2.10
        </label>
      </div>
      <div class="checkbox">
        <label>
          <input checked type="checkbox" name="patch[]" value="3.0"> 3.0 - Current
        </label>
      </div>
    </div>
    <div class="col-sm-3">
    <b>Misc filters</b>
      <div class="checkbox">
        <label>
	  <input type="checkbox" name="approved[]" value="0"> Show pending
        </label>
      </div>
      <div class="checkbox">
        <label>
	  <input type="checkbox" name="approved[]" value="1"> Show accepted
        </label>
      </div>
      <div class="checkbox">
        <label>
	  <input type="checkbox" name="approved[]" value="2"> Show rejected
        </label>
      </div>
    </div>
    <div class="col-sm-3">
    <b>Textual Search</b>
          <input class="form-control" type="text" name="name" id="name" placeholder="Character" style="margin-bottom:5px">
	  <select class="form-control" name="faction"><option value="%">Faction<option value="imp">Imperial<option value="rep">Republic</select>
	  <select class="form-control" name="wztype"><option value="warzone">Warzone (8v8)<option value="arena">Arena</select>
	  <input type="hidden" value="<? echo $_GET['class'];?>" name="class">
	  <input type="hidden" value="<? echo $_GET['type']; ?>" name="type">
	  <input type="hidden" value="<? echo $_GET['inc'];?>" id="page">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="button" id="search" class="btn btn-primary"><b>Filter</b></button> <i class="fa fa-spinner fa-spin fa-2x" id="loading"></i>
    </div>
  </div>
</form>
      </div>
<?
}
?>
<div id="result">
<?
	if(isset($_GET['inc']))
		$inc = "inc/".$_GET['inc'].".php";
	else
		$inc = "inc/home.php";
	if(file_exists($inc))
		include($inc);
	else
		echo "404 - Not found";
?>
</div>
      <footer class="footer">
        <p><a href="http://validator.w3.org/check?uri=http%3A%2F%2Fwww.tre-records.com%2Findex.php">Valid html5</a></p>
      </footer>
    </div><!-- /.container -->

    <script src="js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
    <script type="text/javascript" src="js/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
    <script>
$('.popmenu').popover({
			content: function(){
				var urlf = $(this).attr("data-url-f");
				var urll = $(this).attr("data-url-l");
				var what = $(this).attr("data-what");
				if(what == "class")
					var toreturn = "<? foreach($classes as $key => $value) { $class = implode(' / ', $value); echo "<li class='poplist'><a href='\" + urlf + \"$key\" + urll + \"'>$class</a>\\n"; } ?>";
				else
					var toreturn = "<? foreach($headers as $key => $value) { $class = $value; echo "<li class='poplist'><a href='\" + urlf + \"$key\" + urll + \"'>$class</a>\\n"; } ?>";
	return(toreturn)},

				html: true,
				trigger: 'manual',
				delay: {"hide": 5000}
			})
			.click(function() {
				$('.popmenu').popover('hide');
				$(this).popover('toggle');
			})
			.hover(function() {
				$('.popmenu').popover('hide');
				$(this).popover('toggle');
			});
		$('li.hidepop').hover(function () {$('.popmenu').popover('hide')});
    </script>
<?
	if(isset($_GET['inc']) && $_GET['inc'] == 'add')
	{
?>
<link rel="stylesheet" href="bsvalidator/dist//css/bootstrapValidator.min.css"/>
		<script type="text/javascript" src="bsvalidator/dist//js/bootstrapValidator.min.js"></script>
		<script type="text/javascript" src="js/validation.js"></script>
<?
	}
?>
  </body>
</html>

