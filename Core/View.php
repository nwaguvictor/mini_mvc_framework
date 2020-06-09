<?php

namespace Core;

class View
{
    /**
     * Render a view 
     * 
     * @param String $view - the view file to render
     * 
     * @param Array $args - Data passed to the view
     * 
     * @return void
     */
    public static function render($view, $args = [])
    {
        extract($args, EXTR_SKIP);

        $file = "../App/Views/$view";
        if (is_readable($file)) {
            require $file;
        } else {
            // echo "$file not found";
            throw new \Exception("$file not found");
        }
    }

    /**
     * Render A view template with twig
     * 
     * @param String $template - the file template to render
     * @param Array $args - Optional associative array of data to display in the template
     * 
     * @return void
     */
    public static function renderTemplate($template, $args = [])
    {
        static $twig = null;

        if ($twig === null) {
            $loader = new \Twig\Loader\FilesystemLoader('../App/Views');
            $twig = new \Twig\Environment($loader);
        }
        echo $twig->render($template, $args);
    }
}
