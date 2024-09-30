<?php
    require_once __DIR__ . '/../../../vendor/autoload.php';
    require_once __DIR__ . '/../../../teachers.php';

use app\controllers\testes\Testes;
use app\controllers\users\User;
use app\helpers\Session;
use const app\helpers\FLASH_ERROR;
use const app\helpers\FLASH_INFO;
use const app\helpers\FLASH_SUCCESS;
use const app\helpers\FLASH_WARNING;

// use app\models\TestModel;
class Admin extends User
{
    public Testes $testes;
    public function __construct()
    {
        $this->testes = new Testes();
        parent::__construct();
    }
    public function exportTermin ()
    {
        $this->rm->exportVisitTermin();
        Session::flash('successRegistration', self::SUCCESS_EXPORT, FLASH_SUCCESS);
        //Session::redirect('./dashboard.php?main');
    }

    public function exportTest ()
    {
        $this->testes->tM->findAllTestes();
        Session::flash('successRegistration', self::SUCCESS_EXPORT, FLASH_SUCCESS);
        //Session::redirect('./dashboard.php?main');
    }

    public function importUserData ($array)
    {
        if ($this->rm->insertUserData($array))
        {
            Session::flash('successRegistration', self::SUCCESS_REGISTRATION, FLASH_SUCCESS);
            Session::redirect('./dashboard.php?main');
            exit;
        }
    }

}

$testModel = new Testes();
$admin = new Admin();

if(isset($_POST['upload-btn']))
{
    $uploadDir = $_SERVER['DOCUMENT_ROOT'];
    $uploadFile = $uploadDir . '/' . basename($_FILES['import-file']['name']);
    Session::prntR($uploadFile);

    if (move_uploaded_file($_FILES['import-file']['tmp_name'], $uploadFile)) 
    {
        echo "File is valid, and was successfully uploaded.\n";
    } else 
    {
        echo "Upload failed";
    }
    Session::prntR(($_FILES));
    Session::prntR(($teachers));
    $admin->importUserData($teachers);

    exit;
}

if (isset($_POST['termin']))
{
    Session::prntR($_POST);
    $admin->exportTermin();
    exit;
}

$admin->exportTest();


