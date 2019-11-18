<?php
$cmd1 = "echo apache | sudo -S ifconfig | grep inet[^6]";
$address_list = shell_exec($cmd1);
$cmd2 = "echo '$address_list' | grep -v 127.0.0.1 | awk '{print $2}'";
$address = shell_exec($cmd2);
?>
