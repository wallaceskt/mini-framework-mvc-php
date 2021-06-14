<?php
// dd stands for "Dump and Die." Laravel's dd() function can be defined as a helper function, which is used to dump a variable's contents to the browser and prevent the further script execution.
function dd($params = [], $die = true) {

    echo "<pre>";
    print_r($params);
    echo "</pre>";

    if ($die) die();

}