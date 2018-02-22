<?php

namespace App\Controller;

use FrameworkDevA3\Views\Template;

class PagesController extends MainController
{

    public function home()
    {
        echo Template::render('Pages/home.php');
    }
}