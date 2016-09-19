<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   sc_check_infos.php                                 :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/17 16:20:13 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/19 10:59:21 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();

	function ft_check_login($login)
	{
		$i = 0;
		while ($login[$i])
		{
			$ascii_value = ord($login[$i]);
			if ($ascii_value < 32 || $ascii_value > 126)
				return (FALSE);
			if (ord($login[$i]) >= 97 && ord($login[$i]) <= 122)
				$min = 1;
			else if (ord($login[$i]) >= 65 && ord($login[$i]) <= 90)
				$maj = 1;
			else if (ord($login[$i]) >= 48 && ord($login[$i]) <= 57)
				$number = 1;
			else if ($login[$i] == '\\')
				return (FALSE);
			$i++;
		}
		if ($min == 1 && $maj == 1 && $number == 1 && $i > 5)
			return (TRUE);
		return (FALSE);
	}

?>
