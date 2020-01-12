<?php


namespace Firesphere\SolrPermissions\Tests;

use Firesphere\SolrPermissions\Extensions\SchemaFactoryExtension;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\ORM\ArrayList;

class SchemaFactoryExtensionTest extends SapphireTest
{
    public function testOnBeforeFilterFields()
    {
        $list = ArrayList::create();

        $extension = new SchemaFactoryExtension();

        $extension->onBeforeFilterFields($list);

        $item = $list->first();
        $expected = [
            'Field' => 'MemberView',
            'Type' => 'string',
            'Indexed' => 'true',
            'Stored' => 'true',
            'MultiValued' => 'true',
        ];
        $this->assertEquals($expected, $item);
    }
}
