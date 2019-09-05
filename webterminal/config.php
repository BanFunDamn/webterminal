<?php
$dir = htmlspecialchars($_GET['dir']);
$message = htmlspecialchars($_GET['message']);
$next_page = "";
if(substr($message,0,2) == "vi" or substr($message,0,3) == "vim" or substr($message,0,5) == "emacs") {
  $next_page = "text_editor.php";
}
else {
  $next_page = "index.php";
}
?>
<form name="form" action="<?php echo $next_page; ?>" method="get">
  <input type="hidden" name="dir" value="<?php echo $dir; ?>">
  <input type="hidden" name="message" value="<?php echo $message; ?>">
</form>
<script type="text/javascript">
document.form.submit();
</script>

