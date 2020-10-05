<?php
namespace App\Form;

use Lib\Form;
use App\View\Components\InputText;
use App\View\Components\InputSelect;
use App\View\Components\TextArea;

class DiscountForm extends Form {
	
	protected function initialize($entity=null, array $options) {
		$mode = '';
		if (isset($options['mode']) && $options['mode'] == 'edit')
			$mode = 'edit';
		
		$min = new InputText([
			'name'=>'amount_min',
			'class'=>'amount-min',
			'type'=>'text',
			'required'=>true,
		]);
		$this->addCollection($min);
		
		$max = new InputText([
			'name'=>'amount_max',
			'class'=>'amount-max',
			'type'=>'text',
			'required'=>true,
		]);
		$this->addCollection($max);

		
		$probability = new InputText([
			'name'=>'probability',
			'class'=>'probability',
			'type'=>'text',
			'required'=>true,
		]);
		$this->addCollection($probability);

		$discount = new InputText([
			'name'=>'discount',
			'class'=>'discount',
			'type'=>'text',
			'required'=>true
		]);
		$this->addCollection($discount);

		parent::initialize($entity, $options);
	}
}