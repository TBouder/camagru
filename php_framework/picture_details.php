<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   picture_details.php                                :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/26 15:35:14 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/28 00:22:52 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();

	function ft_comment()
	{
		$image_name = $_GET['name'];
		$sql = "SELECT * FROM db_tbouder.comments WHERE image_name='".$image_name."' ORDER BY date DESC;";
		$comments = ft_exec_sql("fetchAll", $sql);
		$count = ft_exec_sql("rowCount", $sql);

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
	}
?>
