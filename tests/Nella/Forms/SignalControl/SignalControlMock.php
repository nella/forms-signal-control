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

class SignalControlMock extends \Nette\Forms\Controls\TextInput implements \Nette\Application\UI\ISignalReceiver
{

	use SignalControl;

	public $signalValues = FALSE;

	/**
	 * @param mixed
	 * @return mixed
	 */
	public function handleSignal($value)
	{
		$this->signalValues = func_get_args();
	}

	/**
	 * @param string
	 * @param array|mixed
	 * @return string
	 */
	public function linkMock($destination, array $args = array())
	{
		return $this->link($destination, $args);
	}

}
