function forumperm_checkbox_onclick()
{
	getElement("custom_type").checked = true;
}

function forumperm_custom_radio()
{
	var i = document.getElementsByTagName("input");
	for (var c = 0; c < i.length; c++)
	{
		if (i[c].type == "checkbox")
			i[c].onclick = forumperm_checkbox_onclick;
	}
	getElement("check_all").onclick = forumperm_checkbox_onclick;
	getElement("uncheck_all").onclick = forumperm_checkbox_onclick;
}

function article_submit()
{
	if (!trim(getElement('message').value) || !trim(getElement('title').value))
	{
		alert('You must enter a title and a message.');
		return false;
	}
	else if ((getElement('topic').checked && !getElement('topicid').selectedIndex) || (getElement('section').checked && !getElement('sectionid').selectedIndex))
	{
		alert('You must choose a topic or section for your article.');
		return false;
	}
	return true;
}

function announcement_submit()
{
	if (!trim(getElement('message').value) || !trim(getElement('name').value) || !trim(getElement('start').value) || !trim(getElement('end').value))
	{
		alert('You must enter a title, message, start date, and end date.');
		return false;
	}
	return true;
}

doHide = (document.getElementById || document.all) ? true : false;
var previousSection = 'general';
var tables = new Array('general', 'open', 'rules', 'user', 'guests', 'banning', 'signatures', 'useropts', 'forum', 'thread', 'posting', 'sidebar', 'members', 'articles', 'categories', 'search', 'server', 'messages', 'avatars', 'attachments', 'online', 'censoring', 'logging', 'debug', 'images');
var inAllMode = false;

function configShowSection(tableId)
{
	var element = getElement(tableId+'table');
	if (element) {
		if (inAllMode==false) {
			element.style.display = '';
			if (previousSection && previousSection != tableId) {
				configHideSection(previousSection);
			}
			previousSection = tableId;
		}
		else {
			window.location.hash = tableId;
		}
	}
}

function configHideSection(tableId)
{
	if (inAllMode==false)
	{
		var element = getElement(tableId+'table');
		if (element) {
			element.style.display = 'none';
		}
	}
}

function showAllSections(lastSection)
{
	for (var i=0; i<tables.length; i++)
	{
		tableId = tables[i];
		var element = getElement(tableId+'table');
		element.style.display = '';
	}
	previousSection = lastSection;
	window.location.hash = previousSection;
	inAllMode = true;
}

function hideAllSections(exceptSection)
{
	if (inAllMode==true || exceptSection=='general' || exceptSection=='open')
	{
		for (var i=0; i<tables.length; i++)
		{
			tableId = tables[i];
			var element = getElement(tableId+'table');
			if (tableId!=exceptSection)
				element.style.display = 'none';
			else
				configShowSection(exceptSection);
		}
		window.location.hash = 'top';
		inAllMode = false;
	}
}

function hideSection(id)
{
	if (getElement(id))
	{
		getElement(id).className = 'displayNone';
	}
}

function showSection(id)
{
	if (lastShown!=id)
	{
		if (getElement(id))
		{
			getElement(id).className = '';
		}
		hideSection(lastShown);
		lastShown = id;
	}
}