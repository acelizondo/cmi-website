<?php
    define("SERVER_PATH", $_SERVER['DOCUMENT_ROOT']);
    require(SERVER_PATH. "CMI-Website/global_config.php");
    global $config;
    $config['server_path']          = SERVER_PATH;
    $config['abs_url']              = 'CMI-Website/homepage';

    $config['goals']['name'][1]       ="Goal 1";
    $config['goals']['name'][2]       ="Goal 2";
    $config['goals']['name'][3]       ="Goal 3";
    $config['goals']['name'][4]       ="Goal 4";

    $config['goals']['icon'][1]       ="fa fa-4x fa-fire";
    $config['goals']['icon'][2]       ="fa fa-4x fa-heart";
    $config['goals']['icon'][3]       ="fa fa-4x fa-eye";
    $config['goals']['icon'][4]       ="fa fa-4x fa-cloud";

    $config['goals']['desc'][1]       ="description";
    $config['goals']['desc'][2]       ="description";
    $config['goals']['desc'][3]       ="description";
    $config['goals']['desc'][4]       ="description";

    $config['email']                  ="acelizondo11@gmail.com";
    $config['em_subject']             ="CMI Website Feedback";
   


    $config['cover_photo']            = 1;
