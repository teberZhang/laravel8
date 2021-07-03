<?php

if (! function_exists('api_route')) {
    /**
     * Generate the URL to a named route.
     *
     * @param array|string $name
     * @param mixed $parameters
     * @param string $version
     * @param bool $absolute
     * @return string
     */
    function api_route($name, $parameters = [], $version = 'v1',  $absolute = true)
    {
        return version($version)->route($name, $parameters, $absolute);
    }
}
