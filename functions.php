<?php
add_action( 'after_setup_theme', 'crb_load' );
function crb_load() {
    require_once( 'includes/carbon-fields/vendor/autoload.php' );
    \Carbon_Fields\Carbon_Fields::boot();
}

add_action('carbon_fields_register_fields', 'register_carbon_fields');
function register_carbon_fields() {
    require_once( 'includes/carbon-fields-options/post-meta.php' );
}
function register_review_post_type() {
    register_post_type('review', array(
        'labels' => array(
            'name' => 'Отзывы',
            'singular_name' => 'Отзыв',
            'add_new' => 'Добавить новый отзыв',
            'add_new_item' => 'Добавить новый отзыв',
            'edit_item' => 'Редактировать отзыв',
            'new_item' => 'Новый отзыв',
            'view_item' => 'Просмотреть отзыв',
            'search_items' => 'Искать отзывы',
            'not_found' => 'Отзывов не найдено',
            'not_found_in_trash' => 'В корзине нет отзывов',
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor'),
        'menu_icon' => 'dashicons-star-filled',
    ));
}
add_action('init', 'register_review_post_type');

function handle_ajax_review_submission() {
    // Проверяем наличие данных
    if (!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['comment']) || !isset($_POST['rating'])) {
        wp_send_json_error('Неполные данные');
        return;
    }

    // Создаем новый пост с типом 'review'
    $review_id = wp_insert_post(array(
        'post_title'   => sanitize_text_field($_POST['name']),
        'post_content' => sanitize_textarea_field($_POST['comment']),
        'post_type'    => 'review',
        'post_status'  => 'pending', // Ожидание модерации
    ));

    if ($review_id) {
        // Сохраняем поля с помощью Carbon Fields
        carbon_set_post_meta($review_id, 'review_author_name', sanitize_text_field($_POST['name']));
        carbon_set_post_meta($review_id, 'review_author_email', sanitize_email($_POST['email']));
        carbon_set_post_meta($review_id, 'review_rating', intval($_POST['rating']));

        wp_send_json_success('Отзыв успешно отправлен');
    } else {
        wp_send_json_error('Не удалось сохранить отзыв');
    }
}

add_action('wp_ajax_submit_review', 'handle_ajax_review_submission');
add_action('wp_ajax_nopriv_submit_review', 'handle_ajax_review_submission');

function enqueue_review_script() {
    wp_enqueue_script('review-ajax', get_template_directory_uri() . '/js/review-ajax.js', array('jquery'), null, true);
    wp_localize_script('review-ajax', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'enqueue_review_script');
