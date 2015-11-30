$(document).ready(function() {
	function randomNumber(min, max) {
		return Math.floor(Math.random() * (max - min + 1) + min);
	};

	function generateCaptcha() {
		$('#captchaOperation').html([randomNumber(1, 100), '+', randomNumber(1, 200), '='].join(' '));
	};
	generateCaptcha();
	$("form").bootstrapValidator({
		message: 'This value is not valid',
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
		invalid: 'glyphicon glyphicon-remove',
		validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			captcha: {
				validators: {
					callback: {
						message: 'Wrong answer',
		callback: function (value, validator, $field) {
			// Determine the numbers which are generated in captchaOperation
			var items = $('#captchaOperation').html().split(' '),
		sum   = parseInt(items[0]) + parseInt(items[2]);
	return value == sum;
		}
					}
				}
			},
			faction: {
				message: 'Faction is mandatory',
				validators: {
					stringLength: {
						min: 3,
						message: 'Character name is required, and must be at least 3 chars long'
					},
					notEmpty: {
						message: 'Faction is mandatory'
					}
				}
			},
			'class': {
				message: 'Class is mandatory',
				validators: {
					notEmpty: {
						message: 'Class is mandatory'
					}
				}
			},
			type: {
				message: 'Record type is mandatory',
				validators: {
					notEmpty: {
						message: 'Record type is mandatory'
					}
				}
			},
			wztype: {
				message: 'Warzone type is mandatory',
				validators: {
					notEmpty: {
						message: 'Warzone type is mandatory'
					}
				}
			},
			character: {
				message: 'Character name is required, and must be at least 3 chars long',
				validators: {
					stringLength: {
						min: 3,
						message: 'Character name is required, and must be at least 3 chars long'
					},
					notEmpty: {
						message: 'Character name is required, and must be at least 3 chars long'
					}
				}
			},
			url: {
				message: 'URL to proof is mandatory',
				validators: {
					regexp: {
						regexp: /^http:\/\/i\.imgur\.com\/.+(jpg|png|jpeg|gif)$|^http\:\/\/assets-cloud.enjin.com\/.+(jpg|png|jpeg|gif)$/,
						message: 'Images must be uploaded to imgur.com or enjin, and the url must be directly to image'
					},
					notEmpty:{
						message: 'URL is mandatory'
					}
				}
			},
			amount: {
				message: 'Amount is mandatory',
				validators: {
					numeric: {
						message: 'Must be a number'
					},
					notEmpty:{
						message: 'Amount is mandatory'
					}
				}
			}
		},
	})
	.on('error.form.bv', function (e) {
		generateCaptcha();
	})
	.on('success.form.bv', function(e) {
		e.preventDefault();
		var $form = $(e.target);
		var bv = $form.data('bootstrapValidator');
		$.post( "ajax.php", $("form").serialize(), function( data ) {
			$('#result').append(data);
			console.log( "Data Loaded: " + data );
		});
	});
});
