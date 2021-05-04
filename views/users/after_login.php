<?php
if ($users) {
    echo '<ul>';
    foreach($users as $user) {
        echo '<li>'.$user->username.'</li>';
    }
    echo '</ul>';
}
else echo 'Login successfully!';