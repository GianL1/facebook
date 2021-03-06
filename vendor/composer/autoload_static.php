<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbf2d859759230dbb3a7ec6a0a45711a8
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PostgreSQLTutorial\\' => 19,
        ),
        'M' => 
        array (
            'Models\\' => 7,
        ),
        'C' => 
        array (
            'Core\\' => 5,
            'Controllers\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PostgreSQLTutorial\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
        'Models\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Models',
        ),
        'Core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Core',
        ),
        'Controllers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Controllers',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitbf2d859759230dbb3a7ec6a0a45711a8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitbf2d859759230dbb3a7ec6a0a45711a8::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
