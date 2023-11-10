<?php
// подгружаем среду WordPress
// WP делает некоторые проверки и подгружает только самое необходимое для подключения к БД
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );

// тут мы можем общаться с БД. Но практически никакие функции WP работать не будут.
// Глобальные переменные $wp, $wp_query, $wp_the_query не установлены...
global $wpdb;
$result = $wpdb->get_results("SELECT post_title FROM $wpdb->posts WHERE post_type='post'");

if($_POST){
    switch ($_POST['formType']) {
        case 'restaurant':
            $hotel = $_POST['hotel'];
            $title = $_POST['title'].' (Ресторан)'; 
            $name = $_POST['firstName'];
            $phone = $_POST['tel'];
            $date = $_POST['date'];
            $comment = $_POST['comment'];
            $to = $GLOBALS['cgv']['restaurant_modal'];
        break;
        case 'events':
            $hotel = $_POST['hotel'];
            $title = $_POST['title'].' (Событие)';
            $name = $_POST['firstName'];
            $phone = $_POST['tel'];
            $date = $_POST['date'];
            $comment = $_POST['comment'];
            if (strpos(site_url(), 'kazan') !== false) {
                $to = $GLOBALS['cgv']['event_kazan_modal'];
            } else {
                $to = $GLOBALS['cgv']['event_modal'];
            }
        break;
        case 'services':
            $hotel = $_POST['hotel'];
            $title = $_POST['title'].' (Услуга)';
            $name = $_POST['firstName'];
            $phone = $_POST['tel'];
            $date = $_POST['date'];
            $comment = $_POST['comment'];
            if (strpos(site_url(), 'kazan') !== false) {
                $to = $GLOBALS['cgv']['service_kazan_modal'];
            } else {
                $to = $GLOBALS['cgv']['service_modal'];
            }
            
        break;
        case 'offers':
            $hotel = $_POST['hotel'];
            $title = $_POST['title'].' (Предложение)';
            $phone = $_POST['tel'];
            $date = $_POST['date'];
            $comment = $_POST['comment'];
            $to = $GLOBALS['cgv']['offer_modal'];
        break;
        case 'main':
            $title = 'главной';
            $to = $_POST['department'];
            $departmentName = $_POST['departmentName'];
            $name = $_POST['firstName'];
            $surname = $_POST['lastName'];
            $phone = $_POST['tel'];
            $email = $_POST['email'];
            $file = $_FILES['file'];
            $comment = $_POST['comment'];
        break;
        default:
            $to = 'info@kravt-hotel.com';
            $title = $_POST['title'];
            $name = $_POST['firstName'];
            $phone = $_POST['tel'];
            $date = $_POST['date'];
            $comment = $_POST['comment'];
        break;
    } 
}

if (isset($_POST['email'])) {
    $to = 'info@kravt-hotel.com';
}
$subject = 'Kravt Hotel Booking';
$headers = array(
    'From: Kravt Hotel Booking <info@kravt-hotel.com>',
	'content-type: text/html',
	'cc: John Q Codex <baremantar@gmail.com>',
	'bcc: iluvwp@wordpress.org', // тут можно использовать только простой email адрес
);


switch ($_POST['formType']) {
    case 'restaurant':
        $message = 'Бронь на '.$title.',<br>
            отель - '.$hotel.'<br>
            Имя: '.$name.'<br>
            Телефон: '.$phone.'<br>
            Дата и время: '.$date.'<br>
            Комментарий: '.$comment;
        break;
    case 'offers':
        $message = 'Бронь на '.$title.',<br>
            отель - '.$hotel.'<br>
            Имя: '.$name.'<br>
            Телефон: '.$phone.'<br>
            Дата и время: '.$date.'<br>
            Комментарий: '.$comment;
        break;
    case 'services':
        $message = 'Бронь на '.$title.',<br>
            отель - '.$hotel.'<br>
            Имя: '.$name.'<br>
            Телефон: '.$phone.'<br>
            Дата и время: '.$date.'<br>
            Комментарий: '.$comment;
        break;
    case 'events':
        $message = 'Бронь на '.$title.',<br>
            отель - '.$hotel.'<br>
            Имя: '.$name.'<br>
            Телефон: '.$phone.'<br>

            Дата и время: '.$date.'<br>
            Комментарий: '.$comment;
        break;
    case 'main':
        $message = 'Запрос<br>
            Подразделение: '.$departmentName.'<br>
            Имя: '.$name.'<br>
            Фамилия: '.$surname.'<br>
            Телефон: '.$phone.'<br>
            E-mail: '.$email.'<br>
            Комментарий: '.$comment;
        break;
}


if ($_POST['formType'] != 'main') {
    wp_mail($to, $subject, $message, $headers);
} else {
    if ( ! function_exists( 'wp_handle_upload' ) ) {
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
    }

    $uploadedfile = $_FILES['file'];
    $upload_overrides = array( 'test_form' => false );
    $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );

    if( $movefile ) {
        echo "File is valid, and was successfully uploaded.\n";
        $attachments = $movefile[ 'file' ];
        wp_mail($to, $subject, $message, $headers, $attachments);
    } else {
        echo "Possible file upload attack!\n";
    }
}
?>