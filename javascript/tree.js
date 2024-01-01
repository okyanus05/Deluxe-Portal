// Title: Tigra Tree
// Description: See the demo at url
// URL: http://www.softcomplex.com/products/tigra_menu_tree/
// Version: 1.0
// Date: 07-20-2002 (mm-dd-yyyy)
// Contact: feedback@softcomplex.com (specify product title in the subject)
// Notes: Registration needed to use this script on your web site.
// 	Registration for this version (1.0) is free of charge.
//	Visit official site for details

// This script has been modified for use with Deluxe Portal
// Copyright (C) 2001-2003 Deluxeportal.com
// http://www.deluxeportal.com

function tree (a_items, a_template, currentEdit) {

	this.currentEdit = currentEdit ? currentEdit : false;
	this.a_tpl       = a_template;
	this.a_config    = a_items;
	this.o_root      = this;
	this.a_index     = [];
	this.o_selected  = null;
	this.n_depth     = -1;
	
	var o_icone = new Image(),
		o_iconl = new Image();
	o_icone.src = a_template['icon_e'];
	o_iconl.src = a_template['icon_l'];
	a_template['im_e'] = o_icone;
	a_template['im_l'] = o_iconl;
	for (var i = 0; i < 64; i++)
		if (a_template['icon_' + i]) {
			var o_icon = new Image();
			a_template['im_' + i] = o_icon;
			o_icon.src = a_template['icon_' + i];
		}
	
	this.toggle = function (n_id) {	var o_item = this.a_index[n_id]; o_item.open(o_item.b_opened) };
	this.select = function (n_id) { return this.a_index[n_id].select(); };
	
	this.a_children = [];
	for (var i = 0; i < a_items.length; i++)
		new tree_item(this, i);

	this.n_id = trees.length;
	trees[this.n_id] = this;
	
	for (var i = 0; i < this.a_children.length; i++) {
		document.write(this.a_children[i].init());
		this.a_children[i].open();
	}
}
function tree_item (o_parent, n_order) {

	this.n_depth  = o_parent.n_depth + 1;
	this.a_config = o_parent.a_config[n_order + (this.n_depth ? 2 : 0)];
	if (!this.a_config) return;

	this.o_root    = o_parent.o_root;
	this.o_parent  = o_parent;
	this.n_order   = n_order;
	this.b_opened  = !this.n_depth;

	this.n_id = this.o_root.a_index.length;
	this.o_root.a_index[this.n_id] = this;
	o_parent.a_children[n_order] = this;

	this.a_children = [];
	for (var i = 0; i < this.a_config.length - 2; i++)
		new tree_item(this, i);

	this.get_icon = item_get_icon;
	this.open     = item_open;
	this.init     = item_init;
	this.is_last  = function () { return this.n_order == this.o_parent.a_children.length - 1 };
}

function item_open (b_close) {
	var o_idiv = get_element('i_div' + this.n_id);
	if (!o_idiv) return;
	
	if (!o_idiv.innerHTML) {
		var a_children = [];
		for (var i = 0; i < this.a_children.length; i++)
			a_children[i]= this.a_children[i].init();
		o_idiv.innerHTML = a_children.join('');
	}
	o_idiv.style.display = (b_close ? 'none' : 'block');
	
	this.b_opened = !b_close;
	var o_jicon = document.images['j_img' + this.n_id],
		o_iicon = document.images['i_img' + this.n_id];
	if (o_jicon) o_jicon.src = this.get_icon(true);
	if (o_iicon) o_iicon.src = this.get_icon();
}

function item_init () {
	var a_offset = [],
		o_current_item = this.o_parent;
	for (var i = this.n_depth; i > 1; i--) {
		a_offset[i] = '<img class="bottom" alt="" src="' + this.o_root.a_tpl[o_current_item.is_last() ? 'icon_e' : 'icon_l'] + '" />';
		o_current_item = o_current_item.o_parent;
	}
	return (this.n_depth ? a_offset.join('') + (this.a_children.length ? '<a href="javascript: trees[' + this.o_root.n_id + '].toggle(' + this.n_id + ')"><img src="' + this.get_icon(true) + '" alt="" class="bottom" name="j_img' + this.n_id + '" /></a>' : '<img src="' + this.get_icon(true) + '" alt="" class="bottom" />') : '') + '<img src="' + this.get_icon() + '" alt="" class="bottom" name="i_img' + this.n_id + '" class="t' + this.o_root.n_id + 'im" />' + this.a_config[0] + '<br />' + (this.a_children.length ? '<div id="i_div' + this.n_id + '" style="display:none"></div>' : '');
}

function item_get_icon (b_junction) {
	return this.o_root.a_tpl['icon_' + ((this.n_depth ? 0 : 32) + (this.a_children.length ? 16 : 0) + (this.a_children.length && this.b_opened ? 8 : 0) + (!b_junction && this.o_root.o_selected == this ? 4 : 0) + (b_junction ? 2 : 0) + (b_junction && this.is_last() ? 1 : 0))];
}

var trees = [];
get_element = document.all ?
	function (s_id) { return document.all[s_id] } :
	function (s_id) { return document.getElementById(s_id) };
