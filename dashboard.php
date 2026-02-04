<?php
$tasks = [];
if (file_exists('data/tasks.json')) {
    $tasks = json_decode(file_get_contents('data/tasks.json'), true);
} else {
    echo "Arquivo de tarefas não encontrado.";
    exit();
}
