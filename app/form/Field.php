<?php
namespace app\form;
use app\models\Model;

class Field extends BaseField
{
    const TYPE_TXT = 'text';
    const TYPE_PASSWORD = 'password';
    const TYPE_MAIL = 'mail';

    public function __construct($model, $attribute)
    {
        $this->type = self::TYPE_TXT;
        parent::__construct($model, $attribute);
    }

    public function renderInput()
    {
        return sprintf('<input type="%s" class="form-control%s" name="%s" value="%s">',
            $this->type,
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
            $this->attribute,
            $this->model->{$this->attribute},
        );
    }

}