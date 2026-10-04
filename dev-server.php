<?php

$public_dir = realpath(__DIR__ . DIRECTORY_SEPARATOR . 'public');
$request_path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$request_path = is_string($request_path) ? rawurldecode($request_path) : '/';
$requested_file = realpath(
    $public_dir . DIRECTORY_SEPARATOR . ltrim(str_replace('/', DIRECTORY_SEPARATOR, $request_path), DIRECTORY_SEPARATOR)
);

if (
    $request_path !== '/'
    && $requested_file !== false
    && is_file($requested_file)
    && strpos($requested_file, $public_dir . DIRECTORY_SEPARATOR) === 0
) {
    return false;
}

require $public_dir . DIRECTORY_SEPARATOR . 'index.php';
