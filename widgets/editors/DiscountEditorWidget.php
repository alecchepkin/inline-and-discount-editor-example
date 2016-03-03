<?php

/**
 * @brief Виджет информационного компонента.
 * @ingroup Editor
 */
class DiscountEditorWidget extends Widget
{

	public $generateScheme = true;

	/**
	 * @brief Массив CSS, подключаемых в виджет.
	 * @var array $_css
	 */
	protected $_scheme = array();
	protected $_css = array(
		'css.widgets/editors/discount.css'
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
		'/js/widgets/editors/discount/discount.jquery.js',
		'/js/widgets/editors/discount/discount.js'
	);

	protected function getScheme()
	{
		return $this->_scheme ? : $this->editor->generateScheme();
	}

	/**
	 * @brief Запуск виджета.
	 * @return void
	 */
	public function run()
	{

		$this->render('layouts.widgets.editor.discount', array(
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
