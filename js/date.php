<?php

require_once '../../includes/functions.php';

if (isset($_POST['date'])) {
   date_select($_POST['date']);
}
else {
    date_select();
}
