<?php

trait OwnerAttribute{
	public function getAttribute($attribute){
		if(isset($this->{$attribute})){
			return $this->{$attribute};
		} else if($this->owner){
			return $this->owner->getAttribute($attribute);
		}
		return $attribute;
	}
}
