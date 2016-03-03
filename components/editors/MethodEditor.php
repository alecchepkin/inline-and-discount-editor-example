<?php

abstract class MethodEditor extends Component implements OwnerAttributeInterface
{
	const COMMAND = 'ReplaceCommand';
	use OwnerAttribute;

//	const COMMAND_EDIT = 'EditCommand'; 
//	const COMMAND_OPEN_POPUP = 'OpenPopupEditorCommand'; 
//	protected $_command = self::COMMAND_EDIT; 
	protected $_command;
	protected $_id;
	protected $_name;
	protected $_owner;
	protected $_entity;

	public static function instance(array $config = array())
	{
		$self = new static();
		$self->load($config);
		$self->_command = $self->createCommand();
//		$self->_command->owner = $self;
		return $self;
	}

	public function createCommand()
	{
		return CommandEditor::instance(static::COMMAND, array(
//				'params' => array(
//					'target' => 'targetWithHash',
//				),
				'owner'=> $this
//				'execute' => array(
//					array('events' => array('click'), 'context' => 'a.value'),
//				),
//				'undo' => array(
//					array('events' => array('focusout', 'enter'), 'context' => '.edit_container'),
//				),
//				'params' => array(
//					'target' => 'targetWithHash',
//				),
		));
	}

	public function __toString()
	{
		return array(
			'id' => $this->id,
			'name' => get_class($this),
			'options'=> $this->command->getOptions(),
		);
	}
	/**
	 * 
	 * @param type $config
	 */
	protected function __construct()
	{
		
	}

	protected function getCommand()
	{
		return $this->_command;
	}

	protected function getEntity()
	{
		return $this->_entity ? : $this->owner->entity;
	}

	protected function getId()
	{
		return $this->_id ? : $this->owner->id;
	}

	protected function getName()
	{
		return $this->_name ? : $this->owner->name;
	}

	protected function getOwner()
	{
		return $this->_owner;
	}
	protected function getUrl()
	{
		return $this->owner->url;
	}

	protected function setEntity(ActiveRecord $entity)
	{
		$this->_entity = $entity;
	}

	protected function setId($name)
	{
		$this->_name = (string) $name;
	}

	protected function setName($name)
	{
		$this->_name = (string) $name;
	}

	protected function setOwner(AttributeEditor $owner)
	{
		$this->_owner = $owner;
	}

}
