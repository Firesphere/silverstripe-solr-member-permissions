<?php


namespace Firesphere\SolrPermissions\Tests;

use Firesphere\SolrPermissions\Extensions\DataObjectExtension;
use SilverStripe\Dev\SapphireTest;

class DataObjectExtensionTest extends SapphireTest
{
    public function testGetMemberView()
    {
        $page = \Page::get()->first();
        $extension = new DataObjectExtension();
        $extension->setOwner($page);

        $viewStatus = $extension->getMemberView();

        $this->assertEquals(['null'], $viewStatus);

        $page->CanViewType = 'LoggedInUsers';
        $page->write();

        $extension->setOwner($page);

        $status = $extension->getMemberView();

        $this->assertNotContains('null', $status);
    }
}
