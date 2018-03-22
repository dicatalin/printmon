<html>
<body>
<form action="printmon.php" method="post">
<textarea rows="10" cols="15" name="ip"></textarea>
<br>
<input type="submit">
<br>
</form>
</body>
</html>

<?php
#  echo $_POST["ip"] . " ";
$ips = explode(PHP_EOL, $_POST["ip"]);
#print_r($ips);
foreach ($ips as $ip) {
  echo $ip . " ";
  $session = new SNMP(SNMP::VERSION_2c, $ip, "public");
  $model = $session->get("mib-2.43.5.1.1.16.1");
  echo str_replace("\"","",str_replace("STRING: ","","Model: $model\n"));
  $sn = $session->get("mib-2.43.5.1.1.17.1");
  echo str_replace("\"","",str_replace("STRING: ","","Serial: $sn\n"));
  $pc = $session->get("mib-2.43.10.2.1.4.1.1");
  echo str_replace("Counter32:","","Page counter: $pc\n");
echo "<br>";
}
 # $pca = $session->get(array("mib-2.43.10.2.1.4.1.1"));
 # print_r($pca);
?>
