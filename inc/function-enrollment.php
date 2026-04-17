<?php
/**
 * Logic xử lý tự động Enroll học viên vào LearnPress khi Đơn hàng hoàn tất
 */

if (!defined('ABSPATH')) {
    exit; // Tránh truy cập trực tiếp
}

/**
 * Xử lý gán khóa học khi Order WooCommerce chuyển sang Completed
 *
 * @param int $order_id ID của đơn hàng
 */
function canhcam_auto_enroll_courses_on_order_completed($order_id) {
    if (!$order_id) return;

    $order = wc_get_order($order_id);
    if (!$order) return;

    $user_id = $order->get_customer_id();
    
    // nếu đơn hàng với role user khach -> ko cap quyen
    if (!$user_id) {
        $order->add_order_note('CẢNH BÁO LMS: Đơn hàng này không có Tài khoản Học viên (Guest). Hệ thống không thể cấp quyền khóa học. Vui lòng gán tài khoản cho đơn hàng.');
        return;
    }

    // Lấy danh sách ID các bài CPT khoa_hoc được gán trong Order
    $assigned_courses = get_field('assigned_courses', $order_id);

    if (empty($assigned_courses) || !is_array($assigned_courses)) {
        return; // nếu đơn hàng này không gán khóa học nào -> return
    }

    $enrolled_count = 0;
    $enrolled_course_names = array();

    foreach ($assigned_courses as $cpt_khoa_hoc_id) {
        $lp_course_id = get_field('lp_course_id', $cpt_khoa_hoc_id); // ACF field

        if (!$lp_course_id) {
            $order->add_order_note(sprintf('Khóa học "%s" không có ID LearnPress.', get_the_title($cpt_khoa_hoc_id)));
            continue; 
        }

        // Kiểm tra xem Plugin LearnPress có đang kích hoạt không
        if (function_exists('learn_press_get_user') && function_exists('learn_press_get_course')) {
            $lp_user = learn_press_get_user($user_id);
            $lp_course = learn_press_get_course($lp_course_id);

            if ($lp_user && $lp_course) {
                // Kiểm tra xem User đã có trong khóa học chưa
                if (!$lp_user->has_enrolled_course($lp_course_id)) {
                    try {
                        learn_press_update_user_item_field(array(
                            'user_id'    => $user_id,
                            'item_id'    => $lp_course_id,
                            'item_type'  => LP_COURSE_CPT, // Mặc định là 'lp_course'
                            'status'     => 'enrolled',    // Trạng thái đã đăng ký
                            'ref_id'     => $order_id,
                            'ref_type'   => 'woocommerce_order'
                        ));
                        
                        $enrolled_count++;
                        $enrolled_course_names[] = get_the_title($cpt_khoa_hoc_id);

                    } catch (Exception $e) {
                        $order->add_order_note('LỖI LMS: Không thể cấp quyền khóa học (LP ID: ' . $lp_course_id . '). Chi tiết: ' . $e->getMessage());
                    }

                } else {
                    $order->add_order_note(sprintf('LMS: Học viên đã có sẵn quyền truy cập khóa học "%s".', get_the_title($cpt_khoa_hoc_id)));
                }
            }
        }
    }

    if ($enrolled_count > 0) {
        $note = sprintf(
            'HỆ THỐNG LMS: Đã tự động cấp quyền truy cập %d khóa học cho học viên (User ID: %d). Các khóa học: %s.',
            $enrolled_count,
            $user_id,
            implode(', ', $enrolled_course_names)
        );
        $order->add_order_note($note);
    }
}
add_action('woocommerce_order_status_completed', 'canhcam_auto_enroll_courses_on_order_completed', 10, 1);
