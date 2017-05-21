<?php

if ( !$_GET[stp] ) {

    ?>
	<table border="0" align="center">
	  <tr>
		<th>Date</th>
		<th>Title</th>
		<th colspan="2">Commands</th>
	  </tr>
	  <tr>
		<td colspan="2"></td>
		<td colspan="2" align="center"><a href="news.php?stp=edit">add news</a></th>
	  </tr>
	  <?php
    $perpage = $SETTINGS['Admin_News_Items_Per_Page'];

    $pnum = $_GET['p'];
    if ( !$pnum ) {
        $pnum = 0;
    } 
    $lmin = $pnum * $perpage;
    $lmax = $lmin + $perpage;

    $result = $mysqli->query( "SELECT ID,Date,Title FROM news ORDER BY ID DESC LIMIT $lmin, $perpage" );
    while ( $news = $mysqli->fetch( $result ) ) {
        echo "<tr>";
        echo "	<td>" . $news['Date'] . "</td>";
        echo "	<td>" . $news['Title'] . "</td>";
        echo "	<td align=\"center\"><a href=\"news.php?stp=edit&id=" . $news['ID'] . "\"><img src=\"images/edit.gif\" border=\"0\"></a></td>";
        echo "	<td align=\"center\"><a href=\"news.php?stp=delete&id=" . $news['ID'] . "\"><img src=\"images/drop.gif\" border=\"0\"></a></td>";
        echo "</tr>";
    } 

    ?>
	  <tr>
		<td colspan="4" align="center">
			<?php
    echo "<br>Page:<br>";
    $result = $mysqli->query( "SELECT count(*) FROM news" );
    $temp = $mysqli->fetch( $result );
    $pcount = ceil( $temp[0] / $perpage );
    $pnumtemp = 0;
    while ( $pnumtemp < $pcount ) {
        $pnum2 = $pnumtemp + 1;
        if ( $pnumtemp != $pnum ) {
            echo "<a href='news.php?p=$pnumtemp'>$pnum2</a> ";
        } else {
            echo "<b>$pnum2</b> ";
        } 
        $pnumtemp++;
    } 

    ?>
		</td>
	  </tr>
</table>
	<?php
} elseif ( $_GET['stp'] == "edit" ) {
    $editid = round( $_GET['id'] );
    if ( $editid ) {
        $result = $mysqli->query( "SELECT * FROM news WHERE ID='$editid'" );
        $news = $mysqli->fetch( $result );
        $showthis = "<input name=\"id\" type=\"hidden\" value=\"" . $news['ID'] . "\">";
        $submittext = "Edit";
    } else {
        $submittext = "Add";
    } 

    ?>
	<form action="news.php?stp=edit2" method="post">
	<table border="0" align="center">
	  <tr>
		<td>
			<?=$showthis?>
			<b>News Date</b>
			<br>
			<input name="date" type="text" value="<?=$news['Date']?>" size="60">
			<br>
			<b>News Title</b>
			<br>
			<input name="title" type="text" value="<?=$news['Title']?>" size="60">
			<br>
			<b>News Body</b>
			<br>
			<textarea name="body" rows="10" cols="45"><?=$news['Body']?></textarea>
			<br><br>
			<input name="sumbit" type="submit" value="<?=$submittext?>">
		</td>
	  </tr>
	</table>
	</form>
	<?php
} elseif ( $_GET['stp'] == "edit2" ) {
    if ( !$_POST['date'] || !$_POST['title'] || !$_POST['body'] ) {
        echo "you forgot to fill out something";
    } else {
        $date = htmlentities( $_POST['date'] );
        $title = htmlentities( $_POST['title'] );
        $body = htmlentities( $_POST['body'] );
        if ( $_POST['id'] ) {
            $edid = $_POST['id'];
            $mysqli->query( "UPDATE news SET Date=\"$date\",Title=\"$title\",Body=\"$body\" WHERE ID='$edid'" );
            echo "You successfully updated this news item.";
        } else {
            $mysqli->query( "INSERT INTO news (`Date`,`Title`,`Body`) VALUES (\"$date\",\"$title\",\"$body\")" );
            echo "You successfully added this news item.";
        } 
    } 
} elseif ( $_GET['stp'] == "delete" ) {
    $delid = round( $_GET['id'] );
    $mysqli->query( "DELETE FROM news WHERE ID='$delid'" );
    echo "This news item has been successfully deleted.";
} 
require 'includes/footer.php';

?>
