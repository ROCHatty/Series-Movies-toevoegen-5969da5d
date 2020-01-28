<h1>Welkom op het netland beheerderspaneel</h1>
<h3>Films</h3>
<?php
$host = 'localhost';
$db = 'netland';
$user = 'root';
$pass = '';
$charset = 'utf8';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
	PDO::ATTR_ERRMODE				=>	PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_DEFAULT_FETCH_MODE	=>	PDO::FETCH_ASSOC,
	PDO::ATTR_EMULATE_PREPARES		=>	false,
];
try {
	$pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
	throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
$stmt = $pdo->query('SELECT id, title, duur FROM movies');
?>
<table>
	<thead>
		<tr>
			<th>Titel</th>
			<th>Duur</th>
			<th><a href="createfilm.php">Add</a></th>
		</tr>
	</thead>
	<tbody>
<?php
while ($row = $stmt->fetch()) {
?>
		<tr>
			<td><?php echo $row['title']; ?></td>
			<td><?php echo $row['duur']; ?></td>
			<td><a href="films.php?id=<?php echo $row['id']; ?>" target="_blank">Edit</a></td>
		</tr>
<?php
}
?>
	</tbody>
</table>
<h3>Series</h3>
<?php
$stmt = $pdo->query('SELECT id, title, rating FROM series');
?>
<table>
	<thead>
		<tr>
			<th>Titel</th>
			<th>Rating</th>
			<th><a href="createseries.php">Add</a></th>
		</tr>
	</thead>
	<tbody>
<?php
while ($row = $stmt->fetch()) {
?>
		<tr>
			<td><?php echo $row['title']; ?></td>
			<td><?php echo $row['rating']; ?></td>
			<td><a href="series.php?id=<?php echo $row['id']; ?>" target="_blank">Edit</a></td>
		</tr>
<?php
}
?>
	</tbody>
</table>