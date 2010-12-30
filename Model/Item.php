<?php

namespace Bundle\BreadcrumbBundle\Model;

/*
 * (c) Leon van der Ree <leon@fun4me.demon.nl>
 *
 * This source file is subject to the MIT license that is bundled with Symfony2 
 */

/**
 * An Item is the class that represents the crumbs of a breadcrumb 
 *
 * @author Leon van der Ree <leon@fun4me.demon.nl>
 */
class Item
{
    protected 
        $title, 
        $url;
    
    /**
     * 
     * creates a breadcrumb item for a page
     * 
     * @param unknown_type $page
     */
    public function __construct($page)
    {
       $this->title = $page->getTitle();
       $this->url   = $page->getUrl(); 
    }
    
    /**
     * 
     * @return string returns the title of the item
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * 
     * @return string returns the url of the item
     */
    public function getUrl()
    {
        return $this->url;
    }
    
    /**
     * 
     * @return string returns the title of this item
     */
    public function __toString()
    {
        return $this->getTitle();
    }
}
 