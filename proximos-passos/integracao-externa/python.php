<?php
$output = shell_exec('python teste.py 2>&1');
echo "<pre>$output</pre>";
?>
