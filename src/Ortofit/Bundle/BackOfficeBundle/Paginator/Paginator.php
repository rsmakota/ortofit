<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\BackOfficeBundle\Paginator;

/**
 * Class Paginator
 *
 * @package Ortofit\Bundle\BackOfficeBundle\Paginator
 */
class Paginator implements PaginatorInterface
{
    private $limit;
    private $count;
    private $current;

    /**
     * Paginator constructor.
     * @param integer $limit
     * @param integer $current
     * @param integer $count
     */
    public function __construct($limit, $current, $count)
    {
        $this->limit  = $limit;
        $this->count  = ceil($count/$limit);
        if ($this->count >= $current) {
            $this->current = $current;
        } else {
            $this->current = $this->count;
        }
    }

    /**
     * Count of pages
     * @return mixed
     */
    public function count()
    {
        return $this->count;
    }

    /**
     * Get current page
     * @return integer
     */
    public function current()
    {
        return $this->current;
    }

    /**
     * Get next page
     * @return integer|null
     */
    public function next()
    {
        $next = $this->current() + 1;
        if ($this->count >= $next) {
            return $next;
        }

        return null;
    }

    /**
     * Get previous page
     * @return integer|null
     */
    public function previous()
    {
        $previous = $this->current() - 1;
        if (0 < $previous) {
            return $previous;
        }

        return null;
    }


}