<?php
$tasks = json_decode(file_get_contents('data/tasks.json'), true);
$filtered_tasks = $tasks;

if (isset($_POST['search'])) {
    $keyword = $_POST['keyword'];
    $filtered_tasks = array_filter($tasks, function($task) use ($keyword) {
        return strpos($task['title'], $keyword) !== false || strpos($task['description'], $keyword) !== false;
    });
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Recherche de Tâches</title>
</head>
<body>
    <h1>Recherche de Tâches</h1>
    <form method="POST">
        <input type="text" name="keyword" placeholder="Recherche par titre ou description">
        <button type="submit" name="search">Rechercher</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Priorité</th>
                <th>Statut</th>
                <th>Date Limite</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($filtered_tasks as $task): ?>
                <tr>
                    <td><?= htmlspecialchars($task['title']) ?></td>
                    <td><?= htmlspecialchars($task['description']) ?></td>
                    <td><?= htmlspecialchars($task['priority']) ?></td>
                    <td><?= htmlspecialchars($task['status']) ?></td>
                    <td><?= htmlspecialchars($task['due_date']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>