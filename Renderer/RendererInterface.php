<?php
namespace Bundle\BreadcrumbBundle\Renderer;

use Bundle\BreadcrumbBundle\Model\Breadcrumb;

interface RendererInterface
{
    /**
     * renders the breadcrumb 
     * 
     * @param  Breadcrumb $breadcrumb   the breadcrumb to be rendered
     * @return string 	                the rendered breadcrumb
     */
    public function render(Breadcrumb $breadcrumb);
}