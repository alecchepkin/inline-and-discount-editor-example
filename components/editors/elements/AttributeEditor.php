<?php

abstract class AttributeEditor extends ElementEditor
{

	const TARGET_PREFIX = 'uniqid-attr-inline-';

	//protected $_commands = array();

	protected $_uniqid;

	/**
	 * @brief Лэйбл атрибута рабочей модели InlineEditor::$_entity.
	 * Может быть явно определено через InlineEditorAttribute::setLabel()
	 * или быть извлеченным из рабочей модели InlineEditor::$_entity
	 * по атрибуту InlineEditorAttribute::$_name.
	 * @var string $_label
	 */
	protected $_label;

	/**
	 * @brief Имя атрибута рабочей модели InlineEditor::$_entity.
	 * @var string $_name
	 */
	protected $_name;

	/**
	 *
	 * @var type 
	 */
	protected $_method;

	/**
	 *
	 * @var GroupEditor $_owner
	 */
	protected $_owner;

	/**
	 * @brief Значение атрибута рабочей модели InlineEditor::$_entity.
	 * Может быть явно определено через InlineEditorAttribute::setValue()
	 * или быть извлеченным из рабочей модели InlineEditor::$_entity
	 * по атрибуту InlineEditorAttribute::$_name.
	 * @var string $_value
	 */
	protected $_value;

	public static function createDropDownMethod($config)
	{
		return DropdownMethod::instance($config);
	}

	public static function createNestedEditorMethod($config)
	{
		return NestedEditorMethod::instance($config);
	}

	public static function createTextMethod($config = array())
	{
		return TextMethod::instance($config);
	}

	public static function createAutocompleteMethod($config = array())
	{
		return AutocompleteMethod::instance($config);
	}

	public static function createPopupMethod($config = array())
	{
		return PopupMethod::instance($config);
	}

	public static function instance($id, GroupEditor $owner = null, array $config = array())
	{
		return new static($id, $owner, $config);
	}

	/**
	 * 
	 * @param InlineMethodEditor $method
	 */
//	public function appendMethod(MethodEditor $method)
//	{
//		$method->owner = $this;
//		Map::push($this->_methods, $method);
//		//$this->addCommand($method->command);
//	}

	public function getTarget()
	{
		return self::TARGET_PREFIX . $this->_uniqid;
	}

	public function getTargetWithHash()
	{
		return '#' . $this->getTarget();
	}

//	protected function addCommand(CommandEditor $command){
//		
//		if(false == Map::in($command->name, $this->_commands)){
//			Map::push($this->_commands, $command);
//			return true;
//		}
//		
//		return false;
//	}
//	
//	protected function getCommands()
//	{
//		return $this->_commands;
//	}

	/**
	 * @brief Геттер.
	 * Возвращает true, если атрибут имеет состояние "Добавленный", false в ином случае.
	 * @note Геттер определяет вычисляемое свойство InlineEditorAttribute::$isAdded
	 * @return bool
	 * @see RevisionHelper::CHANGE_CREATE
	 */
	protected function getIsAdded()
	{
		return $this->state === RevisionHelper::CHANGE_CREATE;
	}

	/**
	 * @brief Геттер.
	 * Возвращает true, если атрибут имеет состояние "Измененный", false в ином случае.
	 * @note Геттер определяет вычисляемое свойство InlineEditorAttribute::$isChanged
	 * @return bool
	 * @see RevisionHelper::CHANGE_UPDATE
	 */
	protected function getIsChanged()
	{
		return $this->state === RevisionHelper::CHANGE_UPDATE;
	}

	/**
	 * @brief Геттер.
	 * Возвращает true, если атрибут имеет состояние "Удаленный", false в ином случае.
	 * @note Геттер определяет вычисляемое свойство InlineEditorAttribute::$isRemoved
	 * @return bool
	 * @see RevisionHelper::CHANGE_REMOVE
	 */
	protected function getIsRemoved()
	{
		return $this->state === RevisionHelper::CHANGE_REMOVE;
	}

	/**
	 * @brief Геттер.
	 * Возвращает значение свойста AttributeInline::$_label
	 * если оно определено, в ином случае будет возвращен лэйбл атрибута
	 * AttributeInline::$_name модели InlineEditor::$_entity.
	 * @return string InlineEditorAttribute::$_label
	 */
	protected function getLabel()
	{
		return $this->_label === null ?
			$this->entity->getAttributeLabel($this->name) :
			$this->_label;
	}

	protected function getMethod()
	{
		return $this->_method;
	}

	/**
	 * @brief Геттер.
	 * Возвращает значение свойста InlineEditorAttribute::$_name.
	 * @return string InlineEditorAttribute::$_name
	 */
	protected function getName()
	{
		return $this->_name;
	}

	/**
	 * @brief Геттер.
	 * Возвращает значение свойста InlineEditorAttribute::$_value
	 * если оно определено, в ином случае будет возвращено значение атрибута
	 * InlineEditorAttribute::$_name модели InlineEditor::$_entity.
	 * @return string InlineEditorAttribute::$_value
	 */
	protected function getValue()
	{
		$name = $this->name;
		$value = $this->_value === null && $this->entity ?
			$this->entity->{$name} :
			$this->_value;
		return trim($value);
	}

	/**
	 * @brief Сеттер.
	 * Определяет значение свойства InlineEditorAttribute::$_label.
	 * @param string $label
	 */
	protected function setLabel($label)
	{
		$this->_label = (string) $label;
	}

	/**
	 * @brief Сеттер.
	 * Определяет значение свойства InlineEditorAttribute::$_label.
	 * @param string $label
	 */
	protected function setMethod(MethodEditor $method)
	{
//		$this->_methods = array();
//		foreach ($methods as $method) {
//			$this->appendMethod($method);
//		}
		$method->owner = $this;
		$this->_method = $method;
	}

	/**
	 * @brief Сеттер.
	 * Определяет значение свойства InlineEditorAttribute::$_name.
	 * @param string $name
	 * @return void
	 */
	protected function setName($name)
	{
		$this->_name = (string) $name;
	}

	/**
	 * @brief Сеттер.
	 * Определяет значение свойства InlineEditorAttribute::$_value.
	 * @param string $value
	 * @return void
	 */
	protected function setValue($value)
	{
		$this->_value = (string) $value;
	}

	/**
	 * @param string $id Идентификатор объекта
	 * @param GroupEditor $owner Объект-владелец. Указывает на объект-инициатор
	 * @param array $config Массив параметров, передаваемых в объект
	 */
	protected function __construct($id, GroupEditor $owner = null, array $config = array())
	{
		$this->load($config);
		$this->_id = $id;
		if (null == $this->_name) {
			$this->_name = $id;
		}
		$this->_owner = $owner;
		$this->_uniqid = uniqid();
		$this->setDefaultMethod();
	}

	private function setDefaultMethod()
	{
		if (!$this->_method) {
			$this->setMethod(self::createTextMethod());
		}
	}

}
