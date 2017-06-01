<?php

if (! function_exists('format')) {

    /**
     * like python's format.
     *
     * usage:
     *
     * # Samples:
     *
     * # Hello foo and bar
     * echo format('Hello {} and {}.', array('foo', 'bar'));
     *
     * # Hello Mom
     * echo format('Hello {}', 'Mom');
     *
     * # Hello foo, bar and foo
     * echo format('Hello {}, {1} and {0}', array('foo', 'bar'));
     *
     * # I'm not a fool nor a bar
     * echo format('I\'m not a {foo} nor a {}', array('foo' => 'fool', 'bar'));
     *
     */
    function format($msg, $vars)
    {
        $vars = (array) $vars;

        $msg = preg_replace_callback('#\{\}#', function ($r) {
            static $i = 0;

            return '{'.($i++).'}';
        }, $msg);

        return str_replace(
            array_map(function ($k) {
                return '{'.$k.'}';
            }, array_keys($vars)),

            array_values($vars),

            $msg
        );
    }
}
