<?php

    require SERVER_PATH . "CMI-Website/Resources/Classes/template.class.php";

    class homeTemplate extends CMITemplate{
        public function __construct($page, $title)
        {
            global $config;
            //REQUIRED-call parent template construct
            parent::__construct($page, $title);
            $this->addScript('Resources/library/jquery/js/jquery.easing.min.js', $config['base_url']);
            $this->addScript('Resources/library/jquery/js/jquery.fittext.js', $config['base_url']);
            $this->addScript('Resources/js/wow.min.js', $config['base_url']);
            $this->addStyleSheet('Resources/css/animate.min.css', $config['base_url']);
            $this->addScript('Resources/js/classie.js', $config['base_url']);
            $this->addScript('Resources/js/creative.js', $config['base_url']);
            $this->addStylesheet('Resources/css/form-basic.css', $config['base_url']);
        }

    }