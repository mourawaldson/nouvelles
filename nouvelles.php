<!DOCTYPE html>
	<head>
		<title>Nouvelles</title>
		<meta charset="utf-8">
		<meta name="author" content="Waldson Moura" />
		<meta name="description" content="Nouvelles - Canada, en Français">
		<meta name="viewport" content="width=device-width">
	</head>
	<body>
<?php
date_default_timezone_set('America/Montreal');

$xml = simplexml_load_file("http://news.google.com/news?cf=all&ned=fr_ca&hl=fr&output=rss");
$items = $xml->channel->item;

if (!empty($items)) {
?>
		<table>
			<tbody>
<?php
	for ($i = 0; $i < 5; $i++) {
		$item = $items[$i];
		$pub_date = date('Y-m-d', strtotime($item->pubDate));
		preg_match('/src="([^"]+)"/', $item->description, $image_source);
		$informations = explode('<font size="-1">', $item->description);
		$description = strip_tags($informations[2]);
?>
				<tr>
<?php
		if (isset($image_source[1])) {
			$no_image_colspan = '';
?>
					<td valign="top">
						<img src="<?php echo $image_source[1]; ?>" />
					</td>
<?php
		}
		else {
			$no_image_colspan = ' colspan="2"';
		}
?>
					<td valign="top"<?php echo $no_image_colspan; ?>>
						<a href="<?php echo $item->link; ?>"><?php echo $item->title; ?></a><br />
						<span><?php echo $pub_date; ?></span><br />
						<span><?php echo $description; ?></span>
					</td>
				</tr>
<?php
	}
?>
			</tbody>
		</table>
<?php
}
else {
?>
		<p>Pas de Nouvelles!</p>
<?php
}
?>
	</body>
</html>