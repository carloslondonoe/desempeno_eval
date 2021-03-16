<?php
require './vendor/autoload.php';
require './boostrap.php';
require './config/database.php';

use App\controllers\SendMails;

SendMails::sendMailsActivities();
SendMails::sendMailsSeguimientos();