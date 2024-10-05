<?php
/*
Template Name: rew
*/
?>

<?php get_header(); ?>
<div class="review-container">
    <h2>Оставить отзыв</h2>
    <form id="review-form" class="review-form">
        <div class="form-group">
            <label for="name">Имя</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="comment">Комментарий</label>
            <textarea id="comment" name="comment" required></textarea>
        </div>
        <div class="form-group">
            <label>Рейтинг</label>
            <div class="rating">
                <span data-value="1" class="star">&#9733;</span> <!-- 1 звезда -->
                <span data-value="2" class="star">&#9733;</span> <!-- 2 звезды -->
                <span data-value="3" class="star">&#9733;</span> <!-- 3 звезды -->
                <span data-value="4" class="star">&#9733;</span> <!-- 4 звезды -->
                <span data-value="5" class="star">&#9733;</span> <!-- 5 звезд -->
            </div>
        </div>
        <button type="submit" class="submit-btn">Отправить отзыв</button>
    </form>
    <div id="review-response"></div>
</div>

<div class="reviews-section">
    <div class="reviews-header">
        <h3>Отзывы</h3>
        <?php
        // Получаем количество опубликованных отзывов
        $reviews_count = wp_count_posts('review')->publish;
        ?>
        <span class="review-count">Количество отзывов: <?php echo $reviews_count; ?></span>
    </div>

    <?php
    // WP_Query для получения отзывов
    $reviews_query = new WP_Query(array(
        'post_type' => 'review',
        'post_status' => 'publish', // Показываем только опубликованные отзывы
        'posts_per_page' => -1, // Получаем все отзывы
    ));

    if ($reviews_query->have_posts()) :
        while ($reviews_query->have_posts()) : $reviews_query->the_post();
            $author_name = carbon_get_post_meta(get_the_ID(), 'review_author_name');
            $rating = carbon_get_post_meta(get_the_ID(), 'review_rating');
            ?>
            <div class="review-item">
                <div class="review-author"><?php echo esc_html($author_name); ?></div>
                <div class="review-date"><?php echo get_the_date(); ?></div>
                <div class="review-comment"><?php the_content(); ?></div>
                <div class="review-rating">
                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                        <span class="<?php echo ($i <= $rating) ? 'active' : 'inactive'; ?>">&#9733;</span>
                    <?php endfor; ?>
                </div>
            </div>
        <?php endwhile;
    else : ?>
        <p>Отзывы пока отсутствуют.</p>
    <?php endif; wp_reset_postdata(); ?>
</div>



<?php get_footer()?>
