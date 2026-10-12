<?php
require_once __DIR__ . '/config/database.php';
$stmt = $pdo->query('SELECT * FROM projects ORDER BY created_at DESC');
$projects = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard Project</title>
</head>
<body>
<h1>Daftar Project</h1>
<?php if (count($projects) === 0): ?>
<p>Belum ada project.</p>
<?php else: ?>
<table border="1" cellpadding="8" cellspacing="0">
<tr>
<th>Judul</th>
<th>Deskripsi</th>
<th>Teknologi</th>
<th>Tautan</th>
<th>Tanggal Dibuat</th>
</tr>
<?php foreach ($projects as $project): ?>
<tr>
<td><?= htmlspecialchars($project['judul']) ?></td>
<td><?= htmlspecialchars($project['deskripsi']) ?></td>
<td><?= htmlspecialchars($project['teknologi']) ?></td>
<td><a href="<?= htmlspecialchars($project['created_at']) ?>"
target="_blank">Lihat</a></td>
<td><?= htmlspecialchars($project['created_at']) ?></td>
</tr>
<?php endforeach; ?>
</table>
<?php endif; ?>
</body>
</html>