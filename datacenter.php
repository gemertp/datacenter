<?php

$conn = "";

try {
        $dbserver = "10.20.0.62";
        $dbport = "3306";
        $dbname = "datacenter";
        $dbuser = "deltion";
        $dbpassword = "Deltion123!";

        $conn = new PDO (
                "mysql:host=$dbserver; dbname=$dbname", $dbuser, $dbpassword
        );
} catch(PDOExeption $e) {
	print 'Connection failed: ' . $e->getMessage();
}

$sql = 'SELECT hostnaam,osnaam,nwbeheer,nwdb,nwnfs,nwiscsi,nwweb,nwnat FROM servers s JOIN oses o ON s.osid = o.osid;';
$stmt = $conn->prepare($sql);
$stmt->execute();

$servers = $stmt->fetchAll();

$tr="";
foreach ( $servers as $server ) {
	$tr .= '<tr>
	<td>'.$server['hostnaam'].'</td>
			<td>'.$server['osnaam'].'</td>
			<td>'.$server['nwbeheer'].'</td>
			<td>'.$server['nwdb'].'</td>
			<td>'.$server['nwnfs'].'</td>
			<td>'.$server['nwiscsi'].'</td>
			<td>'.$server['nwweb'].'</td>
			<td>'.$server['nwnat'].'</td>
			</tr>';
	}

	echo '<!DOCTYPE html>

	<html>
	<head>
		<title>Datacenter</title>
		<link rel="stylesheet" href="/css/datacenter.css">
	</head>

	<body>
	<table>
	<thead>
	<tr><td>Servernaam</td><td>Osnaam</td><td>Beheer</td><td>Database</td><td>NFS</td><td>iSCSI</td><td>Web</td><td>NAT</td></tr>
	</thead>
	<tbody>
	' . $tr . '
	</tbody>
	</table>
	';
?>

