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

function assets()
{
    return '/assets/';
}

function css()
{
    return assets() . 'css/';
}

function js()
{
    return assets() . 'js/';
}

function images()
{
    return assets() . 'images/';
}

function devError(string $message, $redirectPath = null)
{
    if (DEV_MODE) {
        trigger_error($message, E_USER_WARNING);
        exit;
    }

    if ($redirectPath != null) {
        header('Location: /index/notFound');
        exit;
    }

    header('Location: /');
    exit;
}
