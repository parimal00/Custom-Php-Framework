<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitfa9ccbb3c0961aafea5a8e570a8e528e
{
    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitfa9ccbb3c0961aafea5a8e570a8e528e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitfa9ccbb3c0961aafea5a8e570a8e528e::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitfa9ccbb3c0961aafea5a8e570a8e528e::$classMap;

        }, null, ClassLoader::class);
    }
}