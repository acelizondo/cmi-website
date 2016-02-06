<?php

require_once 'config.php';
require_once 'include/template.inc.php';

$template = new albumTemplate('albums', 'CMI Photos');
$footer ="<script>
                $('.lightbox span.zoom a').ClassyBox({
                widthWindow:  900
                });
       	        </script>";

echo $template->printHead();
echo printPhotoGrid();
echo $template->printFooter($footer);

function printPhotoGrid()
{
    $album = getAlbum();
    $photoGrid = "<div id='welcome'>
                    <div class='container-fluid clearfix' style='padding:0; overflow:hidden'>
                        <div id='ib-main-wrapper' style='height:auto;' class='ib-main-wrapper'>
                            <div class='ib-main'>";
    //$photoGrid .= buildTextBox($album);
    $photoGrid .= getAlbumPhotos($album);

    $photoGrid .= "<div class='clr'></div></div></div></div></div>";
    return $photoGrid;
}

function getAlbumPhotos($albumNum)
{
    global $mysqli;
    $html ="";

    $SQL = "SELECT id, caption, photo
    FROM photo_library
    WHERE album = {$albumNum}
    ORDER BY id";

    $retid = $mysqli->query($SQL);
    while($row=$retid->fetch_assoc()){
        $html .= buildPhotoTag($row);
    }
    return $html;
}

function buildPhotoTag($photo_info)
{
    $photo = base64_encode($photo_info['photo']);
    $id= $photo_info['id'];
    $tag = "<a href='#'><img src='data:image/jpeg;base64,{$photo}' data-largesrc='data:image/jpeg;base64,{$photo}' alt='{$id}'/><span>{$photo_info['caption']}</span></a>\n";

    return $tag;
}

function buildTextBox($id)
{
    global $mysqli;
    $SQL = "SELECT *
    FROM albums
    WHERE id = {$id}";
    $result = $mysqli->query($SQL);
    $album = $result->fetch_assoc();
    $name = $album['name'];
    $caption = $album['caption'];
    $html = "<div class='ib-teaser'><h2>{$name}<span>{$caption}</span></h2></div>";
        //<div class='ib-content-full'><p>{</p></div></a>";
    return $html;
}

function getAlbum()
{
    $album = NULL;
    if(isset($_GET['album']))
    {
        $album = $_GET['album'];
    }
    return $album;
}

