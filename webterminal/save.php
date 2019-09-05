<?php
$dir = htmlspecialchars($_GET['dir']);
$file = htmlspecialchars($_GET['file']);
$content = htmlspecialchars($_GET['content']);
file_put_contents($file, $content);
?>
<form name="form" action="index.php" method="get">
  <input type="hidden" name="dir" value="<?php echo $dir; ?>">
  <input type="hidden" name="message" value="">
</form>
<script type="text/javascript">
  document.form.submit();
</script>

