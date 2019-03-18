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

use App\RealEstate;
use App\ShareCustomer;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use App\UserGroup;

Route::get('sitemap', function() {

    // create new sitemap object
    $sitemap = App::make('sitemap');

    // set cache key (string), duration in minutes (Carbon|Datetime|int), turn on/off (boolean)
    // by default cache is disabled
    $sitemap->setCache('laravel.sitemap', 60);

    // check if there is cached sitemap and build new only if is not
    if (!$sitemap->isCached()) {
        $time   =   \Carbon\Carbon::now();
        // add item to the sitemap (url, date, priority, freq)
        $sitemap->add(URL::to('/'), $time, '1.0', 'daily');
        $sitemap->add(URL::to('tim-kiem'), $time, '0.9', 'monthly');
        $sitemap->add(URL::to('tim-kiem-du-an'), $time, '0.9', 'monthly');
        $sitemap->add(URL::to('tim-kiem-thong-minh'), $time, '0.9', 'monthly');
        $sitemap->add(URL::to('tin-vip'), $time, '0.9', 'monthly');
        $sitemap->add(URL::to('tin-noi-bat'), $time, '0.9', 'monthly');
        $sitemap->add(URL::to('tin-rao-cong-dong-mien-phi'), $time, '0.9', 'monthly');
        $sitemap->add(URL::to('bai-viet/danh-sach'), $time, '0.9', 'monthly');
        $sitemap->add(URL::to('lien-he'), $time, '0.9', 'monthly');

        $sitemap->add(URL::to('dang-nhap'), $time, '0.9', 'monthly');
        $sitemap->add(URL::to('dang-xuat'), $time, '0.9', 'monthly');
        $sitemap->add(URL::to('dang-ky'), $time, '0.9', 'monthly');
        $sitemap->add(URL::to('quen-mat-khau'), $time, '0.9', 'monthly');
        $sitemap->add(URL::to('dat-lai-mat-khau'), $time, '0.9', 'monthly');
        $sitemap->add(URL::to(''), $time, '0.9', 'monthly');
        $sitemap->add(URL::to(''), $time, '0.9', 'monthly');
        $cats   =   \App\ReCategory::all();
        foreach($cats as $cat){
            $sitemap->add(URL::to('danh-muc/'.$cat->slug), $time, '0.9', 'monthly');
        }
        $re =   RealEstate::all();
        foreach($re as $r){
            $sitemap->add(URL::to('tin/'.$r->slug.'-'.$r->id), $time, '0.9', 'monthly');
        }

    }

    // show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
//    $sitemap->store('xml', 'mysitemap');
    return $sitemap->render('xml');
});
Route::get('/', 'PageController@index1')->name('home');
Route::get('/home', ['as'=>'Home1', 'uses'=>'PageController@index1']);
Route::get('/danh-muc/{tag}', ['as' => 'danh-muc', 'uses' => 'PageController@getDanhmuc']);
Route::get('/tim-kiem', ['as' => 'search' , 'uses' => 'PageController@search']);
Route::get('/tim-kiem-du-an', ['as' => 'searchProject' , 'uses' => 'PageController@searchProject']);
Route::get('/tim-kiem-thong-minh', ['as' => 'smart-search', 'uses' => 'PageController@smartSearch']);

/*
 * hard route
 * */
Route::get('/tin-vip', ['as' => 'tin-vip', 'uses' => 'PageController@homeTinVip']);
Route::get('/tin-hot', ['as' => 'tin-hot', 'uses' => 'PageController@featuredRealEstate']);
Route::get('/tin-noi-bat', ['as' => 'tin-noi-bat', 'uses' => 'PageController@highlightRealEstate']);
Route::get('/tin-moi-nhat', ['as' => 'newest-real-estate', 'uses' => 'PageController@newestRealEstate']);
Route::get('/tin-rao-cong-dong-mien-phi', ['as' => 'free-real-estate', 'uses' => 'PageController@freeRealEstate']);
Route::get('/danh-muc-bds/{tag}', ['as' => 'danh-muc-bds', 'uses' => 'PageController@getRealEstateByCat']);
Route::get('/nha-moi-gioi', ['as' => 'nha-moi-gioi', 'uses' => 'PageController@getListAgency']);
/*
 * end hard route
 * */

Route::get('/tin/{slug}', ['as' => 'detail-real-estate', 'uses' => 'PageController@detailRealEstate']);
Route::get('danh-muc-{slugdanhmuc}', ['as' => 'postcategorylist', 'uses' => 'PostController@listCategory']);
Route::get('/bai-viet/danh-sach', ['as' => 'postlist', 'uses' => 'PostController@list']);
Route::get('/bai-viet/{slugchitiet}', ['as' => 'postdetail', 'uses' => 'PostController@detail']);
Route::get('/lien-he', ['as' => 'contact', 'uses' => 'ContactController@getContact']);
Route::post('/lien-he', ['as' => 'post.contact', 'uses' => 'ContactController@postContact']);

/*
 * route thong tin thanh vien
 * */
Route::get('/user/{id}', ['as' => 'user.info', 'uses' => 'PageController@getUserInfo']);

Route::get('/dang-nhap', ['as' => 'login', 'uses' => 'AuthenticateController@getLogin']);
Route::post('/dang-nhap', ['as' => 'post.login', 'uses' => 'AuthenticateController@postLogin']);
Route::get('/dang-xuat', ['as' => 'logout', 'uses' => 'AuthenticateController@getLogout']);
Route::get('/dang-ky', ['as' => 'register', 'uses' => 'AuthenticateController@getRegister']);
Route::post('/dang-ky', ['as' => 'post.register', 'uses' => 'AuthenticateController@postRegister']);
Route::get('/quen-mat-khau', ['as' => 'forgot_password', 'uses' => 'AuthenticateController@getForgotPassword']);
Route::post('/quen-mat-khau', ['as' => 'post.forgot_password', 'uses' => 'AuthenticateController@postForgotPassword']);
Route::get('/dat-lai-mat-khau', ['as' => 'getPassword', 'uses' => 'AuthenticateController@getPassword']);
Route::post('/dat-lai-mat-khau', ['as' => 'postPassword', 'uses' => 'AuthenticateController@postPassword']);

Route::post('/gui-xac-thuc', ['as' => 'post.verify', 'uses' => 'AuthenticateController@postVerify']);
Route::get('/gui-lai-xac-thuc', ['as' => 'resend.verify', 'uses' => 'AuthenticateController@resendVerify']);

//Route::get('/phpfirebase_sdk','FirebaseController@index');
//Route::get('/test-api','FirebaseController@test');

Route::post('/theme-category', ['as' => 'themeCategory', 'uses' => 'ThemeController@getTheme']);

Route::group(['middleware'=>'auth'], function(){
    Route::get('/quan-ly-tin-rao', ['as' => 'manage', 'uses' => 'AuthenticateController@getManage']);
    Route::get('/doi-mat-khau', ['as' => 'change_password', 'uses' => 'AuthenticateController@getChangepassword']);
    Route::post('/doi-mat-khau', ['as' => 'post.change_password', 'uses' => 'AuthenticateController@postChangepassword']);
    Route::get('/thong-tin-thanh-vien', ['as' => 'info', 'uses' => 'AuthenticateController@getInfo']);
    Route::post('/thong-tin-thanh-vien', ['as' => 'post.info', 'uses' => 'AuthenticateController@postInfo']);
    Route::get('/lich-su-giao-dich', ['as' => 'transaction', 'uses' => 'AuthenticateController@transactionList']);
    Route::get('/lich-su-giao-dich/data', ['as' => 'transactionData', 'uses' => 'AuthenticateController@dataTran']);

    Route::get('/nap-tien', ['as' => 'recharge', 'uses' => 'TransactionController@recharge']);
    Route::post('/nap-tien', ['as' => 'post.recharge', 'uses' => 'TransactionController@postRecharge']);
    Route::get('/nap-tien/ket-qua', ['as' => 'rechargeResult', 'uses' => 'TransactionController@rechargeResult']);
    Route::get('/nap-tien/huy-bo', ['as' => 'rechargeCancel', 'uses' => 'TransactionController@rechargeCancel']);

    Route::get('frontend', ['as' => 'frontendList', 'uses' => 'FrontendController@getList']);
    Route::get('frontend/data', ['as' => 'frontendData', 'uses' => 'FrontendController@dataList']);
    Route::get('frontend/create', ['as' => 'frontendCreate', 'uses' => 'FrontendController@getCreate']);
    Route::post('frontend/create', ['as' => 'frontendCreate', 'uses' => 'FrontendController@postCreate']);
    Route::get('frontend/del', ['as' => 'frontendDelete', 'uses' => 'FrontendController@getDelete']);
    Route::get('frontend/edit', ['as' => 'frontendEdit', 'uses' => 'FrontendController@getEdit']);
    Route::post('frontend/edit', ['as' => 'frontendEdit', 'uses' => 'FrontendController@postEdit']);
    Route::post('frontend/save', ['as'=>'saveProjectFrontend', 'uses'=>'FrontendController@saveProject']);
    Route::post('frontend/saveByParts', ['as'=>'saveProjectFrontend', 'uses'=>'FrontendController@saveProjectByParts']);
    Route::post('frontend/export', ['as'=>'saveProjectFrontend', 'uses'=>'FrontendController@exportProject']);

    Route::get('nhom', ['as'=>'userListGroup', 'uses'=>'AuthenticateController@getListGroup']);
    Route::get('nhom/data', ['as'=>'userDataGroup', 'uses'=>'AuthenticateController@dataListGroup']);
    Route::get('nhom/them', ['as'=>'userCreateGroup', 'uses'=>'AuthenticateController@getCreateGroup']);
    Route::post('nhom/them', ['as'=>'userCreateGroup', 'uses'=>'AuthenticateController@postCreateGroup']);
    Route::get('nhom/xoa', ['as'=>'userDeleteGroup', 'uses'=>'AuthenticateController@getDeleteGroup']);
    Route::get('nhom/sua', ['as'=>'userEditGroup', 'uses'=>'AuthenticateController@getEditGroup']);
    Route::post('nhom/sua', ['as'=>'userEditGroup', 'uses'=>'AuthenticateController@postEditGroup']);

    Route::get('nhom/thanh-vien', ['as'=>'getUser', 'uses'=>'AuthenticateController@getMember']);
    Route::get('nhom/thanh-vien/data', ['as'=>'memberData', 'uses'=>'AuthenticateController@getDataMember']);
    Route::get('nhom/thanh-vien/them', ['as'=>'addMember', 'uses'=>'AuthenticateController@postAddMember']);
    Route::get('nhom/thanh-vien/xoa', ['as'=>'deleteMember', 'uses'=>'AuthenticateController@postDeleteMember']);

    Route::group(['prefix'=>'bat-dong-san'], function(){
        Route::get('/{filter?}', ['as' => 'realEstateList', 'uses' => 'RealEstateController@list'])->where('filter', 'tin-rao-het-han|tin-rao-cho-duyet|tin-rao-nhap|tin-rao-da-xoa');
        Route::get('/data',['as' => 'realEstateData', 'uses' => 'RealEstateController@data']);
        Route::get('/sua', ['as' => 'get.edit-real-estate', 'uses' => 'RealEstateController@edit']);
        Route::post('/sua', 'RealEstateController@update');
        Route::get('/tao-moi', ['as' => 'get.create-real-estate',  'uses' => 'RealEstateController@create']);
        Route::post('tao-moi', ['as' => 'post.create-real-estate', 'uses' => 'RealEstateController@store']);
        Route::get('/xoa', 'RealEstateController@delete');
        Route::get('/dang-bai', 'RealEstateController@publish');
        Route::post('/multi-delete', 'RealEstateController@multiDelete');
        Route::post('/sethotvip', 'RealEstateController@setVipHot');
        Route::get('/up', 'RealEstateController@upPost');
        Route::get('/da-ban', 'RealEstateController@sold');
        Route::post('/gia-han', 'RealEstateController@renewed');
        Route::post('/bao-cao',['as' => 're-report', 'uses' => 'RealEstateController@report']);
    });

    Route::group(['prefix' => 'du-an'], function () {
        Route::get('quan-ly-du-an/{filter?}', ['as' => 'freelancerList', 'uses' => 'FreelancerController@list'])->where('filter', 'da-dang|da-chao-gia|da-tham-gia');
        Route::get('quan-ly-du-an/data', ['as' => 'freelancerData', 'uses' => 'FreelancerController@data']);
        Route::post('/tao-moi', ['as' => 'freelancerCreate', 'uses' => 'FreelancerController@postCreate']);
//        Route::get('/chi-tiet/{id}/{slug}', ['as' => 'freelancerDetail', 'uses' => 'FreelancerController@show']);
//        Route::post('luu/{id?}', ['as'=>'freelancerCreate', 'uses'=>'FreelancerController@store']);
        Route::post('dat-gia/{id}', ['as'=>'freelancerDeal', 'uses'=>'FreelancerController@deal']);
        Route::post('nhan-xet', ['as'=>'freelancerReview', 'uses'=>'FreelancerController@review']);
        Route::get('chon/{fl_id}/{deal_id}', ['as'=>'freelancerChoosen', 'uses'=>'FreelancerController@choosen']);
//        Route::post('ket-thuc', ['as'=>'freelancerFinish', 'uses'=>'FreelancerController@finish']);
        Route::get('dong', ['as'=>'freelancerClose', 'uses'=>'FreelancerController@close']);
    });

    /*
     * route for chat
     * */
    Route::get('/tin-nhan', ['as' => 'chat', 'uses' => 'PageController@getChat']);
    Route::resource('conversation','ConversationController');
    Route::resource('message','MessageController');

    Route::post('/update-avatar', ['as' => 'post.update-avatar', 'uses' => 'UserController@updateAvatar']);
    Route::post('/update-cover', ['as' => 'post.update-cover', 'uses' => 'UserController@updateCover']);
    /*
     * friend route
     * */
    Route::get('danh-sach-loi-moi-ket-ban', ['as' => 'friend.request.list', 'uses' => 'FriendController@listFriendRequest']);
    Route::get('them-ban-be/{id}', ['as'=> 'friend.request', 'uses' => 'FriendController@friendRequest']);
    Route::get('xac-nhan-ban-be/{id}', ['as'=> 'friend.confirm.request', 'uses' => 'FriendController@confirmFriendRequest']);
    Route::get('huy-ket-ban/{id}', ['as'=> 'friend.cancel', 'uses' => 'FriendController@cancelFriend']);

    /*
     * ajax route
     * */
    Route::group(['prefix' => 'ajax'], function() {
        Route::get('/get-detail-re/{id}', ['as' => 'ajax.getDetailRe', 'uses' => 'RealEstateController@getDetailRe']);
        Route::post('/update-detail-re/{id}', ['as' => 'ajax.updateDetailRe', 'uses' => 'RealEstateController@updateDetailRe']);
        Route::get('user', 'AjaxController@ajaxUser');
        Route::get('user-group', 'AjaxController@ajaxUserGroup');
        Route::get('customer', 'AjaxController@ajaxCustomer');
        Route::get('street', 'AjaxController@ajaxStreet');
        Route::get('province', 'AjaxController@ajaxProvince')->name('ajaxProvince');
        Route::get('/get-unread-message', ['as' => 'ajax.getUnreadMessage', 'uses' => 'ConversationController@getUnreadMessage']);
        Route::post('/add-cil', ['as'=> 'ajax.addCil', 'uses' => 'RealEstateController@addCil']);
        Route::get('post_left', ['as'=>'getPublicPostLeft', 'uses'=>'AjaxController@getPostleft']);
        Route::get('block', 'AjaxController@ajaxBlock');
    });

    Route::post('search-area', 'AreaController@searchArea');


    Route::group(['prefix'=>'khach-hang'], function(){
        Route::get('', function(\App\DataTables\CustomerDatatable $dataTable) {
            return $dataTable->with([
                'user_id' => request('user_id'),
                'datefrom' => request('datefrom'),
                'dateto' => request('dateto'),
                'phone' => request('phone'),
                'source_id' => request('source_id'),
                'type_id' => request('type_id')
            ])->render('themes.default.customer.list');
        })->name('customerList');

        Route::get('data', ['as'=>'customerData', 'uses'=>'CustomerController@dataList']);
        Route::get('data-shared', ['as'=>'customerSharedData', 'uses'=>'CustomerController@dataSharedList']);
        Route::get('them', ['as'=>'customerCreate', 'uses'=>'CustomerController@getCreate']);
        Route::post('them', ['as'=>'customerCreate', 'uses'=>'CustomerController@postCreate']);
        Route::get('xoa', ['as'=>'customerDelete', 'uses'=>'CustomerController@getDelete']);
        Route::get('sua', ['as'=>'customerEdit', 'uses'=>'CustomerController@getEdit']);
        Route::post('sua', ['as'=>'customerEdit', 'uses'=>'CustomerController@postEdit']);
        Route::get('khach-hang-lien-quan', ['as'=>'relatedCustomer', 'uses'=>'CustomerController@relatedCustomer']);
        Route::get('xoa-khach-hang-lien-quan', ['as'=>'deleteRelatedCustomer', 'uses'=>'CustomerController@deleteRelatedCustomer']);

        Route::get('chia-se', ['as'=>'shareCustomer', 'uses'=>'CustomerController@shareCustomer']);

        Route::get('danh-sach-yeu-cau', ['as'=>'customerRE', 'uses'=>'RequestByCustomerController@getList']);
        Route::get('data-re', ['as'=>'customerREData', 'uses'=>'RequestByCustomerController@data']);

        Route::group(['prefix'=>'cham-soc'], function(){
            Route::get('', ['as'=>'customerCare', 'uses'=>'CareController@index']);
            Route::get('/data', ['as'=>'careData', 'uses'=>'CareController@dataList']);
            Route::get('list', ['as'=>'customerCareList', 'uses'=>'CareController@list']);
            Route::get('responses', ['as'=>'responseList', 'uses'=>'CareController@response']);
            Route::get('suggest', ['as'=>'suggestResponse', 'uses'=>'CareController@suggest']);
            Route::get('/del', ['as'=>'careDelete', 'uses'=>'CareController@getDelete']);
            Route::get('/edit', ['as'=>'careEdit', 'uses'=>'CareController@getEdit']);
            Route::get('/create', ['as'=>'careCreate', 'uses'=>'CareController@getCreate']);
            Route::post('/create', ['as'=>'careCreate', 'uses'=>'CareController@postCreate']);
        });

        Route::group(['prefix'=>'lich-hen'], function(){
            Route::get('', ['as'=>'scheduleList', 'uses'=>'ScheduleController@index']);
            Route::get('/data', ['as'=>'scheduleData', 'uses'=>'ScheduleController@dataList']);
            Route::get('/data2', ['as'=>'scheduleData2', 'uses'=>'ScheduleController@dataCustomer']);
            Route::get('/xoa', ['as'=>'scheduleDelete', 'uses'=>'ScheduleController@getDelete']);
            Route::get('/sua', ['as'=>'scheduleEdit', 'uses'=>'ScheduleController@getEdit']);
            Route::post('/sua', ['as'=>'scheduleEdit', 'uses'=>'ScheduleController@postEdit']);
            Route::get('/tao-moi', ['as'=>'scheduleCreate', 'uses'=>'ScheduleController@getCreate']);
            Route::post('/tao-moi', ['as'=>'scheduleCreate', 'uses'=>'ScheduleController@postCreate']);
        });

//        Route::group(['prefix'=>'yeu-cau'], function(){
//            Route::get('', ['as'=>'requestList', 'uses'=>'RequestByCustomerController@index']);
//            Route::get('/data', ['as'=>'scheduleData', 'uses'=>'RequestByCustomerController@dataList']);
//            Route::get('/data2', ['as'=>'scheduleData2', 'uses'=>'RequestByCustomerController@dataCustomer']);
//            Route::get('/xoa', ['as'=>'scheduleDelete', 'uses'=>'RequestByCustomerController@getDelete']);
//            Route::get('/sua', ['as'=>'scheduleEdit', 'uses'=>'RequestByCustomerController@getEdit']);
//            Route::post('/sua', ['as'=>'scheduleEdit', 'uses'=>'RequestByCustomerController@postEdit']);
//            Route::get('/tao-moi', ['as'=>'scheduleCreate', 'uses'=>'RequestByCustomerController@getCreate']);
//            Route::post('/tao-moi', ['as'=>'scheduleCreate', 'uses'=>'RequestByCustomerController@postCreate']);
//        });
    });
});
Route::group(['prefix' => 'ajax'], function() {
    Route::get('province', 'AjaxController@ajaxProvince')->name('ajaxProvince');
});

Route::group(['prefix' => 'du-an'], function () {
    Route::get('/', ['as' => 'freelancerList', 'uses' => 'FreelancerController@index']);
    Route::get('/chi-tiet/{id}/{slug}', ['as' => 'freelancerDetail', 'uses' => 'FreelancerController@show']);
    Route::get('/{filter?}', ['as' => 'freelancerList', 'uses' => 'FreelancerController@index'])->where('filter', 'tu-van-bat-dong-san|tu-van-tai-chinh|tu-van-thiet-ke|tu-van-phong-thuy');
});
/*
 * Route for master data
 * */
Route::get('/district-by-province/{provinceId}', ['as' => 'districtByProvince', 'uses' => 'RealEstateController@districtByProvince']);
Route::get('/ward-by-district/{districtId}', ['as' => 'wardByDistrict', 'uses' => 'RealEstateController@wardByDistrict']);
Route::get('/street-by-ward/{wardId}', ['as' => 'streetByWard', 'uses' => 'RealEstateController@streetByWard']);
Route::get('/project-by-province/{provinceId}', ['as' => 'projectByProvince', 'uses' => 'RealEstateController@projectByProvince']);
Route::get('/range-price/list-dropdown/{catId}', ['as' => 'rangePriceByCat', 'uses' => 'RangePriceController@getListDropDown']);
Route::get('/re-type/list-dropdown/{catId}', ['as' => 'reTypeByCat', 'uses' => 'ReTypeController@getListDropDown']);
Route::get('/re-type/list-dropdown', ['as' => 'reType', 'uses' => 'ReTypeController@getListDropDownNoCat']);
Route::get('/customer-by-phone/{phone}', ['as' => 'customer-by-phone', 'uses' => 'RealEstateController@customerByPhone']);

Route::get('404', ['as' => '404', 'uses' => 'ErrorController@notfound']);
Route::get('500', ['as' => '500', 'uses' => 'ErrorController@fatal']);

Route::get('/tinh-thanh-quan-tam', function (){
    $value = session('tinhthanhquantam');

    return $value;
});

Route::post('/tinh-thanh-quan-tam',['as' => 'interested-provinces', function (){
//    print_r(request('provinces'));
    session(['tinhthanhquantam' => request('provinces')]);
    if(auth()->check()){
        auth()->user()->subcribes()->sync([request('provinces')]);
    }
    return redirect()->back();
}]);

Route::get('/xoa-session', function (){
    session(['tinhthanhquantam' => '']);
    return redirect()->back();
});

Route::group(['prefix'=>'ajax'], function(){
    Route::get('project', ['as' => 'ajax.project', 'uses' => 'AjaxController@ajaxProject']);

});


Route::get('/t', function (){
    \App\OTP::create([
        'content' => 'ma otp cua ban la',
        'phoneNumber' => '0906213162',
        'send' => 'false',
    ]);
});

Route::group(['prefix'=>'notify'], function(){
    Route::get('read/{id?}', 'NotificationController@read')->name('readNotification');
});


