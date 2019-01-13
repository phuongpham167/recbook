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
Route::get( '/gui-mail', function(){

});
Route::get('/', 'PageController@index')->name('home');
Route::get('/danh-muc/{tag}', ['as' => 'danh-muc', 'uses' => 'PageController@getDanhmuc']);
Route::get('/tim-kiem', ['as' => 'search' , 'uses' => 'PageController@search']);
Route::get('/tim-kiem-thong-minh', ['as' => 'smart-search', 'uses' => 'PageController@smartSearch']);

/*
 * hard route
 * */
Route::get('/tin-vip', ['as' => 'tin-vip', 'uses' => 'PageController@homeTinVip']);
Route::get('/tin-noi-bat', ['as' => 'tin-noi-bat', 'uses' => 'PageController@featuredRealEstate']);
Route::get('/tin-moi-nhat', ['as' => 'newest-real-estate', 'uses' => 'PageController@newestRealEstate']);
Route::get('/tin-rao-cong-dong-mien-phi', ['as' => 'free-real-estate', 'uses' => 'PageController@freeRealEstate']);
Route::get('/danh-muc-bds/{tag}', ['as' => 'danh-muc-bds', 'uses' => 'PageController@getRealEstateByCat']);
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
        Route::get('/setvip', 'RealEstateController@setVip');
        Route::get('/sethot', 'RealEstateController@setHot');

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
Route::get('/customer-by-phone/{phone}', ['as' => 'customer-by-phone', 'uses' => 'RealEstateController@customerByPhone']);

Route::get('t', function(){

});