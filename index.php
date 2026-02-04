<?php
$tasks = [];
if (file_exists('data/tasks.json')) {
    $tasks = json_decode(file_get_contents('data/tasks.json'), true);
} else {
    $tasks = []; // Inicia um array vazio se o arquivo não existir
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tarefas</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <h1>Lista de Tarefas</h1>
        <a href="add_task.php" class="btn">Adicionar uma Tarefa</a>
        <table>
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Prioridade</th>
                    <th>Status</th>
                    <th>Data Limite</th>
                    <th>Responsável</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($tasks)): ?>
                    <tr>
                        <td colspan="7">Nenhuma tarefa encontrada.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($tasks as $task): ?>
                        <tr>
                            <td><?= htmlspecialchars($task['title']) ?></td>
                            <td><?= htmlspecialchars($task['description']) ?></td>
                            <td><?= htmlspecialchars($task['priority']) ?></td>
                            <td><?= htmlspecialchars($task['status']) ?></td>
                            <td><?= htmlspecialchars($task['due_date']) ?></td>
                            <td><?= htmlspecialchars($task['responsible']) ?></td>
                            <td>
                                <a href="edit_task.php?id=<?= $task['id'] ?>" class="btn-edit">Editar</a>
                                <a href="delete_task.php?id=<?= $task['id'] ?>" class="btn-delete">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>