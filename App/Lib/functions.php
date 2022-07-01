<?php

/**
 * Render new view
 *
 * @param string $view
 * @param array $data
 * @return void
 */
function view(string $view, array $data = [])
{
    $view = str_replace(".", DS, $view);
    $view =  VIEWS_PATH . DS . $view . '.view.php';

    extract($data);

    if (file_exists($view)) {
        require_once $view;
    } else {
        require_once VIEWS_PATH . DS . 'errors' . DS . 'dev' . DS . 'viewNotFound.view.php';
    }
}

/**
 * die and dump
 *
 * @param [type] ...$value
 * @return void
 */
function dd(...$value)
{
    var_dump(...$value);
    die();
}
