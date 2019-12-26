<?php


namespace Firesphere\SolrPermissions\Tests;


use Firesphere\SolrPermissions\Extensions\BaseIndexExtension;
use Firesphere\SolrSearch\Queries\BaseQuery;
use SilverStripe\Dev\SapphireTest;
use Solarium\QueryType\Select\Query\Query;

class BaseIndexExtensionTest extends SapphireTest
{

    public function testOnBeforeSearch()
    {
        $object = new \CircleCITestIndex();
        $extension = new BaseIndexExtension();
        $extension->setOwner($object);

        $query = new BaseQuery();
        $clientQuery = new Query();

        $result = $extension->onBeforeSearch($query, $clientQuery);

        $this->assertEquals(['MemberView' => ['null']], $query->getFilter());
    }
}
