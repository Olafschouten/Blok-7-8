<?php

// http://todo.localhost/route.php?url=task/add
// met apache rewrite kun je dat schrijven als http://todo.localhost/task/add
// en de rewrite maakt daar dan dit van: http://todo.localhost/route.php?url=task/add

// Als er iets in de key url zit van $_GET, wordt de code uitgevoerd
if (isset($_GET['url'])) {
    $redirect_to = 'http://todo.localhost';

    // Met trim haal je de zwevende shlashes weg. Bijvoorbeeld:
    // /Students/Edit/1/ wordt Students/Edit/1

    $tmp_url = trim($_GET['url'], "/");

    // Dit haalt de vreemde karakters uit de strings weg
    $tmp_url = filter_var($tmp_url, FILTER_SANITIZE_URL);

    // Met explode splits je een string op. Elk gedeelte voor de "/" wordt in een nieuwe index van een array gestopt.
    // Bijvoorbeeld /Students/Edit/1 wordt opgedeeld in:
    // $temp_url[0] = "Students",
    // $temp_url[1] = "Edit",
    // $temp_url[2] = "1"
    $tmp_url = explode("/", $tmp_url);

    // Hier worden op basis van de eerder opgegeven variable $tmp_url de keys controller en action gevuld

    $url['controller'] = isset($tmp_url[0]) ? ucwords($tmp_url[0]) : null;
    $url['action'] = isset($tmp_url[1]) ? $tmp_url[1] : 'index';
    $url['id'] = isset($tmp_url[2]) ? $tmp_url[2] : 'index';

    // Die twee waarden worden uit de array gehaald
    unset($tmp_url[0], $tmp_url[1], $tmp_url[2]);

    // De overige variabelen worden in de key params gestopt

    $url['params'] = array_values($tmp_url);

    require 'datalayer.php';

    // bepaal welk bestand er geladen moet worden, en roep de gevraagde functie aan
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $url['controller'] == 'Task' && $url['action'] = 'add') {
        TaskInsert($_POST);
        // redirect naar overzicht pagina met lijst van alle tasks
        header('Location: ' . $redirect_to);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $url['controller'] == 'List' && $url['action'] = 'add') {
        ListInsert($_POST);
        header('Location: ' . $redirect_to);
    }

    if ($url['controller'] == 'Task' && $url['action'] = 'delete') {
        TaskDelete($url['id']);
        header('Location: ' . $redirect_to);
    }

    if ($url['controller'] == 'List' && $url['action'] = 'delete') {
        ListDelete($url['id']);
        header('Location: ' . $redirect_to);
    }
}




