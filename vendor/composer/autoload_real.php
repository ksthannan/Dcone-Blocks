<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitb85d835b0e9b8c579f5b15fee04ec456
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInitb85d835b0e9b8c579f5b15fee04ec456', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitb85d835b0e9b8c579f5b15fee04ec456', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitb85d835b0e9b8c579f5b15fee04ec456::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}