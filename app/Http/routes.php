<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


/*_____Routes for the skoolspace registration module__________*/

/*  Bindings for the school, users, clients  */

Route::bind('user' , function($id)
{
    return App\User::find($id);
});

Route::bind('username' , function($name)
{
    /** @var int $id */
    return App\Group::findOrFailByUsername($name);
});

Route::bind('mail' , function($id)
{
    /** @var int $id */
    return App\Mail::where('id',$id)->first();
});

Route::bind('client' , function($id)
{
    /** @var int $id */
    return App\Client::where('id',$id)->first();
});
/*
Route::bind('subject' , function($name)
{
    /** @var string $id
    return new App\Http\Forum\Subject($name);
});*/
/*
Route::bind('recipient' , function($id)
{
    /** @var int $id
    return App\Client::where('id',$id)->first();
});

Route::bind('event' , function($id)
{
    /** @var int $id
    return App\Event::where('id',$id)->first();
});
*/
Route::bind('notice' , function($id)
{
    /** @var int $id */
    return App\Notice::where('id',$id)->first();
});

Route::bind('group' , function($username)
{
    /** @var int $id */
    return App\Group::findOrFailByUsername($username);
});

Route::bind('folder' , function($id)
{
    /** @var int $id */
    return App\Folder::find($id);
});

Route::bind('userFolder' , function($id)
{
    /** @var int $id */
    return App\UserFolder::find($id);
});

Route::bind('file' , function($id)
{
    /** @var int $id */
    return App\File::find($id);
});

Route::bind('code' , function($code)
{
    /** @var int $code */
    return App\User::where('code', $code)->first();
});

Route::bind('request' , function($id)
{
    /** @var int $id */
    return App\Request::find($id);
});

Route::bind('personalFolder' , function($id)
{
    /** @var int $id */
    return App\PersonalFolder::find($id);
});

Route::bind('personalFile' , function($id)
{
    /** @var int $id */
    return App\PersonalFile::find($id);
});

/**Route::bind('school' , function($school)
{
     @var TYPE_NAME $id
    return App\User::where('username', '==' ,$school);
});*/


/* The testing route */

/* Testing Route Ends */
/* Back Pack routes */
    Route::get('/pack/{personalFolder}/',
        [ 'middleware' => 'school', 'uses' => 'PackController@show' ]);
    Route::get('{group}/{user}/{personalFolder}/visit/pack',
        [ 'middleware' => 'school', 'uses' => 'PackController@visit' ]);
    Route::post('/pack/',
        [ 'middleware' => 'school', 'uses' => 'PackController@storeFolder' ]);
    Route::post('/pack/{personalFolder}',
        [ 'middleware' => 'school', 'uses' => 'PackController@store' ]);
    Route::post('/pack/{personalFolder}/sub',
        [ 'middleware' => 'school', 'uses' => 'PackController@storeSubFolder' ]);
    Route::post('/pack/{personalFolder}/update',
        [ 'middleware' => 'school', 'uses' => 'PackController@update' ]);
    Route::get('/pack/{personalFolder}/delete',
        [ 'middleware' => 'school', 'uses' => 'PackController@destroyFolder' ]);
    Route::get('/pack/delete/{personalFolder}/{personalFile}',
        [ 'middleware' => 'school', 'uses' => 'PackController@destroy' ]);
/* End Back Pack Routes */
/* Sharing Routes */
    Route::get('/{username}/administrators/',
        [ 'middleware' => 'school', 'uses' => 'AdministratorController@index' ]);
    Route::get('/{username}/administrators/all',
        [ 'middleware' => 'school', 'uses' => 'AdministratorController@show' ]);
    Route::get('/{username}/administrators/add/{user}',
        [ 'middleware' => 'school', 'uses' => 'AdministratorController@store' ]);
    Route::get('/{username}/administrators/delete/{user}',
        [ 'middleware' => 'school', 'uses' => 'AdministratorController@destroy' ]);
    Route::post('/{username}/administrators/search',
        [ 'middleware' => 'school', 'uses' => 'AdministratorController@search' ]);
    Route::get('/{username}/administrators/{value}/search',
        [ 'middleware' => 'school', 'uses' => 'AdministratorController@getSearch' ]);
/* End Sharing Routes */
/* Sharing Routes */
    Route::get('share/{personalFile}/groups',
        [ 'middleware' => 'school', 'uses' => 'ShareController@index' ]);
    Route::get('/share/{personalFile}/{username}/',
        [ 'middleware' => 'school', 'uses' => 'ShareController@create' ]);
    Route::get('/share/{username}/',
        [ 'middleware' => 'school', 'uses' => 'ShareController@show' ]);
    Route::get('/share/{username}/files/{user}/',
        [ 'middleware' => 'school', 'uses' => 'ShareController@shared' ]);
    Route::post('/share/{personalFile}/search/',
        [ 'middleware' => 'school', 'uses' => 'ShareController@search' ]);
    Route::get('/share/{personalFile}/search',
        [ 'middleware' => 'school', 'uses' => 'ShareController@getSearch' ]);
/* End Sharing Routes */

/* File Manager Routes */
    /* Client Routes */
        Route::get('/manager',
            [ 'middleware' => 'school', 'uses' => 'FileController@index' ]);

        Route::get('/manager/upload',
            [ 'middleware' => 'school', 'uses' => 'FileController@create' ]);
        Route::post('/manager/upload/{folder}',
            [ 'middleware' => 'school', 'uses' => 'FileController@store' ]);
        Route::get('/manager/{folder}/delete',
            [ 'middleware' => 'school', 'uses' => 'FileController@destroyFolder' ]);
        Route::post('/manager/{group}/folder',
            [ 'middleware' => 'school', 'uses' => 'FileController@storeFolder' ]);
        Route::post('/manager/{folder}/sub/folder',
            [ 'middleware' => 'school', 'uses' => 'FileController@storeSubFolder' ]);
        Route::post('/manager/{folder}/folder/update',
            [ 'middleware' => 'school', 'uses' => 'FileController@updateFolder' ]);
        Route::get('/manager/delete/{folder}/{file}',
            [ 'middleware' => 'school', 'uses' => 'FileController@destroy' ]);
        Route::get('/manager/{group}/{folder}/main',
            [ 'middleware' => 'school', 'uses' => 'FileController@show' ]);
        Route::get('/manager/{group}/{folder}/',
            [ 'middleware' => 'school', 'uses' => 'FileController@redirect' ]);
        /*Route::get('/download/',
            [ 'middleware' => 'school', 'uses' => 'FileController@download' ]);*/
        Route::get('/download/{file}',
            [ 'middleware' => 'school', 'uses' => 'FileController@download' ]);
    /* End Client Routes */

    /* School Routes */

    /* End School Routes */



/* Notice Routes */
    /* School Routes */
        Route::get('/admin/notice',  ['middleware' => 'school', 'uses' => 'NoticeController@adminIndex']);
        Route::get('/notices/destroy/{notice}',  ['middleware' => 'school', 'uses' => 'NoticeController@destroy']);
        Route::get('/admin/{username}/notice',  ['middleware' => 'school', 'uses' => 'NoticeController@admin']);
    /* End School Routes */

    /* Client Routes */
        Route::get('/notice',  ['middleware' => 'school', 'uses' => 'NoticeController@index']);
        Route::get('/{username}/notice',  ['middleware' => 'school', 'uses' => 'NoticeController@show']);
        Route::post('/{username}/notice',  ['middleware' => 'school', 'uses' => 'NoticeController@store']);
    /* End Client Routes */
/* End Notice Routes */

/* Group Followers */
    Route::get('/{username}/contacts',  ['middleware' => 'school', 'uses' => 'FollowController@show']);
    Route::post('/{username}/contacts/search',
        [ 'middleware' => 'school', 'uses' => 'AdministratorController@search' ]);
    Route::get('/{username}/contacts/{value}/search',
        [ 'middleware' => 'school', 'uses' => 'AdministratorController@getSearch' ]);

/* End Group Followers */
/* Group Routes */ 
    /* School Routes */

    /* End School Routes */

    /* Client Routes */
        Route::get('groups/all',  ['middleware' => 'school', 'uses' => 'FollowController@create']);
        Route::post('/group/search',  ['middleware' => 'school', 'uses' => 'FollowController@search']);
        Route::get('/group/{query}/search',  ['middleware' => 'school', 'uses' => 'FollowController@getSearch']);
        Route::get('/join/group',  ['middleware' => 'school', 'uses' => 'FollowController@store']);
        Route::get('{username}/join/group',  ['middleware' => 'school', 'uses' => 'FollowController@store']);
        Route::get('{username}/send/request',  ['middleware' => 'school', 'uses' => 'FollowController@createRequest']);
        Route::get('{request}/confirm/request',  ['middleware' => 'school', 'uses' => 'FollowController@storeRequest']);
        Route::get('{request}/trash/request',  ['middleware' => 'school', 'uses' => 'FollowController@destroyRequest']);
        Route::get('{username}/leave/group',  ['middleware' => 'school', 'uses' => 'FollowController@destroy']);
        Route::get('/mygroups',  ['middleware' => 'school', 'uses' => 'FollowController@index']);

    /* End Client Routes */
/* End Group Routes */




/* Login and Registration */
    Route::get('/login', 'SchoolController@getLogin');
    Route::get('/register', 'SchoolController@getRegister');
    Route::post('/register', 'SchoolController@postRegister');
    Route::post('/login', 'SchoolController@postLogin');
    Route::get('/logout', 'SchoolController@getLogout');
    Route::get('/profile/update', 'ClientController@edit');
    Route::get('/profile/destroy', 'ClientController@destroyUser');
    Route::post('/profile/update', 'ClientController@update');
    Route::get('/patch/', 'ClientController@getPatchClient');
    Route::post('/patch/', 'ClientController@postPatchClient');
    Route::get('/', ['middleware' => 'school', 'uses' => 'HomeController@index']);
    Route::get('/noAccount', ['middleware' => 'school', 'uses' => 'HomeController@noAccount']);
    Route::get('/profile/activate/{code}',  'SchoolController@getActivate');
    Route::get('/notActivated/{user}', 'SchoolController@getNotActivated');

 /*End of Login and Registration */



/* Group Routes: Create, Update, Read/Show and Delete */

    Route::get('/create/group',  ['middleware' => 'school', 'uses' => 'GroupController@create']);
    Route::post('/create/group',  ['middleware' => 'school', 'uses' => 'GroupController@store']);
    Route::get('/admin/group',  ['middleware' => 'school', 'uses' => 'GroupController@index']);
    Route::get('/{username}/',  ['middleware' => 'school', 'uses' => 'GroupController@show']);
    Route::get('/{username}/update/',  ['middleware' => 'school', 'uses' => 'GroupController@edit']);
    Route::post('/{username}/update/',  ['middleware' => 'school', 'uses' => 'GroupController@update']);
    Route::post('/{username}/update/administrator',  ['middleware' => 'school', 'uses' => 'GroupController@updateAdministrator']);
    Route::get('/{username}/delete/',  ['middleware' => 'school', 'uses' => 'GroupController@destroy']);
/*End of Group CRUD Routes */

Route::get('/tester/main/one',  ['middleware' => 'school', 'uses' => 'HomeController@tester']);


























































































/* Chat Routes */
/* Client Routes
    Route::get('/chats', ['middleware' => 'school', 'uses' => 'ChatController@index']);
    Route::get('/chat/{client}/home', ['middleware' => 'school', 'uses' => 'ChatController@show']);
    Route::get('/{client}/chat/{recipient}', ['middleware' => 'school', 'uses' => 'ChatController@create']);
    Route::post('/{client}/chat/{recipient}', ['middleware' => 'school', 'uses' => 'ChatController@store']);

/* End Client Rotes */

/* End Chat Routes */

/* Community Routes */
/* School Routes
Route::get('/admin',  ['middleware' => 'school', 'uses' => 'HomeController@admin']);
Route::get('/admin/community',  ['middleware' => 'school', 'uses' => 'ForumController@adminIndex']);
Route::get('/{username}/admin/{subject}/community/',  ['middleware' => 'school', 'uses' => 'ForumController@adminChat']);
Route::post('/{username}/{subject}/admin/community',  ['middleware' => 'school', 'uses' => 'ForumController@postAdminChat']);
/* End School Routes */

/* Client Routes
Route::get('/community',  ['middleware' => 'school', 'uses' => 'ForumController@clientIndex']);
Route::get('/{username}/{subject}/community/',  ['middleware' => 'school', 'uses' => 'ForumController@clientShow']);
Route::post('/community/{client}/{subject}',  ['middleware' => 'school', 'uses' => 'ForumController@postClientChat']);

/* End Client Routes */
/* End Community Routes */

/* Events Routes */
/* School Routes
Route::get('/admin/events',  ['middleware' => 'school', 'uses' => 'TimelineController@admin']);
Route::get('/admin/{username}/events',  ['middleware' => 'school', 'uses' => 'TimelineController@create']);
Route::post('/admin/{username}/events',  ['middleware' => 'school', 'uses' => 'TimelineController@store']);
Route::get('/events/update/{event}',  ['middleware' => 'school', 'uses' => 'TimelineController@edit']);
Route::post('/events/update/{event}',  ['middleware' => 'school', 'uses' => 'TimelineController@update']);
Route::get('/events/destroy/{event}',  ['middleware' => 'school', 'uses' => 'TimelineController@destroy']);
*/
/* End School Routes */

/* Client Routes
Route::get('/{username}/events',  ['middleware' => 'school', 'uses' => 'EventsController@index']);
Route::get('/{username}/events/create',  ['middleware' => 'school', 'uses' => 'EventsController@create']);
Route::post('/{username}/events/create',  ['middleware' => 'school', 'uses' => 'EventsController@store']);
Route::post('/{username}/events/search',  ['middleware' => 'school', 'uses' => 'EventsController@search']);
Route::get('/{event}/events/update',  ['middleware' => 'school', 'uses' => 'EventsController@edit']);
Route::get('/{event}/events/destroy',  ['middleware' => 'school', 'uses' => 'EventsController@destroy']);
Route::post('/{event}/events/update',  ['middleware' => 'school', 'uses' => 'EventsController@update']);
Route::post('/event/file/{folder}',  ['middleware' => 'school', 'uses' => 'EventsController@storeFile']);
Route::post('/{event}/event/chat/store',  ['middleware' => 'school', 'uses' => 'EventsController@storeMessage']);
Route::get('{event}/events/profile',  ['middleware' => 'school', 'uses' => 'EventsController@show']);
Route::get('{event}/events/attend',  ['middleware' => 'school', 'uses' => 'EventsController@attend']);
Route::get('/events/attending',  ['middleware' => 'school', 'uses' => 'EventsController@getUserAttendingEvents']);
Route::post('/events/attending/search',  ['middleware' => 'school', 'uses' => 'EventsController@getUserSearchedChosenEvents']);
Route::get('{event}/events/notAttend',  ['middleware' => 'school', 'uses' => 'EventsController@notAttend']);
Route::get('/events',  ['middleware' => 'school', 'uses' => 'TimelineController@Index']);

*/
/* End Client Routes */

/* End Event Routes */

/* Bag Pack Routes
Route::get('/pack', ['middleware' => 'school', 'uses' => 'PackController@index']);
Route::get('/pack/{userFolder}', ['middleware' => 'school', 'uses' => 'PackController@show']);
Route::get('/{group}/pack/share/{file}', ['middleware' => 'school', 'uses' => 'PackController@share']);
Route::post('/pack/search/{file}', ['middleware' => 'school', 'uses' => 'PackController@search']);
Route::get('/pack/share/{file}', ['middleware' => 'school', 'uses' => 'PackController@getShare']);
Route::get('/{group}/shared/', ['middleware' => 'school', 'uses' => 'PackController@getShared']);
Route::post('/pack/upload/{userFolder}', ['middleware' => 'school', 'uses' => 'PackController@store']);
Route::post('/pack/folder', ['middleware' => 'school', 'uses' => 'PackController@storeFolder']);
Route::post('/pack/{userFolder}/sub', ['middleware' => 'school', 'uses' => 'PackController@storeSubFolder']);
*/
/* School Messenger Routes */
/*
Route::get('/{username}/forum/' ,  ['middleware' => 'school', 'uses' => 'MessengerController@getSchoolMessages']);
Route::post('/{username}/forum/' ,  ['middleware' => 'school', 'uses' => 'MessengerController@postSchoolMessages']);

/* CLIENT'S ROUTES */

/* Client Routes: Login, Registration and Patch Routes */
/*
Route::get('/{username}/login' , 'ClientController@getLoginAndRegistration');
Route::post('/{username}/login' , 'ClientController@postLogin');
Route::post('/{username}/register' , 'ClientController@postRegister');


/* Mail Routes */

    /* Client Routes */
        /*
        Route::get('/mail',  ['middleware' => 'school', 'uses' => 'MailController@clientIndex']);
        Route::get('/{username}/client/mail/{client}/trash',  ['middleware' => 'school', 'uses' => 'MailController@getClientTrash']);
        Route::get('/{username}/client/mail/trash/{client}/{mail}',  ['middleware' => 'school', 'uses' => 'MailController@getClientMessageTrash']);
        Route::get('/{username}/client/mail/{client}/' , ['middleware' => 'client', 'uses' => 'MailController@getClientMail']);
        Route::get('/{username}/client/mail/sent/{client}/' , ['middleware' => 'client', 'uses' =>  'MailController@getClientSent']);
        Route::get('/{username}/client/mail/send/{client}' , ['middleware' => 'client', 'uses' => 'MailController@getClientCompose']);
        Route::post('/{username}/client/mail/send/{client}' , ['middleware' => 'client', 'uses' =>  'MailController@postClientCompose']);
        Route::get('/{username}/client/mail/sent/{client}/{mail}' , ['middleware' => 'client', 'uses' =>  'MailController@getClientMessageSent']);
        Route::get('/{username}/client/mail/{client}/{mail}' , ['middleware' => 'client', 'uses' =>  'MailController@getClientMessageInbox']);
        */
       /*   
        Route::get('/{username}/client/mail/{client}/{mail}/trash' , ['middleware' => 'client', 'uses' =>  'MailController@markInboxTrash']);
        Route::get('/{username}/client/mail/sent/{mail}/trash' , ['middleware' => 'client', 'uses' =>  'MailController@markSentTrash']);
       */

    /* School Routes */
        /*
        Route::get('/{username}/mail/trash',  ['middleware' => 'school', 'uses' => 'MailController@getSchoolTrash']);
        Route::get('/{username}/mail/trash/{mail}',  ['middleware' => 'school', 'uses' => 'MailController@getSchoolMessageTrash']);
        Route::get('/{username}/mail/' ,  ['middleware' => 'school', 'uses' => 'MailController@getSchoolMail']);
        Route::get('/{username}/mail/send' ,  ['middleware' => 'school', 'uses' => 'MailController@getSchoolSend']);
        Route::post('/{username}/mail/send' ,  ['middleware' => 'school', 'uses' => 'MailController@postSchoolSend']);
        Route::get('/{username}/mail/sent',  ['middleware' => 'school', 'uses' => 'MailController@getSchoolSent']);
        Route::get('/{username}/mail/sent/{mail}',  ['middleware' => 'school', 'uses' => 'MailController@getSchoolMessageSent']);
        Route::get('/{username}/mail/{mail}',  ['middleware' => 'school', 'uses' => 'MailController@getSchoolMessageInbox']  );
        Route::get('/{username}/mail/{mail}/trash',  ['middleware' => 'school', 'uses' => 'MailController@markInboxTrash']  );
        Route::get('/{username}/mail/sent/{mail}/trash',  ['middleware' => 'school', 'uses' => 'MailController@markSentTrash']  );
        */


/* End Mail Routes */





/* Client Routes: Home */

//Route::get('/{username}/' ,['middleware' => 'client', 'uses' => 'ClientController@getHome']);

/* Client Forum Routes  */

/*

Route::get('/{username}/client/forum/{client}/' , ['middleware' => 'client', 'uses' => 'MessengerController@getClientMessages']);
Route::post('/{username}/client/forum/{client}/' , ['middleware' => 'client', 'uses' => 'MessengerController@postClientMessages']);
Route::get('/{username}/client/forum/class/{client}/' , ['middleware' => 'client', 'uses' => 'MessengerController@getClientClassMessages']);
Route::post('/{username}/client/forum/class/{client}/' , ['middleware' => 'client', 'uses' => 'MessengerController@postClientClassMessages']);

*/








/* ADMINISTRATOR'S ROUTES  */

/* Administrators Routes: Login and Registration 

Route::get('/{username}/admin/login', 'AdministratorController@getLogin');
Route::post('/{username}/admin/login' , 'AdministratorController@postLogin');
//Route::get('/admin/{username}/admin/' , 'AdministratorController@getRegister');
Route::post('/{username}/admin/register' , 'AdministratorController@postRegister');
Route::get('/{username}/admin/' , ['middleware' => 'admin', 'uses' => 'AdministratorController@home']);

 /* Mail Routes */

/*
Route::get('/{username}/admin/mail', ['middleware' => 'admin', 'uses' => 'MailController@getAdminMail']);
Route::get('/{username}/admin/mail/send', ['middleware' => 'admin', 'uses' => 'MailController@getAdminCompose']);
Route::post('/{username}/admin/mail/send', ['middleware' => 'admin', 'uses' => 'MailController@postAdminCompose']);
Route::get('/{username}/admin/mail/sent', ['middleware' => 'admin', 'uses' => 'MailController@getAdminSent']);
Route::get('/{username}/admin/mail/sent/{mail}', ['middleware' => 'admin', 'uses' => 'MailController@getAdminMessageSent']);
Route::get('/{username}/admin/mail/{mail}', ['middleware' => 'admin', 'uses' => 'MailController@getAdminMessageInbox']);
*/