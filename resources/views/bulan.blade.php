@extends('app')
@section('content')
<form class=""  method="get" onsubmit="window.open('report')">
  <div class="form-group">
    <label>Bulan</label>
    <select class="form-control" name="bulan">
      <option value="1">Januari</option>
      <option value="2">Februari</option>
      <option value="3">Maret</option>
      <option value="4">April</option>
      <option value="5">Mei</option>
      <option value="6">Juni</option>
      <option value="7">Juli</option>
      <option value="8">Agustus</option>
      <option value="9">September</option>
      <option value="10">Oktober</option>
      <option value="11">November</option>
      <option value="12">Desember</option>
    </select>
  </div>


  <button type="submit" class="btn btn-info pull-right">Report</button>

</form>
@endsection
