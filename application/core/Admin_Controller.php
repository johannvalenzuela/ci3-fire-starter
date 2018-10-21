<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Base Admin Class - used for all administration pages
 */
class Admin_Controller extends MY_Controller {

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // must be logged in
        if ( ! $this->user)
        {
            if (current_url() != base_url())
            {
                //store requested URL to session - will load once logged in
                $data = array('redirect' => current_url());
                $this->session->set_userdata($data);
            }

            redirect('login');
        }

        // make sure this user is setup as admin
        if ( ! $this->user['is_admin'])
        {
            redirect(base_url());
        }

        // load the admin language file
        $this->lang->load('admin');

        // prepare theme name
        $this->settings->theme = strtolower($this->config->item('admin_theme'));

        $this
            ->add_external_css(
                array(
                    base_url("/{$this->settings->themes_folder}/core/css/app.min.css")
                ))
            ->add_external_js(
                array(
                    base_url("/{$this->settings->themes_folder}/admin/js/app.min.js")
                ));

        // set up global header data
        $this
            ->add_css_theme("{$this->settings->theme}.css, summernote-bs3.css")
            ->add_js_theme("summernote.min.js" )
            ->add_js_theme("{$this->settings->theme}_i18n.js", TRUE);

        // declare main template
        $this->template = "../../{$this->settings->themes_folder}/{$this->settings->theme}/template.php";
    }

}
