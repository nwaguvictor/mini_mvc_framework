<?php

namespace App\Controllers;

use Core\BaseController;
use Core\View;
use App\Models\Post;

class PostsController extends BaseController
{
    /** 
     * Show the index page
     * 
     * @return Void
     */
    public function indexAction()
    {
        // View::render('Post/index.php');

        $posts = Post::getAll();
        View::renderTemplate('Posts/index.php', [
            "posts" => $posts
        ]);
    }

    /** 
     * Show the create page
     * 
     * @return Void
     */
    public function createAction()
    {
        // echo "Hello, Start Hacking <br>";
    }

    /**
     * Show edit page
     * 
     * @return Void
     */
    public function editAction()
    {
        // echo "HEllo From PostController, the edit method";
        // echo '<p>Route Params: <pre>' . htmlspecialchars(print_r($this->route_params, true));
    }
}
