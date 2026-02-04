
<?php
$tasks = json_decode(file_get_contents('data/tasks.json'), true);
$task = null;

if (isset($_GET['id'])) {
    foreach ($tasks as $t) {
        if ($t['id'] == $_GET['id']) {
            $task = $t;
            break;
        }
    }
}

$errors = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtendo e validando os dados
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $priority = $_POST['priority'];
    $due_date = $_POST['due_date'];
    $responsible = trim($_POST['responsible']);
    
    if (empty($title) || empty($description) || empty($responsible)) {
        $errors[] = "Todos os campos são obrigatórios.";
    }
    
    if (empty($errors)) {
        foreach ($tasks as &$t) {
            if ($t['id'] == $_GET['id']) {
                $t['title'] = $title;
                $t['description'] = $description;
                $t['priority'] = $priority;
                $t['due_date'] = $due_date;
                $t['responsible'] = $responsible;
                break;
            }
        }
        
        file_put_contents('data/tasks.json', json_encode($tasks, JSON_PRETTY_PRINT));
        header("Location: index.php");
        exit();
    }
}

if ($task === null) {
    echo "Tarefa não encontrada.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Editar Tarefa</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <h1>Editar Tarefa</h1>
        <?php if (!empty($errors)): ?>
            <div class="error">
                <?= implode('<br>', $errors); ?>
            </div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label for="title">Título:</label>
                <input type="text" name="title" value="<?= htmlspecialchars($task['title']) ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Descrição:</label>
                <textarea name="description" required><?= htmlspecialchars($task['description']) ?></textarea>
            </div>
            <div class="form-group">
                <label for="priority">Prioridade:</label>
                <select name="priority" required>
                    <option value="basse" <?= $task['priority'] == 'basse' ? 'selected' : '' ?>>Baixa</option>
                    <option value="moyenne" <?= $task['priority'] == 'moyenne' ? 'selected' : '' ?>>Média</option>
                    <option value="haute" <?= $task['priority'] == 'haute' ? 'selected' : '' ?>>Alta</option>
                </select>
            </div>
            <div class="form-group">
                <label for="due_date">Data Limite:</label>
                <input type="date" name="due_date" value="<?= htmlspecialchars($task['due_date']) ?>" required>
            </div>
            <div class="form-group">
                <label for="responsible">Responsável:</label>
                <input type="text" name="responsible" value="<?= htmlspecialchars($task['responsible']) ?>" required>
            </div>
            <button type="submit" class="btn">Salvar Alterações</button>
        </form>
    </div>
</body>
</html>