;(function($){
	$(function(){

		/**
		 * Validation
		 */
		if(typeof $.fn.validate !== 'undefined') { 

			// Validate method for Credit Card Number
			if(typeof $.fn.payment !== 'undefined') { 
			$.validator.addMethod( "creditcard", function( value, element ) {
				//var type  = $.payment.cardType(value);
				var valid = $.payment.validateCardNumber(value);
				return this.optional( element ) || valid;
			}, "Please enter a valid credit card number." );
			// @todo validate CVC and expiration
			}

			// Validate method for currency
			// @link https://github.com/jzaefferer/jquery-validation/blob/master/src/additional/currency.js
			$.validator.addMethod( "currency", function( value, element, param ) {
				var isParamString = typeof param === "string",
					symbol = isParamString ? param : param[ 0 ],
					soft = isParamString ? true : param[ 1 ],
					regex;

				symbol = symbol.replace( /,/g, "" );
				symbol = soft ? symbol + "]" : symbol + "]?";
				regex = "^[" + symbol + "([1-9]{1}[0-9]{0,2}(\\,[0-9]{3})*(\\.[0-9]{0,2})?|[1-9]{1}[0-9]{0,}(\\.[0-9]{0,2})?|0(\\.[0-9]{0,2})?|(\\.[0-9]{1,2})?)$";
				regex = new RegExp( regex );
				return this.optional( element ) || regex.test( value );
			}, "Please use a valid currency format" );

			// Validate method for file extensions
			$.validator.addMethod( "extension", function( value, element, param ) {
				param = typeof param === "string" ? param.replace( /,/g, "|" ) : "png|jpe?g|gif";
				return this.optional( element ) || value.match( new RegExp( "\\.(" + param + ")$", "i" ) );
			}, $.validator.format( "File type is not allowed" ) );

			// Validate method for file size
			// @link https://github.com/jzaefferer/jquery-validation/pull/1512
			$.validator.addMethod("maxsize", function(value, element, param) {
				var maxSize = param,
					optionalValue = this.optional(element),
					i, len, file;
				if (optionalValue) {
					return optionalValue;
				}
				if (element.files && element.files.length) {
					i = 0;
					len = element.files.length;
					for (; i < len; i++) {
						file = element.files[i];
						if (file.size > maxSize) {
							return false;
						}
					}
				}
				return true;
			}, $.validator.format("File exceeds max size allowed"));

			$('.wpforms-validate').each(function() {
				var form = $(this);
				var form_id = form.data('formid');

				if (typeof window['wpforms_'+form_id] != "undefined" && window['wpforms_'+id].hasOwnProperty('validate') ) {	
					properties = window['wpforms_'+id].validate;
				} else if ( typeof wpforms_validate != "undefined") {
					properties = wpforms_validate;
				} else {
					properties = {
						errorClass: 'wpforms-error',
						validClass: 'wpforms-valid',
						errorPlacement: function(error, element) {
							if (element.attr('type') == 'radio' || element.attr('type') == 'checkbox' ) {
								element.parent().parent().parent().append(error);
							} else {
								error.insertAfter(element);
							}
						}
					}
				}
				form.validate( properties );
			});
		}

		/**
		 * Date picker
		 */
		if(typeof $.fn.pickadate !== 'undefined') { 
			$('.wpforms-datepicker').each(function() {
				var element = $(this);
				var form = element.closest('.wpforms-form');
				var form_id = form.data('formid');

				if (typeof window['wpforms_'+form_id] != "undefined" && window['wpforms_'+id].hasOwnProperty('pickadate') ) {	
					properties = window['wpforms_'+id].pickadate;
				} else if ( typeof wpforms_pickadate != "undefined") {
					properties = wpforms_pickadate;
				} else {
					properties = {
						today: false,
						clear: false,
						close: false,
						format: element.data('format')
					}
				}
				element.pickadate(properties)
			});
		};

		/**
		 * Time picker
		 */
		if(typeof $.fn.pickatime !== 'undefined') { 
			$('.wpforms-timepicker').each(function() {
				var element = $(this);
				var form = $(this).closest('.wpforms-form');
				var form_id = form.data('formid');

				if (typeof window['wpforms_'+form_id] != "undefined" && window['wpforms_'+id].hasOwnProperty('pickatime') ) {	
					properties = window['wpforms_'+id].pickadate;
				} else if ( typeof wpforms_pickatime != "undefined") {
					properties = wpforms_pickatime;
				} else {
					properties = {
						clear: false,
						format: $(this).data('format'),
						interval: $(this).data('interval')		
					}
				}
				element.pickatime(properties);
			});
		}

		/**
		 * Masked Input
		 */
		if(typeof $.fn.inputmask !== 'undefined') { 
			$('.wpforms-masked-input').inputmask();
		};

		/**
		 * Credit Card
		 */
		if(typeof $.fn.payment !== 'undefined') { 
			$('.wpforms-field-credit-card-cardnumber').payment('formatCardNumber');
			$('.wpforms-field-credit-card-cardcvc').payment('formatCardCVC');
		};

		/**
		 * Page Break
		 */
		$(document).on('click', '.wpforms-page-button', function(event) {
			event.preventDefault();

			var $this   = $(this),
				valid   = true,
				action  = $(this).data('action'),
				page    = $this.data('page'),
				next    = page+1,
				prev    = page-1,
				formID  = $this.data('formid'),
				$form   = $this.closest('.wpforms-form'),
				$page   = $form.find('.wpforms-page-'+page),
				$submit = $form.find('.wpforms-submit-container');

			if ( action == 'next' ){
				// Validate
				if(typeof $.fn.validate !== 'undefined') { 
					$page.find('input.wpforms-field-required, select.wpforms-field-required, textarea.wpforms-field-required, .wpforms-field-required input').each(function(index, el) {
						var field = $(el);
						if ( field.valid() ) {
						} else {
							valid = false;
						}
					});
				}
				// Move to next page
				if (valid) {
					$page.hide();
					var $nextPage = $form.find('.wpforms-page-'+next);
					$nextPage.show();
					if ( $nextPage.hasClass('last') ) {
						$submit.show();
					}
					// Scroll to top of the form
					$('html, body').animate({
						scrollTop: $form.offset().top-75
					}, 1000);
				}
			} else if ( action == 'prev' ) {
				// Move to prev page
				$page.hide();
				$form.find('.wpforms-page-'+prev).show();
				$submit.hide();
				// Scroll to top of the form
				$('html, body').animate({
					scrollTop: $form.offset().top-75
				}, 1000);
			}
		});

		/**
		 * Payment Total calculation
		 */
		// Calculate total
		function calculate_total($form) {
			var total = 0.00;
			$('.wpforms-payment-price').each(function(index, el) {
				var amount = 0,
					$this  = $(this);
				if ( $this.attr('type') == 'text' ) {
					amount = $this.val();
				} else if ( $this.attr('type') == 'radio' && $this.is(':checked') ) {
					amount = $this.data('amount');
				}
				if ( amount != 0 ) {
					amount = amount.replace(/[^0-9.]/gi,'');
					amount = parseFloat(amount).toFixed(2).replace(/(\d)(?=(\d{6})+\.)/g, "$1,");
					total = parseFloat(total)+parseFloat(amount);
				}
			});
			return parseFloat(total).toFixed(2);
		}
		// Update Total field(s) with latest calculation
		function calculate_total_update(el) {
			var $form = $(el).closest('.wpforms-form'),
				total = calculate_total($form);
			if (isNaN(total)) {
				total = '0.00';
			}
			$form.find('.wpforms-payment-total').each(function(index, el) {
				if ( $(this).attr('type') == 'hidden' ) {
					$(this).val('$'+total);
				} else {
					$(this).text('$'+total);
				}
			});
		}
		// Update Total fields when price changes
		$(document).on('change input', '.wpforms-payment-price', function(event) {
			calculate_total_update( this );
		});
		// Set Total field on load
		$('.wpforms-payment-total').each(function(index, el) {
			calculate_total_update( this );
		})
	});
}(jQuery));