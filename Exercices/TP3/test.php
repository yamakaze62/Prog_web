<?php
require_once('vendor/dg/rss-php/src/Feed.php');
$url='http://radiofrance-podcast.net/podcast09/rss_14312.xml';
$rss = Feed::loadRss($url);
?>
<table>

	<tr>
	<th>Date</th>
	<th>Titre</th>
	<th>URL</th>
	<th>Durée</th>
	<th>Média</th>
	</tr>
	
<?php
foreach ($rss->item as $item) {
 $itunes= $item->children('itunes', true);
	$date=$item->pubDate;
	$titre=$item->title;
	$son=$item->enclosure['url'];
	$duree=$itunes->duration;
	$link=$item->link;
	?>
	<tr>
	<td><?php echo $date ?></td>
	<td><?php echo $titre ?></td>
	<td><audio controls="controls">
		<source src=<?php echo $son; ?> type="audio/mp3" />
	</audio></td>
	<td><?php echo $duree ?></td>
	<td><?php echo $link ?></td>
	</tr>
	<?php
}
?>

</table>
	
