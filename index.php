<?php
	$yourName = "Example";
	$numberOfColumns = 3;
	$todoLists = array('Urgent', 'Research', 'Writing/Reviewing', 
'Personal', 'Teaching', 'Lab/Admin', 'To Read', 'Ideas', 
'Unsorted');

	
	$datadir = realpath(dirname(__FILE__)).'/data';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="expires" content="0">
	<link rel="stylesheet" href="todolist.css" type="text/css"/>
	<script type="text/javascript" src="todolist.js"></script>
	<script type="text/javascript">
		function initList(){
			<?php 
			$dh = opendir($datadir);
			while (($filename = readdir($dh)) !== false) {
				$ext = substr($filename, strrpos($filename, '.') + 1);
				if ($ext=='txt'){		
					$id = substr($filename, 0, strrpos($filename, '.')); 
					$line = file($datadir.'/'.$filename);
					$done = htmlentities($line[0]);
					$text = htmlentities(str_replace("\r\n", "", $line[1]));
					$listID = htmlentities($line[2]);
					if ($listID == "") {$listID = $todoLists[0];}
					if ($done==0) {
						echo 'addTodoItem("'.$id.'", "'.$text.'", "undone", "'.$listID.'");';
					} else {
						echo 'addTodoItem("'.$id.'", "'.$text.'", "done", "'.$listID.'");';
					}
				}
    		}
    		closedir($dh);
			?>
		}
		onload = initList;
	</script>
	<title>Todo List</title>
</head>
<body>
<div id="todoAndCalendar">

<h3> <?php echo $yourName; ?>'s To Do lists </h3>

<hr>

<!-- TO DO TABLES -->

<table>
<tr>

<?php 
	
$listCount = count($todoLists);
	
for ($i = 0; $i < $listCount; $i++)
{
$listID = $todoLists[$i];
if (!($i%$numberOfColumns))
{
	echo "</tr><tr>";
}
?>
<td style="vertical-align:top">
<div id="todoarea" style="width:400px; background-color:#caffca;padding:5px; float:left">

<div id="todotitle" style="text-align: center; background-color:#afff90; font-family:Verdana; font-size:18pt;"> <?php echo $listID; ?> </div>
<div id="<?php echo $listID; ?>_todoitems" style="font-family: arial; font-size: 10pt;"></div>
<div style="padding-top:5px;">
<form action="javascript:addTodoItem(0,0,0,'<?php echo $listID; ?>');">
<input type="text" id="<?php echo $listID; ?>_newtodotext" onclick="value=''" size="53" value="Add new item">
<input type="submit"  value="Add"></form></div>
</div>
</td>
<?php } ?>

</tr>
<table>

</div>

</body>
</html>
<?php // this handy to do list was made by Maciek Chudek, UBC, 2008 - building on a proto-type by Trung Thanh Nguyen. Both can be hunted down since they're former residents of UBC's Green Collge.  ?>
