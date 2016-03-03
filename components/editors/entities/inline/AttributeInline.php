<?php

class AttributeInline extends AttributeEditor
{
	use ElementInline;

	public function getType(){
		return 0;
	}
	public function getAction(){

		switch ($this->state) {
			case RevisionHelper::CHANGE_REMOVE:
				return 'Восстановить';
			case (RevisionHelper::CHANGE_NONE):
				return $this->value ? 'Удалить' : 'Указать';
			case RevisionHelper::CHANGE_CREATE:
			case RevisionHelper::CHANGE_UPDATE:
				return 'Удалить';
		}
	}
	
	/**
	 * @brief Эталонное значение для атрибута InlineEditorAttribute::$_name.
	 * Может быть явно определено через InlineEditorAttribute::setExpected()
	 * или быть извлеченным из эталонной модели InlineEditor::$_reference
	 * по атрибуту InlineEditorAttribute::$_name.
	 * @var string $_expected
	 */
	protected $_expected;

	/**
	 * @brief Состояние атрибута InlineEditorAttribute::$_name.
	 * Принимает значения состояний, описаных в RevisionHelper::$_changes.
	 * @see RevisionHelper::$_changes
	 * @var int $_state
	 */
	protected $_state = RevisionHelper::CHANGE_NONE;

	protected function __construct($id, GroupEditor $owner = null, array $config = array())
	{
		parent::__construct($id, $owner, $config);
		$this->_state = $this->calculateAttributeState();
	}

	/**
	 * @brief Геттер.
	 * Возвращает значение свойста InlineEditorAttribute::$_expected
	 * если оно определено, в ином случае будет возвращено значение атрибута
	 * InlineEditorAttribute::$_name модели InlineEditor::$_reference.
	 * @return string InlineEditorAttribute::$_expected
	 */
	protected function getExpected()
	{
		$name = $this->name;
		$expected = $this->_expected === null && $this->reference ?
			$this->reference->{$name} :
			$this->_expected;
		return trim($expected);
	}

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
	 * Возвращает значение свойста InlineEditorAttribute::$_state.
	 * @return int InlineEditorAttribute::$_state
	 */
	protected function getState()
	{
		return $this->_state;
	}

	/**
	 * @brief Сеттер.
	 * Определяет значение свойства InlineEditorAttribute::$_expected.
	 * @param string $expected
	 * @return void
	 */
	protected function setExpected($expected)
	{
		$this->_expected = (string) $expected;
	}

	/**
	 * @brief Сеттер.
	 * Определяет значение свойства InlineEditorAttribute::$_state.
	 * @param int $state
	 * @return void
	 */
	protected function setState($state)
	{
		$this->_state = (int) $state;
	}

	/**
	 * @brief Вычисляет остояние атрибута и возвращает код,
	 * соответствующий этому состоянию. Вызывается из конструктора.
	 * @return int Состояние атрибута
	 */
	public function calculateAttributeState()
	{
		$expected = $this->expected;
		$value = $this->value;

		if ($expected && $value == null) {
			return RevisionHelper::CHANGE_REMOVE;
		} else if ($expected == null && $value) {
			return RevisionHelper::CHANGE_CREATE;
		} else if ($expected != $value) {
			return RevisionHelper::CHANGE_UPDATE;
		} else {
			return RevisionHelper::CHANGE_NONE;
		}
	}

}