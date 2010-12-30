<?php
namespace Bundle\BreadcrumbBundle\Renderer;

use Bundle\BreadcrumbBundle\Model\Breadcrumb;

/*
 * (c) Leon van der Ree <leon@fun4me.demon.nl>
 *
 * This source file is subject to the MIT license that is bundled with Symfony2 
 */

/**
 * ListRenderer renders a breadcrumb to an unsorted list 
 *
 * @author Leon van der Ree <leon@fun4me.demon.nl>
 */
class ListRenderer implements RendererInterface
{
    /**
     * @see Bundle\BreadcrumbBundle\Renderer.RendererInterface::render()
     * 
     * @param  Breadcrumb $breadcrumb  the breadcrumb to be rendered
     * @return string the html representation of the breadcrumb
     */
    public function render(Breadcrumb $breadcrumb)
    {
        $html = '<ul class="breadcrumb">';
        
        $crumbs = $breadcrumb->getBreadcrumbs();
        $last = array_pop($crumbs);
        
        // render items
        foreach ($crumbs as $crumb) {
            $html .= '<li><a href="'.$crumb->getUrl().'">'.$crumb->getTitle().'</a></li>';
        }
        // last crumb
        $html .= '<li><h2>'.$last->getTitle().'</h2></li>';
                
        $html .= '</ul>';
        
        return $html;
    }
}