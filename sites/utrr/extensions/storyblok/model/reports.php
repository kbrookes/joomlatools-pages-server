<?php
class ExtStoryblokModelReports extends ComPagesModelWebservice
{
    public function __construct(KObjectConfig $config)
    {
        parent::__construct($config);

        $this->getState()
            ->insert('slug', 'cmd', 'stock-research');
    }

    protected function _initialize(KObjectConfig $config)
    {
        $config->append([
            'url' => 'https://api.storyblok.com/v2/cdn/stories?version=published',
            'api_key' => null,
            'data_path' => 'stories',
            'identity_key' => 'slug',
            'cache_path' => $this->getObject('com://site/pages.config')->getCachePath() . '/storyblok',
        ]);

        parent::_initialize($config);
    }

    public function getUrl(array $variables = array())
    {
        $url = parent::getUrl($variables);
        $url->query['token'] = $this->getConfig()->api_key;

        if($variables['slug']) {
            $url->query['starts_with'] = $state->slug;
        }

        return $url;
    }

    public function fetchData($count = false)
    {
        $data = parent::fetchData();
        array_walk($data, function (&$item) {
            $item += $item['content'];
            unset($item['content']);
        });

        return $data;
    }
}
