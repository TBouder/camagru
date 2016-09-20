<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   gallery.php                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/16 10:46:44 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/20 13:15:39 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include_once("includes.php");
	include_all();

	function ft_display_gallery()
	{
		include (CONFIG_DIR."/database.php");

		$elem_per_page = 8;

		$DB = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$count = $DB->prepare("SELECT id FROM db_tbouder.pictures;");
		$count->execute();
		$nb_picture = $count->rowCount();
		$count->closeCursor();
		$count = NULL;

		$page = isset($_GET{'page'}) ? $_GET{'page'} : 0;
		$offset = isset($_GET{'page'}) ? $elem_per_page * $page : 0;

		$left_rec = $nb_picture - ($page * $elem_per_page);


		$picture_db = $DB->prepare("SELECT * FROM db_tbouder.pictures LIMIT ".$elem_per_page." OFFSET ".$offset.";");
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

		if($page == 0 && $left_rec > $elem_per_page)
			echo '<a href='.$_PHP_SELF.'?page='.($page + 1).' class="gallery_next">Next</a>';
		else if($page != 0 && $left_rec <= $elem_per_page)
			echo '<a href='.$_PHP_SELF.'?page='.($page - 1).' class="gallery_previous">Prev</a>';
		else if($page > 0)
		{
			echo '<a href='.$_PHP_SELF.'?page='.($page - 1).' class="gallery_previous">Prev</a>';
			echo '<a href='.$_PHP_SELF.'?page='.($page + 1).' class="gallery_next">Next</a>';
		}
		$DB = NULL;
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
