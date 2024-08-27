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
    protected const SUCCESS_ADDING = 'Test uspjesno dodan!';
    protected const UNSUCCESS_ADDING = 'Something went wrong!';
    protected const SUBJECT_EMPTY = 'Izaberi predmet!';
    protected const CLASS_EMPTY = 'Izaberi razred i odjeljenje!';
    protected const TERMIN_EMPTY = 'Izaberi termin!';
    protected const SUCCESS_DELETE = 'Test je uspjesno obrisan!';
    protected const SUCCESS_UPDATED = 'Test je uspjesno izmjenjen!';
    protected const UNSUCCESS_UPDATED = 'Test nije izmjenjen!';

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
        foreach ($value['department'] as $department)
        {
            $class[] = $value['class'] . $department;
        }
        // $class = $value['class'] . $value['department'][0];
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