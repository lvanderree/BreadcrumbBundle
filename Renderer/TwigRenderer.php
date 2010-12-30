<?php
namespace Bundle\BreadcrumbBundle\Renderer;

use Bundle\BreadcrumbBundle\Model\Breadcrumb;

/*
 * (c) Leon van der Ree <leon@fun4me.demon.nl>
 *
 * This source file is subject to the MIT license that is bundled with Symfony2 
 */

/**
 * TwigRenderer renders the breadcrumb using Twig templates 
 *
 * @author Leon van der Ree <leon@fun4me.demon.nl>
 */
class TwigRenderer implements RendererInterface
{
    /**
     * 
     * Twig used to render the template of the breadcrumb
     * 
     * @var \Twig_Environment 
     */
    protected $twig;
    
    /**
     * 
     * the template to use to render the breadcrumb
     * 
     * @var string
     */
    protected $templateLocation;
    
    /**
     * 
     * breadcrumbRenderer via Twig
     * 
     * @param \Symfony\Bundle\TwigBundle\Renderer\Renderer $renderer  the renderer from your context
     * @param \Symfony\Component\Templating\Storage\Storage $template the template to render this breadcrumb
     */
    public function __construct(\Twig_Environment $twig, $template)
    {
        $this->twig = $twig;
        $this->templateLocation = $template;
    }
    
    /**
     * @see Bundle\BreadcrumbBundle\Renderer.RendererInterface::render()
     * 
     * @param  Breadcrumb $breadcrumb  the breadcrumb to be rendered
     * @return string the html representation of the breadcrumb
     */
    public function render(Breadcrumb $breadcrumb)
    {
        $template = $this->twig->loadTemplate($this->templateLocation);
        
        return $template->render(array('breadcrumb' => $breadcrumb));
    }
}
