<?php

class CommandEditor extends Component implements OwnerAttributeInterface
{

	use OwnerAttribute;

	const ACTION_EXECUTE = 'execute';
	const ACTION_UNDO = 'undo';

	protected $_execute = array();
	protected $_undo = array();
	protected $_name;
	protected $_onwer;
	protected $_params = array();

	public static function instance($name, array $config)
	{
		$self = new static();
		$self->_name = $name;
		$self->load($config);
		return $self;
	}

//	public function getOptions()
//	{
////		return array(
////			'name' => $this->_name,
////			'events' => $this->eventsToString(),
////			'params' => $this->paramsToString(),
////		);
//		$options = array();
//		$options['style'] = 'display:none';
//		$options['name'] = $this->_name;
//		if ($this->_execute) {
//			$options['execute'] = $this->executeToJson();
//		}
//		if ($this->_undo) {
//			$options['undo'] = $this->undoToJson();
//		}		
//		if ($this->_params) {
//			$options['params'] = $this->paramsToJson();
//		}		
//
//		return $options;
//	}
	public function getOptions()
	{
		$options = array();
		$options['name'] = $this->_name;
		if ($this->_execute) {
			$options['execute'] = $this->executeToJson();
		}
		if ($this->_undo) {
			$options['undo'] = $this->undoToJson();
		}		
		if ($this->_params) {
			$options['params'] = $this->paramsToJson();
		}		

		return $options;
	}

	private function arrayToString($array)
	{
		$string = '';
		$sizeof = count($array);
		$iterator = 1;
		foreach ($array as $key => $value) {
			if (is_array($value)) {
				$string.= $this->arrayToString($value);
				if ($iterator != $sizeof) {
					$string.= '|';
				}
			} else {
				$string.= $key . ':' . $value;
				if ($iterator != $sizeof) {
					$string.= ';';
				}
			}
			$iterator++;
		}
		return $string;
	}
	private function executeToString()
	{
		return $this->arrayToString($this->_execute);
	}
	private function executeToJson()
	{
		return CJSON::encode($this->_execute);
	}
	private function undoToJson()
	{
		return CJSON::encode($this->_undo);
	}
	private function undoToString()
	{
		return $this->arrayToString($this->_undo);
	}

	private function paramsToJson()
	{
		$params = $this->resolveParams();
		return CJSON::encode($params);
	}
	private function paramsToString()
	{
		$params = $this->resolveParams();
		return $this->arrayToString($params);
	}

	private function resolveEvents()
	{

		$events = array();
		foreach ($this->events as $key => $value) {
			if (is_numeric($key)) {
				$events[$value] = self::ACTION_EXECUTE;
			} else {
				$events[$key] = $value;
			}
		}

		return $events;
	}

	private function resolveParams()
	{
		$params = array();
		foreach ($this->params as $key => $value) {
			if (is_numeric($key)) {
				$params[$value] = $this->getAttribute($value);
			} else {
				$params[$key] = $this->getAttribute($value);
			}
		}

		return $params;
	}

	protected function getExecute()
	{
		return $this->_execute;
	}

	protected function getUndo()
	{
		return $this->_undo;
	}

	protected function getParams()
	{
		return $this->_params;
	}

	protected function getName()
	{
		return $this->_name;
	}

	protected function getOwner()
	{
		return $this->_name;
	}

	protected function getEvents()
	{
		return $this->_events;
	}

	private function __construct(array $config = array())
	{
		
	}

	protected function setUndo(array $undo)
	{
		if ($this->checkActions($undo)) {
			$this->_undo = $undo;
		}
	}

	protected function setExecute(array $execute)
	{
		if ($this->checkActions($execute)) {
			$this->_execute = $execute;
		}
	}

	protected function setParams(array $params)
	{
		$this->_params = $params;
	}

	protected function setName($name)
	{
		$this->name = (string) $name;
	}

	protected function setOwner(MethodEditor $owner)
	{
		$this->owner = $owner;
	}

	protected function setEvents(array $events)
	{
		$this->_events = $events;
	}

	/**
	 * @todo сделать проверку формата
	 * @param array $actions
	 */
	private function checkActions(array $actions)
	{
		return true;
	}

}
