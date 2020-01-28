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

if (count($_POST) >= 7) {
	foreach ($_POST as $key => $value) {
		$pdo->query('UPDATE series SET '.$key.'="'.$value.'" WHERE id='.$_GET['id']);
	}
}

$stmt = $pdo->query('SELECT * FROM series WHERE id='.$_GET['id']);
?>
<form method="POST" id="edit">
<?php
while ($row = $stmt->fetch()) {
	foreach ($row as $key => $value) {
?>
	<label><?php echo $key; ?></label><br />
<?php
		if (is_numeric($value)) {
?>
	<input type="number" name="<?php echo $key; ?>" value="<?php echo $value; ?>"><br /><br />
<?php
		} elseif (strlen($value) >= 50) {
?>
	<textarea name="<?php echo $key; ?>" form="edit"><?php echo $value; ?></textarea><br /><br />
<?php
		} else {
?>
	<input type="text" name="<?php echo $key; ?>" value="<?php echo $value; ?>"><br /><br />
<?php
		}
	}
}
?>
	<input type="submit" value="Save">
</form>