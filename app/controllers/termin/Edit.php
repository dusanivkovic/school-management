<?php

use app\controllers\users;
use app\controllers\users\User;
use app\helpers\Session;
use app\models\RegisterModel;

use const app\helpers\FLASH_ERROR;
use const app\helpers\FLASH_INFO;
use const app\helpers\FLASH_SUCCESS;
use const app\helpers\FLASH_WARNING;

require_once __DIR__ . '/../../../vendor/autoload.php';

class VisitTermin extends User
{
    public function __construct()
    {
        parent::__construct();
    }

    public function storeVisitTermin ($termin, $id)
    {
        if ($this->rm->editVisitTermin($termin, $id))
        {
            Session::flash('updateTermin', self::SUCCESS_UPDATED, FLASH_SUCCESS);
            Session::redirect('./dashboard.php?main');
        }else
        {
            Session::flash('updateTermin', self::UNSUCCESS_UPDATED, FLASH_WARNING);
            Session::redirect('./dashboard.php?main'); 
        }
    }
}
$visit = new VisitTermin();
$userId = Session::get('userId');

if (isset($_POST['saveTermin']))
{

    $day = $_POST['day'];
    $hour = intval($_POST['hours']);
    $minute = intval($_POST['minutes']);
    $termin = $day . ' ' . $hour . ':' . $minute; 
    $termin = $termin . ';' . $day . ' ' . $hour + 5 . ':' .  $minute + 45;
    // Session::prntR($termin);
    // Exit;
    $visit->storeVisitTermin($termin, $userId);
}