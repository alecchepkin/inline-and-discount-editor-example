<?php

trait ElementInline{
		
	/**
	 * @brief Включить/отключить сравнительный режим.
	 * Формирует сравнительную страницу объекта InlineEditor::$_entity с эталонным
	 * объектом InlineEditor::$_reference. Свойство является глобальным для всех
	 * объектов редактора и может быть переопределено в дальнейшем.
	 * @var bool $_comparative
	 */

	protected $_comparative;

	/**
	 * @brief Включить/отключить режим редактирования.
	 * Разрешает изменять значения атрибутов модели InlineEditor::$_entity.
	 * Свойство является глобальным для всех объектов редактора
	 * и может быть переопределено в дальнейшем.
	 * @var bool $_editable
	 */

	protected $_editable;
	
	/**
	 * @brief Эталонная модель, с которым сравнивается рабочая модель
	 * InlineEditor::$_entity. Свойство является глобальным для всех объектов редактора
	 * и может быть переопределено в дальнейшем.
	 * @var CModel $_reference
	 */

	protected $_reference;

	/**
	 * @brief Геттер.
	 * Возвращает значение свойста InlineEditor::$_comparative.
	 * Если значение свойста InlineEditor::$_comparative не определено, метод вернет
	 * значение аналогичного свойста из объекта-владельца InlineEditor::$_owner.
	 * @return bool InlineEditor::$_comparative
	 */

	protected function getComparative()
	{ 
		return $this->_comparative === null && $this->owner ?
			$this->owner->comparative :
			$this->_comparative;
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
	 * Возвращает значение свойства InlineEditor::$_editable.
	 * Если значение свойста InlineEditor::$_editable не определено, метод вернет
	 * значение аналогичного свойста из объекта-владельца InlineEditor::$_owner.
	 * @return bool InlineEditor::$_editable
	 */

	protected function getEditable()
	{
		return $this->_editable === null && $this->owner ?
			$this->owner->editable :
			$this->_editable;
	}

	/**
	 * @brief Геттер.
	 * Возвращает значение свойста InlineEditor::$_reference.
	 * Если значение свойста InlineEditor::$_reference не определено, метод вернет
	 * значение аналогичного свойста из объекта-владельца InlineEditor::$_owner.
	 * @return CModel InlineEditor::$_reference
	 */

	protected function getReference()
	{
		return $this->_reference === null && $this->owner ?
			$this->owner->reference :
			$this->_reference;
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
	 * Определяет значение свойства InlineEditor::$_reference.
	 * @param CModel $reference
	 * @return void
	 */

	protected function setReference(CModel $reference)
	{
		$this->_reference = $reference;
	}

}