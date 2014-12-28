<?php
/**
 * This file is part of the Nella Project (http://nella-project.org).
 *
 * Copyright (c) Patrik Votoček (http://patrik.votocek.cz)
 *
 * For the full copyright and license information,
 * please view the file LICENSE.md that was distributed with this source code.
 */

namespace Nella\Forms\SignalControl;

class SignalControlPresenterMock extends \Nette\Application\UI\Presenter
{

	public function __construct(array $globalParams = array(), $signal = NULL)
	{
		parent::__construct();

		$signalReceiver = substr($signal, 0, strrpos($signal, '-'));
		$signal = substr($signal, strrpos($signal, '-') + 1);

		$globalParamsReflection = $this->getReflection()->getParentClass()->getProperty('globalParams');
		$globalParamsReflection->setAccessible(TRUE);
		$globalParamsReflection->setValue($this, $globalParams);
		$signalReceiverReflection = $this->getReflection()->getParentClass()->getProperty('signalReceiver');
		$signalReceiverReflection->setAccessible(TRUE);
		$signalReceiverReflection->setValue($this, $signalReceiver);
		$signalReflection = $this->getReflection()->getParentClass()->getProperty('signal');
		$signalReflection->setAccessible(TRUE);
		$signalReflection->setValue($this, $signal);
	}

	public function link($destination, $args = array())
	{
		$url = new \Nette\Http\Url('http://localhost');
		$args['do'] = substr($destination, substr($destination, 0, 2) === '//' ? 2 : 0, -1);
		foreach ($args as $key => $value) {
			$url->setQueryParameter($key, $value);
		}

		return substr($destination, 0, 2) === '//' ? (string) $url : $url->getRelativeUrl();
	}

}
