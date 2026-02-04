<?php
$id = $_GET['id'];
$tasks = json_decode(file_get_contents('data/tasks.json'), true);

// Apenas continua se o ID não estiver vazio
if (!empty($id)) {
    $tasks = array_filter($tasks, function($task) use ($id) {
        return $task['id'] != $id;
    });

    file_put_contents('data/tasks.json', json_encode(array_values($tasks), JSON_PRETTY_PRINT));
}
header("Location: index.php");
exit();
?>