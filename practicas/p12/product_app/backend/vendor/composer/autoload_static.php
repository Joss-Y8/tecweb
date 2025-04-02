<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit62eab0c22b55d0c87f2f2bcb2ef189d8
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'TECWEB\\MYAPI\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'TECWEB\\MYAPI\\' => 
        array (
            0 => __DIR__ . '/../..' . '/myapi',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'TECWEB\\MYAPI\\DataBase' => __DIR__ . '/../..' . '/myapi/DataBase.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit62eab0c22b55d0c87f2f2bcb2ef189d8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit62eab0c22b55d0c87f2f2bcb2ef189d8::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit62eab0c22b55d0c87f2f2bcb2ef189d8::$classMap;

        }, null, ClassLoader::class);
    }
}
