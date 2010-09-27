<?php
// GeoCache Tools:
// Pocket Query GPX Parser
// by Scott Wilcox <scott@dor.ky> http://dor.ky
//
// The latest version of this script can be found on GitHub in the
// geocache-tools repository at http://github.com/dordotky/geocache-tools

// We can use the inbuilt PHP XML Parser to parse a GPX file as its XML,
// but we'll need to use the namespace function to get at the data we want.
$xml = simplexml_load_file("caches.gpx");

// You can now loop through the $xml array and process each cache contained
// within the GPX file in turn
foreach ($xml as $cache) {
	// If this cache has an ID, ie, GC12345
	if ($cache->name) {
		// This is a cache entry and not empty. The following are the fields that 
		// are accessible via parsing without the namespacing, but you don't want 
		// just that when there is so much more.
		//
		// time					Text timestamp of the cache placement
		// name					Text title of the cache
		// desc					Small text description of cache
		// url					Text link to cache on geocaching.com
		// urlname				Text link title
		// sym					Text status of finding cache
		// type					Text type of the cache
		//
		// There is also the "lat" and "lon" attributes to the cache element which
		// contain the latitude and longitude of the cache.
		
		// If we didn't add the namespace here we would end up with bare minimal data
		// for each cache even though there is a lot more data held in the file
		$extended = $cache->children("http://www.groundspeak.com/cache/1/0");
		
		//Each $cache item will have the following enclosed objects in $extended:
		// 
		// name					Textcache name
		// placed_by			Text of the person/group placing cache
		// owner				Text username of cache owner's username
		// type					Text type of cache
		// container			Text size of the cache container
		// difficulty			Number between 1 and 5 for difficulty level
		// terrain				Number between 1 and 5 for terrain level
		// country				Text Country of Cache Location
		// state				Text State/County of Cache Location
		// short_description	Short text description
		// long_description		Long text description
		// encoded_hints		Cache hint as a string
		// logs					SimpleXML Object contain log messages
		// travelbugs			SimpleXML Object containing travelbugs
		
		// The latitude and longtude
		echo "Latitude: ".$cache["lat"].", Longitude: ".$cache["lon"]."\n";
		
		// A standard object, the time this cache was placed
		echo $cache->time."\n";
		
		// An extended object
		echo $extended->cache->name."\n";
	}		
}
?>