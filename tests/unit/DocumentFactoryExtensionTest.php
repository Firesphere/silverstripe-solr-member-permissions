<?php


namespace Firesphere\SolrPermissions\Tests;


use Firesphere\SolrPermissions\Extensions\DocumentFactoryExtension;
use SilverStripe\Dev\SapphireTest;
use Solarium\QueryType\Select\Result\Document;
use Solarium\QueryType\Update\Query\Query;

class DocumentFactoryExtensionTest extends SapphireTest
{

    public function testUpdateDefaultFields()
    {
        $update = new Query();

        $document = $update->createDocument([]);

        $extension = new DocumentFactoryExtension();
        $page = new \Page();

        $extension->updateDefaultFields($document, $page);

        $fields = $document->getFields();

        $this->assertContains('MemberView', $fields);
    }
}
