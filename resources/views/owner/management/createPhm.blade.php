<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">Tambahkan Data User</div>
            <div class="panel-body">
                <form class="panel-form" method="POST" enctype="multipart/form-data" action="{{ route('docreatePhm') }}"
                    style="margin-top: 20px;">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Username : </label>
                        <div class="col-sm-8">
                            <input type="text" name="username" class="form-control" class="form-control" required />
                        </div>
                    </div>
                    <div class="form-group row" id="div-no-identitas">
                      <label class="col-sm-4 col-form-label"> No Identitas : </label>
                      <div class="col-sm-8">
                      <input type="text" name="no_identitas" maxlength="18" value="{{old('no_identitas')}}" class="form-control disablecopypaste" required onkeypress="return cekAngka(event)">
                      </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">First Name : </label>
                        <div class="col-sm-8">
                            <input type="text" name="first_name" value="{{ old('first_name') }}" required=""
                                placeholder="First Name" class="form-control disablecopypaste"
                                pattern="[a-zA-Z]*)">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Middle Name : </label>
                        <div class="col-sm-8">
                            <input type="text" name="middle_name" value="{{ old('middle_name') }}"
                                placeholder="Middle Name" class="form-control disablecopypaste"
                                pattern="[a-zA-Z]*">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Last Name : </label>
                        <div class="col-sm-8">
                            <input type="text" name="last_name" value="{{ old('last_name') }}" required=""
                                placeholder="Last Name" class="form-control disablecopypaste"
                                pattern="[a-zA-Z]*">
                        </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label">gender: </label>
                      <div class="col-sm-8">
                        <select class="form-control" name="gender" id="exampleFormControlSelect1" required>
                            <option value="male" @if (old('gener') == 'male') {{ 'selected' }} @endif>
                                Laki-laki</option>
                            <option value="female" @if (old('gener') == 'female') {{ 'selected' }} @endif>
                                Perempuan</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Email : </label>
                        <div class="col-sm-8">
                            <input type="text" name="email" class="form-control" class="form-control" required />
                        </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label">Phone : </label>
                      <div class="col-sm-8">
                      <input type="number" name="phone" value="{{old('phone')}}" placeholder="Phone" class="form-control disablecopypaste" pattern="\d*">
                      </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Password : </label>
                        <div class="col-sm-8">
                            <input type="password" name="password" class="form-control" class="form-control" required />
                        </div>
                    </div>
                    <hr style="border: 1px solid DimGray;">
                    </hr>
                    <button class="btn btn-success btn-submit" type="submit">Simpan</button>
                    <a href="{{ route('management_users') }}" class="btn btn-danger">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="other-page">
</div>
<div class="modal-dialog">
</div>
