<?php

// for debugging
function dd($value) {
    echo "<pre>";
    var_dump($value);
    echo "/<pre>";
    die();
}

// for checking what's the current url
function urlIs($value) {
    // remove query parameters and then check
    return parse_url($_SERVER['REQUEST_URI'])['path'] === $value;
}

function authorize($condition, $status = Response::FORBIDDEN)
{
    if(! $condition) {
        abort($status);
    }
}