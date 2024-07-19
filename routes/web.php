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
Route::get('/sendmail', 'NotifController@sendmail');
Route::get('/notif', function () {
    return view('emails.notifSurat',['tanggal'=>'2020-04-31','id'=>'2']);
});

Route::get('/cetak-konfirmasi/{id}', 'APIController@cetak_konfirmasi');

Route::group(['prefix'=>'api'],function(){
  Route::post('get_unit','APIController@get_unit');
  Route::post('get_tempat','APIController@get_tempat');
  Route::post('get_tempat_b','APIController@get_tempat_b');
  Route::get('cetak_surat_ijin-{permohonan}-{kategori}','APIController@cetak_surat');
  Route::post('view_surat','APIController@view_surat')->name('view-surat-ijin');
  Route::post('konfirmasi_pengambilan','APIController@konfirmasi_pengambilan');
});

  Route::group(['prefix'=>'login'],function(){
    Route::get('/','Site\LoginController@main')->name('login');
    Route::post('/doLogin','Site\LoginController@doLogin')->name('doLogin');
  });
  Route::get('/logout', 'Site\LoginController@logout');

    Route::get('/', 'Site\DashboardController@main');
    Route::post('/bahasa', 'Site\DashboardController@setBahasa');

    Route::group(['prefix'=>'about'],function(){
      Route::get('/','Site\AboutController@main');
      Route::get('/contact','Site\AboutController@contact');
      Route::get('/sop','Site\AboutController@sop');
    });
    Route::get('recaptchacreate', 'RecaptchaController@create');
    Route::post('store', 'RecaptchaController@store');

    Route::group(['prefix'=>'current'],function(){
      Route::get('/','Site\CurrentController@main');
      Route::get('/viewCurrentIn/{id}','Site\CurrentController@det_viewCurrent');
      Route::get('/ViewFileIn/{id}','Site\CurrentController@ViewFileIn');

    });
    Route::group(['prefix'=>'archive'],function(){
      Route::get('/','Site\ArchiveController@main');
      Route::get('/viewArchive/{thn}/{semester}','Site\ArchiveController@viewArchive');
      Route::get('/viewArchive/{id}','Site\ArchiveController@det_ViewArchive');
      Route::get('/ViewFile/{id}','Site\ArchiveController@ViewFile');
    });
    Route::group(['prefix'=>'announcement'],function(){
      Route::get('/','Site\AnnouncementController@main');
    });
    Route::group(['prefix'=>'article'],function(){
      Route::get('/','Site\ArticleController@main');
    });
    Route::group(['prefix'=>'search'],function(){
      Route::get('/','Site\SearchController@main');
      Route::get('/author','Site\SearchController@author');
      Route::get('/title','Site\SearchController@title');
      Route::post('/Search_Sub','Site\SearchController@Search_Sub')->name('Search_Sub');
    });

  Route::group(['prefix'=>'registrasi'],function(){
    Route::get('/','Site\RegistrationController@main');
    Route::post('/store','Site\RegistrationController@store')->name('regis_store');
    Route::get('/registrasi/refresh_captcha', 'Site\RegistrationController@refreshCaptcha')->name('refresh_captcha');
  });

// user athor route

Route::group(['middleware'=>'userall'],function(){
    Route::group(['prefix'=>'userhome'],function(){
      Route::get('/','Site\UserhomeController@main')->name('userhome');
      Route::get('/edit_profil','Site\UserhomeController@edit')->name('edit_profil');
      Route::any('/update','Site\UserhomeController@do_update')->name('update_profil');
      Route::get('/change','Site\UserhomeController@change_pass')->name('update_password');
      Route::post('/change/update','Site\UserhomeController@update_pass')->name('do_password');
      Route::get('/submit/{id}', 'Site\UserhomeController@view_submit')->name('do_submit');
      Route::post('/comments', 'Site\UserhomeController@insert_submit')->name('store_submit');
      Route::post('/fileup', 'Site\UserhomeController@up_filesub')->name('up_filesubmit');
      Route::post('/upsubis', 'Site\UserhomeController@up_submission')->name('up_submission');
      Route::post('/upsupplemen', 'Site\UserhomeController@up_filesupple')->name('up_filesupple');
      Route::get('/deletesupp/{id}', 'Site\UserhomeController@destroy');
      Route::post('/update_Supp','Site\UserhomeController@update_Supp')->name('update_Supp');

      Route::get('/pernyataan/{id}','Site\UserhomeController@pernyataan')->name('pernyataan');
      Route::post('/confirm_penelitian','Site\UserhomeController@confirm_penelitian')->name('confirm_penelitian');

      Route::get('/active','Site\UserhomeController@view_active')->name('active');
      Route::get('/archive','Site\UserhomeController@view_archive')->name('archive');
      Route::get('/review','Site\UserhomeController@view_review')->name('review');
      Route::get('/revisi','Site\UserhomeController@view_revisi')->name('revisi');

      Route::get('/active/{id}','Site\UserhomeController@det_active')->name('det_active');
      Route::get('/archive/{id}','Site\UserhomeController@det_archive')->name('det_archive');
      Route::get('/review/{id}','Site\UserhomeController@det_review')->name('det_review');
      Route::get('/revisi/{id}','Site\UserhomeController@det_revisi')->name('det_revisi');

      Route::post('/up_review','Site\UserhomeController@up_review')->name('up_review');
      Route::post('/up_revisi','Site\UserhomeController@up_revisi')->name('up_revisi');

      Route::get('/revisi/get_Sub/{id}','Site\UserhomeController@get_Sub')->name('get_Sub');
      Route::post('/Update_Sub','Site\UserhomeController@Update_Sub')->name('Update_Sub');

      Route::get('/up_doc/{id}','Site\FilePendukungController@main')->name('up_doc');
      Route::post('/do_uploadDoc','Site\FilePendukungController@do_upload')->name('do_uploadDoc');

      Route::get('create','Site\FilePendukungController@form_permohonan')->name('formPermohonan');
      Route::post('do_store','Site\FilePendukungController@store_permohonan')->name('store_permohonan');
      Route::post('do_store_b','Site\FilePendukungController@store_permohonan_b')->name('store_permohonan_b');

      Route::get('/view', 'Site\FilePendukungController@view')->name('viewpengajuan');
      Route::get('/view/details/{id}', 'Site\FilePendukungController@details')->name('detailspengajuan');

    });

    Route::group(['prefix'=>'upload-hasil'],function(){
      Route::get('penelitian/{permohonan}','UploadHasilController@main');
      Route::post('simpan','UploadHasilController@simpan')->name('simpan_hasil_penelitian');
    });
});

Route::get('/log_admin','Site\LoginController@log_admin')->name('log_admin');
Route::post('/dolog_admin','Site\LoginController@dolog_admin')->name('dolog_admin');
Route::get('/logout_admin', 'Site\LoginController@logout_admin');


Route::group(['middleware'=>'admin'],function(){

  Route::group(['prefix'=>'owner'],function(){
    Route::get('/','Owner\DashboardController@main')->name('dashboard_owner');
    Route::group(['prefix'=>'identitas'],function(){
      Route::get('/','Owner\IdentitasController@main')->name('identitas_owner');
      Route::post('simpan','Owner\IdentitasController@simpan')->name('simpan_identitas_owner');
      Route::post('doupdate_bahasa','Owner\IdentitasController@doupdate_bahasa')->name('doupdate_bahasa');

      //pkm
      Route::get('/','Owner\IdentitasController@main_pkm')->name('identitas_pkm');
      Route::post('simpan','Owner\IdentitasController@simpan_pkm')->name('simpan_identitas_pkm');
      
      Route::group(['prefix'=>'management_users'],function(){
        Route::get('/','Owner\ManagementController@main')->name('management_users');
        
        Route::post('datagridpemohon','Owner\ManagementController@datagridpemohon')->name('datagridpemohon');
        Route::post('datagridtempat_penelitian','Owner\ManagementController@datagridtempat_penelitian')->name('datagridtempat_penelitian');

        Route::post('datagrid','Owner\ManagementController@editorDatagrid')->name('datagrideditor');
        Route::post('/doDeleteAuthor','Owner\ManagementController@doDeleteAuthor')->name('doDeleteAuthor');
        Route::post('/updateUser','Owner\ManagementController@updateUser')->name('updateUser');

        Route::post('/doUpdateBerita','Owner\ManagementController@do_update_berita')->name('doUpdateBerita');
        Route::post('/upAuthor','Owner\ManagementController@upAuthor')->name('upAuthor');
        Route::post('/detailBerita','Owner\ManagementController@detailBerita')->name('detailBerita');
        Route::post('/modalGambar','Owner\ManagementController@modalGambar')->name('modalGambar');

        Route::post('/detailPkm','Owner\ManagementController@detailPkm')->name('detailPkm');
        Route::post('/updatePkm','Owner\ManagementController@updatePkm')->name('updatePkm');
        Route::post('/storeUpdatePkm','Owner\ManagementController@storeUpdatePkm')->name('storeUpdatePkm');
        
        Route::post('/doDeletePkm','Owner\ManagementController@doDeletePkm')->name('doDeletePkm');
        Route::post('/addUserPhm','Owner\ManagementController@addUserPhm')->name('addUserPhm');
        Route::post('/addUserPkm','Owner\ManagementController@addUserPkm')->name('addUserPkm');
        Route::post('/docreatePkm','Owner\ManagementController@docreatePkm')->name('docreatePkm');
        Route::post('/docreatePhm','Owner\ManagementController@docreatePhm')->name('docreatePhm');
        
      });

      Route::group(['prefix'=>'identitas'],function(){
        Route::get('/','Owner\IdentitasController@main')->name('identitas_owner');
        Route::post('simpan','Owner\IdentitasController@simpan')->name('simpan_identitas_owner');
        Route::post('doupdate_bahasa','Owner\IdentitasController@doupdate_bahasa')->name('doupdate_bahasa');
        Route::post('updatecontact','Owner\IdentitasController@updatecontact')->name('updatecontact');
      });
    });
  });

    Route::group(['prefix'=>'data_pengajuan'],function(){
      Route::get('/','Owner\PengajuanController@main')->name('data_pengajuan');

      Route::post('datagridmenunggu','Owner\PengajuanController@datagridmenunggu')->name('datagridmenunggu');
      Route::post('datagridterima','Owner\PengajuanController@datagridterima')->name('datagridterima');
      Route::post('datagridtolak','Owner\PengajuanController@datagridtolak')->name('datagridtolak');

      Route::post('/detail_pengajuan','Owner\PengajuanController@detail_pengajuan')->name('detail_pengajuan');

      Route::post('/detail_peneliti','Owner\PengajuanController@detail_peneliti')->name('detail_peneliti');
      Route::post('/detail_verifikasi_pengajuan','Owner\PengajuanController@detail_verifikasi_pengajuan')->name('detail_verifikasi_pengajuan');
      
      Route::post('/cetak_konfir','Owner\PengajuanController@cetak_konfir')->name('cetak_konfir');

      Route::post('/detail_hasil','UploadHasilController@detail_hasil')->name('detail_hasil');

      Route::post('/terima_pengajuan','Owner\PengajuanController@terima_pengajuan')->name('terima_pengajuan');
      Route::post('/tolak_pengajuan','Owner\PengajuanController@tolak_pengajuan')->name('tolak_pengajuan');

      Route::post('/send_notif','Owner\PengajuanController@send_notif')->name('send_notif');

      Route::post('/doc_pendukung','Owner\PengajuanController@doc_pendukung')->name('doc_pendukung');
      Route::post('/doc_pendukung_verifikasi','Owner\PengajuanController@doc_pendukung_verifikasi')->name('doc_pendukung_verifikasi');

      Route::post('/doc_hasil','UploadHasilController@doc_hasil')->name('doc_hasil');
      Route::post('/approve_hasil','UploadHasilController@approve_hasil')->name('approve_hasil');
      Route::post('/approvePerFile','Owner\PengajuanController@approvePerFile')->name('approvePerFile');
      Route::post('/approveFile','Owner\PengajuanController@approveFile')->name('approveFile');
      Route::post('/uploadSuratIzin','Owner\PengajuanController@uploadSuratIzin')->name('uploadSuratIzin');
      Route::post('/hapusSuratIzin','Owner\PengajuanController@hapusSuratIzin')->name('hapusSuratIzin');

      Route::post('/approveFileVerifikasi','Owner\PengajuanController@approveFileVerifikasi')->name('approveFileVerifikasi');

      Route::get('/notifikasi_submit','Owner\PengajuanController@notifikasi_submit')->name('notifikasi_submit');
      Route::get('/is_banned','Owner\PengajuanController@is_banned')->name('is_banned');
      Route::post('/delete_accept','Owner\PengajuanController@delete_accept')->name('delete_accept');
      Route::post('/delete_permohonan','Owner\PengajuanController@delete_permohonan')->name('delete_permohonan');

      Route::post('/delete_menunggu','Owner\PengajuanController@delete_menunggu')->name('delete_menunggu');

      Route::post('/modal_surat','Owner\PengajuanController@modal_surat')->name('modal_surat');
      Route::post('/modal_upload_surat_izin','Owner\PengajuanController@modal_upload_surat_izin')->name('modal_upload_surat_izin');
  });

   Route::group(['prefix'=>'permohonan'],function(){
      Route::get('/','Owner\PermohonanController@index')->name('permohonan');
      Route::post('update','Owner\PermohonanController@update')->name('updatepermohonan');
      Route::post('do_update','Owner\PermohonanController@do_update')->name('doupdatepermohonan');
      Route::post('delete','Owner\PermohonanController@delete')->name('deletepermohonan');
    });

  Route::group(['prefix'=>'data_master'],function(){

   Route::group(['prefix'=>'jenis_file_pendukung'],function(){
      Route::get('/','Owner\JenisFilePendukungController@index')->name('jenis_file_pendukung');
      Route::post('datagridjenisfilependukung','Owner\JenisFilePendukungController@datagridjenisfilependukung')->name('datagridjenisfilependukung');
      Route::post('create','Owner\JenisFilePendukungController@create')->name('createjenisfilependukung');
      Route::post('do_create','Owner\JenisFilePendukungController@do_create')->name('docreatejenisfilependukung');
      Route::post('update','Owner\JenisFilePendukungController@update')->name('updatejenisfilependukung');
      Route::post('do_update','Owner\JenisFilePendukungController@do_update')->name('doupdatejenisfilependukung');
      Route::post('delete','Owner\JenisFilePendukungController@delete')->name('deletejenisfilependukung');
    });

    Route::group(['prefix'=>'lembar_konfirmasi'],function(){
      Route::get('/','Owner\LembarKonfirController@index')->name('lembar_konfirmasi');
      Route::post('datagridlembar_konfir','Owner\LembarKonfirController@datagridlembar_konfir')->name('datagridlembar_konfir');
      Route::post('create','Owner\LembarKonfirController@create')->name('createlembar_konfir');
      Route::post('do_create','Owner\LembarKonfirController@do_create')->name('docreatelembar_konfir');
      Route::post('update','Owner\LembarKonfirController@update')->name('updatelembar_konfir');
      Route::post('do_update','Owner\LembarKonfirController@do_update')->name('doupdatelembar_konfir');
      Route::post('delete','Owner\LembarKonfirController@delete')->name('deletelembar_konfir');
    });

     Route::group(['prefix'=>'jenis_penelitian'],function(){
      Route::get('/','Owner\JenisPenelitianController@index')->name('jenis_penelitian');
      Route::post('datagridjenispenelitian','Owner\JenisPenelitianController@datagridjenispenelitian')->name('datagridjenispenelitian');
      Route::post('create','Owner\JenisPenelitianController@create')->name('createjenispenelitian');
      Route::post('do_create','Owner\JenisPenelitianController@do_create')->name('docreatejenispenelitian');
      Route::post('update','Owner\JenisPenelitianController@update')->name('updatejenispenelitian');
      Route::post('do_update','Owner\JenisPenelitianController@do_update')->name('doupdatejenispenelitian');
      Route::post('delete','Owner\JenisPenelitianController@delete')->name('deletejenispenelitian');
    });

     Route::group(['prefix'=>'tempat_penelitian'],function(){
      Route::get('/','Owner\TempatPenelitianController@index')->name('tempat_penelitian');
      Route::post('datagridtempatpenelitian','Owner\TempatPenelitianController@datagridtempatpenelitian')->name('datagridtempatpenelitian');
      Route::post('create','Owner\TempatPenelitianController@create')->name('createtempatpenelitian');
      Route::post('do_create','Owner\TempatPenelitianController@do_create')->name('docreatetempatpenelitian');
      Route::post('update','Owner\TempatPenelitianController@update')->name('updatetempatpenelitian');
      Route::post('do_update','Owner\TempatPenelitianController@do_update')->name('doupdatetempatpenelitian');
      Route::post('delete','Owner\TempatPenelitianController@delete')->name('deletetempatpenelitian');
    });

    Route::group(['prefix'=>'menu'],function(){
      Route::get('/','Owner\MenuController@main')->name('menu_owner');
      Route::post('form','Owner\MenuController@form')->name('form_menu_owner');
      Route::post('simpan','Owner\MenuController@simpan')->name('simpan_menu_owner');
      Route::get('contact','Owner\MenuController@contact')->name('contact');
      Route::get('announcement','Owner\MenuController@announcement')->name('announcement');
      Route::get('articleinpress','Owner\MenuController@articleinpress')->name('articleinpress');
      Route::post('datagrid','Owner\MenuController@journalDatagrid')->name('datagridjournal');
      Route::post('/detailJournal','Owner\MenuController@detailJournal')->name('detailJournal');
      Route::post('/updateJournal','Owner\MenuController@update_journal')->name('updateJournal');
      Route::post('/doDeleteJournal','Owner\MenuController@doDeleteJournal')->name('doDeleteJournal');
      Route::post('doupdate_bahasa','Owner\MenuController@doupdate_bahasa')->name('doupdate_bahasa');

      Route::get('bahasa','Owner\SubmissionController@index_bahasa')->name('bahasa');
      Route::post('datagridbahasa','Owner\SubmissionController@datagridbahasa')->name('datagridbahasa');
      Route::post('/update_bahasa','Owner\SubmissionController@update_bahasa')->name('update_bahasa');

      Route::post('/doup_bahasa','Owner\SubmissionController@doup_bahasa')->name('doup_bahasa');
      Route::post('/dohapus','Owner\SubmissionController@dohapus')->name('dohapus');
    });
  });
  Route::group(['prefix'=>'data_submission'],function(){
    Route::group(['prefix'=>'menu'],function(){

      Route::get('pending','Owner\SubmissionController@sub_pending')->name('pending');
      Route::post('/reviewJournal','Owner\SubmissionController@reviewJournal')->name('reviewJournal');
      Route::post('/detailAuth','Owner\SubmissionController@detailAuth')->name('detailAuth');
      Route::post('/addReviewer','Owner\SubmissionController@addReviewer')->name('addReviewer');
      Route::post('/detReview','Owner\SubmissionController@detReview')->name('detReview');

      Route::post('datagridreview','Owner\SubmissionController@datagridreview')->name('datagridreview');
      Route::post('datagridrevisi','Owner\SubmissionController@datagridrevisi')->name('datagridrevisi');
      Route::post('datagridpending','Owner\SubmissionController@datagridpending')->name('datagridpending');
      Route::post('datagridpublish','Owner\SubmissionController@datagridpublish')->name('datagridpublish');


      Route::get('review','Owner\SubmissionController@sub_review')->name('review');
      Route::get('revisi','Owner\SubmissionController@sub_revisi')->name('revisi');
      Route::get('accept','Owner\SubmissionController@sub_accept')->name('accept');
      Route::get('publish','Owner\SubmissionController@sub_publish')->name('publish');

//accept details owner submission
      Route::post('datagridaccept','Owner\SubmissionController@datagridaccept')->name('datagridaccept');
      Route::post('view_accept','Owner\SubmissionController@view_accept')->name('view_accept');
      Route::post('detail_accept','Owner\SubmissionController@detail_accept')->name('detail_accept');
      Route::post('detailAccept','Owner\SubmissionController@detailAccept')->name('detailAccept');
      Route::post('delete_accept','Owner\SubmissionController@delete_accept')->name('delete_accept');
      Route::post('publish_accept','Owner\SubmissionController@publish_accept')->name('publish_accept');
// pending details owner submission

      Route::post('/UpdateAccept','Owner\SubmissionController@UpdateAccept')->name('UpdateAccept');
      Route::post('detail_publish','Owner\SubmissionController@detail_publish')->name('detail_publish');
    });
  });

});
