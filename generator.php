<?php

$type = $argv[1];
$name = $argv[2];

$twig = file_get_contents('./.skeleton/file.twig');
$scss = file_get_contents('./.skeleton/file.scss');

$dir = './src/components/';

if ($type === 'atom') {
    $dir .= '_atoms/' . $name;
}

if ($type === 'widget') {
    $dir .= '_widgets/' . $name;
}

mkdir($dir);

$twig = str_replace(
    [
        '__TYPE__',
        '__COMPONENT__',
        '__U_COMPONENT__'
    ],
    [
        $type,
        $name,
        ucwords($name)
    ],
    $twig
);

$scss = str_replace(
    [
        '__TYPE__',
        '__COMPONENT__',
        '__U_COMPONENT__'
    ],
    [
        $type,
        $name,
        ucwords($name)
    ],
    $scss
);

file_put_contents($dir . '/' . $name . '.twig', $twig);
file_put_contents($dir . '/' . $name . '.scss', $scss);