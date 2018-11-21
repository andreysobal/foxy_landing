// smooth scroll to the anchor id
function scrollToTop() {
	var top = $('#top').offset().top;
	setTimeout(function() {
		$('html, body').animate({
			scrollTop: top
		}, 1500);
	}, 10);
}

//change images to color
let partners = document.querySelectorAll('.labels__item');
for (var i = partners.length - 1; i >= 0; i--) {
	partners[i].addEventListener('touchstart', function(event) {
		setActive(event.currentTarget);
	});
	partners[i].addEventListener('mouseenter', function(event) {
		setActive(event.target);
	});
}

function setActive (el) {
	document.querySelector('.active').classList.remove('active');
	el.classList.add('active');
}

