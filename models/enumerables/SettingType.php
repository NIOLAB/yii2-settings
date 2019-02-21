<?php

namespace niolab\settings\models\enumerables;

use yii2mod\enum\helpers\BaseEnum;

/**
 * Class SettingStatus
 *
 * @package niolab\settings\models\enumerables
 */
class SettingType extends BaseEnum
{
    const STRING_TYPE = 'string';
    const INTEGER_TYPE = 'integer';
    const BOOLEAN_TYPE = 'boolean';
    const FLOAT_TYPE = 'float';
    const NULL_TYPE = 'null';
    const JSON_TYPE = 'json';

    /**
     * @var string message category
     */
    public static $messageCategory = 'niolab.settings';

    /**
     * @var array
     */
    public static $list = [
        self::STRING_TYPE => 'String',
        self::INTEGER_TYPE => 'Integer',
        self::BOOLEAN_TYPE => 'Boolean',
        self::FLOAT_TYPE => 'Float',
        self::NULL_TYPE => 'Null',
        self::JSON_TYPE => 'JSON',
    ];
}
