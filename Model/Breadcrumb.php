<?php
namespace Bundle\BreadcrumbBundle\Model;

use Bundle\BreadcrumbBundle\Model\Item,
    Bundle\BreadcrumbBundle\Renderer\ListRenderer,
    Bundle\BreadcrumbBundle\Renderer\RendererInterface,
    Countable,
    Iterator;

/*
 * (c) Leon van der Ree <leon@fun4me.demon.nl>
 *
 * This source file is subject to the MIT license that is bundled with Symfony2 
 */

/**
 * Breadcrumb is the class that holds the crumbs that represent the page hierarchy   
 *
 * @author Leon van der Ree <leon@fun4me.demon.nl>
 */
class Breadcrumb implements Countable, Iterator //, WidgetInterface
{
    protected $iterator = 0;
    
    protected $page;
    
    protected $crumbs = array();
    
    protected $renderer;
  
    /**
     * 
     * @param Renderer $renderer  The class that renders this breadcrumb, defaults to ListRenderer
     */
    public function __construct(RendererInterface $renderer = null)
    {
        if ($renderer) {
            $this->renderer = $renderer;
        } else {
            $this->renderer = new ListRenderer();
        }
    }
    
    /**
     * 
     * @param Page $page          The page to create the breadcrumb for
     */
    public function setPage($page)
    {
        $this->page = $page;
        $this->reset();
    }
        
    
    /**
     * reset the breadcrumb
     */
    public function reset()
    {
        $iterator = 0;
        $this->crumbs = array();
        
        if ($this->page)
        {
            $page = $this->page;
            $this->crumbs[] = new Item($page);
            
            while ($page = $page->getParent()) {
                $this->crumbs[] = new Item($page);
            }
            
            // reset order
            $this->crumbs = array_reverse($this->crumbs);
        }
    }
    
    /**
     *
     * @see Countable::count()
     * @return int the number of breadcrumb items
     */
    public function count()
    {
        if ($this->crumbs == array()) {
            $this->getBreadcrumbs();
        }
        
        return count($this->crumbs);
    }

    /**
     * 
     * @see Iterator::offsetExists($key)
     */
    public function offsetExists($key)
    {
        if ($this->crumbs == array()) {
            $this->getBreadcrumbs();
        }
        
        return isset($this->crumbs[$key]);
    }
        
    /**
     * @see Iterator::current()
     * @return Bundle\BreadcrumbBundle\Model\Item
     */
    public function current()
    {
        return $this->crumbs[$this->iterator];
    }
   
    /**
     * @see Iterator::next()
     */
    public function next()
    {
        $this->iterator++;
    }

    /**
     * @see Iterator::key()
     */
    public function key()
    {
        return $this->iterator;
    }
   
    /**
     * @see Iterator::valid()
     */
    public function valid()
    {
        return isset($this->crumbs[$this->iterator]);
    }

    /**
     * @see Iterator::rewind()
     */
    public function rewind()
    {
        $this->iterator = 0;
    }
   
    /**
     * 
     * @return array breadcrumbItems
     */
    public function getBreadcrumbs()
    {
        return $this->crumbs;
    }

    /**
     * 
     * @return string the rendered breadcrumb
     */
    public function render()
    {
        return $this->renderer->render($this);
    }
    
    /**
     * 
     * @return string the rendered breadcrumb
     */
    public function __toString()
    {
        return $this->render();
    }
}