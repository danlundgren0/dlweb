<?php
namespace TYPO3\CMS\Form\Tests\Unit\Validator;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

/**
 * Test case
 */
class EmailValidatorTest extends AbstractValidatorTest
{
    /**
     * @var string
     */
    protected $subjectClassName = \TYPO3\CMS\Form\Domain\Validator\EmailValidator::class;

    /**
     * @return array
     */
    public function validEmailProvider()
    {
        return array(
            'a@b.de' => array('a@b.de'),
            'somebody@mymac.local' => array('somebody@mymac.local')
        );
    }

    /**
     * @return array
     */
    public function invalidEmailProvider()
    {
        return array(
            'myemail@' => array('myemail@'),
            'myemail' => array('myemail'),
            'somebody@localhost' => array('somebody@localhost'),
        );
    }

    /**
     * @test
     * @dataProvider validEmailProvider
     */
    public function validateForValidInputHasEmptyErrorResult($input)
    {
        $options = array('element' => uniqid('test'), 'errorMessage' => uniqid('error'));
        $subject = $this->createSubject($options);

        $this->assertEmpty(
            $subject->validate($input)->getErrors()
        );
    }

    /**
     * @test
     * @dataProvider invalidEmailProvider
     */
    public function validateForInvalidInputHasNotEmptyErrorResult($input)
    {
        $options = array('element' => uniqid('test'), 'errorMessage' => uniqid('error'));
        $subject = $this->createSubject($options);

        $this->assertNotEmpty(
            $subject->validate($input)->getErrors()
        );
    }
}
