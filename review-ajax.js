jQuery(document).ready(function($) {
    var selectedRating = 0;

    // Обработка клика по звездам рейтинга
    $('.rating span').on('click', function() {
        selectedRating = $(this).data('value'); // Получаем значение нажатой звезды

        // Обновляем все звезды
        $('.rating span').each(function(index) {
            if (index < selectedRating) {
                $(this).addClass('selected'); // Добавляем класс для заполненных звезд
            } else {
                $(this).removeClass('selected'); // Убираем класс для пустых звезд
            }
        });
    });

    // Обработка отправки формы
    $('#review-form').on('submit', function(e) {
        e.preventDefault(); // Предотвращаем стандартное поведение формы

        var name = $('#name').val();
        var email = $('#email').val();
        var comment = $('#comment').val();

        if (selectedRating === 0) {
            $('#review-response').html('<p class="error">Пожалуйста, выберите рейтинг.</p>');
            return;
        }

        // Сообщение перед отправкой
        $('#review-response').html('<p class="info">Ваш отзыв отправляется на модерацию...</p>');

        // AJAX запрос
        $.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'submit_review',
                name: name,
                email: email,
                comment: comment,
                rating: selectedRating,
            },
            success: function(response) {
                if (response.success) {
                    $('#review-response').html('<p class="success">Спасибо за отзыв! Он будет опубликован после проверки.</p>');
                    $('#review-form')[0].reset();
                    selectedRating = 0; // Сбрасываем выбранный рейтинг
                    $('.rating span').removeClass('selected'); // Убираем выделение со звезд
                } else {
                    $('#review-response').html('<p class="error">' + response.data + '</p>');
                }
            },
            error: function(xhr, status, error) {
                $('#review-response').html('<p class="error">Произошла ошибка при отправке отзыва. Попробуйте снова.</p>');
            }
        });
    });
});
