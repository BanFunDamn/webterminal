<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="test.css">
<meta charset="utf-8">
<title>Text Editor</title>
</head>
<h1>
Connection:
<?php
include('./header.php');
echo $address;
?>
</h1>
<body>
<?php
if($_GET['dir']) {
$dir = htmlspecialchars($_GET['dir']);
}
if($_GET['message']) {
$tmp = htmlspecialchars($_GET['message']);
while(substr($tmp,0,1) != " ") {
$tmp = substr($tmp,1);
}
while(substr($tmp,0,1) == " ") {
$tmp = substr($tmp,1);
}
}
$content = htmlspecialchars(shell_exec("echo apache | sudo -S cat $tmp"));
?>
<form action="save.php" method="get">
<input type="hidden" name="dir" value="<?php echo $dir;?>">
<input type="hidden" name="file" value="<?php echo $tmp;?>">
<textarea name="content" style="border:none;background:black;color:white" autofocus autocomplete=off>
<?php echo $content; ?></textarea>
<input type="submit" value="submit">
</form>
</body>
</html>

