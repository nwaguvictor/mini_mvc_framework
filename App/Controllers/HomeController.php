<?php

namespace App\Controllers;

use Core\BaseController;
use Core\View;

class HomeController extends BaseController
{
    /**
     * Before Filter
     * 
     * @return Void
     */
    protected function before()
    {
        //    
    }

    /**
     * After Filter
     * 
     * @return Void
     */
    protected function after()
    {
        echo "After";
    }

    /**
     * Show the index page
     * 
     * @return Void
     */
    public function indexAction()
    {
        // View::render('Home/index.php', [
        //     'name' => 'Victor',
        //     'colors' => ['blue', 'black', 'red', 'white']
        // ]);

        View::renderTemplate('Home/index.php', [
            'name' => 'Victor',
            'colors' => ['blue', 'black', 'red', 'white']
        ]);
    }
}
