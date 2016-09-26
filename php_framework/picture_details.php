<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   picture_details.php                                :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/26 15:35:14 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/26 19:33:54 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();

	function ft_comment()
	{
		include (CONFIG_DIR."database.php");
		$image_name = $_GET['name'];
		try
		{
			$DB = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "SELECT * FROM db_tbouder.comments WHERE image_name='".$image_name."' ORDER BY date DESC;";
			$request = $DB->prepare($sql);
			$request->execute();
			$comments = $request->fetchAll();
			$count = $request->rowCount();
			$request->closeCursor();
			$request = NULL;
			if ($count !== 0)
			{
				echo "<div class='comment_section'>";
				foreach ($comments as $key => $value)
				{
					$comment = $value['comment'];
					echo "<div class='comment_content'>";
						echo "<div class='comment_section_poster'>";
							echo "Comment by <span class='comment_highlight'>".$value['poster']."</span>";
						echo "</div>";
						echo "<div class='comment_comment'>";
							echo "<xmp> ".$comment." </xmp>";
						echo "</div>";
					echo "</div>";
				}
				echo "</div>";
			}
			$DB = NULL;
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
			die();
		}
	}
?>
