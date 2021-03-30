% PW-DOM  Compte rendu de TP

# Compte-rendu de TP

Sujet choisi : Analyse d’un flux RSS de podcast

## Participants 

* NGUYEN Justin
* ZHANG Keming


## Utilisation de TMDB
* Mise en jambes

1)Le format de réponse est JSON, le film est Fight Club, si on utilise language=fr, l'overview est en FR mais aussi en EN.

2)```curl -I http://api.themoviedb.org/3/movie/550?api_key=ebb02613ce5a2ae58fde00f4db95a9c1```

3)Veuillez utilisez le fichier Mej3.html.

## Analyse d'un flux RSS de podcast
* Mise en jambes(Tableau des podcasts)

* Intercalaire hebdomadaire

* Tableau hebdomadaire

* Plusieurs Podcasts

* Attributs du mp3

Pour le fichier 2.mp3, ç'affiche dans l'image du 5_Atttribut_du_p3.png, et son bitrate est 128kbps et il est stereo

et un autre exemple ici

Résultat de ```mp3info -x 14312-21.02.2020-ITEMA_22288585-0.mp3``` :

```14312-21.02.2020-ITEMA_22288585-0.mp3 does not have an ID3 1.x tag.
File: 14312-21.02.2020-ITEMA_22288585-0.mp3
Media Type:  MPEG 1.0 Layer III
Audio:       128 kbps, 44 kHz (joint stereo)
Emphasis:    none
CRC:         No
Copyright:   No
Original:    No
Padding:     Yes
Length:      9:56
```

* Réencodage

conversion : ```lame -b32 -a <fichier a convertir> <fichier converti>```
Ç'affiche dans l'image 6_Reencodage.png

* 

  
