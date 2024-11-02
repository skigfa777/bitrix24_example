<?php

use Bitrix\Main\ModuleManager;

class csoft_test extends CModule
{
    public $MODULE_ID = 'csoft.test';
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_NAME;
    public $MODULE_DESCRIPTION;
    public $PARTNER_URI;
    public $MODULE_GROUP_RIGHTS;

    public function __construct()
    {
        include __DIR__ . '/version.php';

        if (is_array($arModuleVersion) && array_key_exists('VERSION', $arModuleVersion)) {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        }

        $this->MODULE_NAME = 'Модуль вывода IP сервера';
        $this->MODULE_DESCRIPTION = 'Модуль выводит IP сервера в Битрикс24';
        $this->PARTNER_NAME = 'Алексей Бабушкин';
        $this->PARTNER_URI = '';
        $this->MODULE_GROUP_RIGHTS = 'N';
    } 

    function installFiles()
    {
        CopyDirFiles(
            $_SERVER["DOCUMENT_ROOT"]."/local/modules/".$this->MODULE_ID."/install/js",
            $_SERVER["DOCUMENT_ROOT"]."/bitrix/js/".$this->MODULE_ID, $ReWrite = true, $Recursive = true
        );

        return true;
    }

    public function UnInstallFiles()
    {        
        if(is_dir($_SERVER["DOCUMENT_ROOT"]."/bitrix/js/".$this->MODULE_ID)){                    
            DeleteDirFilesEx("/bitrix/js/".$this->MODULE_ID);
        }
        
        return true;
    } 

    public function DoInstall()
    {
        $this->installFiles();
        $this->installEvents();
        ModuleManager::registerModule($this->MODULE_ID);
    }
    
    public function DoUninstall()
    {
        $this->UnInstallFiles();
        $this->unInstallEvents();
        ModuleManager::unRegisterModule($this->MODULE_ID);
    }

    public function installEvents()
    {
        RegisterModuleDependences("main", "OnEpilog", "csoft.test", "CSoft\Test\Cmain", "initTest", "100");
        return true;
    }

    public function unInstallEvents()
    {
        UnRegisterModuleDependences("main", "OnEpilog", "csoft.test", "CSoft\Test\Cmain", "initTest", "100");
        return false;
    }
}
