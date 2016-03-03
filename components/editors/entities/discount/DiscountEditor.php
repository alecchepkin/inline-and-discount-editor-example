<?php

class DiscountEditor extends EntityEditor
{

	protected $_entity;
	protected $_scheme;
	protected $_groups = array();
	protected $_types = array();
	protected $_cache_id_pattern = 'DiscountEditor_%d';

	protected function setEntity(DiscountCustomerBase $entity)
	{
		$this->_entity = $entity;
	}

	protected function setCache($cache)
	{
		$this->_cache = (boolean) $cache;
	}

	protected function setCleanCache($cleanCache)
	{
		$this->_cache = (boolean) $cleanCache;
	}

	public static function instanceWithTypesAndGroups($id, $config)
	{
		$self = static::instance($id, $config);
		$self->_groups = InventoryGroupDiscount::instance()->findAll('use_for_discount_form = 1');
		$self->_types = InfEquipType::instance()->findAll();
		return $self;
	}

	public function generateScheme($useCache = true, $updateCache = false)
	{
		if ($updateCache) {
			Yii::app()->cache->set($this->cacheId(), null);
		}
		if ($useCache) {
			$this->_scheme = Yii::app()->cache->get($this->cacheId());
		}

		if (!$this->_scheme) {
			$this->_scheme = new stdClass();
			$this->_scheme->id = $this->_id;
			$this->typesToScheme();
			$this->groupsToScheme();
			$this->competitorDiscountsToScheme();
		}

		if ($useCache) {
			Yii::app()->cache->set($this->cacheId(), $this->_scheme);
		} else {
			Yii::app()->cache->set($this->cacheId(), null);
		}
		return $this->_scheme;
	}

	private function typesToScheme()
	{
		$types = array();
		foreach ($this->_types as $type) {
			$types[$type->equip_type_id] = (object) array(
					'equip_type_id' => $type->equip_type_id,
					'name' => $type->name,
					'competitorsCount' => count($competitors = $this->competitorsToTypeScheme($type)),
					'selected' => key($competitors),
					'competitors' => $competitors,
			);
		}
		$this->_scheme->types = $types;
	}

	private function groupsToScheme1()
	{
		$groups = array();
		foreach ($this->_groups as $group) {
			$groups[] = (object) array(
					'group_id' => $group->group_id,
					'name' => $group->name
			);
		}
		$this->_scheme->groups = $groups;
	}

	private function groupsToScheme()
	{
		$groups = array();
		foreach ($this->_groups as $group) {
			$groups[] = (object) array(
					'groupId' => $group->group_id,
					'nameGroup' => $group->name,
					'countryCompetitor' => '',
					'discountOur' => '',
					'discountGivenByCompetitor' => '',
					'discountWeWantAddToGivenCompetitor' => '',
					'discountRequired' => '',
					'discountForApproval' => '',
					'discountTotalWithExtra' => '',
			);
		}
		$this->_scheme->groups = $groups;
	}

	private function competitorsToTypeScheme(InfEquipType $type)
	{
		$cr = new CDbCriteria();
		$_groups = array();
		foreach ($type->equipTypeInventoryGroupDiscounts as $g) {
			if ($g->use_for_discount_form) {
				$_groups[] = $g->group_id;
			}
		}
		$cr->addInCondition('group_id', $_groups);
		$competitors = InfCompetitorDiscount::instance()->findAll($cr);
		$_competitors = array();
		foreach ($competitors as $c) {
			$_competitors[$c->competitor_id] = $c->infCompetitor->name;
		}
		return $_competitors;
	}

	private function competitorDiscountsToScheme()
	{
		$competitorDiscounts = array();
		foreach (InfCompetitorDiscount::instance()->findAll() as $c) {
			if ($c->infDiscountGroupDiscount->use_for_discount_form) {
				$key = $c->infDiscountGroupDiscount->equip_type_id . '_' . $c->competitor_id;
				$competitorDiscounts[$key] []= (object)array(
					'competitor_discount_id' => $c->competitor_discount_id,
					'competitor_id' => $c->competitor_id,
					'group_id' => $c->group_id,
					'value' => $c->value,
					'country' => $c->country,
					'name' => $c->infCompetitor->name,
					'equip_type_id' => $c->infDiscountGroupDiscount->equip_type_id,
				);
			}
		}
		$this->_scheme->competitorsCount = count($competitorDiscounts);
		$this->_scheme->competitorDiscounts = $competitorDiscounts;
	}

	private function cacheId()
	{
		return String::compile($this->_cache_id_pattern, array($this->_entity->discount_customer_id));
	}

}
