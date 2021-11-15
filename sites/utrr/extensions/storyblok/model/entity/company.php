<?php

class ExtStoryblokModelEntityCompany extends ComPagesModelEntityItem
{
    public function getPropertyRecord()
	{
        $records = $this->getObject('ext:airtable.model.records')
        ->Code($this->code)
        ->fetch();

        return $records;
	}
}