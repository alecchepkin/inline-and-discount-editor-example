<?php

class InlineEditor extends EntityEditor
{

	//abstract protected function createRootGroup(array $config);

	public static function instance($id, $rootConfig)
	{
		$self = new static($id);
		$self->root = $self->createRootGroup($rootConfig);
		return $self;
	}

	public function generateScheme()
	{
		$scheme = array();

		foreach ($this->root->children as $group) {
			$scheme[$group->id] = $this->makeGroup($group);
		}

		/* >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> */
//		echo '<pre>';
//		echo '<<< $scheme >>>', "\n";
//		print_r($scheme);
//		echo "\n";
//		exit(__FILE__ . ':' . __FUNCTION__ . ':' . __LINE__);
		/* <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< */

		return $scheme;
	}

	public function makeGroup(GroupInline $group, $level = 1)
	{
		$_group = new stdClass();
		$_group->id = $group->id;
		$_group->title = $group->title;
		$_group->editable = $group->editable;
		$_group->btnAddAttr = $group->btnAddAttr;
		$_group->btnAddGroup = $group->btnAddGroup;
		$_group->btnEditGroup = $group->btnEditGroup;
		$_group->attributes = $this->makeAttributes($group);
		$_group->comparative = $group->comparative;
		$_group->open = $group->open ? 'open' : 'close';
		$_group->level = $level;
		$_group->url = $group->url;
		$children = array();
		foreach ($group->children as $child) {
			$children[$child->id] = $this->makeGroup($child, $level + 1);
		}

		$_group->groups = $children;
		return $_group;
	}

	private function makeAttributes(GroupInline $group)
	{
		$attributes = array();
		foreach ($group->attributes as $key => $attribute) {
			$_attribute = new stdClass();
			$_attribute->name = $attribute->name;
			$_attribute->editable = $attribute->editable;
			$_attribute->comparative = $attribute->comparative;
			$_attribute->label = $attribute->label;
			$_attribute->type = $attribute->getType();
			$_attribute->default = $attribute->default;
			$_attribute->value = $attribute->value;
			$_attribute->expected = $attribute->expected;
			$_attribute->url = $attribute->url;
			$_attribute->action = $attribute->getAction();
			$_attribute->state = $attribute->calculateAttributeState();
			$_attribute->target = $attribute->target;
			$_attribute->targetWithHash = $attribute->targetWithHash;
			$_attribute->method = $this->getMethod($attribute);
			$_attribute->url = $attribute->url;
			$_attribute->entity = get_class($attribute->entity);
			$_attribute->entity_id = $attribute->entity->primaryKey;
			$_attribute->group_id = $group->id;

			$attributes[] = $_attribute;
		}
		return $attributes;
	}

	private function attrEditor($attribute)
	{
		if ($attribute->editor) {
			return $this->makeGroup($attribute->editor->root);
		}
	}

	private function getMethod($attribute)
	{
		$result = array();
		if ($attribute->method) {
			$result = (object) $attribute->method->__toString();
		}
		return $result;
	}

	protected function createRootGroup(array $config)
	{
		return GroupInline::instance($this->id, null, $config);
	}

	protected function setRoot(GroupEditor $root)
	{
		$this->_root = $root;
	}

	protected function getRoot()
	{
		return $this->_root;
	}

}
