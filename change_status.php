<?php
$id = $_GET['id'];
$tasks = json_decode(file_get_contents('data/tasks.json'), true);

foreach ($tasks as &$task) {
    if ($task['id'] == $id) {
        $statuses = ['à faire', 'en cours', 'terminée'];
        $current_index = array_search($task['status'], $statuses);
        $task['status'] = $statuses[($current_index + 1) % count($statuses)];
        break;
    }
}

file_put_contents('data/tasks.json', json_encode($tasks, JSON_PRETTY_PRINT));
header("Location: index.php");
exit();
?>