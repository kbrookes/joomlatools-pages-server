<?php
class ExtStoryblokModelBlog extends ComPagesModelWebservice
{
	protected function _initialize(KObjectConfig $config)
	{
		$config->append([
			'url'          => 'https://api.storyblok.com/v2/cdn/stories?sort_by=first_published_at:desc&filter_query[component][in]=Post&starts_with=blog&version=published&per_page=100',
			'api_key'      => null,
			'data_path'    => 'stories',
			'identity_key' => 'slug',
			'cache_path'   =>  $this->getObject('com://site/pages.config')->getCachePath().'/storyblok',
		]);
	   
		parent::_initialize($config);
	}

	public function getUrl(array $variables = array())
    {
        $url = parent::getUrl($variables);
		$url->query['token'] = $this->getConfig()->api_key;
		
		return $url;
    }
	
	public function fetchData($count = false)
	{
		$data = parent::fetchData();
		array_walk($data, function(&$item)
		{
			$item += $item['content'];
			unset($item['content']);
		});
		
		return $data;
	}
}
