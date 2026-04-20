<?php
/**
 * Popup Brochure – hiển thị khi click nút "Tải Brochure"
 * - File PDF lấy từ ACF field: kh_brochure_file
 * - Form CF7 lấy từ ACF field: kh_brochure_form_shortcode
 * - JS: sau khi CF7 submit thành công → tự động tải PDF về máy
 */
$brochure_file      = get_field('kh_brochure_file');
$brochure_shortcode = get_field('kh_brochure_form_shortcode', 'option');
$brochure_btn_title = get_field('kh_brochure_btn_title') ?: 'Tải brochure';
$course_title       = get_the_title();
$course_subtitle    = get_field('kh1_subtitle');

// Không render popup nếu chưa có file PDF
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
			<?php else: ?>
			<!-- Fallback form nếu chưa có CF7 shortcode -->
			<form id="popup-brochure-form" novalidate>
				<div class="block-input">
					<span class="wpcf7-form-control-wrap">
						<input class="wpcf7-form-control" type="text" name="fullname" placeholder="Họ và tên"
							required />
					</span>
				</div>
				<div class="block-input">
					<span class="wpcf7-form-control-wrap">
						<input class="wpcf7-form-control" type="tel" name="phone" placeholder="Số điện thoại" required
							pattern="^[0-9\s\+\-]{9,15}$" />
					</span>
				</div>
				<div class="block-input">
					<span class="wpcf7-form-control-wrap">
						<input class="wpcf7-form-control" type="email" name="email" placeholder="Email" required />
					</span>
				</div>
				<div class="btn-submit">
					<button class="btn btn-primary" type="submit">
						<?php echo esc_html($brochure_btn_title); ?>
					</button>
				</div>
			</form>
			<?php endif; ?>
		</div>
	</div>
</section>

<script>
(function() {
	var popup = document.getElementById('popup-brochure');
	if (!popup) return;

	var pdfUrl = popup.getAttribute('data-pdf-url');

	/* ─── Helper: trigger download ─── */
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

	/* ─── Mở / đóng popup ─── */
	document.addEventListener('click', function(e) {
		// Mở: click vào [data-toggle="popup-brochure"] hoặc href="#popup-brochure"
		var trigger = e.target.closest('[data-toggle="popup-brochure"], [href="#popup-brochure"]');
		if (trigger) {
			e.preventDefault();
			popup.classList.add('active');
			document.body.classList.add('popup-open');
			return;
		}

		// Đóng: click overlay hoặc close-btn
		if (e.target.closest('.close-btn') || e.target === popup.querySelector('.overlay')) {
			popup.classList.remove('active');
			document.body.classList.remove('popup-open');
		}
	});

	// Đóng bằng Escape
	document.addEventListener('keydown', function(e) {
		if (e.key === 'Escape' && popup.classList.contains('active')) {
			popup.classList.remove('active');
			document.body.classList.remove('popup-open');
		}
	});

	/* ─── CF7: download sau khi gửi thành công ─── */
	document.addEventListener('wpcf7mailsent', function(event) {
		// Kiểm tra form có nằm trong popup này không
		if (!popup.contains(event.target)) return;
		triggerDownload(pdfUrl);
		// Đóng popup sau 1.5s
		setTimeout(function() {
			popup.classList.remove('active');
			document.body.classList.remove('popup-open');
		}, 1500);
	});

	/* ─── Fallback form (nếu không dùng CF7) ─── */
	var fallbackForm = document.getElementById('popup-brochure-form');
	if (fallbackForm) {
		fallbackForm.addEventListener('submit', function(e) {
			e.preventDefault();

			var valid = true;
			var inputs = fallbackForm.querySelectorAll('input[required]');

			inputs.forEach(function(input) {
				input.classList.remove('wpcf7-not-valid');
				// HTML5 constraint validation
				if (!input.validity.valid) {
					input.classList.add('wpcf7-not-valid');
					valid = false;
				}
			});

			if (!valid) return;

			triggerDownload(pdfUrl);

			// Đóng popup sau 1.5s
			setTimeout(function() {
				popup.classList.remove('active');
				document.body.classList.remove('popup-open');
				fallbackForm.reset();
			}, 1500);
		});
	}
})();
</script>