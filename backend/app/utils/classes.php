<?php

if (!function_exists('getClassProperties')) {
    function getClassProperties(string $className): array
    {
        if (class_exists($className)) {
            return array_keys(get_class_vars($className));
        }
        return [];
    }
}
