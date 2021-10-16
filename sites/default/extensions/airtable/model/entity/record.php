<?php

class ExtAirtableModelEntityRecord extends ComPagesModelEntityItem
{
    public function getPropertyRecords()
	{
        $records = $this->getObject('ext:airtable.model.records')
        ->code($this->Content['code'])
        ->fetch();

        return $records;
	}
}