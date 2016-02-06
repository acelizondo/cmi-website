<?php
/**
 * Created by PhpStorm.
 * User: Aaron
 * Date: 1/14/2016
 * Time: 7:09 PM
 */

    require SERVER_PATH . "CMI-Website/Resources/Classes/template.class.php";


    class albumTemplate extends CMITemplate{
        public function __construct($page, $title){
            global $config;
            parent::__construct($page, $title);
            $this->addStylesheet('css/grid.css', $config['gallery_url']);
            $this->addScript('js/grid.js', $config['gallery_url']);
            $this->addScript('Resources/library/classybox/css/jquery.classybox.css', $config['base_url']);
            $this->addScript('Resources/library/kinetic/jquery.kinetic.min.js', $config['base_url']);
            $this->addScript('Resources/library/kinetic/jquery.kinetic.js', $config['base_url']);
            $this->addScript('Resources/library/classybox/js/jquery.classybox.js', $config['base_url']);
            $this->addScript('Resources/library/classybox/js/jquery.classybox.min.js', $config['base_url']);
            $this->addScript('Resources/library/classybox/js/jwplayer.js', $config['base_url']);
            $this->addScript('Resources/library/classybox/js/jwplayer.html5.js', $config['base_url']);
            $this->addScript('Resources/library/jquery/js/jquery.tmpl.min.js', $config['base_url']);
            $this->addScript('Resources/library/jquery/js/jquery.easing.min.js', $config['base_url']);
        }

        public function printHead(){
            $html = "<script id='img-wrapper-tmpl' type='text/x-jquery-tmpl'>
                    <div class='rg-image-wrapper'>
				        {{if ItemsCount > 1}}
					        <div class='rg-image-nav'>
						        <a href='#' class='rg-image-nav-prev'>Previous Image</a>
                                <a href='#' class='rg-image-nav-next'>Next Image</a>
					        </div>
				        {{/if}}
				    <div class='rg-image'></div>
				        <div class='rg-loading'></div>
				            <div class='rg-caption-wrapper'>
					            <div class='rg-caption' style='display:none;'>
						            <p></p>
					            </div></div></div></script>";


		/*$html .= "<script id='contentTmpl' type='text/x-jquery-tmpl'>
			<div id='ib-content-preview' class='ib-content-preview'>
                <div class='ib-teaser' style='display:none;'>{{html teaser}}</div>
                <div class='ib-content-full' style='display:none;'>{{html content}}</div>
                <span class='ib-close' style='display:none;'>Close Preview</span>
            </div>
		</script>";*/
            $output = $this->generateHTMLHead($html);
            $output .= $this->generateHTMLBody();
            return $output;
        }


    }