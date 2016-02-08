<?php
namespace XLite\Module\modxDmitry\twitter\View;
/**
 * @ListChild (list="sidebar.single", zone="customer", weight="100")
 * @ListChild (list="sidebar.first", zone="customer", weight="100")
 */
 
class SocialSidebarTWTTR extends \XLite\View\SideBarBox
{
    protected function getHead()
    {
        return 'Latest Tweet';
    }
  
   
    protected function getDir()
    {
        return 'modules/modxDmitry/twitter/twitter_tpl';
        
    }
}
