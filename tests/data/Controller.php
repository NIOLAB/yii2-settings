<?php

namespace niolab\settings\tests\data;

/**
 * Class Controller
 *
 * @package niolab\settings\tests\data
 */
class Controller extends \yii\web\Controller
{
    /**
     * @inheritdoc
     */
    public function render($view, $params = [])
    {
        return [
            'view' => $view,
            'params' => $params,
        ];
    }
}
