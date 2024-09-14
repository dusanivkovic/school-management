<?php
namespace app\controllers\testes;
// use app\controllers\testes\Testes;
use app\helpers\Session;
use const app\helpers\FLASH_ERROR;
use const app\helpers\FLASH_INFO;
use const app\helpers\FLASH_SUCCESS;
use const app\helpers\FLASH_WARNING;
require_once __DIR__ . '/../../../vendor/autoload.php';

class Edit extends Testes 
{
    public function populateTest ($id)
    {
        $test = $this->tM->findTestById($id);
        return $test ? [
            'subject' => $test['subject'],
            'class' => $test['class'],
            'testType' => $test['test_type'],
            'termin' => $test['termin'],
            'userId' => $test['user_id']
        ] : false;
    }

    public function saveTest ($subject, $class, $testType, $termin, $id)
    {
        if ($this->tM->updateTest($subject, $class, $testType, $termin, $id))
        {
            Session::flash('updateTest', self::SUCCESS_UPDATED, FLASH_SUCCESS);
            Session::redirect('./dashboard.php?controlsView');
        }else
        {
            Session::flash('updateTest', self::UNSUCCESS_UPDATED, FLASH_WARNING);
            Session::redirect('./dashboard.php?controlsView');
        }
    }
}

$model = new Edit();
if (isset ($_POST['update-test']))
{
    $subject = $model->tM->db->conn->real_escape_string($_POST['subject']);
    $class = $_POST['class'] . $_POST['department'][0];
    $testType = $_POST['testtype'][0];
    $termin = $_POST['termin'];
    $id = $_POST['testId'];
    Session::prntR($class);
    $model->saveTest($subject, $class, $testType, $termin, $id);
}

