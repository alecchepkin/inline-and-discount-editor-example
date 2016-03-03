<?php

abstract class GroupEditor extends ElementEditor
{

	/**
	 *
	 * @var type 
	 */
	protected $_attributes = array();

	/**
	 *
	 * @var type 
	 */
	protected $_children = array();
	
	protected $_btnAddAttr = false;
	protected $_btnAddGroup = false;
	protected $_btnEditGroup = false;
	
	/**
	 * @brief Заголовок блока.
	 * @var string $_title
	 */
	protected $_title;

	/**
	 * @brief Фабричный метод.
	 * Возвращает объект атрибута, связанный с объектом-владельцем $owner.
	 * @param GroupEditor $owner Объект-владелец
	 * @param string $id Идентификатор объекта
	 * @param array $config Конфигурационный массив
	 * @return InlineEditorAttribute Объект атрибута
	 */

	abstract public function createAttribute($id, array $config = array());

	/**
	 * @brief Фабричный метод.
	 * Возвращает объект группы, связанный с объектом-владельцем $owner.
	 * @param InlineElementEditor $owner Объект-владелец
	 * @param string $id Идентификатор объекта
	 * @param array $config Конфигурационный массив
	 * @return GroupInline Объект группы
	 */
	
	abstract public function createGroup($id, array $config = array());

	/**
	 * 
	 * @param array $config
	 * @return type
	 */

	public function addAttribute($id, array $config)
	{
		$attribute = $this->createAttribute($id, $config);
		$this->appendAttribute($attribute);
		return $attribute;
	}

	/**
	 * 
	 */

	public function appendAttribute($attribute)
	{
		$this->_attributes[$attribute->id] = $attribute;
		//$this->_attributes[] = $attribute;
		return $attribute;
	}


	/**
	 * 
	 */

	public function appendGroup($group)
	{
		$this->_children[$group->id] = $group;
		return $group;
	}

	public function addGroup($id, $config = array())
	{
		$group = $this->createGroup($id, $config);
		$this->appendGroup($group);
		return $group;
	}

	/**
	 * 
	 * @return type
	 */

	public function hasAttributes()
	{
		return (bool) Map::length($this->_attributes);
	}

	/**
	 * 
	 * @return type
	 */

	public function hasChildren()
	{
		return (bool) Map::length($this->_children);
	}

	
	/**
	 * @brief Фабричный метод.
	 * Возвращает объект атрибута, связанный с объектом-владельцем $owner.
	 * @param string $id Идентификатор объекта
	 * @param array $config Конфигурационный массив
	 * @return GroupEditor Объект атрибута
	 */ 

	public static function instance($id, GroupEditor $owner = null, array $config = array())
	{
		return new static($id, $owner, $config);
	}


	/**
	 * 
	 * @param type $path
	 */
	public function get($path, $searchingAttribute = true)
	{
	$delimert = '.';
		if(stripos($path, $delimert)){
			$ids = explode($delimert, $path);
		}else{
			$ids = array($path);
		}
		if($searchingAttribute){
			$last = sizeof($ids)-1;
			$attrId = $ids[$last];
			unset($ids[$last]);
		}
		
		$current = $this;
		foreach($ids as $id){
			$current = Map::get($current->_children, $id);
			if(!$current){
				return null;
			}
		}
		if($searchingAttribute){
			return Map::get($current->_attributes, $attrId);
		}
		return $current;	
	}

	/**
	 * 
	 * @return type
	 */

	protected function getAttributes()
	{
		return $this->_attributes;
	}

	protected function getChildren()
	{
		return $this->_children;
	}
	
	/**
	 * @brief Геттер.
	 * Возвращает конфигурацию объекта в виде массива.
	 * @return array Массив параметров объекта
	 */

	protected function getConfiguration()
	{
		$configuration = new stdClass();
		$configuration->comparative = $this->comparative;
		return (array) $configuration;
	}

	/**
	 * @brief Геттер.
	 * Возвращает значение свойста InlineEditor::$_default.
	 * Если значение свойста InlineEditor::$_default не определено, метод вернет
	 * значение аналогичного свойста из объекта-владельца InlineEditor::$_owner.
	 * @return string InlineEditor::$_default
	 */

	protected function getDefault()
	{
		return $this->_default === null && $this->owner ?
			$this->owner->default :
			$this->_default;
	}

	/**
	 * @brief Геттер.
	 * Возвращает значение свойства InlineEditor::$_entity.
	 * Если значение свойста InlineEditor::$_entity не определено, метод вернет
	 * значение аналогичного свойста из объекта-владельца InlineEditor::$_owner.
	 * @return CModel InlineEditor::$_entity
	 */

	protected function getEntity()
	{
		return $this->_entity === null && $this->owner ?
			$this->owner->entity :
			$this->_entity;
	}

	/**
	 * @brief Геттер.
	 * Возвращает значение свойства InlineEditor::$_id.
	 * @return CModel InlineEditor::$_id
	 */

	protected function getId()
	{
		return (string) $this->_id;
	}

	/**
	 * @brief Геттер.
	 * Возвращает значение свойста InlineEditor::$_owner.
	 * @return CComponent InlineEditor::$_owner
	 */

	protected function getOwner()
	{
		return $this->_owner;
	}

	/**
	 * @brief Геттер.
	 * Возвращает значение свойста InlineEditorGroup::$_title.
	 * @return string InlineEditorGroup::$_title
	 */

	protected function getTitle()
	{
		return $this->_title;
	}


	/**
	 * 
	 * @param array $attributes
	 */

	protected function setAttributes(array $config)
	{
		foreach($config as $key => $value){
			if(Map::isArray($value)){
				if(!is_numeric($key)){
					$id = $key;
				}else{
//					$id = $value['name'];
					$id = $key;
				}
				$_config = $value;
			} else{
				$id = $value;
				$_config = array('name'=> $value);
			}
			$this->addAttribute($id, $_config);
		}
	}

	public function getbtnAddAttr()
	{
		return (boolean)$this->_btnAddAttr;
	}
	
	public function getbtnAddGroup()
	{
		return (boolean)$this->_btnAddGroup;
	}
	
	public function getbtnEditGroup()
	{
		return (boolean)$this->_btnEditGroup;
	}
	
	protected function setbtnAddAttr($button)
	{
		$this->_btnAddAttr = (boolean)$button;
	}
	protected function setbtnAddGroup($button)
	{
		$this->_btnAddGroup = (boolean)$button;
	}
	protected function setbtnEditGroup($button)
	{
		$this->_btnEditGroup = (boolean)$button;
	}
	
	/**
	 * @brief Сеттер.
	 * Определяет значение свойства InlineEditor::$_comparative.
	 * @param bool $comparative
	 * @return void
	 */

	protected function setComparative($comparative)
	{
		$this->_comparative = (bool) $comparative;
	}

	/**
	 * 
	 */
	
	protected function setChildren(array $config)
	{
		foreach($config as $id => $_config){
			$this->addGroup($id, $_config);
		}
	}
	/**
	 * @brief Сеттер.
	 * Определяет значение свойства InlineEditor::$_default.
	 * @param string $default
	 * @return void
	 */

	protected function setDefault($default)
	{
		$this->_default = $default;
	}

	/**
	 * @brief Сеттер.
	 * Определяет значение свойства InlineEditor::$_editable.
	 * @param bool $editable
	 * @return void
	 */

	protected function setEditable($editable)
	{
		$this->_editable = (bool) $editable;
	}

	/**
	 * @brief Сеттер.
	 * Определяет значение свойства InlineEditor::$_entity.
	 * @param CModel $entity
	 * @return void
	 */

	protected function setEntity(CModel $entity)
	{
		$this->_entity = $entity;
	}

	/**
	 * @brief Сеттер.
	 * Определяет значение свойства InlineEditor::$_id.
	 * @param string $id
	 * @return void
	 */

	protected function setId($id)
	{
		$this->_id = (string) $id;
	}
	
	/**
	 * @brief Сеттер.
	 * Определяет значение свойства InlineEditorGroup::$_title.
	 * @param string $title
	 * @return void
	 */
	protected function setTitle($title)
	{
		$this->_title = (string) $title;
	}

	/**
	 * @brief Закрытый конструктор.
	 * @param string $id Идентификатор объекта
	 * @param array $config Массив параметров, передаваемых в объект
	 */

	private function __construct($id, $owner, array $config = array())
	{
		$this->load($config);
		$this->_id = $id;
		$this->_owner = $owner;
	}
}
