<?php 
/**
 * Example use of Edurep search and results.
 */
require_once("edurepsearch.php");
date_default_timezone_set('Europe/Amsterdam');

# create with a valid api key
$edurep = new EdurepSearch( "12345" );

# optionally, set a different baseurl
# the default baseurl points to production
# $edurep->setBaseurl( "http://anotheredurepurl.nl" );

# perform a search for smo records
# mind that the smo search does not support all parameters
# and has different drilldown values 
# $edurep->setSearchType("smo");

# set search terms, default edurep
# should be provided urldecoded, the class will encode it
$edurep->setParameter( "query", "math" );

# set another default record schema
# default lom
$edurep->setParameter( "recordSchema", "oai_dc" );

# set a different amount of records to return each page
# default 10, minimum 1, maximum 100
$edurep->setParameter( "maximumRecords", 7 );

# set a different start records (for paging results)
# default 1
$edurep->setParameter( "startRecord", 3 );

# set to return drilldowns, default none
$edurep->setParameter( "x-term-drilldown", "lom.technical.format:5,lom.rights.cost:2" );

# set to return an additional recordschema
# can be called multiple times
$edurep->setParameter( "x-recordSchema", "smbAggregatedData" );

# set recordSchema extra for contributes and classifications
# in the results.
$edurep->setParameter( "x-recordSchema", "extra" );

# get the query (without host) before the search
# for caching purposes
$query = $edurep->getQuery();

# perform a search for lom records
$edurep->search();

# the raw result is stored in $response
# call the EdurepResults class to fill the result object
$results = new EdurepResults( $edurep->response );

# print the result records
print_r( $results->records );

# print the result drillldowns
print_r( $results->drilldowns );

# print startrecord values for a navigation bar
print_r( $results->navigation );
?>
