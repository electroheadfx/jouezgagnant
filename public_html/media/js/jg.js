
/* ----------------------------------------------------------------------
   ---------------------------------------------------------------------- */

jg = new function () {
	/* public variables ------------------------------------------------- */
	this.baseURL = '/';

	/* private variables ------------------------------------------------ */

	/* public functions ------------------------------------------------- */
	this.init = function () {
	}
	
	this.showScreen = function () {
		createScreen();
		$('.screen').height($(document).height() + 'px');
		$('.screen').width($(document).width() + 'px');
		$('.screen').show();
	}
	
	this.hideScreen = function () {
		$('#screen').hide();
	}
	
	this.setBaseURL = function (base) {
		this.baseURL = base;
	}
	
	this.URL = function (url) {
		return this.baseURL + url;
	}
	
	this.stripSlashes = function (str) {
	    var re = /[\/\\]/g;
	    return str.replace(re, "");
	}
	
	this.modalMessage = function (msg) {
		
	}
	

	/* private functions ------------------------------------------------ */
	function createScreen () {
		if ($('#screen').length < 1) {
			var ele = document.createElement("div");
			ele.id = 'screen';
			ele.className = 'screen';
			document.body.appendChild(ele);
		}
	}
	
	function createMessagePane (msg) {
		
	}

};

jg.subscriptions = new function () {

	/* public variables ------------------------------------------------- */

	/* private variables ------------------------------------------------ */
	
	/* public functions ------------------------------------------------- */
	this.agree = function () {
		if ($('#agree').attr('checked')) {
			return true;
		}
		$('#agree_border').css("border", "3px solid #f00");
		$('#agree_border').css("padding", "2px");
		return false;
	}
};

jg.predictions = new function () {
	/* public variables ------------------------------------------------- */

	/* private variables ------------------------------------------------ */
	var active_tab = 'info';

	/* public functions ------------------------------------------------- */
	this.calculate = function () {
		var horseCount = 0;
		var horseOdds = getOdds();
		var emu = parseInt($('#emulation_amount').val());
		if (isNaN(emu)) {
			displayError('Emulation Amount must be an integer.', 'console');
			return false;
		}
		var weight = emu + (emu * 10) / 100;
		
		var totalBet = 0;
		var b1 = getBet(1, horseOdds, weight);
		if (b1 !== "--") { totalBet += b1; }
		var b2 = getBet(2, horseOdds, weight);
		if (b2 !== "--") { totalBet += b2; }
		var b3 = getBet(3, horseOdds, weight);
		if (b3 !== "--") { totalBet += b3; }
		
		var seek = (horseOdds.average * weight) - totalBet;
		
		$('#euro1').text(b1);
		$('#euro2').text(b2);
		$('#euro3').text(b3);

		$('#totalbet').text(totalBet);
		$('#seek_amount').text(seek.toFixed(2));
	}
	
	this.adjust_emu = function (type) {
		var emu = parseInt($('#emulation_amount').val());
		if (isNaN(emu)) {
			$('#emulation_amount').val(100);
			return;
		}
		if (type === 'down') {
			$('#emulation_amount').val(emu - 1);
		} else {
			$('#emulation_amount').val(emu + 1);
		}
		jg.predictions.calculate();
		return false;
	}
	
	this.toggle_pmu = function (to) {
		switch (to) {
			case "info":
			case "pmu":
			case "today":
				$('#' + active_tab + '_handle').removeClass('on');
				$('#' + active_tab + '_handle').addClass('off');
				$('#' + active_tab + '_display').css('display', 'none');

				$('#' + to + '_handle').removeClass('off');
				$('#' + to + '_handle').addClass('on');
				$('#' + to + '_display').css('display', 'block');
				
				active_tab = to;
				break;
				
			default:
				break;
		}
	}
	
	/* private functions ------------------------------------------------ */
	function displayError (msg, ele) {
		if (ele === "console") {
//			console.log("An error occured: %s", msg);
		}
	}
	
	function getBet (place, odds, weight) {
		if (odds[place] !== 'empty') {
			var bet = odds.average * (weight/odds[place]);
			return Math.round(bet);
		} else {
			return "--";
		}
	}
	
	function getOdds () {
		var odds = new Object();
		odds.total = 0;
		odds.count = 0;
		for (var i = 1; i <=3; i++) {
			var bet = "pp" + i;
			var ele = "odd" + i;
			var b = parseInt($('#' + bet).val());
			var c = parseFloat($('#' + ele).val());
			if (!isNaN(c) && c > 0 && !isNaN(b) && b > 0) {
				odds[i] = c;
				odds.total += c;
				odds.count++;
			} else {
				odds[i] = 'empty';
			}
		}
		odds.average = odds.total / odds.count;
		return odds;
	}
	
};

jg.admin = new function () {
	/* public variables ------------------------------------------------- */
	this.release = 1;

	/* private variables ------------------------------------------------ */
	var loaded = false;


	/* public functions ------------------------------------------------- */
	this.init = function () {
	
	}
	
	this.displayMessage = function (msg) {
		$('#status_message').css({display: 'block'});
		$('#status_message').text(msg);
		messagePulse();
	}
	
	this.clearMessage = function () {
		$('#status_message').fadeTo(500, 0);
		$('#status_message').css({display: 'none'});
		$('#status_message').text('');
		$('#status_message').stop();
	}
	

	/* private functions ------------------------------------------------ */
	function messagePulse () {
		$('#status_message').fadeTo(3000, 1);
		$('#status_message').fadeTo(3000, 0.25, messagePulse);
	}
};

jg.admin.races = new function () {
	/* public variables ------------------------------------------------- */

	/* private variables ------------------------------------------------ */

	/* public functions ------------------------------------------------- */
	this.create = function () {
		jg.showScreen();
		var pos = $('#top_left').position();
		$('#edit_detail').css('top', pos.top + 'px');
		$('#edit_detail').css('left', pos.left + 'px');
		$('a#create_race').css('display', 'none');
		$('#edit_detail').show();
		$('.admin_form').attr('action', jg.URL('admin/races/create'));
		return false;
	}
	
	this.edit = function () {
		jg.showScreen();
		var pos = $('#top_left').position();
		$('#edit_detail').css('top', pos.top + 'px');
		$('#edit_detail').css('left', pos.left + 'px');
		$('a#create_race').css('display', 'none');
		$('#edit_detail').show();
		$('.admin_form').attr('action', jg.URL('admin/races/edit/'+current_race));
		$('#submit_race').text('edit');
		$('#edit_message').text('Edit Race');
		return false;
	}

	this.cancel = function () {
		$('#edit_detail').hide();
		$('a#create_race').css('display', 'block');
		jg.hideScreen();
		return false;
	}
	
	this.submit = function () {
		$('.admin_form').submit();
	}
	
	this.filterDate = function (date) {
//		console.log("Filtering on: %s", date);
		window.location.href = jg.URL('admin/races/view/'+jg.stripSlashes(date));
	}

	/* private functions ------------------------------------------------ */
};

jg.admin.race_days = new function () {
	/* public variables ------------------------------------------------- */

	/* private variables ------------------------------------------------ */

	/* public functions ------------------------------------------------- */
	this.create = function () {
		jg.showScreen();
		var pos = $('#top_left').position();
		$('#edit_detail').css('top', pos.top + 'px');
		$('#edit_detail').css('left', pos.left + 'px');
		$('a#create_race_day').css('display', 'none');
		$('#edit_detail').show();
		$('.admin_form').attr('action', jg.URL('admin/race_days/create'));
		return false;
	}
	
	this.edit = function () {
		jg.showScreen();
		var pos = $('#top_left').position();
		$('#edit_detail').css('top', pos.top + 'px');
		$('#edit_detail').css('left', pos.left + 'px');
		$('a#create_race_day').css('display', 'none');
		$('#edit_detail').show();
		$('.admin_form').attr('action', jg.URL('admin/race_days/edit/'+current_race_day));
		$('#submit_race_days').text('edit');
		$('#edit_message').text('Edit Race Day');
		return false;
	}

	this.cancel = function () {
		$('#edit_detail').hide();
		$('a#create_race_day').css('display', 'block');
		jg.hideScreen();
		return false;
	}
	
	this.submit = function () {
		$('.admin_form').submit();
	}
	
	this.filterDate = function (date) {
//		console.log("Filtering on: %s", date);
		window.location.href = jg.URL('admin/race_days/view/'+jg.stripSlashes(date));
	}

	/* private functions ------------------------------------------------ */
};

jg.admin.pages = new function () {
	/* public variables ------------------------------------------------- */

	/* private variables ------------------------------------------------ */

	/* public functions ------------------------------------------------- */
	this.create = function () {
		jg.showScreen();
		var pos = $('#top_left').position();
		$('#edit_detail').css('top', pos.top + 'px');
		$('#edit_detail').css('left', pos.left + 'px');
		$('a#create_page').css('display', 'none');
		$('#edit_detail').show();
		$('#page_admincreate_form').attr('action', jg.URL('admin/pages/create'));
		return false;
	}
	
	this.edit = function () {
		jg.showScreen();
		var pos = $('#top_left').position();
		$('#edit_detail').css('top', pos.top + 'px');
		$('#edit_detail').css('left', pos.left + 'px');
		$('a#create_page').css('display', 'none');
		$('#edit_detail').show();
		$('#page_adminedit_form').attr('action', jg.URL('admin/pages/edit/'+current_page));
		$('#submit_page').text('edit');
		$('#edit_message').text('Edit Page');
		return false;
	}
	
	this.cancel = function () {
		$('#edit_detail').hide();
		$('a#create_page').css('display', 'block');
		jg.hideScreen();
		return false;
	}
	
	this.submit = function () {
		$('.admin_form').submit();
	}
	
	/* private functions ------------------------------------------------ */
	
};

jg.admin.orders = new function () {
	/* public variables ------------------------------------------------- */

	/* private variables ------------------------------------------------ */

	/* public functions ------------------------------------------------- */
	this.edit = function () {
		jg.showScreen();
		var pos = $('#top_left').position();
		$('#edit_detail').css('top', pos.top + 'px');
		$('#edit_detail').css('left', pos.left + 'px');
		$('a#create_page').css('display', 'none');
		$('#edit_detail').show();
		//$('#page_adminedit_form').attr('action', jg.URL('admin/pages/edit/'+current_page));
		$('#submit_page').text('edit');
		$('#edit_message').text('View Order');
		return false;
	}
	
	this.submit = function () {
		//$('.admin_form').submit();
	}
	
	/* private functions ------------------------------------------------ */
	
};

jg.admin.users = new function () {
	/* public variables ------------------------------------------------- */

	/* private variables ------------------------------------------------ */

	/* public functions ------------------------------------------------- */
	this.create = function () {
		jg.showScreen();
		var pos = $('#top_left').position();
		$('#edit_detail').css('top', pos.top + 'px');
		$('#edit_detail').css('left', pos.left + 'px');
		$('a#create_account').css('display', 'none');
		$('#edit_detail').show();
		$('#user_admincreate_form').attr('action', jg.URL('admin/users/create'));
		return false;
	}
	
	this.edit = function () {
		jg.showScreen();
		var pos = $('#top_left').position();
		$('#edit_detail').css('top', pos.top + 'px');
		$('#edit_detail').css('left', pos.left + 'px');
		$('a#create_account').css('display', 'none');
		$('#edit_detail').show();
		$('#user_adminedit_form').attr('action', jg.URL('admin/users/edit/'+current_user));
		$('#submit_account').text('edit');
		$('#edit_message').text('Edit Account');
		return false;
	}
	
	this.cancel = function () {
		$('#edit_detail').hide();
		$('a#create_account').css('display', 'block');
		jg.hideScreen();
		return false;
	}
	
	this.submit = function () {
		$('.admin_form').submit();
	}
	
	/* private functions ------------------------------------------------ */
	
};

jg.admin.media = new function () {
	/* public variables ------------------------------------------------- */

	/* private variables ------------------------------------------------ */

	/* public functions ------------------------------------------------- */
	this.create = function () {
		jg.showScreen();
		var pos = $('#top_left').position();
		$('#edit_detail').css('top', pos.top + 'px');
		$('#edit_detail').css('left', pos.left + 'px');
		$('a#create_media').css('display', 'none');
		$('#edit_detail').show();
		$('#media_admincreate_form').attr('action', jg.URL('admin/media/create'));
		return false;
	}
	
	this.edit = function () {
		jg.showScreen();
		var pos = $('#top_left').position();
		$('#edit_detail').css('top', pos.top + 'px');
		$('#edit_detail').css('left', pos.left + 'px');
		$('a#create_media').css('display', 'none');
		$('#edit_detail').show();
		$('#media_adminedit_form').attr('action', jg.URL('admin/media/edit/'+current_media));
		$('#submit_account').text('edit');
		$('#edit_message').text('Edit Media');
		return false;
	}
	
	this.cancel = function () {
		$('#edit_detail').hide();
		$('a#create_media').css('display', 'block');
		jg.hideScreen();
		return false;
	}
	
	this.submit = function () {
		$('.admin_form').submit();
	}
	
	/* private functions ------------------------------------------------ */
	
};