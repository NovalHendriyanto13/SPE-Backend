<?php
namespace App\Form;

use Lib\Form;
use App\View\Components\InputText;
use App\View\Components\InputSelect;
use App\Models\Group;

class UserForm extends Form {
	
	protected function initialize($entity=null, array $options) {
		$mode = '';
		if (isset($options['mode']) && $options['mode'] == 'edit')
			$mode = 'edit';

		$name = new InputText([
			'name'=>'name',
			'class'=>'tes',
			'type'=>'text',
			'required'=>true,
		]);
		$this->addCollection($name);

		$username = new InputText([
			'name'=>'username',
			'class'=>'username',
			'type'=>'text',
			'required'=>true,
		]);
		$this->addCollection($username);

		$email = new InputText([
			'name'=>'email',
			'type'=>'email',
			'required'=>true,
		]);
		$this->addCollection($email);

		parent::initialize($entity, $options);
	}
}