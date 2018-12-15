<?php
/**
 * PHPUnit
 *
 * Copyright (c) 2001-2013, Sebastian Bergmann <sebastian@phpunit.de>.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the name of Sebastian Bergmann nor the names of his
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package    PHPUnit
 * @subpackage TextUI
 * @author     Sebastian Bergmann <sebastian@phpunit.de>
 * @copyright  2001-2013 Sebastian Bergmann <sebastian@phpunit.de>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @link       http://www.phpunit.de/
 * @since      File available since Release 3.0.0
 */

/**
 * A TestRunner for the Command Line Interface (CLI)
 * PHP SAPI Module.
 *
 * @package    PHPUnit
 * @subpackage TextUI
 * @author     Sebastian Bergmann <sebastian@phpunit.de>
 * @copyright  2001-2013 Sebastian Bergmann <sebastian@phpunit.de>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @link       http://www.phpunit.de/
 * @since      Class available since Release 3.0.0
 */
class PHPUnit_TextUI_Command
{
    /**
     * @var array
     */
    protected $arguments = array(
      'listGroups'              => FALSE,
      'loader'                  => NULL,
      'useDefaultConfiguration' => TRUE
    );

    /**
     * @var array
     */
    protected $options = array();

    /**
     * @var array
     */
    protected $longOptions = array(
      'colors' => NULL,
      'bootstrap=' => NULL,
      'configuration=' => NULL,
      'coverage-html=' => NULL,
      'coverage-clover=' => NULL,
      'coverage-php=' => NULL,
      'coverage-text==' => NULL,
      'debug' => NULL,
      'exclude-group=' => NULL,
      'filter=' => NULL,
      'testsuite=' => NULL,
      'group=' => NULL,
      'help' => NULL,
      'include-path=' => NULL,
      'list-groups' => NULL,
      'loader=' => NULL,
      'log-json=' => NULL,
      'log-junit=' => NULL,
      'log-tap=' => NULL,
      'process-isolation' => NULL,
      'repeat=' => NULL,
      'stderr' => NULL,
      'stop-on-error' => NULL,
      'stop-on-failure' => NULL,
      'stop-on-incomplete' => NULL,
      'stop-on-skipped' => NULL,
      'strict' => NULL,
      'tap' => NULL,
      'testdox' => NULL,
      'testdox-html=' => NULL,
      'testdox-text=' => NULL,
      'test-suffix=' => NULL,
      'no-configuration' => NULL,
      'no-globals-backup' => NULL,
      'printer=' => NULL,
      'static-backup' => NULL,
      'verbose' => NULL,
      'version' => NULL
    );

    /**
     * @var array
     */
    protected $missingExtensions = array();

    /**
     * @param boolean $exit
     */
    public static function main($exit = TRUE)
    {
        $command = new PHPUnit_TextUI_Command;
        return $command->run($_SERVER['argv'], $exit);
    }

    /**
     * @param array   $argv
     * @param boolean $exit
     */
    public function run(array $argv, $exit = TRUE)
    {
        $this->handleArguments($argv);

        $runner = $this->createRunner();

        if (is_object($this->arguments['test']) &&
            $this->arguments['test'] instanceof PHPUnit_Framework_Test) {
            $suite = $this->arguments['test'];
        } else {
            $suite = $runner->getTest(
              $this->arguments['test'],
              $this->arguments['testFile'],
              $this->arguments['testSuffixes']
            );
        }

        if ($this->arguments['listGroups']) {
            PHPUnit_TextUI_TestRunner::printVersionString();

            print "Available test group(s):\n";

            $groups = $suite->getGroups();
            sort($groups);

            foreach ($groups as $group) {
                print " - $group\n";
            }

            if ($exit) {
                exit(PHPUnit_TextUI_TestRunner::SUCCESS_EXIT);
            } else {
                return PHPUnit_TextUI_TestRunner::SUCCESS_EXIT;
            }
        }

        unset($this->arguments['test']);
        unset($this->arguments['testFile']);

        try {
            $result = $runner->doRun($suite, $this->arguments);
        }

        catch (PHPUnit_Framework_Exception $e) {
            print $e->getMessage() . "\n";
        }

        $ret = PHPUnit_TextUI_TestRunner::FAILURE_EXIT;

        if (isset($result) && $result->wasSuccessful()) {
            $ret = PHPUnit_TextUI_TestRunner::SUCCESS_EXIT;
        }

        else if (!isset($result) || $re