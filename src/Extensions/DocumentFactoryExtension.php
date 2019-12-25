<?php


namespace Firesphere\SolrPermissions\Extensions;


use Firesphere\SolrSearch\Factories\DocumentFactory;
use SilverStripe\Core\Extension;
use SilverStripe\ORM\DataObject;
use Solarium\Core\Query\AbstractDocument;

/**
 * Class \Firesphere\SolrPermissions\Extensions\DocumentFactoryExtension
 *
 * Extension class to add the default MemberView field to the Solr document
 *
 * @property DocumentFactory|DocumentFactoryExtension $owner
 */
class DocumentFactoryExtension extends Extension
{

    /**
     * Add the MemberView status to the default fields
     *
     * @param AbstractDocument $doc
     * @param DataObject|DataObjectExtension $item
     */
    public function updateDefaultFields($doc, $item)
    {
        $doc->addField('MemberView', $item->getMemberView());
    }
}
