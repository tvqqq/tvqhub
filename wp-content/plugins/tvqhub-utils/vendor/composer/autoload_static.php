<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitba7663f09ebea7e6dfdd30513b37fa22
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Tvqhub\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Tvqhub\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitba7663f09ebea7e6dfdd30513b37fa22::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitba7663f09ebea7e6dfdd30513b37fa22::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
