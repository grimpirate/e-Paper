<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit58e4aaf09ceb2ea6ea164056e45c39be
{
    public static $files = array (
        'fc73bab8d04e21bcdda37ca319c63800' => __DIR__ . '/..' . '/mikecao/flight/flight/autoload.php',
        '5b7d984aab5ae919d3362ad9588977eb' => __DIR__ . '/..' . '/mikecao/flight/flight/Flight.php',
    );

    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Mike42\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Mike42\\' => 
        array (
            0 => __DIR__ . '/..' . '/mike42/gfx-php/src/Mike42',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit58e4aaf09ceb2ea6ea164056e45c39be::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit58e4aaf09ceb2ea6ea164056e45c39be::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
