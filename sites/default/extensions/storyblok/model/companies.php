<?php
class ExtStoryblokModelCompanies extends ComPagesModelWebservice
{
	protected function _initialize(KObjectConfig $config)
	{
		$config->append([
			'token_public'		=> null, // Used for standard publicly available views
			'token_preview'		=> null, // Used for previewing draft content
			'data_path'   		=> 'stories',
			'identity_key'		=> 'slug',
			'name'				=> 'name',
			'created_at'		=> 'created_at',
			'published_at'		=> 'published_at',
			'cache_path'  		=>  $this->getObject('com://site/pages.config')->getCachePath().'/storyblok',
			'per_page'			=> 20, // Number of responses per page
			'page'				=> 1, // Starting page number
		]);
	   
		parent::_initialize($config);
	}
	
	public function fetchData($count = false)
	{
		$data = parent::fetchData();
		array_walk($data, function(&$item)
		{
			$item += $item['content'];
			unset($item['content']);
		});
		
		//Check if the database has a lastModified column
		if(!$this->_hash_key && array_key_exists('lastModified', $data[0])) {
			$this->_hash_key = array('lastModified');
		}
		
		return $data;
	}
	
	public function setPropertyCode($value)
	{
		if($value)
		{
			//Get the single Airtable row
			$value = $this->getObject('ext:model.airtable')
				->Code($value)
				->fetch()
				->find($value);
		}

		return $value;
	}
	
}
