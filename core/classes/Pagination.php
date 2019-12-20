<?php

namespace Castlegate\Apollo\Core;

/**
 * Pagination links compatibility
 *
 * Parses the WordPress pagination HTML and returns a list of links in a more
 * useful format.
 */
class Pagination
{
    /**
     * Unmodified HTML
     *
     * @var string
     */
    private $original = '';

    /**
     * List of links
     *
     * @var array
     */
    private $links = [];

    /**
     * Construct
     *
     * @param array $args Parameters for paginate_links function
     * @return void
     */
    public function __construct($args = [])
    {
        $this->original = paginate_links($args);
        $this->parse();
    }

    /**
     * Parse HTML and create links
     *
     * Parse the unmodified HTML output of the paginate_links function and
     * create a list of objects representing the pagination links.
     *
     * @return void
     */
    private function parse()
    {
        $nodes = $this->nodes();

        if (!$nodes) {
            return;
        }

        foreach ($nodes as $node) {
            $this->createLink($node);
        }
    }

    /**
     * Convert original HTML to DOM nodes
     *
     * Remove all elements that are not links or spans, then return a list of
     * nodes. Return null if no nodes are found.
     *
     * @return array|null
     */
    private function nodes()
    {
        if (!$this->original) {
            return;
        }

        $dom = new \DOMDocument;
        $dom->loadHTML(strip_tags($this->original, '<a><span>'));

        $parents = $dom->getElementsByTagName('body');

        if ($parents->count() === 0 ||
            $parents->item(0)->childNodes->count() === 0) {
            return;
        }

        return $parents->item(0)->childNodes;
    }

    /**
     * Create link object from DOM node
     *
     * @param DOMNode $node
     * @return void
     */
    private function createLink($node)
    {
        // Skip nodes that are not HTML elements.
        if ($node->nodeType !== 1) {
            return;
        }

        $link = new \stdClass;
        $classes = explode(' ', $node->getAttribute('class'));

        $link->url = $node->getAttribute('href');
        $link->text = $node->nodeValue;
        $link->link = $node->nodeName === 'a';
        $link->current = in_array('current', $classes);
        $link->next = in_array('next', $classes);
        $link->prev = in_array('prev', $classes);

        $this->links[] = $link;
    }

    /**
     * Return links as objects
     *
     * @return array
     */
    public function links()
    {
        return $this->links;
    }
}
