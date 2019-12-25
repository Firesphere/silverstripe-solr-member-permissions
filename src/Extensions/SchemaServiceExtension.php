<?php


namespace Firesphere\SolrPermissions\Extensions;


use Firesphere\SolrSearch\Services\SchemaService;
use SilverStripe\Core\Extension;
use SilverStripe\ORM\ArrayList;

/**
 * Class \Firesphere\SolrPermissions\Extensions\SchemaServiceExtension
 *
 * Extension class to add the default filters for the MemberView
 *
 * @property SchemaService|SchemaServiceExtension $owner
 */
class SchemaServiceExtension extends Extension
{

    /**
     * Add the MemberView field to Solr for filtering on members
     *
     * @param ArrayList $return
     */
    public function onBeforeFilterFields(ArrayList $return)
    {
        $return->push([
            'Field'       => 'MemberView',
            'Type'        => 'string',
            'Indexed'     => 'true',
            'Stored'      => 'true',
            'MultiValued' => 'true',
        ]);
    }
}
