var agt = navigator.userAgent.toLowerCase();
var isIE = ((agt.indexOf("msie") != -1) && (agt.indexOf("opera") == -1));
var ieVersion = isIE ? Number(navigator.appVersion.match(/MSIE (\d+\.\d+)/, "")[1]) : false;
var isOpera  = (agt.indexOf("opera") != -1);
var isMac = (agt.indexOf("mac") != -1);
var isMacIE = (isIE && isMac);
var isWinIE = (isIE && !isMac);
var isMoz = (navigator.product == "Gecko");

function textboxReplaceSelect(oTextbox, sText)
{
	if (isIE && ieVersion > 5)
	{
		oTextbox.focus();
		var oRange = document.selection.createRange();
		oRange.text = sText;
		oRange.collapse(true);
		oRange.select();
	}
	else if (isMoz)
	{
		var iStart = oTextbox.selectionStart;
		oTextbox.value = oTextbox.value.substring(0, iStart) + sText + oTextbox.value.substring(oTextbox.selectionEnd, oTextbox.value.length);
		oTextbox.setSelectionRange(iStart + sText.length, iStart + sText.length);
	}
	else
		oTextbox.value += sText;

	oTextbox.focus();
}

function trim(value)
{
	return value.replace(/^\s*(.*?)\s*$/, '$1');
}

function RegExpQuote(string)
{
	return string.replace(/(\\|\+|\*|\?|\[|\^|\]|\$|\(|\)|\{|\}|\=|\!|\<|\>|\||\:)/gi, '\\$1');
}

document.getElementsByClassName = function(getClassName)
{
	var returnElements = new Array();
	document.allElements = document.getElementsByTagName('*');
	searchRegExp = new RegExp('\\b' + RegExpQuote(getClassName) + '\\b');
	elementsLength = document.allElements.length;
	for (i = 0; i < elementsLength; i++)
	{
		currentElement = document.allElements[i];
		if (currentElement.className.match(searchRegExp))
			returnElements[returnElements.length] = currentElement;
	}
	return returnElements;
};

document.getElementsByAttribute = function(attributeName, attributeValue, caseInsensitive)
{
	var returnElements = new Array();
	if (caseInsensitive)
		attributeValue = attributeValue.toLowerCase();
	document.allElements = document.getElementsByTagName('*');
	elementsLength = document.allElements.length;
	for (i = 0; i < elementsLength; i++)
	{
		currentElement = document.allElements[i];
		checkValue = currentElement.getAttribute(attributeName);
		if (caseInsensitive)
			checkValue = checkValue.toLowerCase();
		if (checkValue == attributeValue)
			returnElements[returnElements.length] = currentElement;
	}
	return returnElements;
}

function checkboxes(checkOff)
{
	element = getElement('pm')
	if (element!=false)
	{
		checkboxElements = element.getElementsByTagName('input');
		numCheckboxes = checkboxElements.length;
		for (i=0; i < numCheckboxes; i++)
		{
			e = checkboxElements[i];
			if ((e.name != 'checkall') && (e.type=='checkbox'))
				e.checked = checkOff;
		}
	}
	return true;
}

function doVisible(ctrl)
{
	if (getElement(ctrl).style.display=='block')
		getElement(ctrl).style.display = 'none';
	else
		getElement(ctrl).style.display = 'block';
	return true;
}
				
function replies(threadid)
{
	window.open("replies.php?id="+threadid, "replies", "toolbar=0,scrollbars=1,resizable=1,width=320,height=300");
}
				
function str_replace(replacee, replacement, subject)
{
	while(subject.indexOf(replacee) != -1)
		subject = subject.replace(replacee, replacement);
	return subject;
}

function smilie(tag, url)
{
	if (window.messageEditor)
	{
		window.messageEditor.focusEditor();
		if (HTMLArea.is_ie)
			window.messageEditor.insertHTML('<img tag="'+tag+'" src="'+url+'" /><span></span>');
		else
			window.messageEditor._doc.execCommand("inserthtml", false, '<img tag="'+tag+'" src="'+url+'" />');
		window.messageEditor.focusEditor();
	}
	else
		textboxReplaceSelect(getElement('message'), tag + ' ');
}

function getElement(elementName)
{
	element = false;
	if (document.getElementById && document.getElementById(elementName))
		element = document.getElementById(elementName);
	else if (document.all && document.all[elementName])
		element = document.all[elementName];
	else if (document.layers && document.layers[elementName])
		element = document.layers[elementName];
	if (element==false)
		eval('if (document.' + elementName + ') element = document.' + elementName + ';');
	return element;
}

document.createHTMLElement = function(elemName, attribs)
{	// The 2nd argument is an object literal specifying all the attribute/value pairs. Example:
	// var a = document.createHTMLElement( "a", { title:'Email Tecknetix', class:'hov', href:"mailto:" + mailpart1 + "@" + mailpart2, text: showtext } );

	if (document.createElementNS)
	{
		var elem = document.createElementNS("http://www.w3.org/1999/xhtml", elemName);
		var isNamespaced = true;
	}
	else
	{
		var elem = document.createElement(elemName);
		var isNamespaced = false;
	}
	if (typeof attribs != 'undefined')
	{
		for (var i in attribs)
		{
			switch (true)
			{
				case (i=='text'):
						elem.appendChild(document.createTextNode(attribs[i]));
					break;
				case (i=='class'):
						elem.className = attribs[i];
					break;
				default : 
					if (isNamespaced==true)
						elem.setAttributeNS("http://www.w3.org/1999/xhtml", i, '');
					else
						elem.setAttribute(i, '');
					elem[i] = attribs[i];
			}
		}
	}
	return elem;	
};

function check_all(node)
{
	var nodes = node.childNodes;
	var numNodes = nodes.length;
	for (var e = 0; e < numNodes; e++)
	{
		if (nodes[e].type == "checkbox")
			nodes[e].checked = true;
		else
			check_all(nodes[e]);
	}
}

function uncheck_all(node)
{
	var nodes = node.childNodes;
	var numNodes = nodes.length;
	for (var e = 0; e < numNodes; e++)
	{
		if (nodes[e].type == "checkbox")
			nodes[e].checked = false;
		else
			uncheck_all(nodes[e]);
	}
}

function pm_submit()
{
	if (!trim(getElement('message').value) || !trim(getElement('subject').value) || !trim(getElement('users').value))
	{
		alert('You must enter a subject, message, and one or more usernames.');
		return false;
	}
	return true;
}

function thread_submit(button)
{
	if (button.form.onsubmit)
		button.form.onsubmit();
	if (thread_submit2())
	{
		button.disabled=true;
		button.form.submit();
		return true;
	}
	return false;	
}

function thread_submit2()
{
	if (!trim(getElement('message').value) || !trim(getElement('subject').value))
	{
		alert('You must enter a subject and a message.');
		return false;
	}
	return true;
}

function reply_submit(button)
{
	if (button.form.onsubmit)
		button.form.onsubmit();
	if (reply_submit2())
	{
		button.disabled=true;
		button.form.submit();
		return true;
	}
	return false;	
}

function reply_submit2()
{
	if (!trim(getElement('message').value))
	{
		alert('You must enter a message.');
		return false;
	}
	return true;
}

function check_uncheck_all(box, id)
{
	if (box.checked)
		check_all(getElement(id));
	else
		uncheck_all(getElement(id));
}

function messageNotEmpty()
{
	if (getElement('message').value.length==0)
	{
		alert('Please enter a message.');
		getElement('message').focus();
		return false;
	}
	else
		return true;
}
function setQuickQuote(postid)
{
	if ((postIdElement = getElement('quotepostid')) && (checkboxElement = getElement('quoteselected')) && (textBoxElement = getElement('message')))
	{
		postIdElement.value = postid;
		checkboxElement.title = 'Quote selected message with reply';
		checkboxElement.checked = true;
		checkboxElement.disabled = false;
		textBoxElement.blur();
		textBoxElement.focus();
	}
}