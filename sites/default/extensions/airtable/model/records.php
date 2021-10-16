<?php
class ExtAirtableModelRecords extends ComPagesModelWebservice
{
	protected function _initialize(KObjectConfig $config)
	{
		$config->append([
			'url'         => 'https://api.airtable.com/v0/appxFHbo5P6cryBsh/Small%20Caps?maxRecords=300',
			'api_key'     => null,
			'identity_key'  => 'Code',
			'data_path'   => 'records',
			'cache_path'  =>  $this->getObject('com://site/pages.config')->getCachePath().'/airtable',
		]);
	   
		parent::_initialize($config);
	}
	
	public function getHeaders()
	{
		$headers = parent::getHeaders();
		$headers['Authorization'] = 'Bearer '.$this->getConfig()->api_key;

		return $headers;
	}
	
	public function fetchData($count = false)
	{
		$data = parent::fetchData();
		array_walk($data, function(&$item)
		{
			$item += $item['fields'];
			unset($item['fields']);
		});
		
		return $data;
	}
}
