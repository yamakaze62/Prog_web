<?php

/**
 * TMDB query function
 * @param string $urlcomponent (after the prefix)
 * @param array (associative) GET parameters (ex. ['language' => 'fr'])
 * @return string $content
 **/
function tmdbget($urlcomponent, $params = null)
{
    $apikey = 'ebb02613ce5a2ae58fde00f4db95a9c1';
    $apiprefix = 'http://api.themoviedb.org/3/'; //3rd API version

    $targeturl = $apiprefix . $urlcomponent . '?api_key=' . $apikey;
    $targeturl .= (isset($params) ? '&' . http_build_query($params) : '');

    list($content, $info) = smartcurl($targeturl);

    return $content;
}

/**
 * curl wrapper
 * @param string $url
 * @return string $content
 **/
function smartcurl($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, "php-libcurl");
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

    $rawcontent = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);
    return [$rawcontent, $info];
}





/**
 * function to print a poster
 * @param array $tab
 * @param string $elem
 * @param string $nb_lines
 * @param string $size
 **/
function print_poster($tab, $elem, $nb_lines, $size) {          //On affiche un poster avec la size indiqué et le nombre de ligne dans le tableau qu'il doit prendre
    if (isset($tab[$elem]) && !empty($tab[$elem])) {            
    ?>
        <td rowspan=<?php echo $nb_lines ?>>
            <img
                class="pic"
                src=https://image.tmdb.org/t/p/<?php echo $size . $tab[$elem] ?>
            >
        </td>
    <?php
    } else {
    ?>
        <td rowspan=<?php echo $nb_lines ?> class="empty"> </td>
    <?php
    }
}

/**
 * function to print a content
 * @param array $tab
 * @param string $elem
 * @param string $nb_col
 **/
function print_content($tab, $elem, $nb_col) {                  //On affiche une phrase dans le tableau si elle existe et sinon on grise la case du tableau
    if (isset($tab[$elem]) && !empty($tab[$elem])) { ?>
        <td class="content" colspan=<?php echo $nb_col ?> > <?php echo $tab[$elem] ?> </td>
    <?php
    } else { ?>
        <td class="empty" colspan=<?php echo $nb_col ?> > </td>
    <?php
    }
}

/**
 * function to print a link
 * @param string $url
 * @param string $display name
 * @param string $description of link
 **/
function print_link($url, $name, $descr) {          //On affiche le lien avec le nom $name et la description $descr s'il y en a une
    ?>
    <a
        href=<?php echo $url ?>
        target="_blank"
        <?php 
        if (!empty($descr)) {
            echo "title=\"" . $descr . "\"";
        }
        ?>
        >
        <?php echo $name ?>
    </a>
    <?php
}

/**
 * function to print a video
 * @param string $url
 * @param array $code
 **/
function print_video($url, $code) {         //On affiche une vidéo de type 'Trailer' d'un film
    if (!isset($code['status_code']) && isset($code['results']) && !empty($code['results'])) {
        $nb_for = count($code['results']);
        for ($i = 0; $i != $nb_for; $i++) {
            if (isset($code['results'][$i]['key']) && !empty($code['results'][$i]['key']) && $code['results'][$i]['type'] == 'Trailer') { ?>
                <td class="content" colspan="3">
                    <iframe
                        src=<?php echo $url . $code['results'][$i]['key'] ?>
                        allowfullscreen
                        class="video"
                    >
                    </iframe>
                </td>
            <?php
            return;
            }
        }
    }
    ?>
    <td class="empty" colspan="3"> </td>
    <?php
}



/**
 * function to print a audio
 * @param string $url
 **/
function print_audio($url) {            //On ajoute à la page Web une piste audio au format MP3
    ?>
    <audio
        class="audio"
        controls="controls">
        <source
            src=<?php echo $url ?>
            type="audio/mp3"
        />
        Votre navigateur ne supporte pas la balise audio
    </audio>
    <?php
}


/**
 * function to print an entire week of the Hebdo prog
 * @param string $week
 * @param string $year
 * @param string $tab with week content
 * @param string $isAndroid podcast
 * @param string $isFI content
 **/
function print_weekMulti($week, $year, $tab_week, $isAndroid, $isFI) {      //Fonction pour afficher une semaine de contenu dans le programme podcastTabMulti.php
    ?>
    <tr>
        <th class="header"> <?php echo $week . " (" . $year . ")" ?> </th>
        <?php
        foreach($tab_week as $day) {        //Pour chaque jour du tableau, on affiche les différentes informations si elles existent et une case grisée s'il n'y a pas d'informations
            if (!empty($day)) { ?>
                <td class="content">
                <?php
                    $nb_link = count($day['link']);
                    for ($i = 0; $i != $nb_link; $i++) { 
                        print_link($day['link'][$i], $day['title'][$i], $day['description'][$i]);
                        if ($nb_link != 1 && $i != $nb_link - 1) echo "<br /> <br />";
                    } ?>
                </td>

                <td class="content"> <?php echo substr($day['date'], 0, 16) ?> </td>

                <td>
                <?php
                    $nb_url = count($day['url']);
                    for ($i = 0; $i != $nb_url; $i++) { 
                        print_audio($day['url'][$i]);
                        if ($nb_url != 1 && $i != $nb_url - 1) echo "<br /> <br />";
                    }
                ?>
                </td>
            
            <?php
            } else { ?>
                <td colspan="3" class="empty"> </td>
            <?php
            }
        }
        if ($isAndroid && $isFI) {
            ?> <th colspan="2"> x </th> <?php
        } else if ($isAndroid && !$isFI) {
            ?>
            <td class="empty"> </td>
            <th class="header"> x </th>             <!-- On affiche si les podcasts de la semaine appartiennent à 'La Méthode Scientifique' et/ou 'Salut Techie !' -->
            <?php
        } else {
            ?>
            <th class="header"> x </th>
            <td class="empty"> </td>
            <?php
        }
    ?>
    </tr>
    <?php
}


/**
 * function to print an entire week of the Multi prog
 * @param string $week
 * @param string $year
 * @param string $tab with week content
 **/
function print_weekHebdo($week, $year, $tab_week) {         //Fonction pour afficher une semaine de contenu dans le programme podcastTabHebdo.php
    ?>
    <tr>
        <th class="header"> <?php echo $week . " (" . $year . ")" ?> </th>
        <?php
        foreach($tab_week as $day) {            //Pour chaque jour de la semaine, on affiche les différentes informations disponibles et une case grisée s'il n'y en a pas.
            if (!empty($day)) { ?>
                <td class="content">
                <?php
                    $nb_link = count($day['link']);
                    for ($i = 0; $i != $nb_link; $i++) { 
                        print_link($day['link'][$i], $day['title'][$i], $day['description'][$i]);
                        if ($nb_link != 1 && $i != $nb_link - 1) echo "<br /> <br />";
                    } ?>
                </td>

                <td class="content"> <?php echo substr($day['date'], 0, 16) ?> </td>

                <td>
                <?php
                    $nb_url = count($day['url']);
                    for ($i = 0; $i != $nb_url; $i++) { 
                        print_audio($day['url'][$i]);
                        if (!empty($day['twitter'][$i])) {
                            print_link($day['twitter'][$i], "Feed Twitter", NULL);
                        }
                        if ($nb_url != 1 && $i != $nb_url - 1) echo "<br /> <br />";
                    }
                ?>
                </td>
            
            <?php
            } else { ?>
                <td colspan="3" class="empty"> </td>
            <?php
            }
        }
    ?>
    </tr>
    <?php
}
