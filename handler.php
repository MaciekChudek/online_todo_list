<?php

if ($_REQUEST['removeTodoItem']<>"") removeTodoItem();
if ($_REQUEST['addTodoItem']<>"") addTodoItem();
if ($_REQUEST['doneTodoItem']<>"") doneTodoItem();


function removeTodoItem(){
	$id = $_GET['id'];
	//$dir = $_GET['dir'];
	//$filename = $dir.'/'.$id.'.txt';
	$filename = 'data/'.$id.'.txt';
	unlink($filename);
}

function addTodoItem(){
	$id = $_GET['id'];
	//$dir = $_GET['dir'];
	$listID = $_GET['listID'];
	$text = $_GET['text'];
	//$filename = $dir.'/'.$id.'.txt';
	$filename = 'data/'.$id.'.txt';
	$fh = fopen($filename, 'w');
	fputs($fh,'0'."\r\n");
	fputs($fh,$text."\r\n");
	fputs($fh,$listID);
	fclose($fh);
}

function doneTodoItem(){
	$id = $_GET['id'];
	//$dir = $_GET['dir'];
	//$filename = $dir.'/'.$id.'.txt';
	$filename = 'data/'.$id.'.txt';
	if (file_exists($filename)){
		$lines = file($filename);
		$fh = fopen($filename, 'w');
		fputs($fh,'1'."\r\n");
		fputs($fh,$lines[1]);
		fputs($fh,$lines[2]);
		fclose($fh);
	}
}

?>