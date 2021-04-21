<?php
echo '<ul>';
foreach ($semesters as $semester) {
    echo '<li><a href=#>'.$semester->name.'</a></li>';
}
echo '</ul>';