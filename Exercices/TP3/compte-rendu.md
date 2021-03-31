% PW-DOM  Compte rendu de TP

# Compte-rendu de TP

Sujet choisi : Analyse d’un flux RSS de podcast

## Participants 

* NGUYEN Justin
* ZHANG Keming


## Utilisation de TMDB
* Mise en jambes

1)Le format est un JSON. Le film est Fight Club. En passant le paramètre language=fr, le champ
« Overview » est maintenant en français.

2)La commande sur le terminal pour récupérer les informations du header :
```curl -I http://api.themoviedb.org/3/movie/550?api_key=ebb02613ce5a2ae58fde00f4db95a9c1```

La commande sur le terminal pour récupérer les informations de la page :
```curl http://api.themoviedb.org/3/movie/550?api_key=ebb02613ce5a2ae58fde00f4db95a9c1```

On trouve bien les mêmes informations que sur le site
En récupérant les informations de la fonction smartcurl, on trouve : ["content_type"]=> string(30)
"application/json;charset=utf-8". IMAGE
Le format est donc bien JSON.

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
S'affiche dans l'image 6_Reencodage.png

* Interaction avec le fil Twitter
Liens Twitter:
On peut récupérer le lien à l’aide de la fonction smartcurl.

Liens Twitter dans le mp3: 
Le format mp3 seul ne peut stocker que des données binaires basiques. Il faut donc utiliser le format ID3 qui permet d'inclure les métadonnées telles que le nom de l'auteur, le nom de l'interprète, le titre du morceau, l’année de sortie, le nom de l'album, le genre musical, une illustration de la pochette d'album, les paroles de karaoké, etc... on peut donc inclure le lien vers le fil twitter avec.

  
