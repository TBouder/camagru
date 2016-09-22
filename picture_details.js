/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   picture_details.js                                 :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/21 18:07:23 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/22 11:46:53 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

function ajax_load(name)
{
	pictures = document.getElementById('pictures');
	var request2 = new XMLHttpRequest;
	request2.open('GET', 'php_scripts/sc_display_picture_details.php?name=' + name, true);
	request2.onload = function()
	{
		if (request2.status >= 200 && request2.status < 400)
		{
			var resp = request2.responseText;
			pictures.innerHTML = resp;
		}
	};
	request2.send();
}
function ajax_like(image_name, callback, like, name)
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
			callback(image_name);
		}
	};
}

function ft_like(name)
{
	ajax_like(name, ajax_load, 1);
}
function ft_dislike(name)
{
	ajax_like(name, ajax_load, -1);
}
