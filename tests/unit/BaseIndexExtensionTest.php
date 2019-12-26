<?php


namespace Firesphere\SolrPermissions\Tests;


use Firesphere\SolrPermissions\Extensions\BaseIndexExtension;
use Firesphere\SolrSearch\Queries\BaseQuery;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\Security\DefaultAdminService;
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

        $member = (new DefaultAdminService())->findOrCreateDefaultAdmin();
        $this->logInAs($member);

        $query = new BaseQuery();
        $clientQuery = new Query();

        $extension->onBeforeSearch($query, $clientQuery);

        $this->assertContains(['1-' . $member->ID], $query->getFilter()['MemberView']);
    }
}
