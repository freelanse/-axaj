<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
        /* Стили для страницы */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .review-container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        /* Стили формы */
        .review-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 97%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            background-color: #f4f4f4;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        textarea:focus {
            border-color: #0066cc;
            background-color: #fff;
            outline: none;
        }

        textarea {
            height: 100px;
            resize: vertical;
        }

        /* Стили для рейтинга */
        .rating {
            display: flex;
            gap: 5px;
            justify-content: center;
        }

        .rating span {
            font-size: 2rem;
            cursor: pointer;
            color: #ccc; /* Серый цвет для неактивных звезд */
            transition: color 0.3s ease;
        }

        /* Подсветка звезд слева направо */
        .rating span:hover,
        .rating span.selected {
            color: #ffc107; /* Желтый цвет для активных звезд */
        }



        /* Стили кнопки */
        .submit-btn {
            background-color: #0066cc;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #004999;
        }

        /* Стили для сообщений */
        #review-response {
            text-align: center;
            margin-top: 20px;
            font-size: 16px;
            color: #28a745; /* Зеленый для успеха */
        }

        #review-response.error {
            color: #dc3545; /* Красный для ошибок */
        }

        /* Стили для блока вывода отзывов */
        .reviews-section {
            margin-top: 40px;
        }

        .reviews-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #ccc;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .reviews-header h3 {
            font-size: 24px;
            margin: 0;
            color: #333;
        }

        .reviews-header .review-count {
            font-size: 16px;
            color: #666;
        }

        /* Стили каждого отзыва */
        .review-item {
            border-bottom: 1px solid #eee;
            padding: 15px 0;
        }

        .review-item:last-child {
            border-bottom: none;
        }

        .review-author {
            font-weight: bold;
            font-size: 18px;
            color: #333;
        }

        .review-date {
            font-size: 14px;
            color: #999;
            margin-top: 5px;
        }

        .review-comment {
            margin-top: 10px;
            font-size: 16px;
            color: #555;
        }

        .review-rating {
            margin-top: 10px;
        }

        .review-rating span {
            font-size: 1.5rem;
            color: #ffc107;
        }

        .review-rating span.inactive {
            color: #ccc; /* Серый цвет для неактивных звезд */
        }
       .reviews-section {
            width: 1330px;
            margin: auto;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <?php wp_head()?>
</head>
<body>
