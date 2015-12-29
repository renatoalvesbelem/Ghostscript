<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\GhostscriptTest\Enum;

use GravityMedia\Ghostscript\Enum\TransferFunctionInfo;

/**
 * The transfer function info enum test class
 *
 * @package GravityMedia\GhostscriptTest\Enum
 *
 * @covers  \GravityMedia\Ghostscript\Enum\TransferFunctionInfo
 */
class TransferFunctionInfoTest extends \PHPUnit_Framework_TestCase
{
    public function testValues()
    {
        $values = [
            TransferFunctionInfo::PRESERVE,
            TransferFunctionInfo::REMOVE,
            TransferFunctionInfo::APPLY
        ];

        $this->assertEquals($values, TransferFunctionInfo::values());
    }
}
