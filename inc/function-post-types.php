<?php
// create_post_type('test_products', array(
// 	'name' => 'Test Products',
// 	'slug' => 'test-products',
// 	'icon' => 'dashicons-cart',
// ));

// create_taxonomy($key, array(
// 	'name' => 'Danh mục',
// 	'object_type' => array('test_products'),
// 	'slug' => 'danh-muc-san-pham',
// ));

// Đăng ký Post Type Khóa Học
create_post_type('khoa_hoc', array(
	'name' => 'Khóa Học',
	'slug' => 'khoa-hoc',
	'icon' => 'dashicons-welcome-learn-more',
    'show_ui'           => true,
	'show_in_menu'      => true,
	'menu_position'     => 2,
	'menu_icon'         => 'dashicons-welcome-learn-more',
	'hierarchical'      => false,
	'supports'          => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
	'has_archive'       => true,
	'public'            => true,
	'rewrite'           => array( 'slug' => 'khoa-hoc' ),
	'show_in_rest'      => true,
	'taxonomies'        => array(),
    'custom_labels'            => array(
        'name'               => 'Khóa Học',
        'singular_name'      => 'Khóa Học',
        'menu_name'          => 'Khóa Học',
        'parent_item_colon'  => 'Khóa Học cha',
        'all_items'          => 'Tất cả Khóa Học',
        'view_item'          => 'Xem Khóa Học',
        'add_new_item'       => 'Thêm Khóa Học mới',
        'add_new'            => 'Thêm mới',
        'edit_item'          => 'Sửa Khóa Học',
        'update_item'        => 'Cập nhật Khóa Học',
        'search_items'       => 'Tìm kiếm Khóa Học',
        'not_found'          => 'Không tìm thấy Khóa Học',
        'not_found_in_trash' => 'Không tìm thấy Khóa Học trong thùng rác',
    ),
));

// Đăng ký Taxonomy Loại khóa học
create_taxonomy('loai_khoa_hoc', array(
	'name' => 'Loại khóa học',
	'object_type' => array('khoa_hoc'),
	'slug' => 'loai-khoa-hoc',
));

// Đăng ký Post Type Giảng viên
create_post_type('giang_vien', array(
	'name' => 'Giảng viên',
	'slug' => 'giang-vien',
	'icon' => 'dashicons-businessman',
	'show_ui'           => true,
	'show_in_menu'      => true,
	'menu_position'     => 3,
	'menu_icon'         => 'dashicons-businessman',
	'hierarchical'      => false,
	'supports'          => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
	'has_archive'       => true,
	'public'            => true,
	'rewrite'           => array( 'slug' => 'giang-vien' ),
	'show_in_rest'      => true,
	'taxonomies'        => array(),
	'custom_labels'            => array(
		'name'               => 'Giảng viên',
		'singular_name'      => 'Giảng viên',
		'menu_name'          => 'Giảng viên',
		'parent_item_colon'  => 'Giảng viên cha',
		'all_items'          => 'Tất cả Giảng viên',
		'view_item'          => 'Xem Giảng viên',
		'add_new_item'       => 'Thêm Giảng viên mới',
		'add_new'            => 'Thêm mới',
		'edit_item'          => 'Sửa Giảng viên',
		'update_item'        => 'Cập nhật Giảng viên',
		'search_items'       => 'Tìm kiếm Giảng viên',
		'not_found'          => 'Không tìm thấy Giảng viên',
		'not_found_in_trash' => 'Không tìm thấy Giảng viên trong thùng rác',
	),
));

// Đăng ký Post Type Sự Kiện
create_post_type('su_kien', array(
	'name'          => 'Sự Kiện',
	'slug'          => 'su-kien',
	'icon'          => 'dashicons-calendar-alt',
	'show_ui'       => true,
	'show_in_menu'  => true,
	'menu_position' => 4,
	'hierarchical'  => false,
	'supports'      => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
	'has_archive'   => true,
	'public'        => true,
	'rewrite'       => array( 'slug' => 'su-kien' ),
	'show_in_rest'  => true,
	'custom_labels'        => array(
		'name'               => 'Sự Kiện',
		'singular_name'      => 'Sự Kiện',
		'menu_name'          => 'Sự Kiện',
		'all_items'          => 'Tất cả Sự Kiện',
		'view_item'          => 'Xem Sự Kiện',
		'add_new_item'       => 'Thêm Sự Kiện mới',
		'add_new'            => 'Thêm mới',
		'edit_item'          => 'Sửa Sự Kiện',
		'update_item'        => 'Cập nhật Sự Kiện',
		'search_items'       => 'Tìm kiếm Sự Kiện',
		'not_found'          => 'Không tìm thấy Sự Kiện',
		'not_found_in_trash' => 'Không tìm thấy Sự Kiện trong thùng rác',
	),
));