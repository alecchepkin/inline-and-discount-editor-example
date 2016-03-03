<?php

/**
 * @brief Виджет информационного компонента.
 * @ingroup Editor
 */
class InlineEditorWidget extends Widget
{

	public $generateScheme = true;

	/**
	 * @brief Массив CSS, подключаемых в виджет.
	 * @var array $_css
	 */
	protected $_scheme = array();
	protected $_css = array(
		'css.widgets/editors/inline.css'
	);

	/**
	 * @brief Объект информационного компонента.
	 * @var EntityEditor $_editor
	 */
	protected $_editor;

	/**
	 * @brief Массив JS, подключаемых в виджет.
	 * @var array $_js
	 */
	protected $_js = array(
		'/js/plugins/jquery.finder.js',
		'/js/widgets/editors/editor.jquery.js',
		'/js/widgets/editors/inline.js'
	);

	/**
	 * @brief Список дополнительных действий над атрибутами.
	 * Используется при формировании вывода атрибутов некоторых типов.
	 * @var array $_actions
	 */
	private static $_actions = array(
		'remove' => 'Удалить',
		'restore' => 'Восстановить',
		'specify' => 'Указать'
	);
	
	private static $_types = array(
		RevisionHelper::CHANGE_NONE => 'none',
		RevisionHelper::CHANGE_CREATE => 'added',
		RevisionHelper::CHANGE_UPDATE => 'changed',
		RevisionHelper::CHANGE_REMOVE => 'removed',
	);

	public function getTypeByState($state)
	{
		if (isset($this->types[$state]))
			return $this->types[$state];
	}

	/**
	 * @brief Геттер.
	 * Возвращает значение свойства InlineEditorWidget::$_actions.
	 * @return stdClass
	 */
	protected function getActions()
	{
		return (object) self::$_actions;
	}

	protected function getScheme()
	{
		return $this->_scheme ? : $this->editor->generateScheme();
	}

	protected function getTypes()
	{
		return self::$_types;
	}

	/**
	 * @brief Запуск виджета.
	 * @return void
	 */
	public function run()
	{

		$this->render('layouts.widgets.editor.inline', array(
			'scheme' => $this->scheme
		));
	}

	/**
	 * @brief Геттер.
	 * Возвращает значение свойства InlineEditorWidget::$_editor.
	 * @return EntityEditor
	 */
	protected function getEditor()
	{
		return $this->_editor;
	}

	/**
	 * @brief Сеттер.
	 * Определяет значение свойства InlineEditorWidget::$_editor.
	 * @param EntityEditor $editor
	 * @return void
	 */
	protected function setEditor(EntityEditor $editor = null)
	{
		$this->_editor = $editor;
	}

	protected function setScheme($scheme)
	{
		$this->_scheme = $scheme;
	}

}
