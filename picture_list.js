/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   picture_list.js                                    :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/21 18:07:23 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/27 16:35:41 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

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
		request.open('POST', 'php_scripts/sc_like_picture.php', true);
	else
		request.open('POST', 'php_scripts/sc_dislike_picture.php', true);
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

function ft_like(name, page, sort)
{
	ajax_like(name, ajax_load, 1, page, sort);
}
function ft_dislike(name, page, sort)
{
	ajax_like(name, ajax_load, -1, page, sort);
}
