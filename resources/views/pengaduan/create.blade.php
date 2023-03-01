@extends('master')

@section('content')
<form action="{{ route('pengaduan.store'  ) }}" method="post" enctype='multipart/form-data'>
  @csrf


  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
        <h1 class="card-title">PENGADUAN MASYARAKAT</h1>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
        <div class="card-body">
            <div class="form-group">
              <label for="Alamat">Isi Laporan</label>
              <textarea 
                class="form-control" 
                name="isi_laporan" rows="5" 
                id="isi_laporan" placeholder="isi_laporan">{{ old('isi_laporan') }}</textarea>
            </div>
            @error('isi_laporan')
              <div class="alert alert-danger" role="alert">{{ $message }}</div>
            @enderror
            <div class="form-group" >
              <label for="formFile" class="form-label">Pilih File</label>
              <input class="form-control" type="file" id="formFile" name="foto">
            </div>
            @error('foto')
              <div class="alert alert-danger" role="alert">{{ $message }}</div>
            @enderror
          </div>
      </div>
      <div class="card-footer">
        <input type="submit" class="btn btn-primary ml-3" value="Submit">
        <a href="/pengaduan" class="btn btn-secondary ml-3" style="float:left;">Back</a>
      </div>
    </div>
  </div>
</form>
  @endsection