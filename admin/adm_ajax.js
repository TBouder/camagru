/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   adm_ajax.js                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/21 18:07:23 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/28 13:09:30 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

function adm_ajax_load()
{
	adm_core = document.getElementById('adm_core');
	var request = new XMLHttpRequest;
	request.open('GET', 'sc_adm_content.php', true);
	request.onload = function()
	{
		if (request.status >= 200 && request.status < 400)
		{
			var resp = request.responseText;
			adm_core.innerHTML = resp;
		}
	};
	request.send();
}

function ft_adm_ajax_delete_user(login)
{
	var request = new XMLHttpRequest;
	request.open('POST', 'sc_remove_user.php', true);
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
	request.send("login=" + login);
	request.onload = function()
	{
		if (request.status >= 200 && request.status < 400)
		{
			var resp = request.responseText;
			adm_ajax_load();
		}
	};
}


function ft_adm_ajax_minus(data, login)
{
	var request = new XMLHttpRequest;
	request.open('POST', 'sc_change_rights.php', true);
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
	request.send("login=" + login + "&data=" + data + "&change=minus");
	request.onload = function()
	{
		if (request.status >= 200 && request.status < 400)
		{
			var resp = request.responseText;
			adm_ajax_load();
		}
	};
}
function ft_adm_ajax_plus(data, login)
{
	var request = new XMLHttpRequest;
	request.open('POST', 'sc_change_rights.php', true);
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
	request.send("login=" + login + "&data=" + data + "&change=plus");
	request.onload = function()
	{
		if (request.status >= 200 && request.status < 400)
		{
			var resp = request.responseText;
			console.log(resp);
			adm_ajax_load();
		}
	};
}
