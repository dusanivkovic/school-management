<?php

use app\controllers\testes\Testes;
use app\helpers\Session;
use app\models\TestModel;

use const app\helpers\FLASH_ERROR;
use const app\helpers\FLASH_INFO;
use const app\helpers\FLASH_SUCCESS;
use const app\helpers\FLASH_WARNING;

require_once __DIR__ . '/../../../vendor/autoload.php';

class CreateTest extends Testes
{

    public function addTest ()
    {
        $data = $this->validateData($_POST);
        $date = new DateTimeImmutable($data['termin']);
        if (!$this->validateSubject($_POST['subject']))
        {
            Session::flash('choseSubject', self::SUBJECT_EMPTY, FLASH_WARNING);
            Session::redirect('dashboard.php?addTest');
            exit;
        }
        if (!$this->validateSubject($_POST['class']))
        {
            Session::flash('choseSubject', self::CLASS_EMPTY, FLASH_WARNING);
            Session::redirect('dashboard.php?addTest');
            exit;
        }
        if (!$this->validateSubject($_POST['termin']))
        {
            Session::flash('choseSubject', self::TERMIN_EMPTY, FLASH_WARNING);
            Session::redirect('dashboard.php?addTest');
            exit;
        }
        if ($this->tM->registerTest($data['subject'], $data['class'], $data['testType'],$date->format('Y-m-d'), $data['userId'])) 
        {
            Session::flash('successAddTest', self::SUCCESS_ADDING, FLASH_SUCCESS);
            Session::redirect('dashboard.php?main');
            exit;
        }else
        {
            Session::flash('unsuccessfullyAdding', self::UNSUCCESS_ADDING, FLASH_ERROR);
        }
    }
}

$test = new CreateTest ();
if (isset($_POST['saveTest']))
{
    $test->addTest();
}

