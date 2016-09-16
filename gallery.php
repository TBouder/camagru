<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   gallery.php                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/16 10:46:44 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/16 11:54:59 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include_once("includes.php");
	include_all();

	function ft_display_gallery()
	{
		include (CONFIG_DIR."/database.php");

		$elem_per_page = 2;

		$DB = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$count = $DB->prepare("SELECT id FROM db_tbouder.pictures;");
		$count->execute();
		$nb_picture = $count->rowCount();
		$count->closeCursor();
		$count = NULL;

		if(isset($_GET{'page'}))
		{
			$page = $_GET{'page'} + 1;
			$offset = $elem_per_page * $page ;
		}
		else
		{
			$page = 0;
			$offset = 0;
		}
		$left_rec = $nb_picture - ($page * $elem_per_page);


		$picture_db = $DB->prepare("SELECT * FROM db_tbouder.pictures LIMIT ".$offset.", ".$elem_per_page.";");
		$picture_db->execute();
		$all_pictures = $picture_db->fetchAll();
		$picture_db->closeCursor();
		$picture_db = NULL;

		echo '<div class="picture_container">';
		foreach ($all_pictures as $elem)
		{
			echo "<div class='picture_content'><div class='picture_content_2'>";
				echo "<img src=".$elem['link']." alt=".$elem['name']." />";
			echo "</div></div>";
		}
		echo '</div><div class="float_clr"></div>';

	if( $page > 0 )
	{
		$last = $page - 2;
		echo '<a href = '.$_PHP_SELF.'?page='.$last.'>Last 10 Records</a> |';
		echo '<a href = '.$_PHP_SELF.'?page='.$page.'>Next 10 Records</a>';
		}
	else if( $page == 0 )
	{
		echo '<a href = '.$_PHP_SELF.'?page='.$page.'>Next 10 Records</a>';
	}
	else if( $left_rec < $rec_limit )
	{
		$last = $page - 2;
		echo '<a href = '.$_PHP_SELF.'?page='.$last.'>Last 10 Records</a>';
	}

		$DB = NULL;

		// $picture_db = $DB->prepare("SELECT * FROM db_tbouder.pictures;");
		// $picture_db->execute();
		// $all_pictures = $picture_db->fetchAll();
		// $picture_db->closeCursor();
		// $picture_db = NULL;

		// echo "$nb_picture";
		// echo '<div class="picture_container">';
		// foreach ($all_pictures as $elem)
		// {
		// 	echo "<div class='picture_content'><div class='picture_content_2'>";
		// 		echo "<img src=".$elem['link']." alt=".$elem['name']." />";
		// 	echo "</div></div>";
		// }
		// echo '</div><div class="float_clr"></div>';

	}
?>

<html>
	<?php ft_head()?>
	<body>
		<?php ft_navbar() ?>
		<?php ft_display_gallery() ?>
		<?php ft_footer() ?>
	</body>
</html>
