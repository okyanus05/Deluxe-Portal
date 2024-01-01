function smilie(tag, url)
{
	if (window.opener.messageEditor && window.opener.HTMLArea)
	{
		window.opener.messageEditor.focusEditor();
		if (window.opener.HTMLArea.is_ie)
			window.opener.messageEditor.insertHTML('<img tag="'+tag+'" src="'+url+'" /><span></span>');
		else
			window.opener.messageEditor._doc.execCommand("inserthtml", false, '<img tag="'+tag+'" src="'+url+'" />');
		window.opener.messageEditor.focusEditor();
	}
	else
		window.opener.textboxReplaceSelect(window.opener.getElement('message'), tag + ' ');
	window.focus();
}