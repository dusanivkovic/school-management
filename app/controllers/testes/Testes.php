<?php
namespace app\controllers\testes;
use app\helpers\Session;
use app\models\TestModel;

use const app\helpers\FLASH_ERROR;
use const app\helpers\FLASH_INFO;
use const app\helpers\FLASH_SUCCESS;
use const app\helpers\FLASH_WARNING;

require_once __DIR__ . '/../../../vendor/autoload.php';

class Testes 
{
    public TestModel $tM;
    protected const SUCCESS_ADDING = 'Test successfully add!';
    protected const UNSUCCESS_ADDING = 'Something went wrong!';
    protected const SUBJECT_EMPTY = 'Izaberi predmet!';
    protected const CLASS_EMPTY = 'Izaberi razred i odjeljenje!';
    protected const TERMIN_EMPTY = 'Izaberi termin!';

    public function __construct()
    {
        $this->tM = new TestModel();
    }

    public function validateSubject ($value): bool
    {
        return empty($value) ? false : true;
    }

    public function validateData ($value): array
    {
        $class = $value['class'] . $value['department'][0];
        return $this->tM->data = [
            'userId' => $this->tM->db->conn->real_escape_string($value['userId']),
            'subject' => $this->tM->db->conn->real_escape_string($value['subject']),
            'testType' => $this->tM->db->conn->real_escape_string($value['testtype'][0]),
            'class' => $class,
            'termin' => $value['termin']
        ];
    }
    public static function PrintTets ()
    {
        Session::prntR($_POST);
    }

}