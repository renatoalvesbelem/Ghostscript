<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Device;

use GravityMedia\Ghostscript\Process\Argument as ProcessArgument;
use GravityMedia\Ghostscript\Process\Arguments as ProcessArguments;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;

/**
 * The abstract device class
 *
 * @package GravityMedia\Ghostscript\Devices
 */
abstract class AbstractDevice
{
    /**
     * The process builder object
     *
     * @var ProcessBuilder
     */
    private $builder;

    /**
     * The arguments object
     *
     * @var ProcessArguments
     */
    private $arguments;

    /**
     * Create abstract device object
     *
     * @param ProcessBuilder   $builder
     * @param ProcessArguments $arguments
     */
    public function __construct(ProcessBuilder $builder, ProcessArguments $arguments)
    {
        $this->builder = $builder;
        $this->arguments = $arguments;
    }

    /**
     * Get Argument
     *
     * @param string $name
     *
     * @return null|ProcessArgument
     */
    protected function getArgument($name)
    {
        return $this->arguments->getArgument($name);
    }

    /**
     * Get argument value
     *
     * @param string $name
     *
     * @return null|string
     */
    protected function getArgumentValue($name)
    {
        $argument = $this->getArgument($name);
        if (null === $argument) {
            return null;
        }

        return $argument->getValue();
    }

    /**
     * Set argument
     *
     * @param string $argument
     *
     * @return $this
     */
    protected function setArgument($argument)
    {
        $this->arguments->setArgument($argument);

        return $this;
    }

    /**
     * Create process object
     *
     * @param string $inputFile
     *
     * @throws \RuntimeException
     *
     * @return Process
     */
    public function createProcess($inputFile)
    {
        if (!is_file($inputFile)) {
            throw new \RuntimeException('Input file does not exist');
        }

        $arguments = array_values($this->arguments->toArray());
        array_push($arguments, '-f', $inputFile);

        return $this->builder->setArguments($arguments)->getProcess();
    }
}
