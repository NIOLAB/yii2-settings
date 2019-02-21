<?php

namespace niolab\settings\tests;

use Yii;
use yii\helpers\ArrayHelper;
use niolab\settings\tests\data\Controller;
use niolab\settings\tests\data\Session;

/**
 * This is the base class for all yii framework unit tests.
 */
class TestCase extends \PHPUnit\Framework\TestCase
{
    protected function setUp()
    {
        parent::setUp();
        $this->mockApplication();

        $this->setupTestDbData();
    }

    protected function tearDown()
    {
        $this->destroyApplication();
    }

    /**
     * Populates Yii::$app with a new application
     * The application will be destroyed on tearDown() automatically.
     *
     * @param array $config The application configuration, if needed
     * @param string $appClass name of the application class to create
     */
    protected function mockApplication($config = [], $appClass = '\yii\web\Application')
    {
        new $appClass(ArrayHelper::merge([
            'id' => 'testapp',
            'basePath' => __DIR__,
            'vendorPath' => $this->getVendorPath(),
            'components' => [
                'db' => [
                    'class' => 'yii\db\Connection',
                    'dsn' => 'sqlite::memory:',
                ],
                'session' => [
                    'class' => Session::class,
                ],
                'request' => [
                    'hostInfo' => 'http://domain.com',
                    'scriptUrl' => 'index.php',
                ],
                'settings' => [
                    'class' => 'niolab\settings\components\Settings',
                ],
                'cache' => [
                    'class' => 'yii\caching\ArrayCache',
                ],
                'i18n' => [
                    'translations' => [
                        'niolab.settings' => [
                            'class' => 'yii\i18n\PhpMessageSource',
                            'basePath' => '@niolab/settings/messages',
                        ],
                    ],
                ],
            ],
        ], $config));
    }

    /**
     * @return string vendor path
     */
    protected function getVendorPath()
    {
        return dirname(__DIR__) . '/vendor';
    }

    /**
     * Destroys application in Yii::$app by setting it to null.
     */
    protected function destroyApplication()
    {
        Yii::$app = null;
    }

    /**
     * @param array $config controller config
     *
     * @return Controller controller instance
     */
    protected function createController($config = [])
    {
        return new Controller('test', Yii::$app, $config);
    }

    /**
     * Setup tables for test ActiveRecord
     */
    protected function setupTestDbData()
    {
        $db = Yii::$app->getDb();

        // Structure :

        $db->createCommand()->createTable('setting', [
            'id' => 'pk',
            'type' => 'string(10) not null',
            'section' => 'string not null',
            'key' => 'string not null',
            'value' => 'text not null',
            'status' => 'smallint not null default 1',
            'description' => 'string',
            'created_at' => 'integer not null',
            'updated_at' => 'integer not null',
        ])->execute();
    }
}
