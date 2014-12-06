<?php
/**
 * Test: Nella\Forms\SignalControl\SignalControl
 * @testCase
 *
 * This file is part of the Nella Project (http://nella-project.org).
 *
 * Copyright (c) Patrik Votoček (http://patrik.votocek.cz)
 *
 * For the full copyright and license information,
 * please view the file LICENSE.md that was distributed with this source code.
 */

namespace Nella\Forms\SignalControl;

use Nette\Application\UI\Form;
use Tester\Assert;

require __DIR__ . '/../../../bootstrap.php';
require __DIR__ . '/SignalControlMock.php';
require __DIR__ . '/SignalControlPresenterMock.php';

class SignalControlTest extends \Tester\TestCase
{

    /**
     * @throws \Nette\InvalidStateException
     */
    public function testInvalidAttachToBasicForm()
    {
        $form = new \Nette\Forms\Form;
        $form->addComponent(new SignalControlMock('Test'), 'test');
    }

    public function testLinkSignalOnly()
    {
        $control = $this->createControl();
        Assert::equal('?do=form-test-signal', $control->linkMock('signal!'));
    }

    public function testLinkFullSignalOnly()
    {
        $control = $this->createControl();
        Assert::equal('http://localhost/?do=form-test-signal', $control->linkMock('//signal!'));
    }

    public function testLinkSignalWithParameter()
    {
        $control = $this->createControl();
        Assert::equal(
            '?form-test-parameter=foo&do=form-test-signal',
            $control->linkMock('signal!', array('parameter' => 'foo'))
        );
    }

    public function testLinkFullSignalWithParameter()
    {
        $control = $this->createControl();
        Assert::equal(
            'http://localhost/?form-test-parameter=foo&do=form-test-signal',
            $control->linkMock('//signal!', array('parameter' => 'foo'))
        );
    }

    /**
     * @throws \Nette\InvalidArgumentException
     */
    public function testInvalidLinkNoSignal()
    {
        $this->createControl()->linkMock('test');
    }

    /**
     * @throws \Nette\InvalidArgumentException
     */
    public function testInvalidLinkPresenter()
    {
        $this->createControl()->linkMock('Homepage:default');
    }

    public function testSignal()
    {
        $control = $this->createControl(array('form-test' => array('value' => 'foo')), 'form-test-signal');
        /** @var SignalControlPresenterMock $presenter */
        $presenter = $control->getForm()->getPresenter();
        $presenter->processSignal();
        Assert::equal(array('foo'), $control->signalValues);
    }

    /**
     * @throws \Nette\Application\UI\BadSignalException
     */
    public function testInvalidSignal()
    {
        $control = $this->createControl(array(), 'form-test-invalid');
        /** @var SignalControlPresenterMock $presenter */
        $presenter = $control->getForm()->getPresenter();
        $presenter->processSignal();
    }

    /**
     * @param array|mixed[]
     * @param string|NULL
     * @return SignalControlMock
     */
    private function createControl(array $globalParams = array(), $signal = NULL)
    {
        $presenter = new SignalControlPresenterMock($globalParams, $signal);
        $form = new Form();

        $control = new SignalControlMock();
        $form->addComponent($control, 'test');

        $presenter->addComponent($form, 'form');

        return $control;
    }

}

id(new SignalControlTest)->run(isset($_SERVER['argv'][1]) ? $_SERVER['argv'][1] : NULL);
