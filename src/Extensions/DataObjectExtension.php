<?php


namespace Firesphere\SolrPermissions\Extensions;

use SilverStripe\ORM\ArrayList;
use SilverStripe\ORM\DataExtension;
use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Member;
use SilverStripe\Security\Security;

/**
 * Class \Firesphere\SolrPermissions\Extensions\DataObjectExtension
 *
 * Add the ability to get the Member View statusses for Solr.
 *
 * @package Firesphere\SolrPermissions\Extensions
 * @property DataObject|DataObjectExtension $owner
 */
class DataObjectExtension extends DataExtension
{
    /**
     * @var ArrayList Cached list of the members to reduce looping impact
     */
    protected static $memberList;

    /**
     * Get the member permissions for each unique user in the system
     * This is additional to the GroupView permissions
     *
     * @return array
     */
    public function getMemberView()
    {
        /** @var Member|null $currentUser */
        $currentUser = Security::getCurrentUser();
        Security::setCurrentUser(null);

        if ($this->owner->canView(null)) {
            Security::setCurrentUser($currentUser);

            return ['null'];
        }

        if (!static::$memberList) {
            static::$memberList = ArrayList::create(Member::get()->toArray());
        }

        $return = ['false'];
        foreach (static::$memberList as $member) {
            if ($this->owner->canView($member)) {
                $return[] = sprintf('1-%s', $member->ID);
            }
        }

        Security::setCurrentUser($currentUser);

        return $return;
    }
}
