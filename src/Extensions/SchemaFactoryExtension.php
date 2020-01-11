<?php
/**
 * Class SchemaFactoryExtension|Firesphere\SolrPermissions\Extensions\SchemaFactoryExtension Add the member view
 * permission field to the schema
 *
 * @package Firesphere\SolrPermissions\Extensions
 * @author Simon `Firesphere` Erkelens; Marco `Sheepy` Hermo
 * @copyright Copyright (c) 2018 - now() Firesphere & Sheepy
 */

namespace Firesphere\SolrPermissions\Extensions;

use Firesphere\SolrSearch\Factories\SchemaFactory;
use SilverStripe\Core\Extension;
use SilverStripe\ORM\ArrayList;

/**
 * Class \Firesphere\SolrPermissions\Extensions\SchemaFactoryExtension
 *
 * Extension class to add the default filters for the MemberView
 *
 * @package Firesphere\SolrPermissions\Extensions
 * @property SchemaFactory|SchemaFactoryExtension $owner
 */
class SchemaFactoryExtension extends Extension
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
