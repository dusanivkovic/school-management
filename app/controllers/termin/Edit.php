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
    $termin = '';
    for ($i = 0; $i < 2; $i++)
    {
        $day = $_POST['day'][$i];
        $hourStart = $_POST['hours-start'][$i];
        $minuteStart = $_POST['minutes-start'][$i];
        $hourEnd = $_POST['hours-end'][$i];
        $minuteEnd = $_POST['minutes-end'][$i];
        if (!empty($hourStart) and !empty($minuteStart))
        {
            $termin = $termin ."$day $hourStart:$minuteStart - $hourEnd:$minuteEnd, "; 
        }
    }
    $visit->storeVisitTermin($termin, $userId);
}