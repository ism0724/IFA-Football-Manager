<?php

namespace App;

class Autoloader {
    
    //  Enregistre notre autoloader

    public static function register() {
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    /**
     * Calcule le chemin du fichier et le charge
     * @param string $class Le nom de la classe complète (avec namespace)
     */
    public static function autoload($class) {

        $class = str_replace('App\\', '', $class);

        $class = str_replace('\\', '/', $class);
       
        $file = __DIR__ . '/' . $class . '.php';

     
        if (file_exists($file)) {
            require_once $file;
        }
    }
}