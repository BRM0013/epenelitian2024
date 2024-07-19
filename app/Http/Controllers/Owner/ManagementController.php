<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Libraries\MenuOwner;
use App\Http\Models\Identitas;
use App\Http\Models\Management_user;
use App\Http\Models\Users;
use App\Http\Model\Submission;
use App\Profile;
use App\User;
use App\Tempat_Penelitian;
use Auth;
use Session;
use Redirect;
use Validator;
use Hash;

class ManagementController extends Controller
{
    function main(){
        $menu = MenuOwner::menuActive('mn_management');
        $data = [
          'identitas'=>Management_user::find(1),
          'title'=>'Management User',
          'nama_pkm' => User::join('tempat_penelitian','tempat_penelitian.id_tempat_penelitian','=', 'users.tempat_penelitian_id')
                        ->where('users.id',Auth::User()->id)->first(),
          'nama_user' => User::where('users.id',Auth::User()->id)->first(),

        ];
        $data = array_merge($data,$menu);
        return view('owner.management.main',$data);
      }

      public function datagridpemohon(Request $request)
      {
          $data = Management_user::getJsonPemohon($request);
          return response()->json($data);
      }

      public function datagridtempat_penelitian(Request $request)
      {
          $data = Management_user::getJsonTempatPenelitian($request);
          return response()->json($data);
      }

      public function detailBerita(Request $request)
      {
        $menu = MenuOwner::menuActive('mn_management');
        $berita = Management_user::where("users_id",$request->id)->first();
            $data['users_id'] = $berita;
            $data['title'] = 'Kembali';
            $data = array_merge($data,$menu);
            $content = view('owner.management.detail',$data)->render();
            return ['status'=>'success','content'=>$content];
      }

      public function doUpdateBerita(Request $request)
      {
        $menu = MenuOwner::menuActive('mn_management');
        $berita = Management_user::where("users_id",$request->id)->first();
        $data['users_id'] = $berita;
        $berita->first_name;
        $berita->email;
        $berita->id_orcid;
        $berita->telp;
        $berita->interest;
      }

      public function modalGambar(Request $request)
      {
        $menu = MenuOwner::menuActive('mn_management');
        $berita = Management_user::where("users_id",$request->id)->first();
            $data['users_id'] = $berita;
            $data['title'] = 'Edit Pemohon';
            $data = array_merge($data,$menu);
            $image = $request->image;
            $content = view('owner.management.modalGambar',$data)->render();
            return ['status'=>'success','content'=>$content];
      }

      public function updateUser(Request $request)
      {
        $menu = MenuOwner::menuActive('mn_management');
        $berita = Management_user::where("users_id",$request->id)->first();
            $data['users_id'] = $berita;
            $data['title'] = 'Kembali';
            $data = array_merge($data,$menu);
            $content = view('owner.management.updateAuthor',$data)->render();
            return ['status'=>'success','content'=>$content];
      }

      public function doDeleteAuthor(Request $request)
      {
        $delProfil = Management_user::where("users_id",$request->id)->first();

            if(!empty($delProfil)){
                $delProfil->delete();
                $delUser = User::where('id',$delProfil->users_id)->first();
                $delUser->delete();
                return ['status' => 'success'];
            }else{
                return ['status'=>'error'];
            }   
      }

      public function upAuthor(Request $request){
          $level = $request->level;
          $password = $request->password;
          $users_id = Users::where("id",$request->id)->first();
          
          $users_id->level = $level;
          $users_id->password = Hash::make ($password);
          $users_id->save();  
          if($users_id){
            $title = 'Success';
            $message = 'Berhasil disimpan';
            $type = 'success';
          }else{
            $title = 'Whooops';
            $message = 'Gagal disimpan';
            $type = 'error';
          }
          Session::flash('title',$title);
          Session::flash('message',$message);
          Session::flash('type',$type);
          return Redirect::to('owner/identitas/management_users');
        }

      //UNTUK USER PKM

      public function detailPkm(Request $request)
      {
        // return $request->all();
        $menu = MenuOwner::menuActive('mn_management');
        $berita = User::join('tempat_penelitian','users.tempat_penelitian_id', '=', 'tempat_penelitian.id_tempat_penelitian')
                        ->where("id",$request->id)->first();

        $data['users'] = $berita;
        $data['title'] = 'Kembali';
        // return $data;

        $data = array_merge($data,$menu);
        $content = view('owner.management.detailPkm',$data)->render();
        return ['status'=>'success','content'=>$content];
      }

       public function doDeletePkm(Request $request)
      {
        $delProfil = User::where("id",$request->id)->first();

            if(!empty($delProfil)){
                $delProfil->delete();                
                return ['status' => 'success'];
            }else{
                return ['status'=>'error'];
            }   
      }

      public function addUserPkm(Request $request)
      {
          $menu = MenuOwner::menuActive('mn_management');
          $tempat = Tempat_Penelitian::all();

          $data = [
            'title'=>'Tambah Data User',
            'tempat_penelitian' => $tempat,
          ];
          $data = array_merge($data,$menu);

            $content = view('owner.management.createPkm',$data)->render();
            return ['status'=>'success','content'=>$content];

      } 

      public function addUserPhm(Request $request)
      {
          $menu = MenuOwner::menuActive('mn_management');
          $berita = Management_user::where("users_id",$request->id)->first();

          $data = [
            'title'=>'Tambah Data User Pemohon',
            
          ];
          $data = array_merge($data,$menu);

            $content = view('owner.management.createPhm',$data)->render();
            return ['status'=>'success','content'=>$content];

      } 

       public function docreatePkm(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'tempat_penelitian_id' => 'required',
        ]);

        $tempatpe = new User;
        $tempatpe->username = $request->username;
        $tempatpe->email = $request->email;
        $tempatpe->password  = Hash::make($request->password);
        $tempatpe->level = 6;
        $tempatpe->tempat_penelitian_id = $request->tempat_penelitian_id;
        $tempatpe->is_banned = 0;
      
        $tempatpe->save(); 

          if($tempatpe){
            $title = 'Success';
            $message = 'Berhasil disimpan';
            $type = 'success';
          }else{
            $title = 'Whooops';
            $message = 'Gagal disimpan';
            $type = 'error';
          }

      Session::flash('title',$title);
      Session::flash('message',$message);
      Session::flash('type',$type);
      return Redirect::route('management_users');
             
    }
    public function docreatePhm(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'no_identitas' => 'required',
        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator->errors());
        }
    
        // Create the User
        $user = new User;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->level = 3;
        $user->is_banned = 0;
        $user->save();
    
        if ($user) {
            // Create the Pr
            $profile = new Profile;
            $profile->username = $request->username;
            $profile->email = $request->email;
            $profile->users_id = $user->id;
            $profile->first_name= $request->first_name;
            $profile->middle_name= $request->middle_name;
            $profile->last_name= $request->last_name;
            $profile->gender= $request->gender;
            $profile->last_name= $request->phone;
            $profile->no_identitas= $request->no_identitas;
            $profile->phone= $request->phone;
            $profile->password = Hash::make($request->password);
            $profile->save();
    
            // Check if profile creation is successful
            if ($profile) {
                Session::flash('title', 'Success');
                Session::flash('message', 'Berhasil disimpan');
                Session::flash('type', 'success');
            } else {
                Session::flash('title', 'Whooops');
                Session::flash('message', 'Gagal menyimpan profil');
                Session::flash('type', 'error');
            }
        } else {
            Session::flash('title', 'Whooops');
            Session::flash('message', 'Gagal menyimpan pengguna');
            Session::flash('type', 'error');
        }
    
        return Redirect::route('management_users');
    }
    

    public function updatePkm(Request $request)
      {
        $menu = MenuOwner::menuActive('mn_management');
        $berita = User::join('tempat_penelitian','tempat_penelitian.id_tempat_penelitian', '=', 'users.tempat_penelitian_id')
                      ->where("id",$request->id)->first();

        $data = [
          'users' => $berita,
          'title' => 'Kembali',
          'tempat_penelitian' => Tempat_Penelitian::join('users','users.tempat_penelitian_id', '=', 'tempat_penelitian.id_tempat_penelitian')->get(),
        ];

        // return $data;

        $data = array_merge($data,$menu);
        $content = view('owner.management.updatePkm',$data)->render();
        return ['status'=>'success','content'=>$content];
      }

       public function storeUpdatePkm(Request $request){

        // return $request->all();
          $store = Users::where("id",$request->id)->first();
        
          $store->username    = $request->username;
          $store->password    = Hash::make($request->username);
          $store->email       = $request->email;
          $store->tempat_penelitian_id = $request->tempat_penelitian_id;

          $store->save();  
          if($store){
            $title = 'Success';
            $message = 'Berhasil disimpan';
            $type = 'success';
          }else{
            $title = 'Whooops';
            $message = 'Gagal disimpan';
            $type = 'error';
          }

          Session::flash('title',$title);
          Session::flash('message',$message);
          Session::flash('type',$type);
          return Redirect::to('owner/identitas/management_users');
        }

}