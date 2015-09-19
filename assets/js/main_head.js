$.fn.focusWithoutScrolling = function(){
  var x = window.scrollX, y = window.scrollY;
  this.focus();
  window.scrollTo(x, y);
  return this; //chainability
};


$(document).ready( function() {

	
	// function email(){
	// 	var _0xb7dc=["\x23\x65\x6D\x61\x69\x6C","\x68\x72\x65\x66","\x6D\x61\x69\x6C\x74\x6F\x3A\x64\x61\x73\x6C\x69\x63\x68\x74\x40\x61\x6E\x73\x6F\x6C\x61\x73\x2E\x64\x65","\x61\x74\x74\x72","\x64\x61\x73\x6C\x69\x63\x68\x74\x40\x61\x6E\x73\x6F\x6C\x61\x73\x2E\x64\x65","\x74\x65\x78\x74"];var email=$(_0xb7dc[0]);email[_0xb7dc[3]](_0xb7dc[1],_0xb7dc[2]);email[_0xb7dc[5]](_0xb7dc[4]);
		
	// }
	// email();
	//var _0xe293=["\x23\x61\x64\x64\x72\x65\x73\x73","\x3C\x73\x74\x72\x6F\x6E\x67\x3E\x4D\x61\x72\x63\x20\x57\x65\x6E\x73\x61\x75\x65\x72\x20\x3C\x62\x72\x3E\x2D\x41\x4E\x53\x4F\x4C\x41\x53\x2D\x20\x3C\x62\x72\x3E\x20\x4F\x64\x65\x72\x73\x74\x72\x61\x73\x73\x65\x20\x35\x35","\x3C\x62\x72\x3E\x3C\x70\x3E\x44\x45\x20\x2D\x20\x32\x37\x34\x37\x34\x20\x43\x75\x78\x68\x61\x76\x65\x6E\x3C\x2F\x70\x3E\x3C\x2F\x73\x74\x72\x6F\x6E\x67\x3E","\x68\x74\x6D\x6C"];var address=$(_0xe293[0]);var s=_0xe293[1]+_0xe293[2];address[_0xe293[3]](s);
	//var _0xf44e=["\x23\x70\x68\x6F\x6E\x65","\x28\x30\x30\x34\x39\x29\x20\x30\x20\x34\x37\x20\x32\x31\x20\x2D\x20\x36\x38\x20\x31\x32\x20\x39\x37\x20","\x68\x74\x6D\x6C"];var phone=$(_0xf44e[0]);phone[_0xf44e[2]](_0xf44e[1]);


	function updateActiveCSSClass(req) {
  		$( "nav li a" ).each( function( index ) {
			var self = $(this);
			if(self.attr('href') != req.fullPath) {
				self.parent().removeClass('active');
			}else{
				$(this).parent().addClass('active');
			}
		});
	}

	var hijax = $("#hijax");
	function getContent(req) {
		updateActiveCSSClass(req);
		$.ajax({
		  url: req.path,
		  context: $("#hijax")
		}).done(function(data) {
			hijax.animate({
				opacity: 0
			}, 250, "easeInOutQuart", function() {
				hijax.html("");
	  			hijax.html(data);
				hijax.animate({
					opacity: 1,
				}, 250, "easeInOutQuart", function() {
					//email();
				});
			});

		});
	}


	var app = Davis(function () {
		
	  	this.get('/about', function (req) {
	  		getContent( req );
		});

		this.get('/contact', function (req) {
			getContent( req ); 
			
		});

		this.get('/', function (req) {
			getContent( req ); 
		});


	});
	app.start();
		console.log('main head scripts initialized...');

});