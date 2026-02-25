<?php

namespace Core;

class ValidationException extends \Exception
{
    public readonly $errors;
    public readonly $old;

    public static function throwException($errors, $old)
    {
        $instance = new static;

        $instance->errors = $errors;
        $instance->old = $old;

        throw $instance;
    }
}