<?php

require_once   '../vendor/autoload.php';

R::setup(
    'mysql:host=localhost;dbname=framework',
    'bit_academy',
    'bit_academy'
);

$path = getPath();
$controller = $path[0] ?: "Recipe";
$method = $path[1] ?? "index";

$class = ucfirst($controller) . "Controller";

if (class_exists($class)) {
    $activeClass = new $class();
    if (!method_exists($activeClass, $method)) {
        error(404, "No known method");
    }
    $activeMethod = $activeClass->$method();
} else {
    error(404, "Controller '$controller' not found");
}