<?php
namespace App\Form;

use Lib\Form;
use App\View\Components\InputText;
use App\View\Components\InputSelect;
use App\Models\Group;

class CustomerForm extends Form {
	
	protected function initialize($entity=null, array $options) {
		$mode = '';
		if (isset($options['mode']) && $options['mode'] == 'edit')
			$mode = 'edit';

		$code = new InputText([
			'name'=>'customer_code',
			'type'=>'text',
			'required'=>true,
		]);
		$this->addCollection($code);

		$name = new InputText([
			'name'=>'name',
			'class'=>'tes',
			'type'=>'text',
			'required'=>true,
		]);
		$this->addCollection($name);

		$email = new InputText([
			'name'=>'email',
			'type'=>'email',
			'required'=>true,
		]);
		$this->addCollection($email);

		parent::initialize($entity, $options);
	}
}