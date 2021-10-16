<?php

class ExtStoryblokModelEntityCompany extends ComPagesModelEntityItem
{
    public function getPropertyRecord()
	{
        $records = $this->getObject('ext:airtable.model.records')
        ->Code($this->Code)
        ->fetch();

        return $records;
	}
}