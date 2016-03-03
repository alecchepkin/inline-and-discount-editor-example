<?php

class AutocompleteMethod extends TextMethod
{
	protected $_url;
	
	public function __toString()
	{
		$result = parent::__toString();
		$result['url'] = $this->url; 
		return $result;
	}
	
	protected function getUrl()
	{
		return $this->_url;
	}
	
	protected function setUrl($url)
	{
		$this->_url = (string) $url;
	}
}