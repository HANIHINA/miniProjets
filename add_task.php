<?php
$errors = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $priority = $_POST['priority'];
    $due_date = $_POST['due_date'];
    $responsible = trim($_POST['responsible']);

    // Validação
    if (empty($title) || empty($description) || empty($responsible)) {
        $errors[] = "Todos os campos são obrigatórios.";
    }

    if (empty($errors)) {
        $new_task = [
            'id' => uniqid(),
            'title' => $title,
            'description' => $description,
            'priority' => $priority,
            'status' => 'à faire',
            'creation_date' => date('Y-m-d H:i:s'),
            'due_date' => $due_date,
            'responsible' => $responsible
        ];
        
        $tasks = json_decode(file_get_contents('data/tasks.json'), true) ?: [];
        $tasks[] = $new_task;
        file_put_contents('data/tasks.json', json_encode($tasks, JSON_PRETTY_PRINT));
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Tarefa</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <h1>Adicionar Tarefa</h1>
        <?php if (!empty($errors)): ?>
            <div class="error">
                <?= implode('<br>', $errors); ?>
            </div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label for="title">Título:</label>
                <input type="text" name="title" required>
            </div>
            <div class="form-group">
                <label for="description">Descrição:</label>
                <textarea name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="priority">Prioridade:</label>
                <select name="priority" required>
                    <option value="basse">Baixa</option>
                    <option value="moyenne">Média</option>
                    <option value="haute">Alta</option>
                </select>
            </div>
            <div class="form-group">
                <label for="due_date">Data Limite:</label>
                <input type="date" name="due_date" required>
            </div>
            <div class="form-group">
                <label for="responsible">Responsável:</label>
                <input type="text" name="responsible" required>
            </div>
            <button type="submit" class="btn">Adicionar Tarefa</button>
        </form>
        <a href="index.php" class="btn">Voltar</a>
    </div>
</body>
</html>