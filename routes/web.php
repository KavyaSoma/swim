<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
if (App::environment('production')) {
    URL::forceScheme('https');
}

Route::get('/', 'HomeController@index');
Route::get('/socialnetwork', 'SocialController@index');
Route::get('/updatelocation', 'PoolfinderController@updateLocation');
Route::get('/clubs', 'ClubController@clubs');
Route::get('/myclubs', 'ClubController@myClubs');
Route::post('/clubs', 'ClubController@searchClubs');
Route::get('/venues', 'VenueController@venues');
Route::get('/myvenues', 'VenueController@myVenues');
Route::get('/venueinformation/{id}', 'VenueController@information');
Route::post('/venues', 'VenueController@searchVenues');
Route::get('/events', 'EventController@events');
Route::get('/myevents', 'EventController@myEvents');
Route::post('/events', 'EventController@searchEvents');
Route::get('/instructors', 'InstructorController@instructors');
Route::get('/myinstructors', 'InstructorController@myInstructors');
Route::post('/instructors', 'InstructorController@searchInstructors');
Route::get('/poolfinder', 'PoolfinderController@index');
Route::get('locationsuggestions/{id}', 'PoolfinderController@locationSuggestions');

Route::get('/getfavourites/{type}/{id}/{uid}', 'UserController@getFavourites');
Route::get('/getimages/{type}/{id}', 'UserController@getImages');
Route::get('/managefavourites/{type}/{id}/{uid}', 'UserController@manageFavourites');

Route::get('/register','HomeController@register');
Route::post('/register','HomeController@userRegistration');
Route::get('/activation/{id}','HomeController@userActivation');
Route::get('/login','HomeController@login');
Route::post('/login','HomeController@checkLogin');
Route::get('/logout','HomeController@logout');
Route::get('/forgotpassword','HomeController@forgot');
Route::post('/emailcheck','HomeController@emailCheck');
Route::get('/changepassword/{id}','HomeController@changePassword');
Route::post('/updatepassword','HomeController@updatePassword');

Route::get('/facebooklogin', 'SocialAuthFacebookController@facebooklogin');
Route::get('/callback', 'SocialAuthFacebookController@facebookcallback');

Route::get('/googlelogin', 'SocialAuthGoogleController@googlelogin');
Route::get('/googlecallback', 'SocialAuthGoogleController@googlecallback');

Route::get('/twitterlogin', 'SocialAuthTwitterController@twitterlogin');
Route::get('/twittercallback', 'SocialAuthTwitterController@twittercallback');

Route::get('/addkin','UserController@ViewKinForm');
Route::post('/addkin','UserController@SaveKindetail');

Route::get('/kincontact/{id}','UserController@SaveKindetail');

Route::get('/kincontact','UserController@SaveKinContact');
Route::post('/kincontact','UserController@SaveKinContact');
Route::get('/viewallkins/{id}','UserController@ViewKins');

Route::get('/editkin/{id}','UserController@EditKinDetails');
Route::post('/editkin/{id}','UserController@UpdateKinDetails');
Route::get('/editkincontact/{id}','UserController@EditKinContact');
Route::get('/kininformationpage/{id}','UserController@kininformation');

//adding and editing forms
Route::get('/getoldevents/{type}/{id}','EventController@getOldEntries');
Route::get('/newevent','EventController@newevent');
Route::get('/checkshortname/event/{shortname}','EventController@checkshortname');
Route::get('/addevent/{event_id}','EventController@addEvent');
Route::post('/addevent/{event_id}','EventController@saveEvent');
Route::get('/eventtime/{event_id}','EventController@eventTime');
Route::post('/eventtime/{event_id}','EventController@saveeventTime');
Route::get('/venue-event/{event_id}','EventController@venueEvent');
Route::get('/venue-event/{event_id}/{id}','EventController@editVenueEvent');
Route::post('/venue-event/{event_id}','EventController@saveVenueEvent');
Route::get('/subevent/{event_id}','EventController@subEvent');
Route::get('/subevent/{event_id}/{sub_event_id}','EventController@editSubEvent');
Route::post('/subevent/{event_id}','EventController@saveSubEvent');
Route::get('/contact-event/{event_id}','EventController@contactEvent');
Route::get('/contact-event/{event_id}/{contact_id}','EventController@editcontactEvent');
Route::post('contact-event/{event_id}','EventController@saveContactEvent');
Route::get('/club-event/{event_id}','EventController@EventClub');
Route::get('/club-event/{event_id}/{club_id}','EventController@editEventClub');
Route::post('club-event/{event_id}','EventController@saveClubEvent');
Route::get('/venue-subevent/{event_id}','EventController@subeventVenue');
Route::get('/venue-subevent/{event_id}/{id}','EventController@editsubeventVenue');
Route::post('/venue-subevent/{event_id}','EventController@savesubeventVenue');



Route::get('/schedule-event/{id}','EventController@scheduleEvent');
Route::post('/schedule-event/{id}','EventController@saveScheduleEvent');
Route::get('/contact-event/{event_id}','EventController@contactEvent');
Route::post('contact-event/{type}/{id}','EventController@saveContactEvent');

Route::get('/confirm-event/{id}','EventController@confirmEvent');
Route::post('/confirm-event/{id}','EventController@saveConfirmEvent');

Route::get('/editevent/{id}','EventController@editEvent');
Route::post('/editevent/{id}','EventController@saveEditEvent');
Route::get('/edit-subevent/{event_id}/{sub_event_id}','EventController@editSubEvent');
Route::get('/edit-subevent/{event_id}','EventController@redirectSubEvent');
Route::post('/edit-subevent/{event_id}/{sub_event_id}','EventController@saveEditSubEvent');
Route::get('/edit-eventschedule/{event_id}','EventController@editSchedule');
Route::get('/edit-scheduleevent/{event_id}','EventController@editSchedule');
Route::post('/edit-scheduleevent/{event_id}','EventController@saveEditSchedule');
Route::post('/edit-subevent/{event_id}/{sub_event_id}','EventController@saveEditSubEvent');

Route::get('/edit-eventclub/{event_id}/{id}','EventController@editClubEvent');
Route::post('/edit-eventclub/{event_id}/{id}','EventController@saveEditEventClub');
Route::get('/edit-eventcontact/{event_id}/{id}','EventController@editEventContact');
Route::post('/edit-eventcontact/{event_id}/{id}','EventController@saveEditEventContact');
Route::post('/edit-eventvenue/{event_id}/{id}','EventController@saveEditEventVenue');
Route::get('/edit-eventclub/{id}','EventController@editClubEvent');
Route::post('/edit-eventclub/{id}','EventController@saveEditClubEvent');
Route::get('/edit-contactevent/{id}','EventController@editEventContact');
Route::post('/edit-contactevent/{id}','EventController@SaveEditEventContact');


Route::get('/addvenue','VenueController@addVenue');
Route::post('/addvenue','VenueController@saveVenue');
Route::get('/venuepool/{id}','VenueController@VenuePool');
Route::post('/venuepool/{id}','VenueController@saveVenuePool');
Route::get('/venueaddress/{id}','VenueController@VenueAddress');
Route::post('venueaddress/{id}','VenueController@saveVenueAddress');
Route::get('/venuecontact/{id}','VenueController@VenueContact');
Route::post('venuecontact/{id}','VenueController@saveVenueContact');
Route::get('/venuetimings/{id}','VenueController@VenueTimings');
Route::post('/venuetimings/{id}','VenueController@saveVenueTimings');
Route::get('/venuesociallinks/{id}','VenueController@VenueSocialLinks');
Route::post('/venuesociallinks/{id}','VenueController@saveVenueLinks');
Route::get('/confirmvenue/{id}','VenueController@ConfirmVenue');
Route::post('/confirmvenue/{id}','VenueController@saveConfirmVenue');
Route::get('/venueadminpreview','VenueController@venueAdmin');
Route::get('/getoldvenues/{type}/{id}','VenueController@getOldEntries');
Route::get('/editvenue/{id}','VenueController@editVenue');
Route::post('/editvenue/{id}','VenueController@saveEditVenue');
Route::get('/edit-venuepool/{venue_id}/{id}','VenueController@editPool');
Route::get('/edit-venuepool/{id}','VenueController@checkPool');
Route::post('/edit-venuepool/{venue_id}/{id}','VenueController@saveEditPool');
Route::get('/edit-venueaddress/{venue_id}','VenueController@editVenueAddress');
Route::post('/edit-venueaddress/{venue_id}','VenueController@saveEditAddress');

Route::get('/edit-venuecontact/{venue_id}/{id}','VenueController@editVenueContact');
Route::post('/edit-venuecontact/{venue_id}/{id}','VenueController@saveEditContact');

Route::get('/edit-venuetimings/{id}','VenueController@editVenueTiming');
Route::post('/edit-venuetimings/{id}','VenueController@saveEditTiming');
Route::get('/edit-venuesociallinks/{id}','VenueController@editSocialLinks');
Route::post('/edit-venuesociallinks/{id}','VenueController@saveEditLinks');

Route::get('/addinstructor','InstructorController@AddInstructor');
Route::post('/addinstructor','InstructorController@InsertInstructorBasic');
Route::get('/instructortimings/{id}','InstructorController@InstructorTimings');
Route::post('/instructortimings/{id}','InstructorController@InsertInstructorTimings');
Route::get('/instructoraddress/{id}','InstructorController@InstructorAddress');
Route::post('/instructoraddress/{id}','InstructorController@InsertInstructorAddress');
Route::get('/instructorexperience/{id}','InstructorController@InstructorExperience');
Route::post('/instructorexperience/{id}','InstructorController@InsertInstructorExperience');
Route::get('/instructorcontact/{id}','InstructorController@InstructorContact');
Route::post('/instructorcontact/{id}','InstructorController@UpdateInstructorContact');
Route::get('/setpassword/{id}','InstructorController@setPassword');
Route::post('/confirmpassword/{id}','InstructorController@confirmPassword');

Route::get('/addclub','ClubController@addClub');
Route::post('/addclub','ClubController@saveClub');

Route::get('/viewclub/{id}','ClubController@viewClub');
Route::get('/clubinfo','ClubController@clubInfo');
Route::get('/deleteclub/{id}','ClubController@deleteClub');
Route::get('/editclub/{id}','ClubController@editClub');
Route::post('/editclub/{id}','ClubController@saveEditClub');


//messages
Route::get('/inbox','UserController@mailbox');
Route::get('/sendmessage','UserController@sendMsg');
Route::post('/sendmessage','UserController@sendMail');
Route::get('/sentmessage','UserController@sentMessage');
Route::get('/archivemessage','UserController@archiveMessage');
Route::get('/replymessage/{id}','UserController@viewmessage');
Route::post('/replymessage/{id}','UserController@sendReply');
Route::get('/archive/{id}','UserController@archive');
Route::get('deletemessage/{id}','UserController@deleteMessage');
Route::get('sendmessage/{id}','UserController@emailSuggestions');

//social network
Route::get('/socialnetwork', 'SocialController@index');
Route::post('/socialnetwork','SocialController@addFriend');
Route::get('/addfriend/{id}','SocialController@newFriend');
Route::get('/friendlist','SocialController@friendList');
Route::post('/friendlist','SocialController@searchfriend');
Route::get('/myfriendlist','SocialController@myFriend');
//forum
Route::get('/forumanswers/{id}','SocialController@answers');
Route::post('forumanswers/{id}','SocialController@forumAnswer');
Route::get('/forum','SocialController@forum');
Route::get('/forum/{category}','SocialController@categoryForum');
Route::post('/forum','SocialController@forum');
Route::post('/forumquestion','SocialController@saveForumQuestion');

Route::get('postnews','AdminController@postNews');
Route::post('postnews','AdminController@saveNews');
Route::get('deletenews/{id}','AdminController@deleteNews');

//public pages
Route::get('/event/{shortname}/subevent','EventController@viewsubEvent');
Route::get('/event/{shortname}/eventschedule','EventController@vieweventSchedule');
Route::get('/event/{shortname}/eventcontact','EventController@vieweventContact');
Route::get('/event/{shortname}/eventvenue','EventController@eventVenue');
Route::get('/event/{shortname}','EventController@eventBasic');
Route::get('/subscribed/{shortname}','EventController@subscribeEvent');

Route::get('/inviteparticipants/{eventid}','EventController@inviteParticipants');
Route::post('/inviteparticipants/{eventid}','EventController@inviteParticipants');
Route::get('/manageparticipants/{eventid}','EventController@manageParticipants');
Route::get('/invite/{id}/{participantid}','EventController@sendEventInvite');

Route::get('manageheatsetup','VenueController@manageHeatSetup');

Route::get('/resultentry','EventController@resultEntry');

Route::get('/user/{shortname}','UserController@userInformation');
Route::get('user/{shortname}/message','UserController@message');
Route::get('/user/{shortname}/following','UserController@followUser');

Route::get('venue/{shortname}','VenueController@venuebasicDetails');
Route::get('/venue/{shortname}/venuepool','VenueController@viewvenuePool');
Route::get('/venue/{shortname}/venueevents','VenueController@viewvenueEvents');
Route::get('/venue/{shortname}/venueaddress','VenueController@viewvenueAddress');
Route::get('/venue/{shortname}/venuecontact','VenueController@viewvenueContact');
Route::get('venue/{shortname}/join','VenueController@JoinVenue');

/* Dashboards & Public pages Routes */
Route::get('/instructordashboard','InstructorController@InstructorDashboard');
Route::get('/userdashboard','UserController@UserDashboard');
Route::get('/admindashboard', 'AdminController@admindashboard');
Route::post('/admindashboard','AdminController@addUser');
Route::get('/activation/{id}','AdminController@userActivation');
Route::get('/clubdashboard','ClubController@ClubDashboard');
Route::get('/eventsdashboard','EventController@EventDashboard');
Route::get('/venuedashboard','VenueController@VenueDashboard');
Route::get('/acceptuserrequest/{id}/venue','VenueController@acceptuserrequest');
Route::get('/rejectuserrequest/{id}/venue','VenueController@rejectuserrequest');
Route::get('/acceptclubrequest/{id}/club','ClubController@acceptclubrequest');
Route::get('/rejectclubrequest/{id}/club','ClubController@rejectclubrequest');
Route::get('/acceptevent/{id}/event','EventController@acceptEventRequest');
Route::get('/rejectevent/{id}/event','EventController@rejectEventRequest');
Route::get('/acceptuserrequest/{id}','VenueController@acceptuserrequest');
Route::get('/rejectuserrequest/{id}','VenueController@rejectuserrequest');
Route::get('/instructor/{shortname}','InstructorController@viewinstructorBasic');
Route::post('/instructor/{shortname}','InstructorController@savebookInstructor');
Route::get('/instructor/{shortname}/following','InstructorController@followInstructor');


Route::get('/club/{shortname}','ClubController@clubInformation');
Route::get('/acceptclubrequest/{id}','ClubController@acceptclubrequest');

Route::get('/about','HomeController@About');
Route::get('/how-it-works','HomeController@howitWorks');
Route::get('/contactus','HomeController@contact');
Route::post('contactus','HomeController@contactUs');
Route::get('/frequently-asked-questions','HomeController@Questions');
Route::get('/terms-and-conditions','HomeController@TermsandConditions');
Route::get('/privacy-policy','HomeController@privacyPolicy');
Route::get('/news','HomeController@News');
Route::get('/disclaimer','HomeController@Disclaimer');
Route::get('/group/{groupid}','SocialController@group');
Route::post('/group/{groupid}','SocialController@group');
Route::get('/groups','SocialController@groups');
Route::post('/groups','SocialController@groups');
Route::post('/addgroup','SocialController@postGroup');
Route::get('/joingroup/{group_id}/{user_id}/{admin}','SocialController@joinGroup');
Route::get('/answerscount/{question_id}','SocialController@answersCount');

Route::get('/heatsetup/{id}','VenueController@heatSetup');
Route::post('/heatsetup/{id}','VenueController@saveheatSetup');
Route::get('/editheat/{event_id}/{heat_id}','VenueController@editheat');
Route::post('/editheat/{event_id}/{heat_id}','VenueController@saveeditheat');
Route::get('/oldscheduleheat/{event_id}','VenueController@oldHeatSchedule');
Route::get('/manageparticipants/{event_id}/{heat_id}','VenueController@manageParticpants');
Route::post('/manageparticipants/{event_id}/{heat_id}','VenueController@saveParticipants');

Route::get('/instructor/{shortname}/bookinstructor','InstructorController@bookinstructor');
Route::post('/instructor/{shortname}/bookinstructor','InstructorController@savebookInstructor');

Route::get('/profile','UserController@userProfile');
Route::get('/kindetails','UserController@kinDetails');
Route::get('/editprofile','UserController@editProfile');
Route::post('/editprofile','UserController@updateProfile');
Route::get('/event/{shortname}/flag','EventController@flagEvent');
Route::get('/getgroupsimages/{groupid}','SocialController@getGroupsImages');

//result entry 
Route::get('/resultentry/{event_id}/{heat_id}/{level_id}','UserController@resultEntry');
Route::get('/resultentry/{event_id}/{heat_id}/{level_id}','UserController@saveresultEntry');

Route::post('uploadexcel','UserController@uploadExcel');

Route::get('/eventclub','ClubController@eventClub');

Route::get('/search/all','HomeController@search');
Route::get('search/all','HomeController@search');
Route::post('search/all','HomeController@search');

Route::get('search/events','HomeController@searchEvents');
Route::get('search/clubs','HomeController@searchClubs');
Route::get('search/venues','HomeController@searchVenues');
Route::get('search/instructors','HomeController@serachInstructors');
Route::get('search/users','HomeController@searchUsers');

Route::get('/heatsetup/{id}','VenueController@heatSetup');
Route::post('/heatsetup/{id}','VenueController@saveheatSetup');
Route::get('/editheat/{event_id}/{heat_id}','VenueController@editheat');
Route::post('/editheat/{event_id}/{heat_id}','VenueController@saveeditheat');
Route::get('/deleteheat/{event_id}/{heat_id}','VenueController@deleteHeat');
Route::get('/oldscheduleheat/{event_id}','VenueController@oldHeatSchedule');
Route::get('/manageparticipants/{event_id}/{heat_id}','VenueController@manageParticpants');
Route::post('/manageparticipants/{event_id}/{heat_id}','VenueController@saveParticipants');


Route::get('/semiheatsetup/{id}','VenueController@heatsemifinal');
Route::post('/semiheatsetup/{id}','VenueController@savesemifinal');
Route::get('/oldsemifinal/{event_id}','VenueController@oldSemiSchedule');
Route::get('/finalheatsetup/{id}','VenueController@heatfinal');
Route::post('/finalheatsetup/{id}','VenueController@savefinal');
Route::get('/oldfinalheat/{event_id}','VenueController@oldFinalSchedule');

Route::get('/invitefriends/{id}','EventController@inviteFriends');
Route::get('/invite/{id}/{participantid}','EventController@sendEventInvite');

Route::get('/changeemail','UserController@changeEmail');
Route::post('/changeemail','UserController@updateEmail');
Route::get('emailactivation/{id}','UserController@mailActivation');
Route::get('/checkshortname/club/{shortname}','ClubController@clubname');

Route::post('/checkfacebookemail', 'HomeController@checkFacebookEmail');

Route::get('/multiple-event/{id}','EventController@multipleevent');
Route::post('/multiple-event/{id}','EventController@savemultipleevent');
Route::get('/recurring-event/{id}','EventController@recurringevent');
Route::post('/week-event/{id}','EventController@saveweekevent');
Route::post('/month-event/{id}','EventController@savemonthevent');
Route::post('/year-event/{id}','EventController@saveyearevent');




Route::get('/edit-multipleevent/{event_id}','EventController@editmulitpleevents');
Route::post('/edit-multipleevent/{event_id}','EventController@saveEditMultiple');
Route::get('/edit-recuringevent/{event_id}','EventController@editrecuringevent');
Route::post('/edit-weekevent/{event_id}','EventController@saveeditweekevent');
Route::post('/edit-monthevent/{event_id}','EventController@saveeditmonthevent');
Route::post('/edit-yearevent/{event_id}','EventController@saveedityearevent');

Route::get('/delete-subevent/{event_id}/{subevent_id}','EventController@deletesubevent');
Route::get('/delete-eventclub/{event_id}/{id}','EventController@deleteeventclub');
Route::get('/delete-eventcontact/{event_id}/{id}','EventController@deleteeventcontact');
Route::get('/delete-eventvenue/{type}/{event_id}/{id}','EventController@deleteeventvenue');
Route::get('/delete-schedule/{event_id}/{id}','EventController@deleteschedule');

Route::get('/deletepool/{venue_id}/{pool_id}','VenueController@deletepool');
Route::get('/delete-venuecontact/{venue_id}/{contact_id}','VenueController@deleteContact');
Route::get('/checkshortname/venue/{shortname}','VenueController@venueshortname');

Route::get('excel','UserController@excel');
Route::get('participantsexcel/{event_id}/{heat_id}/{stage_id}','UserController@participantsExcel');

Route::get('/managevenues','VenueController@manageVenues');
Route::get('/deletevenue/{id}','VenueController@deleteVenue');

Route::get('/notifications','UserController@listAlerts');

Route::get('club/{shortname}/join','ClubController@JoinClub');

Route::get('/admindashboard', 'AdminController@admindashboard');
Route::post('/admindashboard', 'AdminController@admindashboard');
Route::post('/admindashboard/adduser','AdminController@addUser');
Route::get('/activation/{id}','AdminController@userActivation');
Route::get('/acceptrequest/{id}','AdminController@acceptadds');
Route::get('/acceptrequest/{id}','AdminController@acceptNews');
Route::get('/rejectrequest/{id}','AdminController@rejectadds');
Route::get('/rejectrequest/{id}','AdminController@rejectNews');
Route::get('/rejectclubrequest/{id}/club','ClubController@rejectclubrequest');
Route::get('/contactvenue/{type}/{contact}','VenueController@autocomplete');

Route::get('/contactvenue/{type}/{contact}','VenueController@autocomplete');
Route::get('/eventclub/{club}','EventController@clubevent');
Route::get('/eventcontact/{contact}','EventController@autocontact');
Route::get('/eventvenues/{venue}','EventController@venuesevent');
Route::get('/addressinstructor/{address}','InstructorController@autocompleteaddress');
Route::get('/clubaddress/{type}/{key}','ClubController@autocompleteclub');
Route::get('/contactkin/{key}','UserController@autocompletecontact');
Route::get('sendmessage/{id}','UserController@emailSuggestions');

Route::get('/addkin','UserController@ViewKinForm');
Route::post('/addkin','UserController@SaveKindetail');
Route::get('/kincontact/{id}','UserController@KinContact');
Route::post('/kincontact/{id}','UserController@SaveKinContact');

Route::get('/editkin/{id}','UserController@EditKinDetails');
Route::post('/editkin/{id}','UserController@UpdateKinDetails');
Route::get('/editkincontact/{id}','UserController@EditKinContact');
Route::post('/editkincontact/{id}','UserController@saveEditKitContact');


Route::get('/multiple-event/{id}','EventController@multipleevent');
Route::post('/multiple-event/{id}','EventController@savemultipleevent');
Route::get('/recurring-event/{id}','EventController@recurringevent');
Route::post('/week-event/{id}','EventController@saveweekevent');
Route::post('/month-event/{id}','EventController@savemonthevent');
Route::post('/year-event/{id}','EventController@saveyearevent');

Route::get('/checkshortname/event/{shortname}','EventController@checkshortname');


Route::get('/edit-multipleevent/{event_id}','EventController@editmulitpleevents');
Route::post('/edit-multipleevent/{event_id}','EventController@saveEditMultiple');
Route::get('/edit-recuringevent/{event_id}','EventController@editrecuringevent');
Route::post('/edit-weekevent/{event_id}','EventController@saveeditweekevent');
Route::post('/edit-monthevent/{event_id}','EventController@saveeditmonthevent');
Route::post('/edit-yearevent/{event_id}','EventController@saveedityearevent');

Route::get('/delete-subevent/{event_id}/{subevent_id}','EventController@deletesubevent');
Route::get('/delete-eventclub/{event_id}/{id}','EventController@deleteeventclub');
Route::get('/delete-eventcontact/{event_id}/{id}','EventController@deleteeventcontact');
Route::get('/delete-eventvenue/{event_id}/{id}','EventController@deleteeventvenue');
Route::get('/delete-schedule/{event_id}/{id}','EventController@deleteschedule');
Route::get('/checkshortname/club/{shortname}','ClubController@clubname');
Route::get('/checkmail/{email}','HomeController@duplicatemail');

Route::get('/edituser/{id}','AdminController@editUser');
Route::post('/edituser/{id}','AdminController@updateUser');
Route::get('/deleteuser/{id}','AdminController@deleteUser');

Route::get('/graphs','EventController@graphs');

Route::post('/changepassword','UserController@changePassword');

Route::get('user/{shortname}/unfollow','UserController@unfollowUser');
Route::get('instructor/{shortname}/unfollow','InstructorController@unfollowInstructor');

Route::get('manageparticipants/{event_id}/{heat_id}/{level_id}','VenueController@semifinalParticipants');
Route::post('manageparticipants/{event_id}/{heat_id}/{level_id}','VenueController@savesemifinalParticipants');
Route::get('/heatresults/{event_id}/{heat_id}/{level_id}','UserController@heatresult');

Route::get('/acceptevent/{id}/{participantid}','EventController@accepteventInvitation');

Route::get('/comingsoon','HomeController@commingsoon');
Route::post('/comingsoon','HomeController@checkcomingsoon');
Route::get('/comingsoon/{id}/{token}','HomeController@comingsoonconfirmation');
