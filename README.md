Signal form control for [Nette Framework](http://nette.org)
=============================================================================================

[![Build Status](https://img.shields.io/travis/nella/forms-signal-control.svg?style=flat-square)](https://travis-ci.org/nella/forms-signal-control)
[![SensioLabsInsight Status](https://insight.sensiolabs.com/projects/6c814be4-3f3d-4e09-a0b0-debd409a900c/mini.png)](https://insight.sensiolabs.com/projects/6c814be4-3f3d-4e09-a0b0-debd409a900c)
[![Latest Stable Version](https://img.shields.io/packagist/v/nella/forms-signal-control.svg?style=flat-square)](https://packagist.org/packages/nella/forms-signal-control)
[![Composer Downloads](https://img.shields.io/packagist/dt/nella/forms-signal-control.svg?style=flat-square)](https://packagist.org/packages/nella/forms-signal-control)
[![Dependency Status](https://img.shields.io/versioneye/d/user/projects/5492e271dd709d6dbd000259.svg?style=flat-square)](https://www.versioneye.com/user/projects/5492e271dd709d6dbd000259)
[![HHVM Status](https://img.shields.io/hhvm/nella/forms-signal-control.svg?style=flat-square)](http://hhvm.h4cc.de/package/nella/forms-signal-control)

Installation
------------

```
composer require nella/forms-signal-control
```

Usage
------

```php

class InteractiveControl extends \Nette\Forms\Controls\TextInput
{

	use \Nella\Forms\SignalControl\SignalControl;

	public function handleMySignal($value)
	{
		// do something
	}

	public function getControl()
	{
		/** @var \Nette\Utils\Html $el */
		$el = parent::getControl();

		$el->data('signal-link', $this->link('//mySignal!', array('value' => 'someValue')));

		return $el;
	}

}

$form = new \Nette\Application\UI\Form;
$form->addComponent(new InteractiveControl('Test'), 'test');

```

License
-------
Signal form control for Nette Framework is licensed under the MIT License - see the LICENSE file for details
