;
(function ( $, window, document, undefined ) {
	'use strict';
	var PLUGIN_NAME = 'ecsSelect';
	// The actual plugin constructor
	function Plugin() {
		this._state = [];
		this.defaults = {
			emptyText: '- dowolne -',
			selectAllLabel: 'Wszystkie',
			width: false,
			withToggle: false,
			onChange: null,
			onOpen: null,
			onClose: null,
            onComplete: null
		};
	}

	$.extend(Plugin.prototype, {
		init: function (element, options) {
			if (this._getInstance(element)) {
				return false;
			}

			var self = this, mainContainer,
			instance = self._newInstance(element);

			self._state[instance.uid] = false;

			$.extend(instance.settings, self.defaults, options);

			instance.multiselect = $(instance.element).attr('multiple') != undefined ? true : false;

			mainContainer = (instance.multiselect === true) ? self._multiSelect(instance) : self._select(instance);

			$(instance.element).after(mainContainer);
			$(instance.element).hide();

			$.data(element, PLUGIN_NAME, instance);

			$("html").live('mousedown', function(e) {
				$('select').ecsSelect('close');
			});

			$(".toggle-container, .text-element").live('mousedown', function(e) {
                if (self._state[instance.uid]) {
                    e.stopPropagation();
                }
			});

		},
		_getInstance: function(target) {
			try {
				return $.data(target, PLUGIN_NAME);
			}
			catch (err) {
				throw 'Ups. Coś się zepsuło';
			}
		},
		_newInstance: function(element) {
			var id;
			if (typeof $(element).attr("id") !== 'undefined') {
				id = $(element).attr("id");
			} else {
				id = $.now();
				$(element).attr('id', id);
			}
			return {
				id: id,
				uid: $.now(),
				element: element,
				isOpen: false,
				settings: {}
			};
		},
		_synchornizeSelect: function(clickedElement, instance) {
			//wszystkie elementy
			if (clickedElement.attr('id') === 'select-all_' + instance.uid) {
				$(instance.element).find('option').attr("selected", clickedElement.is(":checked"));
				return;
			}
            //clear button
            if (clickedElement.attr('id') == 'clear') {
                $(instance.element).find('option').attr("selected", false);
            }

			//zaznaczanie pojedynczego elementu
			var checkboxValue = clickedElement.val();
			$(instance.element).find('option[value="' + checkboxValue + '"]').attr("selected", clickedElement.is(":checked"));
		},
		_fillTextContainer: function (element, instance) {
			var tab = [];
			var currentTxt = $(instance.textElement).text(), current = '';
			if (currentTxt != instance.settings.emptyText) {
				current = currentTxt.split(",");
			}

			if(current != ''){
				tab = tab.concat(current);
			}

			if (element.is(":checked") === true) {
				tab.push(element.next().text());
			} else {
				tab = $.grep(tab, function(value) {
					return value != element.next().text();
				});
			}
			$(instance.textElement).text((tab.length != 0) ? tab.join(",") : instance.settings.emptyText);
			(tab.length != 0) ? $(instance.textElement).removeClass('default-grey') : $(instance.textElement).addClass('default-grey');
		},
		_getAll: function(element, instance) {
			var tab = [];
			if (element.is(":checked") === true) {
				$(instance.element).find('option').each(function(){
					tab.push($(this).text());
				});
				$(instance.textElement).text(tab.join(","));
				$(instance.textElement).removeClass('default-grey');
			} else {
				$(instance.textElement).text(instance.settings.emptyText);
				$(instance.textElement).addClass('default-grey');
			}
		},
		_checkSelectAllCheckbox: function(checkbox, instance) {
			var parentUl = checkbox.parent().parent();
			if ($(instance.checkboxSelectAll).is(":checked")) {
				$(instance.checkboxSelectAll).prop("checked", false);
			}

			if (!$(parentUl).find('input[type=checkbox]:not(:checked)').length){
				$(instance.checkboxSelectAll).prop('checked', true);
			}
		},
		_openSelectbox: function (target) {
			var instance = this._getInstance(target),
			    onOpen = this._get(instance, 'onOpen'),
                left = -1,
                top = $(instance.toggleContainer).outerHeight() - 1;
            if (!instance || instance.isOpen || instance.isDisabled) {
				return;
			}
			instance.optionsContainer.css({
				left:  left + "px",
				top:  top + "px"
			});
			instance.isOpen = true;
			this._state[instance.uid] = true;
			if (onOpen) {
				onOpen.apply((instance.element ? instance.element[0] : null), [instance]);
			}
			$.data(target, PLUGIN_NAME, instance);
		},
		_closeSelectbox: function (target) {
			var instance = this._getInstance(target);
			if (!instance || !instance.isOpen) {
				return;
			}
			var onClose = this._get(instance, 'onClose');
			instance.optionsContainer.css({
				left: '-33000px',
				top: '-33000px'
			});
			instance.isOpen = false;
			this._state[instance.uid] = false;

			if (onClose) {
				onClose.apply((instance.element ? instance.elemen[0] : null), [instance]);
			}
            this._complete(target, instance);
			$.data(target, PLUGIN_NAME, instance);
		},
		_get: function(inst, name) {
			return inst.settings[name] !== undefined ? inst.settings[name] : this.defaults[name];
		},
		_multiSelect: function(instance) {
			var optionsContainer, closeButton, ul, topLi, label, checkbox,
				buttonsDiv, closeTrigger, clearButton, chooseButton, mainContainer,
				textElement, toggleElement, wrapper, elementsInColumn, optionsUl,
				optionsLength = $(instance.element).find("option").length, numberColumns = 1,
				self = this;


			if (optionsLength > 14) {
				numberColumns = (optionsLength%14 == 0) ? (optionsLength/14) : (Math.ceil(optionsLength/14));
			}
			elementsInColumn = (optionsLength >= 56) ? Math.ceil(optionsLength/4) : 14;
			numberColumns = (numberColumns < 4) ? numberColumns : 4;
			instance.optionsUlWidth = parseInt(100/numberColumns);

			$(instance.element).attr('sel', instance.uid);

			function closeOthers() {
				var key, select,
				uid = this.attr("id").split("_")[1];

				for (key in self._state) {
					if (key !== uid) {
						if (self._state.hasOwnProperty(key)) {
							select = $("select[sel='" + key + "']")[0];
							if (select) {
								self._closeSelectbox(select);
							}
						}
					}
				}
			}

			optionsContainer = $('<div />', {
				'id': "ul-container-" + instance.uid,
				'class': 'ul-container',
				'css': {
					'left': '-33000px',
					'top': '-33000px'
				},
				'click': function(e){
					e.stopPropagation();
				},
				'mousedown': function(e){
					e.stopPropagation();
				}

			});

			closeButton = $('<div>', {
				'class': 'close-button'
			});

			closeTrigger = $("<div>", {
				'class': 'close',
				'text': '',
				'click': function(){
					self._closeSelectbox(instance.element);
				}
			});
			closeTrigger.appendTo(closeButton);
			closeButton.appendTo(optionsContainer);

			ul = $('<ul/>', {
				'class': 'top-level',
				'id': 'top-level-' + instance.uid
			});

			instance.topLevelUl = ul;

			topLi = $('<li></li>', {
				'class': 'top-level-li'
			});
			checkbox = $("<input/>", {
				'type': 'checkbox',
				'name': 'select-all',
				'id': 'select-all_' + instance.uid,
				'click': function(e){
					e.stopImmediatePropagation();
					var all = $(this);
					all.next().next().find('li input').prop("checked", all.is(':checked'));
					self._synchornizeSelect(all, instance);
					self._getAll(all, instance);
				}
			});

			instance.checkboxSelectAll = checkbox;

			label = $("<label />", {
				'for': 'select-all_' + instance.uid,
				'text': instance.settings.selectAllLabel
			});


			checkbox.appendTo(topLi);
			label.appendTo(topLi);
			topLi.appendTo(ul);
			ul.appendTo(optionsContainer);

			buttonsDiv = $('<div/>', {
				'class': 'buttons'
			});

			clearButton = $('<a>', {
				'class': 'clear-button',
				'text': 'wyczyść zaznaczenia',
				'id': 'clear',
				'click': function(e){
					$(this).parent().prev().find('li input').prop("checked", false);
					self._synchornizeSelect($(this), instance);
					self._getAll($(this), instance);
					instance.textElement.addClass('default-grey');
				}
			});

			chooseButton = $('<a>', {
				'id': 'choose',
				'class': 'choose',
				'click': function(){
					self._closeSelectbox(instance.element);
				}
			});

            var img = $("<span>");
			img.appendTo(chooseButton);

			mainContainer = $("<div>", {
				'class': 'toggle-container',
                'id': 'toggle-container_' + instance.uid
			});

			if (instance.settings.width) {
				mainContainer.css({
					width: instance.settings.width + 'px'
				});
			}

			textElement = $("<span/>", {
				'class': 'text-element default-grey',
				'id': 'text-element_' + instance.uid,
				'text': instance.settings.emptyText,
				'click': function(e) {
                    e.stopImmediatePropagation();
					closeOthers.apply($(this), []);
					var id = $(this).attr("id").split("_")[1];
					if (self._state[id] == true) {
						self._closeSelectbox(instance.element);
					} else {
						self._openSelectbox(instance.element);
					}
				}
			});

			toggleElement = $("<span/>", {
				'class': 'toggle-element',
				'id': 'toggle-element_' + instance.uid,
				'click': function(e) {
					e.stopImmediatePropagation();
					closeOthers.apply($(this), []);
					var id = $(this).attr("id").split("_")[1];
					if (self._state[id] == true) {
						self._closeSelectbox(instance.element);
					} else {
						self._openSelectbox(instance.element);
					}
				}
			});

			wrapper = $('<div>', {
				'class': 'list-wrapper'
			});
			optionsUl = $('<ul />', {
				'class': 'select-values',
				'id': 'select-values',
                css: {
                    'width': instance.optionsUlWidth + '%'
                }
			});
            var labelLength = 0, selectedTxt = [];
			$(instance.element).children().each(function(i, option){
				var value, li, label, text = '', input, disabled, checked = false;

				value = $(option).attr('value');
				disabled = $(option).attr('disabled');
				text = $(option).text();
				if (text.length > labelLength) {
                    labelLength = text.length;
                }
                if ($(option).is(":selected")) {
					checked = true;
					selectedTxt.push(text);
				}

				if (disabled == 'disabled') {
					li = $('<li>', {
						'class': 'dividingLine'
					});
					$(optionsUl).find('li').each(function (j, liElem) {
						$(liElem).addClass('beforeLine');
					});
				} else {
					input = $("<input />", {
						'type': 'checkbox',
						'id': instance.uid + '-item-' + i,
						'name': '',
						'value': value,
						'checked': checked,
						'click': function(e) {
							e.stopImmediatePropagation();
							self._synchornizeSelect($(this), instance);
							self._fillTextContainer($(this), instance);
							self._checkSelectAllCheckbox($(this), instance);
						}
					});

					label = $('<label>', {
						'for': instance.uid + '-item-' + i,
						'text': text,
						'click': function(e) {
							e.stopImmediatePropagation();
						}
					});

					li = $('<li>', {
						'mouseover': function(e){
							var $this = $(this);
								$this.siblings().removeClass('focus');
								$this.addClass("focus");
						},
						'mouseout': function(e){
							$(this).removeClass("focus");
						}
					});
					input.appendTo(li);
					label.appendTo(li);
				}

				if (i%elementsInColumn == 0 && i > 0) {
					li.appendTo(optionsUl);
					optionsUl.appendTo(wrapper);
					optionsUl = '';
					optionsUl = $('<ul />', {
						'class': 'select-values',
						'id': 'select-values_'+i,
                        css: {
                           'width': instance.optionsUlWidth + '%'
                        }
					});
				}
				li.appendTo(optionsUl);
			});
			if (selectedTxt.length > 0) {
				textElement.text(selectedTxt.join(","));
				textElement.removeClass('default-grey');
			}
			optionsUl.appendTo(wrapper);
			wrapper.append($('<div class="clear" />'));

			wrapper.appendTo(topLi);

			textElement.appendTo(mainContainer);
			toggleElement.appendTo(mainContainer);
			clearButton.appendTo(buttonsDiv);
			chooseButton.appendTo(buttonsDiv);

			buttonsDiv.appendTo(optionsContainer);

			instance.textElement = textElement;
			instance.optionsContainer = optionsContainer;

            optionsContainer.css({
                width: (labelLength*8*numberColumns+instance.optionsUlWidth) + 'px'
            });
            optionsContainer.appendTo(mainContainer);
            instance.toggleContainer = mainContainer;
			return mainContainer;
		},
		_select: function(instance) {
			var mainContainer,textElement,toggleElement,wrapper,optionsUl,optionsContainer,
				self = this;


			$(instance.element).attr('sel', instance.uid);

			function closeOthers() {
				var key, select,
				uid = this.attr("id").split("_")[1];

				for (key in self._state) {
					if (key !== uid) {
						if (self._state.hasOwnProperty(key)) {
							select = $("select[sel='" + key + "']")[0];
							if (select) {
								self._closeSelectbox(select);
							}
						}
					}
				}
			}

			mainContainer = $("<div>", {
				'class': 'toggle-container single-select',
                'id': 'toggle-container_' + instance.uid
			});

			if (instance.settings.width) {
				mainContainer.css({
					width: instance.settings.width + 'px'
				});
			}

			optionsContainer = $('<div />', {
				'id': "ul-container-" + instance.uid,
				'class': 'ul-container select-element',
				'css': {
					'left': '-33000px',
					'top': '-33000px'
				},
				'click': function(e){
					e.stopPropagation();
				},
				'mousedown': function(e){
					e.stopPropagation();
				}

			});
			textElement = $("<span/>", {
				'class': 'text-element default-grey',
				'id': 'text-element_' + instance.uid,
				'text': instance.settings.emptyText,
				'click': function(e) {
					e.preventDefault();
					closeOthers.apply($(this), []);
					var id = $(this).attr("id").split("_")[1];
					if (self._state[id] == true) {
						self._closeSelectbox(instance.element);
					} else {
						self._openSelectbox(instance.element);
					}
				}
			});
          if (instance.settings.withToggle == true) {
			  toggleElement = $("<span/>", {
				'class': 'toggle-element',
				'id': 'toggle-element_' + instance.uid,
				'click': function(e) {
					e.preventDefault();
					closeOthers.apply($(this), []);
					var id = $(this).attr("id").split("_")[1];
					if (self._state[id] == true) {
						self._closeSelectbox(instance.element);
					} else {
						self._openSelectbox(instance.element);
					}
				}
			});
			toggleElement.appendTo(mainContainer);
		  }


			wrapper = $('<div>', {
				'class': 'list-wrapper'
			});
			optionsUl = $('<ul />', {
				'class': 'select-values',
				'css': {
					width: '100%'
				}
			});

			var liLength = 0;
			$(instance.element).children().each(function(i, option){
				var value, li, a, text = '';

				value = $(option).attr('value');
				text = $(option).text();
                if ($(option).is(":selected")) {
					textElement.text(text);
					textElement.removeClass('default-grey');
				}
				if (value == '') {
					textElement.addClass('default-grey');
				}
				a = $('<a>', {
					'text': text,
					'href': '#'+value,
					'rel': value,
                    'class': $(instance.element).attr('name') + "_" + value.replace(";","_"),
					'click': function(e) {
						e.preventDefault();
						self._changeSelectbox(instance.element, value, text, instance);
						self._closeSelectbox(instance.element);
					},
					'mouseover': function(e){
						var $this = $(this);
							$this.parent().siblings().find("a").removeClass('focus');
							$this.addClass("focus");
					},
					'mouseout': function(e){
						$(this).removeClass("focus");
					}
				});
				li = $('<li />');

				a.appendTo(li);
				if (text.length > liLength) {
                    liLength = text.length;
                }
				li.appendTo(optionsUl);
			});
			optionsUl.appendTo(wrapper);

			optionsContainer.css({
                width: (liLength*7*1+20) + 'px'
            });
			wrapper.appendTo(optionsContainer);
			textElement.appendTo(mainContainer);

			optionsContainer.appendTo(mainContainer);
			instance.toggleContainer = mainContainer;
			instance.optionsContainer = optionsContainer;
			return mainContainer;
		},
		_changeSelectbox: function (target, value, text, inst) {
			var onChange;
			if (inst) {
				onChange = this._get(inst, 'onChange');
				$("#text-element_" + inst.uid).text(text);
			}
			value = value.replace(/\'/g, "\\'");
			(value != '') ? $("#text-element_" + inst.uid).removeClass('default-grey') : $("#text-element_" + inst.uid).addClass('default-grey');
			$(target).find("option[value='" + value + "']").attr("selected", true);

			if (inst && onChange) {
				onChange.apply((inst.element ? inst.element[0] : null), [value, inst]);
			} else if (inst && inst.element) {
				$(inst.element).trigger('change');
			}
		},
        _complete: function (element, instance) {
            var onComplete = this._get(instance, 'onComplete'),
                selected = $(element).find('option:selected');
            if (instance && onComplete && selected.length > 0) {
				onComplete.apply((instance.element ? instance.element[0] : null), [selected, instance]);
			} else if (instance && instance.element && selected.length > 0) {
                $(instance.element).trigger('onComplete');
            }

        },
		_detachSelectbox: function (target) {
			var inst = this._getInstance(target);
			if (!inst) {
				return false;
			}
			$("#toggle-container_" + inst.uid).remove();
			$.data(target, PLUGIN_NAME, null);
			$(target).show();
		},
		_enableSelectbox: function (target) {
			var inst = this._getInstance(target);
			if (!inst || !inst.isDisabled) {
				return false;
			}
			$("#toggle-container_" + inst.uid).removeClass('disabled');
			inst.isDisabled = false;
			$.data(target, PLUGIN_NAME, inst);
		},
		_disableSelectbox: function (target) {
			var inst = this._getInstance(target);
			if (!inst || inst.isDisabled) {
				return false;
			}
			$("#toggle-container_" + inst.uid).addClass('disabled');
			inst.isDisabled = true;
			$.data(target, PLUGIN_NAME, inst);
		}
	});

	$.fn.ecsSelect = function(options) {
//        console.log(options);
		var otherArgs = Array.prototype.slice.call(arguments, 1);

        if (options == 'option' && arguments.length == 2 && typeof arguments[1] == 'string') {
			return $.ecsSelect['_' + options + 'Selectbox'].apply($.ecsSelect, [this[0]].concat(otherArgs));
		}
		return this.each(function() {
			typeof options == 'string' ?
			$.ecsSelect['_' + options + 'Selectbox'].apply($.ecsSelect, [this].concat(otherArgs)) :
			$.ecsSelect.init(this, options);
		});
	};

	$.ecsSelect = new Plugin();
})(jQuery, window, document);
