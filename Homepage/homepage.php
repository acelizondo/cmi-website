<?php
    require_once 'config.php';
    require_once 'include/template.inc.php';

    /*if(isset($_REQUEST['email']) && isset($_REQUEST['textarea'])){
        if(isset($_REQUEST['name'])){$name = $_POST['name'];}
        else{$name="";}
        global $config;
        $to = $config['email'];
        $subject = $config['em_subject'];
        $headers = "From: " . $config['email'];
        $message = $name . "\n" . $_POST['email'] . "\n" . $_POST['textarea'];
        $mail_sent = $config['smtp']->send($to, $headers, $body);
        //$mail_sent = mail( $to, $subject, $message, $headers );
        echo $mail_sent ? "Mail sent" : "Mail failed";
    }*/
    $template = new homeTemplate('homepage', 'CMI Homepage');

    echo $template->printHead();
    echo build_Description();
    echo goals();
    echo album_grid();
    echo printCalendar();
    echo $template->printFooter();

    //Builds the portfolio section by pulling information from the DB
    function album_grid(){
        global $config, $mysqli;
        $html = "<section class='no-padding' id='portfolio'>
            <div class='container-fluid''>
                <div class='row no-gutter'>";


        $SQL = "SELECT *
          FROM {$config['db']['albums']}";

        $retid = $mysqli->query($SQL);
        while($row = $retid->fetch_assoc()){
            $sql = "SELECT photo
                FROM photo_library
                WHERE album = {$row['id']} AND cover_photo = {$config['cover_photo']}";
            $result = $mysqli->query($sql);
            if($result) {
                $photos = $result->fetch_assoc();
                $html .= printCover($photos, $row['name'], $row['id']);
            }
        }
        $html .= "</div></div></section>";
        return $html;
        
    }


    function printCover($photo, $albumName, $albumID){
        global $config;
        $url = $config['gallery_url'] . 'index.php?album=' . $albumID;
        $file = base64_encode($photo['photo']);
        $html = "";
            $html .= "<div class='col-lg-4 col-sm-6'>
                <a href='{$url}' class='portfolio-box' target='_blank'>
                    <img src='data:image/jpeg;base64,{$file}' class='img-responsive' alt=''>
                    <div class='portfolio-box-caption'>
                        <div class='portfolio-box-caption-content'>
                            <!--<div class='project-category text-faded'>Category</div>-->
                            <div class='project-name''>{$albumName}</div>
                        </div>
                    </div>
                </a>
            </div>";
        return $html;
    }

    function build_Description(){
        global $config;
        //$url = $config['base_url'] . "Resources/img/bascom.jpg";
        $out = "<header><div class='header-content'></div></header>";
        //Who are we div 
        $out .= "<section class='bg-primary' id='about'>
               <div class='container'>
                    <div class='row'>
                        <div class='col-lg-8 col-lg-offset-2 text-center'>
                            <h2 class='section-heading'>Who are we?</h2>
                            <hr class='light'>
                            <p class='text-faded'>'Description here about CMI'</p>
                        </div>
                    </div>
                </div>
        </section>";

        return $out;
    }

    function goals(){
        global $config;
        $goals = "<section id='services'>
            <div class='container'>
                <div class='row'>
                    <div class='col-lg-12 text-center'>
                        <h2 class='section-heading'>Our Goals</h2>
                        <hr class='primary'>
                    </div>
                </div>
            </div>
            <div class='container'>
                <div class='row'>";

        //goal 1
        $goals.=build_goal($config['goals']['name'][1], $config['goals']['icon'][1], $config['goals']['desc'][1]);
        $goals.=build_goal($config['goals']['name'][2], $config['goals']['icon'][2], $config['goals']['desc'][2]);
        $goals.=build_goal($config['goals']['name'][3], $config['goals']['icon'][3], $config['goals']['desc'][3]);
        $goals.=build_goal($config['goals']['name'][4], $config['goals']['icon'][4], $config['goals']['desc'][4]);
        $goals .= "</div></div></section>";
        return $goals;   
    }

    function build_goal($name, $icon, $description){
        $bg = "<div class='col-lg-3 col-md-6 text-center'>
                <div class='service-box'>
                    <i class='{$icon} wow bounceIn text-primary'></i>
                    <h3>{$name}</h3>
                    <p class='text-muted'>{$description}</p>
                </div>
            </div>";
       return $bg;
    }

    function printCalendar(){
        $calendar = "<section class='bg-primary' id='calendar'>
                <div class='container'>
                    <div class='row'>
                        <div class='col-lg-8 col-lg-offset-2 text-center'>
                            <h2 class='section-heading'>Upcoming Events</h2>
                            <hr class='light'>
                        </div>
                    </div>";
        $calendar .= "<iframe class='center-block' src='https://calendar.google.com/calendar/embed?title=Social%20Events
            &amp;showTitle=0&amp;showNav=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;
            height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=acelizondo11%40gmail.com&amp;color=%2329527A
            &amp;src=en.usa%23holiday%40group.v.calendar.google.com&amp;color=%23125A12&amp;ctz=America%2FChicago'
            style='border-width:0' width='700' height='500' frameborder='0' scrolling='no'></iframe></div></section>";
        return $calendar;
    }
