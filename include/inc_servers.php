<?php

require('include/db_connect.php');

echo '
	<table>
		<tr>
			<th>Servidor</th>
			<th>IP</th>
			<th>Mapa</th>
			<th>Jugadores</th>
			<th>Estado</th>
		</tr>';

$sql = "SELECT * FROM " . $table_servers . " ORDER BY Number;";
$res = mysqli_query($conn, $sql);

if (mysqli_num_rows($res) > 0) {
	while ($row = mysqli_fetch_assoc($res)) {
		echo '<tr>';
		echo '<td> #' 	. $row['Number'] . ' ' . $row['Name'] . '</td>';
		echo '<td>' 	. $row['Ip'] . '</td>';
		echo '<td>' 	. $row['Map'] . '</td>';
		echo '<td>' 	. $row['Players'] . '/' . $row['MaxPlayers'] . '</td>';
		
		echo '<td><font color="#28bf11">Online</font></td></tr>';
	}
}

mysqli_close($conn);
echo '</table>';

?>