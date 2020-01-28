<button onlick="window.close();">Terug</button><br /><br /><br />
<br />
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

if (count($_POST) >= 5) {
	$sql = "INSERT INTO series ";
	foreach ($_POST as $key => $value) {
		$sql .= $key.", ";
	}
	$sql = substr($sql, 0, -2);
	$sql .= ' VALUES (';
	foreach ($_POST as $key => $value) {
		$sql .= "'".$value."', ";
	}
	$sql = substr($sql, 0, -2);
	$sql .= ')';
	$pdo->query($sql);
}

$stmt = $pdo->query('SELECT * FROM series LIMIT 1');
?>
<form method="POST" id="edit">
<?php
while ($row = $stmt->fetch()) {
	foreach ($row as $key => $value) {
?>
<?php
		if ($key == 'id') { }
		elseif (is_numeric($value)) {
?>
	<label><?php echo $key; ?></label><br />
	<input type="number" name="<?php echo $key; ?>"><br /><br />
<?php
		} elseif (strlen($value) >= 50) {
?>
	<label><?php echo $key; ?></label><br />
	<textarea name="<?php echo $key; ?>" form="edit"></textarea><br /><br />
<?php
		} else {
?>
	<label><?php echo $key; ?></label><br />
	<input type="text" name="<?php echo $key; ?>"><br /><br />
<?php
		}
	}
}
?>
	<input type="submit" value="Save">
</form>