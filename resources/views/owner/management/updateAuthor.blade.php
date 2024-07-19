<form method='post' action="{{ route('upAuthor') }}" enctype='multipart/form-data'>
  {{ csrf_field() }}
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <div class="panel panel-primary">
        <div class="panel-heading">
           <a href="{{ route('management_users') }}">
              <i class="fa fa-angle-left"></i> <b>{{$title}}</b>
            </a>           
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <input type="hidden" class="form-control" id="nameAuthor" name="id" value="{{$users_id->users_id}}">
      <div class="col-md-4">
        <label>Username</label>
        <input type="text" class="form-control" id="nameAuthor" name="first_name" value="{{$users_id->username}}" disabled>
      </div>
      <div class="col-md-4">
        <label>Password</label>
        <input type="text" class="form-control" id="password" name="password">
      </div>
      <div class="col-md-4">
        <label>Email</label>
        <input type="text" class="form-control" id="emailAuthor" name="email" value="{{$users_id->email}}" disabled>
      </div>
      <div class="col-md-4">
        <label>Change User</label>
        <select class="form-control col-md-2" id="selectAuthor" name="level">
          <option selected>Choose...</option>
          <option value="1">Admin</option>          
          <option value="2">Reviewer</option>
          <option value="3">Pemohon</option>
        </select>
      </div>
      <div class="col-md-4">
        <label>Nama Lengkap</label>
        <input type="text" class="form-control" id="identifyAuthor" name="identify" value="{{$users_id->first_name}} {{$users_id->middle_name}} {{$users_id->last_name}}" disabled>
      </div>
      <div class="col-md-4">
        <label>Telp</label>
        <input type="text" class="form-control" id="telpAuthor" name="phone" value="{{$users_id->phone}}" disabled>
      </div>
    </div>
    <input type="submit" name="" value="Simpan" class="form-control btn btn-primary" style="margin-top: 20px;">
  </div>
</form>
  