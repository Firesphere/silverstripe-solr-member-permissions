<?php


namespace Firesphere\SolrPermissions\Extensions;


use Firesphere\SolrSearch\Indexes\BaseIndex;
use Firesphere\SolrSearch\Queries\BaseQuery;
use Minimalcode\Search\Criteria;
use SilverStripe\Core\Extension;
use SilverStripe\Security\Security;
use Solarium\QueryType\Select\Query\Query;

/**
 * Class \Firesphere\SolrPermissions\Extensions\BaseIndexExtension
 *
 * Add Member specific view capabilities to the Index
 *
 * @property BaseIndex|BaseIndexExtension $owner
 */
class BaseIndexExtension extends Extension
{

    /**
     * Add the Member based permissions
     */
    public function onAfterInit()
    {

        $this->owner->addFilterField('MemberView');
    }

    /**
     * Before search, add the member view filtering
     *
     * @param BaseQuery $query
     * @param Query $clientQuery
     */
    public function onBeforeSearch($query, $clientQuery) {
        $member = Security::getCurrentUser();

        $filter = ['null'];

        if ($member) {
            $filter[] = sprintf('1-%s', $member->ID);
        }

        $query->addFilter('MemberView', $filter);

        $criteria = Criteria::where('MemberView')->in($filter);

        $clientQuery->createFilterQuery('MemberView')
            ->setQuery($criteria->getQuery());
        $filterQueries = $clientQuery->getFilterQueries();
        unset($filterQueries['ViewStatus']);
        $clientQuery->setFilterQueries($filterQueries);
    }
}
