<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Base Public Class - used for all public pages
 */
class Public_Controller extends MY_Controller {

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // prepare theme name
        $this->settings->theme = 'default';

        // declare main template
        $this->template = "../../{$this->settings->themes_folder}/default/template.php";
    }

}
