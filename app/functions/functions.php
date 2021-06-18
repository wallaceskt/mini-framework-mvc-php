<?php
/**
 * dd stands for "Dump and Die." Laravel's dd() function can be defined as a helper function, which is used to dump a variable's contents to the browser and prevent the further script execution.
 *
 * @param  mixed $params
 * @param  mixed $die
 * @return void
 */
function dd($params = [], $die = true) {

    echo "<pre>";
    print_r($params);
    echo "</pre>";

    if ($die) die();

}

/**
 * Redireciona o usuário para a URL informada e finaliza a operação
 *
 * @param  string $url URL a ser redirecionada
 * @return void
 */
function redirect(string $url) {

    header('Location:' . $url);
    exit;

}