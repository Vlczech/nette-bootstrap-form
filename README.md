Nette bootstrap form renderer
=============================

Simple nette bootstrap form renderers.

Installation
------------

```sh
composer require vlczech/nette-bootstrap-form
```

Usage
-----

```php
use Vlczech\Form\Renderer\BootstrapRenderer;
use Nette\Application\UI\Form;

$form = new Form;
$form->setRenderer(new BootstrapRenderer);
```

For inline form you can use ```Vlczech\Form\Renderer\BootstrapInlineRenderer```

For vertical form (bootstrap default) you can use ```Vlczech\Form\Renderer\BootstrapVerticalRenderer```
