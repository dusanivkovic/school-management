<?php

use app\controllers\testes\Testes;
use app\helpers\Session;
use const app\helpers\FLASH_ERROR;
use const app\helpers\FLASH_INFO;
use const app\helpers\FLASH_SUCCESS;
use const app\helpers\FLASH_WARNING;
require_once __DIR__ . '/../../../vendor/autoload.php';

class DeleteTest extends Testes
{
    public function delete ($id)
    {
        if ($this->tM->deleteTest($id))
        {
            Session::flash('successDeleteTest', self::SUCCESS_DELETE, FLASH_SUCCESS);
            Session::redirect('dashboard.php?controlsView');
            exit;
        }else
        {
            Session::flash('unsuccessfullyAdding', self::UNSUCCESS_ADDING, FLASH_ERROR);
        }
    }
}

$test = new DeleteTest();
if (isset($_POST['testId']))
{
    $test->delete($_POST['testId']);
}

