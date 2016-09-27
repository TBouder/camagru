/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   picture_list.js                                    :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/21 18:07:23 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/27 18:44:23 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

/*******************************************************************************
** Ajax to avoid reloading page
*******************************************************************************/
	function ajax_load(page, sort)
	{
		pictures = document.getElementById('pictures');
		var request2 = new XMLHttpRequest;
		request2.open('GET', 'php_scripts/sc_display_picture_list.php?page=' + page + '&sort=' + sort, true);
		request2.onload = function()
		{
			if (request2.status >= 200 && request2.status < 400)
			{
				var resp = request2.responseText;
				pictures.innerHTML = resp;
				if (history.pushState)
				{
					var url = document.location.host + document.location.pathname + document.location.search.split('sort=')[0];
					var newurl = window.location.protocol + "//" + url + "sort=" + sort;
					window.history.pushState({path:newurl},'',newurl);
				}
			}
		};
		request2.send();
	}
	function ajax_like(image_name, callback, like, page, sort)
	{
		var request = new XMLHttpRequest;
		if (like == 1)
			request.open('POST', 'php_scripts/sc_like_plus_picture.php', true);
		else
			request.open('POST', 'php_scripts/sc_like_minus_picture.php', true);
		request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
		request.send("image_name=" + image_name);
		request.onload = function()
		{
			if (request.status >= 200 && request.status < 400)
			{
				var resp = request.responseText;
				console.log(resp);
				callback(page, sort);
			}
		};
	}
/*******************************************************************************
** Small functions to detect if it's a like or a dislike
*******************************************************************************/
	function ft_like(name, page, sort)
	{
		ajax_like(name, ajax_load, 1, page, sort);
	}
	function ft_dislike(name, page, sort)
	{
		ajax_like(name, ajax_load, -1, page, sort);
	}

/*******************************************************************************
** Sort function, will apply change without reloading, according to the sorting
*******************************************************************************/
	function ft_load_sort(page, sort)
	{
		var select = document.getElementById("picture_list_select").selectedIndex;

		if (select === 0)	ajax_load(page, "date");
		if (select === 1)	ajax_load(page, "like");
		if (select === 2)	ajax_load(page, "dislike");
		if (select === 3)	ajax_load(page, "author");
	}
