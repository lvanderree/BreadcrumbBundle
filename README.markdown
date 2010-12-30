 
 Class to build an render breadcrumbs based on hierarchical pages (with parents)

## Features

- Page hierarchy is parsed by simple interface requirements for a page (see interface spec)
- Can render via Php and Twig (ability to define your own templates) 

## Installation

### Add BreadcrumbBundle to your src/Bundle dir

    git submodule add git://github.com/lvanderree/BreadcrumbBundle.git src/Bundle/BreadcrumbBundle

### Add BreadcrumbBundle to your application kernel

    // app/AppKernel.php
    public function registerBundles()
    {
        return array(
            // ...
            new Bundle\BreadcrumbBundle\BreadcrumbBundle(),
            // ...
        );
    }
    
### activate the Breadcrumb service (with twig and default template) from your config
    
    # app/config/config.yml
    # ...
    breadcrumb.config: ~
    
    # which defaults to:
    
    # breadcrumb.config:
    #     renderer: Bundle\BreadcrumbBundle\Renderer\TwigRenderer # Php renderer ListRenderer is available as well 
    #     template: BreadcrumbBundle:Default:breadcrumb.twig      # obviously you can provide your own templates as well



### Create your own classes

You must create a Page class, that at least implements the methods mentioned in the PageInterface

### use (this is a snapshop from my controller)

    public function indexAction($pageId)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $page = $em->find('CmsBundle:Page', $pageId); 

        $breadcrumb = $this->get('breadcrumb');
        $breadcrumb->setPage($page);
        
        $template = $page->getTemplate();
        $vars = array('page' => $page);

        return $this->render($template, $vars);
    }
