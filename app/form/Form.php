<?php
namespace app\form;
use app\models\Model;

class form 
{
    public static function begin (string $action, string $method, array $options = []):form
    {
        $attributes = [];
        foreach ($options as $key => $value) {
            $attributes[] = "$key=\"$value\"";
        }
        echo sprintf('<form action="%s" method="%s" %s class="pt-3">', $action, $method, implode(" ", $attributes));
        return new Form();
    }

    public static function end(): void
    {
        echo '</form>';
    }

    public function field(Model $model, $attribute): Field
    {
        return new Field($model, $attribute);
    }

}