<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;

class PoolfinderController extends Controller
{
public function index(Request $request) {
$addressid = 12;
$location_name = "Nordic Leisure Centre @ The Waveney River Centre";
if($request->has('location')) {
$location_name = $request->location;
}

$distance = 10;
if($request->has('range')) {
$distance = $request->range;
}

$longitude = 0;
if($request->has('longitude')) {
$longitude = $request->longitude;
}

$latitude = 0;
if($request->has('latitude')) {
$latitude = $request->latitude;
}

$switch = 0;
if($request->has('switch')) {
$switch = $request->switch;
}

$sortby = "favCount";
if($request->has('sort')) {
$sortby = $request->sort;
}

$filterby = "Gym";
if($request->has('filter')) {
$filterby = $request->filter;
}

$orderby = "DESC";
$multiplemarkers = "";
$venues = array();

if($switch == 0) {

$locations = DB::select('select DISTINCT AddressId,Latitude,Longitude from address where AddressLine1 like "%'.$location_name.'%"');
    if( count($locations) == 0 ) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, 'https://maps.googleapis.com/maps/api/geocode/json?address='.$location_name.'&sensor=false&key=AIzaSyDRnlh876O-brSi9sYLbnDvqiIxgVsR7x8');
    $result = curl_exec($ch);
    curl_close($ch);

    $obj = json_decode($result,true);
    $location = $obj['results'][0]['address_components'][0]['long_name'];
    $lat = $obj['results'][0]['geometry']['location']['lat'];
    $lng = $obj['results'][0]['geometry']['location']['lng'];
    return redirect('poolfinder?location='.$location.'&latitude='.$lat.'&longitude='.$lng.'&switch=1&range=10&sort=favCount&filter=Gym');
}


$addressid = $locations[0]->AddressId;
$latitude = $locations[0]->Latitude;
$longitude = $locations[0]->Longitude;

$allvenues = DB::select("SELECT DISTINCT b.AddressId,b.AddressLine1,b.Longitude,b.Latitude,b.favCount as favourites,
   69.0 *
    DEGREES(ACOS(COS(RADIANS(a.Latitude))
         * COS(RADIANS(b.Latitude))
         * COS(RADIANS(a.Longitude - b.Longitude))
         + SIN(RADIANS(a.Latitude))
         * SIN(RADIANS(b.Latitude)))) AS distance
  FROM address AS a
  JOIN address AS b ON a.AddressId <> b.AddressId and a.AddressId=?  HAVING distance <= ?
    ORDER BY b.favCount ".$orderby, [$addressid,$distance]);
    //$latitude = $allvenues[0]->Latitude;
    //$longitude = $allvenues[0]->Longitude;
    $location_name = $allvenues[0]->AddressLine1;
}
if ($switch == 1) {
  $allvenues = DB::select("SELECT AddressId,Latitude,Longitude,favCount as favourites, ( 3959 * acos( cos( radians(".$latitude.") ) * cos( radians( Latitude ) ) * cos( radians( Longitude ) - radians(".$longitude.") ) + sin( radians(".$latitude.") ) * sin( radians( Latitude) ) ) ) AS distance FROM address HAVING distance <= ".$distance." ORDER BY favCount ".$orderby);
  $location_name = "Your Current Location";
}
foreach($allvenues as $venue)
{
$is_venue = DB::select('select AddressId from venue where AddressId=?',[$venue->AddressId]);
if(count($is_venue) > 0) {  
$venues[]=$venue->AddressId;
if($multiplemarkers == "") {
$multiplemarkers="var myCenter = new google.maps.LatLng(".$venue->Latitude.", ".$venue->Longitude.");";
$multiplemarkers.="var marker = new google.maps.Marker({position:myCenter});";
$multiplemarkers.="marker.setMap(map);";
} else {
$multiplemarkers.="var myCenter = new google.maps.LatLng(".$venue->Latitude.", ".$venue->Longitude.");";
$multiplemarkers.="var marker = new google.maps.Marker({position:myCenter});";
$multiplemarkers.="marker.setMap(map);";
}
}
}
if($sortby == "favourites") {
$venues = DB::table('venue')
    ->selectRaw('*, venue.VenueId,venue.VenueName,venue.ParaSwimmingFacilities,venue.Parking,venue.Gym,venue.Diving,venue.AddressId,( 3959 * acos( cos( radians("'.$latitude.'") ) * cos( radians( Latitude ) ) * cos( radians( Longitude ) - radians("'.$longitude.'") ) + sin( radians("'.$latitude.'") ) * sin( radians( Latitude) ) ) ) AS distance')
          ->join('address', 'address.AddressId', '=', 'venue.AddressId')
          ->whereIn('venue.AddressId', $venues)
          ->where('venue.'.$filterby,'=','yes')
          ->having('address','<=',$distance)
          ->orderBy('venue.'.$sortby,'desc')
          ->paginate(15);
} else {
$venues = DB::table('venue')
      ->selectRaw('*, venue.VenueId,venue.VenueName,venue.ParaSwimmingFacilities,venue.Parking,venue.Gym,venue.Diving,venue.AddressId,( 3959 * acos( cos( radians("'.$latitude.'") ) * cos( radians( Latitude ) ) * cos( radians( Longitude ) - radians("'.$longitude.'") ) + sin( radians("'.$latitude.'") ) * sin( radians( Latitude) ) ) ) AS distance')
            ->join('address', 'address.AddressId', '=', 'venue.AddressId')
            ->whereIn('venue.AddressId', $venues)
            ->where('venue.'.$filterby,'=','yes')
            ->orderBy('venue.VenueId','desc')
            ->paginate(15);
}
if(count($venues) == 0) { $multiplemarkers = "";}
      return view('poolfinder',['venues'=>$venues->appends(Input::except('page')),'multiplemarkers'=>$multiplemarkers,'latitude'=>$latitude,'longitude'=>$longitude,'location'=>$location_name,'distance'=>$distance,'sort'=>$sortby,'filter'=>$filterby,'switch'=>$switch,'show_values'=>'yes']);
    }
public function ajaxFunction(Request $request) {

}
    public function locationSuggestions(Request $request) {
      $q = $request->id;
      $locations = DB::select('select AddressLine1 as location from address where AddressLine1 like "%'.$q.'%"or PostCode like "%'.$q.'%"');
      if(count($locations)>0) {
        echo json_encode($locations);
      }
    }
    
    public function updateLocation(Request $request) {
        
    $locations = DB::select('select PostCode from address where Latitude=? or Longitude=?', [0.000000,0.000000]);
    if( count($locations) > 0 ) {
    foreach( $locations as $loc) {    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, 'https://maps.googleapis.com/maps/api/geocode/json?address='.str_replace(' ','%',$loc->PostCode).'&sensor=false&key=AIzaSyDRnlh876O-brSi9sYLbnDvqiIxgVsR7x8');
    $result = curl_exec($ch);
    curl_close($ch);
    echo 'https://maps.googleapis.com/maps/api/geocode/json?address='.str_replace(' ','%',$loc->PostCode).'&sensor=false&key=AIzaSyDRnlh876O-brSi9sYLbnDvqiIxgVsR7x8';
    $obj = json_decode($result,true);
    $location = $obj['results'][0]['address_components'][0]['long_name'];
    $lat = $obj['results'][0]['geometry']['location']['lat'];
    $lng = $obj['results'][0]['geometry']['location']['lng'];
    DB::UPDATE('update address set Latitude=?,Longitude=? where PostCode=?',[$lat,$lng,$loc->PostCode]);
    echo $lat.'-'.$lng.'-'.$loc->PostCode;
    }
    }
    }
}
