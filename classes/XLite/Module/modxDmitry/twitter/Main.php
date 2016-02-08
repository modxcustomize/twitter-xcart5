<?php

namespace XLite\Module\modxDmitry\twitter;

/**
 * Development module that simplifies the process of implementing design changes
 *
 */
abstract class Main extends \XLite\Module\AModule
{
    /**
     * Author name
     *
     * @return string
     */
    public static function getAuthorName()
    {
        return 'Dmitry [xcart developer]';
    }

    /**
     * Module name
     *
     * @return string
     */
    public static function getModuleName()
    {
        return 'import my twitter posts into xcart5 via a module';
    }

    /**
     * Get module major version
     *
     * @return string
     */
    public static function getMajorVersion()
    {
        return '5.2';
    }

    /**
     * Module version
     *
     * @return string
     */
    public static function getMinorVersion()
    {
        return '1';
    }

    /**
     * Module description
     *
     * @return string
     */
    public static function getDescription()
    {
        return 'A module to import twitter posts';
    }

    /**
     * No settings for this module
     *
     * @return boolean
     */
    public static function showSettingsForm()
	{
		return false;
	}

    /**
     * The following pathes are defined as substitutional skins:
     *
     * admin interface:     skins/custom_skin/admin/en/
     * customer interface:  skins/custom_skin/default/en/
     * mail interface:      skins/custom_skin/mail/en
     *
     * @return array
     */
/*    public static function getSkins()
    {
        return array(
            \XLite::ADMIN_INTERFACE     => array('chinabeast_skin/admin'),
            \XLite::CUSTOMER_INTERFACE  => array('chinabeast_skin/default'),
            \XLite::MAIL_INTERFACE      => array('chinabeast_skin/mail'),
        );
    }
*/
    public static function runBuildCacheHandler()
    {
        parent::runBuildCacheHandler();
 
         
    }
    /**
     * The module is defined as skin module
     *
     * @return integer|null
     */
    public static function getModuleType()
    {
        return static::MODULE_TYPE_SKIN;
    }
}
