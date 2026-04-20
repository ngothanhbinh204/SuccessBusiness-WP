<?php
function log_dump($data)
{
	ob_start();
	var_dump($data);
	$dump = ob_get_clean();

	$highlighted = highlight_string("<?php\n" . $dump . "\n?>", true);

$formatted = '
<pre>' . substr($highlighted, 27, -8) . '</pre>';

$custom_css = 'pre {position: static;
background: #ffffff80;
// max-height: 50vh;
width: 100vw;
}
pre::-webkit-scrollbar{
width: 1rem;}';

$formatted_css = '<style>
' . $custom_css . '
</style>';
echo ($formatted_css . $formatted);
}

function empty_content($str)
{
return trim(str_replace('&nbsp;', '', strip_tags($str, '<img>'))) == '';
}

/**
*
* Ưu tiên kiểm tra trạng thái LearnPress theo thứ tự:
* 1. has_finished_course → "Đã hoàn thành khóa học" → link bài học đầu tiên (xem lại)
* 2. has_enrolled_course → "Tiếp tục học" → link bài học đầu tiên
* 3. Fallback → dùng ACF field kh_btn_register
*
* @param int $post_id Post ID của khóa học (mặc định get_the_ID())
* @return array { show_register, register_url, register_label, register_target, brochure_file, brochure_btn_title }
*/
function canhcam_get_course_cta( int $post_id = 0 ): array {
if ( ! $post_id ) $post_id = get_the_ID();

$btn_register = get_field( 'kh_btn_register', $post_id );
$btn_register_title = get_field( 'kh_btn_register_title', $post_id ) ?: 'Đăng ký khóa học';
$brochure_file = get_field( 'kh_brochure_file', $post_id );
$brochure_btn_title = get_field( 'kh_brochure_btn_title', $post_id ) ?: 'Tải brochure';
$lp_course_id = get_field( 'lp_course_id', $post_id );

$show_register = false;
$register_url = '';
$register_label = '';
$register_target = '_self';

if ( $lp_course_id && is_user_logged_in() && function_exists( 'learn_press_get_current_user' ) ) {
$lp_user = learn_press_get_current_user();
$lp_course = function_exists( 'learn_press_get_course' ) ? learn_press_get_course( $lp_course_id ) : null;

// URL bài học đầu tiên – dùng chung cho enrolled & finished
$first_lesson_url = '';
if ( $lp_course ) {
$first_item_id = $lp_course->get_first_item_id();
$first_lesson_url = $first_item_id ? $lp_course->get_item_link( $first_item_id ) : '';
}

if ( $lp_user->has_finished_course( $lp_course_id ) ) {
// Đã hoàn thành → cho xem lại bài học
$show_register = true;
$register_label = 'Đã hoàn thành khóa học';
$register_target = '_self';
$register_url = $first_lesson_url ?: get_permalink( $lp_course_id );
} elseif ( $lp_user->has_enrolled_course( $lp_course_id ) ) {
// Đang học
$show_register = true;
$register_label = 'Tiếp tục học';
$register_target = '_self';
$register_url = $first_lesson_url ?: get_permalink( $lp_course_id );
}
}

// Fallback: chưa ghi danh hoặc chưa đăng nhập → dùng ACF field
if ( ! $show_register && $btn_register ) {
$show_register = true;
$register_url = $btn_register['url'];
$register_label = $btn_register_title;
$register_target = $btn_register['target'] ?: '_self';
}

return compact( 'show_register', 'register_url', 'register_label', 'register_target', 'brochure_file',
'brochure_btn_title' );
}


add_filter('wpcf7_form_elements', function($content) {
$placeholder_text = __('Chọn khóa học quan tâm', 'canhcamtheme');
$content = preg_replace(
'/<select([^>]+class="[^"]*wpcf7-select-custom[^"]*")/',
	'<select aria-label="' . esc_attr($placeholder_text) . '" $1', $content );
		$search_option='/<option value="">—Please choose an option—<\/option>/' ;
		$replace_option='<option value="" disabled selected>' . esc_html($placeholder_text) . '</option>' ;
		$content=preg_replace($search_option, $replace_option, $content); return $content; });
		add_action('template_redirect', function () { if (!is_singular('lp_course')) return;
		$lesson_slug=class_exists('LP_Settings') ? LP_Settings::get_option('lesson_slug', 'lessons' ) : 'lessons' ;
		$quiz_slug=class_exists('LP_Settings') ? LP_Settings::get_option('quiz_slug', 'quizzes' ) : 'quizzes' ;
		$request_uri=isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '' ; if (strpos($request_uri, '/' .
		$lesson_slug . '/' ) !==false) return; if (strpos($request_uri, '/' . $quiz_slug . '/' ) !==false) return;
		$lp_course_id=get_the_ID(); $khoa_hoc_posts=get_posts([ 'post_type'=> 'khoa_hoc',
		'posts_per_page' => 1,
		'post_status' => 'publish',
		'meta_query' => [[
		'key' => 'lp_course_id',
		'value' => $lp_course_id,
		'compare' => '=',
		]],
		]);

		if (!empty($khoa_hoc_posts)) {
		wp_redirect(get_permalink($khoa_hoc_posts[0]->ID), 301);
		exit;
		}
		});