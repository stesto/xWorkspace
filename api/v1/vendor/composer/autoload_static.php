<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit13511f22d377004ba9cf213ddf1facd9
{
    public static $prefixesPsr0 = array (
        'S' => 
        array (
            'Slim' => 
            array (
                0 => __DIR__ . '/..' . '/slim/slim',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit13511f22d377004ba9cf213ddf1facd9::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit13511f22d377004ba9cf213ddf1facd9::$classMap;

        }, null, ClassLoader::class);
    }
}