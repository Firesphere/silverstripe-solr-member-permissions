<?php


namespace Firesphere\SolrPermissions\Extensions;


use SilverStripe\ORM\DataExtension;
use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Member;
use SilverStripe\Security\Security;

/**
 * Class \Firesphere\SolrPermissions\Extensions\DataObjectExtension
 *
 * @property DataObject|DataObjectExtension $owner
 */
class DataObjectExtension extends DataExtension
{

    /**
     * Get the member permissions for each unique user in the system
     * This is additional to the GroupView permissions
     *
     * @return array
     */
    public function getMemberView()
    {
        $currentUser = Security::getCurrentUser();
        Security::setCurrentUser(null);

        if ($this->owner->canView(null)) {
            Security::setCurrentUser($currentUser);

            return ['null'];
        }

        $members = Member::get();

        $return = ['false'];
        foreach ($members as $member) {
            if ($this->owner->canView($member)) {
                $return[] = sprintf('1-%s', $member->ID);
            }
        }

        Security::setCurrentUser($currentUser);

        return $return;
    }
}
