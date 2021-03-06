<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Route::group(['prefix' => 'admin'],function ()
{
    Route::get('login-----//------', 'LoginController@showLoginForm')->name('admin.login');
    Route::post('login-----//------', 'LoginController@login');
    Route::get('logout', 'LoginController@logout');
    Route::get('dash', 'DashboardController@index');
    Route::get('index','IndexController@index');
    Route::post('upload/images','ImageUploadController@ImagesUpload');
    Route::post('upload/articleimages','ImageUploadController@upload_image');
    Route::post('file-delete-batch','ImageUploadController@DeletePics');
    Route::get('category','CategoryController@Index');
    Route::get('category/create/{id?}','CategoryController@Create');
    Route::get('category/edit/{id}','CategoryController@Edit');
    Route::post('category/create','CategoryController@PostCreate')->name('category_create');
    Route::put('category/edit/{id}','CategoryController@PostEdit')->name('category_edit');
    Route::post('category/delete/{id}','CategoryController@DeleteCategory');
    Route::get('article','ArticleController@Index');
    Route::get('article/ownership','ArticleController@OwnerShip');
    Route::get('article/pendingaudit','ArticleController@PendingAudit');
    Route::get('article/pedingpublished','ArticleController@PedingPublished');
    Route::get('article/brands','ArticleController@Brands');
    Route::get('article/previewarticle/{id}','ArticleController@PreViewArticle');
    Route::post('article/delete/{id}','ArticleController@DeleteArticle');
    Route::post('article/branddelete/{id}','ArticleController@DeleteBrandArticle');
    Route::post('article/uploads','ArticleController@UploadImages');
    Route::get('article/create','ArticleController@Create');
    Route::get('article/brandcreate','ArticleController@BrandCreate');
    Route::get('article/edit/{id}','ArticleController@Edit');
    Route::post('article/titlecheck','ArticleController@ArticletitleCheck');
    Route::get('article/brandedit/{id}','ArticleController@BrandEdit');
    Route::get('article/type/{id}','ArticleController@Type');
    Route::post('article/create','ArticleController@PostCreate')->name('article_create');
    Route::post('article/brand/create','ArticleController@PostBrandArticle')->name('article_brand_create');
    Route::post('article/search','ArticleController@PostArticleSearch')->name('article_search');
    Route::put('article/edit/{id}','ArticleController@PostEdit')->name('article_edit');
    Route::put('brandarticle/edit/{id}','ArticleController@PostBrandArticleEditor')->name('brand_article_edit');
    Route::get('flink','FlinkController@Index');
    Route::get('flink/create','FlinkController@CreateFlink');
    Route::get('flink/edit/{id}','FlinkController@EditFlink');
    Route::get('flink/delete/{id}','FlinkController@DeleteFlink');
    Route::put('flink/edit/{id}','FlinkController@PostEditFlink');
    Route::post('flink/create','FlinkController@PostCreateFlink');
    Route::get('admin/list','AdminController@Index');
    Route::get('admin/regsiter','AdminController@Register');
    Route::post('admin/regsiter','AdminController@PostRegister');
    Route::get('admin/edit/{id}','AdminController@Edit');
    Route::get('admin/delete/{id}','AdminController@delete');
    Route::put('admin/edit/{id}','AdminController@PostEdit');
    Route::get('admin/userauth','AdminController@Userauth');
    Route::get('admin/article/infos','AdminController@ArticleInfos')->name('admin_articles');
    Route::get('/clearnotification','AdminController@NotificationClear');
    Route::get('userlist','FrontUserController@Index');
    Route::get('useradd','FrontUserController@UserAdd');
    Route::get('user/edit/{id}','FrontUserController@UserEdit');
    Route::get('user/charge','FrontUserController@UserCharge');
    Route::put('user/charge','FrontUserController@PostUserCharge');
    Route::get('user/charge-history','FrontUserController@UserChargeHistory');
    Route::put('user/edit/{id}','FrontUserController@PostUserEdit');
    Route::get('user/delete/{id}','FrontUserController@UserDelete');
    Route::get('ask','AskController@Index')->name('adminasklists');
    Route::get('ask/add','AskController@Add');
    Route::post('ask/add','AskController@PostAdd')->name('ask_create');
    Route::get('ask/edit/{id}','AskController@AskEdit');
    Route::put('ask/edit/{id}','AskController@PostEdit')->name('ask_edit');
    Route::get('ask/delete/{id}','AskController@Delete');
    Route::get('ask/pending','AskController@PendingAsks');
    Route::get('answers','AnswerController@AnswerLists')->name('answerlists');
    Route::get('answer/edit/{id}','AnswerController@AnswerEdit');
    Route::put('answer/edit/{id}','AnswerController@PostEdit')->name('answer_edit');
    Route::get('answer/delete/{id}','AnswerController@AnswerDetete');
    Route::get('answers/pending','AnswerController@AnswerPending');
    Route::get('comments','CommentsController@Index')->name('commentlists');
    Route::get('comments/pendingaudit','CommentsController@Pending');
    Route::get('comment/edit/{id}','CommentsController@CommentEdit');
    Route::put('comment/edit/{id}','CommentsController@PostCommentEdit');
    Route::get('comment/delete/{id}','CommentsController@DeleteComment');
    Route::get('commentsreversion','CommentReversionController@Index')->name('reversionlists');
    Route::get('commentsreversion/pendingaudit','CommentReversionController@Pending');
    Route::get('reversion/edit/{id}','CommentReversionController@ReversionEdit');
    Route::put('reversion/edit/{id}','CommentReversionController@PostReversionEdit');
    Route::get('reversion/delete/{id}','CommentReversionController@ReversionDelete');
    Route::get('makesitemap','SiteMapController@Index');
    Route::get('makemsitemap','SiteMapController@MobileSitemap');
    Route::get('phone','PhoneManageController@Index');
    Route::post('phone/create','PhoneManageController@CreatePhoneManage');

    Route::get('phone/edit/{id}','PhoneManageController@PhoneManageEdit');
    Route::put('phone/edit/{id}','PhoneManageController@PhoneManageEditPost');
    Route::get('phone/delete/{id}','PhoneManageController@DeletePhone');
    Route::get('sysconfig','SysConfigController@Index');
    Route::get('sysinfo','SysConfigController@Info');
    Route::get('searchkey','SeoInfoController@SearchKey');
    Route::get('webinfo','SeoInfoController@Index');
    Route::get('brands','SeoInfoController@BrandsView');
    Route::get('worklinks','SeoInfoController@WorkLinks');
    Route::get('workcheck','SeoInfoController@WorkCheck');
    Route::get('weichatusercheck','WechatUserController@Usercheck');
    Route::get('weichatusers','WechatUserController@UserLists');
    Route::get('weichatuser/{openid}','WechatUserController@User');
    Route::post('weichatuser/{openid}','WechatUserController@PostUser');
    Route::get('weichatuser/{openid}','WechatUserController@User');
    Route::get('querylisthtml','QuerylistHtmlController@getQueryListHtml');
    Route::get('brandimport','NaichaBrandController@importBrands');
    Route::get('brandlists','NaichaBrandController@brandListsView')->name('pbrandlists');
    Route::get('branddatas/del/{id}','NaichaBrandController@Delete');
    Route::post('brandstatus/{id}', 'NaichaBrandController@Status')->name('status');
    Route::get('brandtypelist','BrandTypeController@brandTypeLIst')->name('brandtypelist');
    Route::get('brandtypecreate','BrandTypeController@brandTypeCreate');
    Route::post('brandtypecreate','BrandTypeController@postBrandTypeCreate');
    Route::get('brandtype/edit/{id}','BrandTypeController@brandTypeEdit');
    Route::post('brandtype/edit/{id}','BrandTypeController@postBrandTypeEreate');
    Route::get('brandtype/delete/{id}','BrandTypeController@brandTypeDelete');
    Route::get('importbrands','NaichaBrandController@brandsImport');
    Route::put('importbrands','NaichaBrandController@postBrandsImport')->name('importbrands');
    Route::get('investmentlist','InvestMentController@InvestMentList');
    Route::get('investmentcreate','InvestMentController@InvestMentCreate');
    Route::post('investmentcreate','InvestMentController@postInvestMentCreate');
    Route::get('investment/edit/{id}','InvestMentController@InvestMentEdit');
    Route::post('investment/edit/{id}','InvestMentController@postInvestMentEdit');
    Route::get('acreagelist','AcreageMentController@acreageMentList');
    Route::get('acreagecreate','AcreageMentController@acreageMentCreate');
    Route::post('acreagecreate','AcreageMentController@postAcreageMentCreate');
    Route::get('acreage/edit/{id}','AcreageMentController@acreageMentEdit');
    Route::post('acreage/edit/{id}','AcreageMentController@postAcreageMentEdit');
    Route::get('/captcha/{config?}','CaptchasController@Captchas');
});
Route::get('phone',function(){
    return view('phone');
});
