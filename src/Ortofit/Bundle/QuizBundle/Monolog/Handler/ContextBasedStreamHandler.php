<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author    Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\QuizBundle\Monolog\Handler;

use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Class ContextBasedStreamHandler
 *
 * @package Grabber\Bundle\GrabBundle\Monolog\Handler
 */
class ContextBasedStreamHandler extends AbstractProcessingHandler
{
    protected $handlers;
    protected $filename;

    /**
     * @param int      $filename
     * @param bool|int $level
     * @param bool     $bubble
     */
    public function __construct($filename, $level = Logger::DEBUG, $bubble = true)
    {
        parent::__construct($level, $bubble);
        $this->filename = $filename;
    }

    /**
     * @param string $filename
     *
     * @return RotatingFileHandler
     */
    protected function createHandler($filename)
    {
        return new StreamHandler($filename, $this->level, $this->bubble);
    }

    /**
     * @return AbstractProcessingHandler
     */
    protected function getHandler()
    {
        $filename = $this->formatFilename();

        if (!isset($this->handlers[$filename])) {
            $this->handlers[$filename] = $this->createHandler($filename);
        }

        return $this->handlers[$filename];
    }

    /**
     * Writes the record down to the log of the implementing handler
     *
     * @param array $record
     *
     * @return void
     */
    protected function write(array $record)
    {
        $this->getHandler()->write($record);
    }

    /**
     * @return string
     */
    protected function formatFilename()
    {
        return sprintf($this->filename, date('Y-m-d'));
    }
}