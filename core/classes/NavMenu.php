<?php

namespace Castlegate\Apollo\Core;

/**
 * Navigation menu compatibility
 *
 * Edits the parameters passed to wp_nav_menu and the class names in its output
 * for compatibility with the Atlas front end framework.
 */
class NavMenu
{
    /**
     * Navigation menu theme location(s)
     *
     * @var array
     */
    private $locations = [];

    /**
     * List component class
     *
     * @var string
     */
    private $listClass = '';

    /**
     * Item component class
     *
     * @var string
     */
    private $itemClass = '';

    /**
     * Link component class
     *
     * @var string
     */
    private $linkClass = '';

    /**
     * WordPress default active classes
     *
     * @var array
     */
    private $defaultActiveClasses = [
        'current-menu-item',
        'current-menu-parent',
        'current-menu-ancestor',
        'current_page_item',
        'current_page_parent',
        'current_page_ancestor',
    ];

    /**
     * Construct
     *
     * Set navigation menu theme location(s) and apply filters to wp_nav_menu
     * parameters and the class names and attributes in its output.
     *
     * @param mixed $locations Menu theme location(s)
     * @return void
     */
    public function __construct($locations)
    {
        if (!$locations) {
            return;
        }

        if (!is_array($locations)) {
            $locations = [$locations];
        }

        $this->locations = $locations;

        $this->createClasses();
        $this->createFilters();
    }

    /**
     * Create class names
     *
     * @return void
     */
    private function createClasses()
    {
        $block = ATLAS_PREFIX . 'header';

        $this->listClass = $block . '__nav-list';
        $this->itemClass = $block . '__nav-item';
        $this->linkClass = $block . '__nav-link';
    }

    /**
     * Add filters
     *
     * @return void
     */
    private function createFilters()
    {
        add_filter('wp_nav_menu_args', [$this, 'sanitizeArgs']);
        add_filter('nav_menu_submenu_css_class', [$this, 'sanitizeSubMenuClass'], 10, 3);
        add_filter('nav_menu_css_class', [$this, 'sanitizeItemClass'], 10, 4);
        add_filter('nav_menu_link_attributes', [$this, 'sanitizeLinkAttributes'], 10, 4);
    }

    /**
     * Sanitize function parameters
     *
     * @param array $args wp_nav_menu function parameters
     * @return void
     */
    public function sanitizeArgs($args)
    {
        if (!$this->hasLocation($args)) {
            return $args;
        }

        $args['container'] = false;
        $args['depth'] = 2;
        $args['fallback_cb'] = [$this, 'fallback'];

        $args['menu_class'] = implode(' ', [
            $this->listClass,
            $this->level($this->listClass, 1),
        ]);

        return $args;
    }

    /**
     * Sanitize second and subsequent level list classes
     *
     * @param array $classes List of classes on list element
     * @param stdClass $args wp_nav_menu function parameters
     * @param integer $depth WordPress navigation menu depth
     * @return array
     */
    public function sanitizeSubMenuClass($classes, $args, $depth)
    {
        if (!$this->hasLocation($args)) {
            return $classes;
        }

        return [
            $this->listClass,
            $this->level($this->listClass, $depth + 2),
        ];
    }

    /**
     * Sanitize list item classes
     *
     * @param array $classes List of classes on list item element
     * @param WP_Post $item Post object representing list item
     * @param stdClass $args wp_nav_menu function parameters
     * @param integer $depth WordPress navigation menu depth
     * @return array
     */
    public function sanitizeItemClass($classes, $item, $args, $depth)
    {
        if (!$this->hasLocation($args)) {
            return $classes;
        }

        return [
            $this->itemClass,
            $this->level($this->itemClass, $depth + 1),
        ];
    }

    /**
     * Sanitize link attributes
     *
     * @param array $attributes HTML attributes on link element
     * @param WP_Post $item Post object representing list item
     * @param stdClass $args wp_nav_menu function parameters
     * @param integer $depth WordPress navigation menu depth
     * @return array
     */
    public function sanitizeLinkAttributes($attributes, $item, $args, $depth)
    {
        if (!$this->hasLocation($args)) {
            return $attributes;
        }

        $classes = [
            $this->linkClass,
            $this->level($this->linkClass, $depth + 1),
        ];

        // Does the navigation item have an active class?
        if (array_intersect($this->defaultActiveClasses, $item->classes)) {
            $classes[] = $this->level($this->linkClass, $depth + 1, '-active');
        }

        $attributes['class'] = implode(' ', $classes);

        return $attributes;
    }

    /**
     * Does the menu location match the target location?
     *
     * @param mixed $args wp_nav_menu function parameters
     * @return boolean
     */
    private function hasLocation($args)
    {
        $args = (object) $args;
        $property = 'theme_location';

        return property_exists($args, $property) && in_array($args->$property, $this->locations);
    }

    /**
     * Return class name modifier for navigation menu level
     *
     * @param string $class Component class name
     * @param integer $level Atlas navigation menu depth
     * @param string $suffix Additional text appended to modifier class
     * @return string
     */
    private function level($class, $level = 1, $suffix = '')
    {
        return $class . '--level-' . strval($level) . $suffix;
    }

    /**
     * Fallback navigation menu
     *
     * If no navigation menu has been defined for the theme location, attempt to
     * load a custom fallback menu template part.
     *
     * @return void
     */
    public function fallback()
    {
        get_template_part('components/header/fragments/nav-menu-fallback');
    }
}
