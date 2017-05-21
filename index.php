<?php
require"header.php";
?>
<hr>

<p>getting started</p>

<?php
					
$newlim = $SETTINGS['Number_of_News_Items'];
$newsformat = html_entity_decode( $SETTINGS['News_Template'] );
$result = $mysqli->query( "SELECT * FROM news ORDER BY ID DESC LIMIT $newlim" );

while ( $news = $db->fetch( $result ) ) {
    $newdisplay = str_replace( "[date]", $news['Date'], $newsformat );
    $newdisplay = str_replace( "[title]", $news['Title'], $newdisplay );
    $newdisplay = str_replace( "[body]", html_entity_decode( $news['Body'] ), $newdisplay );
    echo $newdisplay;
} 
$mysqli->close();
?>

<hr>

<?php
require"footer.php";
?>
