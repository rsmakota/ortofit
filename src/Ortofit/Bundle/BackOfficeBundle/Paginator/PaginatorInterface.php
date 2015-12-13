<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\BackOfficeBundle\Paginator;

/**
 * Interface PaginatorInterface
 *
 * @package Ortofit\Bundle\BackOfficeBundle\Paginator
 */
interface PaginatorInterface
{
    /**
     * Count of pages
     * @return mixed
     */
    public function count();

    /**
     * Get current page
     * @return integer
     */
    public function current();

    /**
     * Get next page
     * @return integer|null
     */
    public function next();

    /**
     * Get previous page
     * @return integer|null
     */
    public function previous();

}