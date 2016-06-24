/**
 * Edit-in-place with contentEditable property (FF2 is not supported)
 * Project page - http://valums.com/edit-in-place/
 * Copyright (c) 2008 Andris Valums, http://valums.com
 * Licensed under the MIT license (http://valums.com/mit-license/)
 * Version 0.4 (27.02.2009)
 */
(function(){
var d = document, w = window;

/**
 * Get element by id
 */	
function $(element){
	if (typeof element == "string")
		element = d.getElementById(element);
	return element;
}

/**
 * Attaches event to a dom element
 */
function addEvent(el, type, fn){
	if (w.addEventListener){
		el.addEventListener(type, fn, false);
	} else if (w.attachEvent){
		var f = function(){
		  fn.call(el, w.event);
		};			
		el.attachEvent('on' + type, f)
	}
}

if (jQuery){
	jQuery.fn.editable = function(onChange){
		return this.each(function(){
			editableAreas.add(this, onChange);
		});
	};
}

editableAreas = {
	enterDisabled : false
	,instances : []
	,active : null
	,inited : false
	,init : function(){
		var self = this;
		// attach enter keypress capturer to document
		addEvent(d, 'keypress', function(e){
			// find which key was pressed (code from jQuery library)
			if ( !e.which && ((e.charCode || e.charCode === 0) ? e.charCode : e.keyCode)){
				e.which = e.charCode || e.keyCode;
			}

			if (self.enterDisabled && (e.which == 13)) {
				if (e.preventDefault) e.preventDefault();
				else e.returnValue = false;
			}
		});

		addEvent(d, 'click', function(e){
			var target = e.target ? e.target : e.srcElement || document;

			while (target.nodeName != "HTML"
				&& target.nodeName != "BODY"
				&& target.contentEditable != true && target.contentEditable != 'true')
				// contentEditable is boolean in Opera
			{
				target = target.parentNode;
			}

			if (self.active && (self.active.el !== target)){
				// User clicked outside of editable area
				self.enterDisabled = false;
				self.active.onChange.call(self.active.el, self.active.el);
				self.active = null;
			}

			if ( ! self.active){
				var i = self.indexOfEditable(target);
				if (i !== -1){
					if (target.nodeName != 'DIV'){		
						//disable line breaks for h1..h5,p,etc ..
						self.enterDisabled = true;
					}
					self.active = self.instances[i];
				}
			}
		});

		this.inited = true;
	}
	,add : function(el, onChange){
		el = $(el);
		onChange = onChange ||	function(){};
		// FF2 doesn't support contentEditable
		el.contentEditable = true;
		this.instances.push({el:el, onChange:onChange});
		
		if (!this.inited) this.init();		
	}
	,indexOfEditable : function(el){
		for (var i=0, length = this.instances.length; i < length; i++){				
			if (this.instances[i].el === el){
				return i;
			}	
		}				
		return -1;
	}
	
	};
})();
