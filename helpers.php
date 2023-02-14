<?php

function displayTemplate($template, $array)
{
    $loader = new \Twig\Loader\FilesystemLoader('../views/');
    $twig = new \Twig\Environment(
        $loader,
        ['debug' => true]
    );
    $twig->addExtension(new \Twig\Extension\DebugExtension());
    $twig->display($template, $array);
}
function error($errorNumber, $errorMessage)
{
    http_response_code($errorNumber);
    displayTemplate("error.twig", array("error" => $errorMessage, "number" => $errorNumber));
    exit();
}

function getPath(): array
{
    $path = strtok($_GET['params'], '?');
    while (str_contains($path, '//')) {
        $path = str_replace('//', '/', $path);
    }

    if ($path === '/') {
        return [];
    }

    return explode('/', trim($path, '/'));
}
