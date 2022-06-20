<?php
namespace EasyGithDev\Paginator;

spl_autoload_register(function ($class_name) {
    require str_replace(__NAMESPACE__. '\\', '', $class_name) . '.php';
});
