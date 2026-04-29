<?php

$brochure_file      = get_field('kh_brochure_file');
$brochure_shortcode = get_field('kh_brochure_form_shortcode', 'option');
$brochure_btn_title = get_field('kh_brochure_btn_title') ?: 'Tải brochure';
$course_title       = get_the_title();
$course_subtitle    = get_field('kh1_subtitle');

if (!$brochure_file) return;
?>

<section class="popup-wrapper" id="popup-brochure" data-pdf-url="<?php echo esc_url($brochure_file); ?>">
	<div class="overlay"></div>
	<div class="popup-content">
		<button class="close-btn" type="button" aria-label="Đóng">&times;</button>

		<div class="form-header mb-6 text-center">
			<h2 class="heading-2 text-primary-1 text-left">
				<?php echo esc_html($course_title); ?>
				<?php if ($course_subtitle): ?>
				<br><?php echo esc_html($course_subtitle); ?>
				<?php endif; ?>
			</h2>
		</div>

		<div class="form-body">
			<?php if ($brochure_shortcode): ?>
			<?php echo do_shortcode($brochure_shortcode); ?>
			<?php endif; ?>
		</div>
	</div>
</section>

<script>
(function() {
	var popup = document.getElementById('popup-brochure');
	if (!popup) return;

	var pdfUrl = popup.getAttribute('data-pdf-url');

	function triggerDownload(url) {
		if (!url) return;
		var a = document.createElement('a');
		a.href = url;
		a.setAttribute('download', '');
		a.setAttribute('target', '_blank');
		document.body.appendChild(a);
		a.click();
		document.body.removeChild(a);
	}

	document.addEventListener('click', function(e) {
		var trigger = e.target.closest('[data-toggle="popup-brochure"], [href="#popup-brochure"]');
		if (trigger) {
			e.preventDefault();
			popup.classList.add('active');
			document.body.classList.add('popup-open');
			return;
		}

		if (e.target.closest('.close-btn') || e.target === popup.querySelector('.overlay')) {
			popup.classList.remove('active');
			document.body.classList.remove('popup-open');
		}
	});

	document.addEventListener('keydown', function(e) {
		if (e.key === 'Escape' && popup.classList.contains('active')) {
			popup.classList.remove('active');
			document.body.classList.remove('popup-open');
		}
	});

	document.addEventListener('wpcf7mailsent', function(event) {
		if (!popup.contains(event.target)) return;
		triggerDownload(pdfUrl);
		setTimeout(function() {
			popup.classList.remove('active');
			document.body.classList.remove('popup-open');
		}, 1500);
	});

	var fallbackForm = document.getElementById('popup-brochure-form');
	if (fallbackForm) {
		fallbackForm.addEventListener('submit', function(e) {
			e.preventDefault();

			var valid = true;
			var inputs = fallbackForm.querySelectorAll('input[required]');

			inputs.forEach(function(input) {
				input.classList.remove('wpcf7-not-valid');
				if (!input.validity.valid) {
					input.classList.add('wpcf7-not-valid');
					valid = false;
				}
			});

			if (!valid) return;

			triggerDownload(pdfUrl);

			setTimeout(function() {
				popup.classList.remove('active');
				document.body.classList.remove('popup-open');
				fallbackForm.reset();
			}, 1500);
		});
	}
})();
</script>