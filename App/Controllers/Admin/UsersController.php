<?php

namespace App\Controllers\Admin;

use Core\BaseController;

class UsersController extends BaseController
{
    /**
     * Before Fileter
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
        //
    }

    /**
     * Show index page
     * 
     * @return Void
     */
    public function indexAction()
    {
        echo "User admin";
    }
}
