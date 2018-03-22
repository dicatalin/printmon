<html>
<head>
<style>
table {
    border-collapse: collapse;
}
table, th, td {
        padding: 5px;
        border: 1px solid black;
}
</style>
</head>
<body>
<center>
<form action="printmon.php" method="post">
<textarea rows="10" cols="15" name="ip"></textarea>
<br>
<input type="submit">
<br>
</form>

<?php
#  echo $_POST["ip"] . " ";
$nc=0;
$ips = explode(PHP_EOL, $_POST["ip"]);
#print_r($ips);
echo "<table><tr><th>Nr.</th><th>IP</th><th>MODEL</th><th>SERIAL NUMBER</th><th>PAGE COUNTER</th></tr>";
foreach ($ips as $ip) { 
	$session = new SNMP(SNMP::VERSION_2c, $ip, "public");
		$model = $session->get("mib-2.43.5.1.1.16.1");
		$sn = $session->get("mib-2.43.5.1.1.17.1");
		$pc = $session->get("mib-2.43.10.2.1.4.1.1");

$model_cl=str_replace("\"","",str_replace("STRING: ","","$model\n"));
$serial_cl=str_replace("\"","",str_replace("STRING: ","","$sn\n"));
$pc_cl=str_replace("Counter32:","","$pc\n");
$nc=$nc+1;
echo "<tr><td>" . $nc . "</td><td>" . $ip . "</td><td>" . $model_cl . "</td><td>" . $serial_cl . "</td><td>" . $pc_cl . "</td>";
}
echo "</table>";
?>
</center>
</body>
</html>
