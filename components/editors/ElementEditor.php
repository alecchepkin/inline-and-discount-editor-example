<?php

abstract class ElementEditor extends Component implements OwnerAttributeInterface
{

	use OwnerAttribute;
	
	/**
	 * @brief Значение по-умолчанию.
	 * Значение, возвращаемое в случае отсутствия значения у запрашиваемого свойства.
	 * Используется в классах-наследниках. Свойство является глобальным для всех
	 * объектов редактора и может быть переопределено в дальнейшем.
	 * @var string $_default
	 */
	protected $_default = 'Не указан';

	/**
	 * @brief Редактируемая или просматриваемая модель. Также является рабочим
	 * объектом редактора. Свойство является глобальным для всех объектов редактора
	 * и может быть переопределено в дальнейшем.
	 * @var CModel $_entity
	 */
	protected $_entity;

	/**
	 * @brief Идентификатор объекта.
	 * Строка, идентифицирующая блок или атрибут. В большинстве случаев формируется
	 * автоматически. Через идентификатор производится обращение к тому или иному объекту,
	 * присутствующему в редакторе.
	 * @var string $_id
	 */
	protected $_id;

	/**
	 * @brief URL для обновления.
	 * @var string
	 */
	protected $_url;

	/**
	 * @brief Объект-владелец. Указывает на объект-инициатор.
	 * @var CComponent $_owner
	 */
	protected $_owner;

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

	protected function getUrl()
	{
		return $this->_url === null && $this->owner ?
			$this->owner->url :
			$this->_url;
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

	protected function setUrl($url)
	{
		$this->_url = (string) $url;
	}

}
