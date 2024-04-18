<?php
namespace app\form;
use app\models\Model;

class Field extends BaseField
{
    const TYPE_TXT = 'text';
    const TYPE_PASSWORD = 'password';
    const TYPE_MAIL = 'email';

    public function __construct(Model $model, string $attribute)
    {
        $this->type = self::TYPE_TXT;
        parent::__construct($model, $attribute);
    }

    public function renderInput()
    {
        return sprintf('<input type="%s" class="form-control form-control-lg border-left-0 %s" name="%s" value="%s">',
            $this->type,
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
            $this->attribute,
            $this->model->{$this->attribute},
        );
    }

    public function passwordField()
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }

    public function mailField()
    {
        $this->type = self::TYPE_MAIL;
        return $this;
    }

}