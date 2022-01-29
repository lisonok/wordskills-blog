<?php

$output .= '
<h1>Вы вошли в систему как администратор. <a href="logout.php">Выход</a></h1>
<form method="POST" id="post_form">
    <div class="form-group">
        <input type="text" name="post_name" id="post_name" class="form-control" placeholder="Заголовок" />
    </div>
    <div class="form-group">
        <textarea name="post_content" id="post_content" class="form-control" placeholder="Контент" rows="5"></textarea>
    </div>
    <div class="form-group">
        <input type="hidden" name="post_id" id="post_id" value="0" />
        <input type="submit" name="submit" id="submit" class="btn btn-info" value="Опубликовать" />
    </div>
</form>
';

?>
<!DOCTYPE html>
<html>

<head>
    <title>WordSkills Blog</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">

        <?php
        session_start();
        if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        ?>
            <h1>Вы вошли в систему как гостевой пользователь. <a href="login.php">Вход</a></h1>
        <?php
        } else {
            echo $output;
        }
        ?>

        <span id="post_message"></span>
        <br />
        <div id="display_post"></div>
    </div>
</body>

</html>

<script>
    $(document).ready(function() {

        $('#post_form').on('submit', function(event) {
            event.preventDefault();
            var form_data = $(this).serialize();
            $.ajax({
                url: "add.php",
                method: "POST",
                data: form_data,
                dataType: "JSON",
                success: function(data) {
                    if (data.error != '') {
                        $('#post_form')[0].reset();
                        $('#post_message').html(data.error);
                        $('#post_id').val('0');
                        load_post();
                    }
                }
            })
        });

        load_post();

        function load_post() {
            $.ajax({
                url: "fetch.php",
                method: "POST",
                success: function(data) {
                    $('#display_post').html(data);
                }
            })
        }

        $(document).on('click', '.reply', function() {
            var post_id = $(this).attr("id");
            $('#post_id').val(post_id);
            $('#post_name').focus();
        });

    });
</script>