<?php

namespace Vlczech\Form\Renderer;

use Nette;
use Nette\Forms\Controls;
use Nette\Forms\Rendering\DefaultFormRenderer;

class BootstrapRenderer extends DefaultFormRenderer
{
    public $wrappers = array(
        'form' => array(
            'container' => null,
        ),
        'error' => array(
            'container' => 'div class="alert alert-danger"',
            'item' => 'p',
        ),
        'group' => array(
            'container' => 'fieldset',
            'label' => 'legend',
            'description' => 'p',
        ),
        'controls' => array(
            'container' => 'div',
        ),
        'pair' => array(
            'container' => 'div class=form-group',
            '.required' => 'required',
            '.optional' => null,
            '.odd' => null,
            '.error' => 'has-error',
        ),
        'control' => array(
            'container' => 'div class=col-sm-9',
            '.odd' => null,
            'description' => 'span class=help-block',
            'requiredsuffix' => '',
            'errorcontainer' => 'span class=help-block',
            'erroritem' => '',
            '.required' => 'required',
            '.text' => 'text',
            '.password' => 'text',
            '.file' => 'text',
            '.submit' => 'button',
            '.image' => 'imagebutton',
            '.button' => 'button',
        ),
        'label' => array(
            'container' => 'div class="col-sm-3 control-label"',
            'suffix' => null,
            'requiredsuffix' => '',
        ),
        'hidden' => array(
            'container' => 'div',
        ),
    );

    /**
     * Provides complete form rendering.
     * @param  Nette\Forms\Form
     * @param  string 'begin', 'errors', 'ownerrors', 'body', 'end' or empty to render all
     * @return string
     */
    public function render(Nette\Forms\Form $form, $mode = null)
    {
        $form->getElementPrototype()->addClass('form-horizontal');
        $form->getElementPrototype()->setNovalidate('novalidate');
        foreach ($form->getControls() as $control) {
            $this->customizeControl($control);
        }

        return parent::render($form, $mode);
    }
    
    
    /**
     * Provide rendering of control pair
     * 
     * @param Nette\Forms\IControl $control
     * @return string
     */
    public function renderPair(Nette\Forms\IControl $control) {
        $this->customizeControl($control);
      
        return parent::renderPair($control);
    }
    
    
    /**
     * Provide rendring of control only
     * 
     * @param Nette\Forms\IControl $control
     * @return string
     */
    public function renderControl(Nette\Forms\IControl $control) {
        $this->customizeControl($control);
        
        return parent::renderControl($control);
    }
    

    
    
    /**
     * Process control 
     * 
     * @param Nette\Forms\IControl $control
     */
    private function customizeControl(Nette\Forms\IControl $control)
    {
        if ($control instanceof Controls\Button) {
            if (strpos($control->getControlPrototype()->getClass(), 'btn') === FALSE) {
                $control->getControlPrototype()->addClass(empty($usedPrimary) ? 'btn btn-primary' : 'btn btn-default');
                $usedPrimary = true;
            }
        } elseif ($control instanceof Controls\TextBase ||
            $control instanceof Controls\SelectBox ||
            $control instanceof Controls\MultiSelectBox) {
            $control->getControlPrototype()->addClass('form-control');
        } elseif ($control instanceof Controls\Checkbox ||
            $control instanceof Controls\CheckboxList ||
            $control instanceof Controls\RadioList) {
            $control->getSeparatorPrototype()->setName('div')->addClass($control->getControlPrototype()->type);
        }
    }
}
