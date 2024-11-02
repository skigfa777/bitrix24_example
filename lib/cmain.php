<?php
namespace CSoft\Test;

use Bitrix\Main\Page\Asset;


class CMain
{
    public static function initTest()
    {
        global $APPLICATION;
        $currentPage = $APPLICATION->GetCurPage();

        if (!strstr($currentPage, '/bitrix/')) {
            ?>
            <script>
                var csoft_test = <?echo \CUtil::PhpToJSObject(array(
                        'server_ip' => $_SERVER['SERVER_ADDR'], 
                        'show_popup' => \Bitrix\Main\Context::getCurrent()->getRequest()->getCookie('csoft_popup')
                    ));?>
            </script>
            <?
            // Asset::getInstance()->addJs('/bitrix/js/csoft.test/script.js');

            //для отладки и демо 
            Asset::getInstance()->addJs('/local/modules/csoft.test/install/js/script.js');

            \Bitrix\Main\Context::getCurrent()->getResponse()->addCookie(
                new \Bitrix\Main\Web\Cookie('csoft_popup', 'N')
            );
        }
    }
}
