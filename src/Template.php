<?php

class Template
{
    /** @var string template path */
    protected $filepath;
    /** @var string template content */
    protected $filecontent;
    /** @var string layout file */
    protected $layoutfile = __DIR__ . '/default.php';

    public function render($vars = [])
    {

    }

}