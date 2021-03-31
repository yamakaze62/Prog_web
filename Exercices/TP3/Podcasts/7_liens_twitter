<?php
require_once 'vendor/dg/rss-php/src/Feed.php';
include "tp3-helpers.php";
$rss = Feed::loadRss("http://radiofrance-podcast.net/podcast09/rss_14312.xml");
?>


<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <link rel="stylesheet" href="table.css">
    <link rel="stylesheet" href="text.css">
    <link rel="stylesheet" href="media.css">
    <title> Les Podcasts : Tableau Hebdomadaire </title>

</head>


<body>

    <table>

        <tr>
            <th class="header" colspan="16"> Podcast : <u><i>La Méthode Scientifique</i></u> </th>
        </tr>
    
        <tr>
            <th class="empty"> </th>
            <th class="header" colspan="3"> Monday </th>
            <th class="header" colspan="3"> Tuesday </th>
            <th class="header" colspan="3"> Wednesday </th>
            <th class="header" colspan="3"> Thursday </th>
            <th class="header" colspan="3"> Friday </th>
        </tr>

        <tr>
            <th class="header"> Week </th>
            <th class="header"> Title </th>
            <th class="header"> Date </th>
            <th class="header"> Medias </th>

            <th class="header"> Title </th>
            <th class="header"> Date </th>
            <th class="header"> Medias </th>

            <th class="header"> Title </th>
            <th class="header"> Date </th>
            <th class="header"> Medias </th>

            <th class="header"> Title </th>
            <th class="header"> Date </th>
            <th class="header"> Medias </th>

            <th class="header"> Title </th>
            <th class="header"> Date </th>
            <th class="header"> Medias </th>
        </tr>

        <?php
        $tab_week = array();
        $tab_week['Mon'] = array();
        $tab_week['Tue'] = array();
        $tab_week['Wed'] = array();
        $tab_week['Thu'] = array();
        $tab_week['Fri'] = array();

        $drap = 0;

        foreach ($rss->item as $item) {
            $itunes = $item->children("itunes", true);
            $podcast = $item->children("podcastRF", true);

            $date = $item->pubDate;
            $sec = strtotime($date);
            $week = date('W', $sec);
            $year = date('Y', $sec);

            if ($drap == 0) {
                $num_week = $week;
                $num_year = $year;
                $drap = 1;
            }

            if ($num_week != $week) {
                print_weekHebdo($num_week, $num_year, $tab_week);
                $num_week = $week;
                $num_year = $year;
                $tab_week = array();
                $tab_week['Mon'] = array();
                $tab_week['Tue'] = array();         //Quand on commence une nouvelle semaine, on affiche les informations que l'on a récupéré dans tab_week
                $tab_week['Wed'] = array();         //Et on réinitialise le tableau
                $tab_week['Thu'] = array();
                $tab_week['Fri'] = array();
            }

            if ($item->title != "Retrouvez tous les épisodes sur l’appli Radio France") {
                $day = date('D', $sec);

                $description = $item->description;
                $start = strripos($description, "- par");
                $end = strripos($description, "- réalisation");         //On récupère la description du podcast
                if ($end !== false) $description = "Sujet" . substr($description, $start + 1, $end - $start - 1);
                else $description = "Sujet" . substr($description, $start + 1);

                $twitter = NULL;
                if ($podcast->businessReference == '26360') {
                    list($content, $info) = smartcurl($item->link);
                    $start = strpos($content, "https://twitter.com/lamethodeFC/status/");
                    if ($start !== false) {
                        $twitter = substr($content, $start);        //On récupère le lien Twitter
                        $end = strpos($twitter, "=");
                        $twitter = substr($twitter, 0, $end) . "=200";
                    }
                }

                $tab_week[$day]['date'] = $date;
                $tab_week[$day]['link'][] = $item->link;
                $tab_week[$day]['title'][] = $item->title;              //On ajoute les informations dont on a besoin dans le jour correspondant dans le tableau
                $tab_week[$day]['url'][] = $item->enclosure['url'];
                $tab_week[$day]['description'][] = $description;
                $tab_week[$day]['twitter'][] = $twitter;
            }
        }
        print_weekHebdo($num_week, $num_year, $tab_week);
        ?>

    </table>

</body>

</html>
