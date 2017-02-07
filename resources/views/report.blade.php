<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <style type="text/css">
    html{
      font-family: sans-serif;
    }
    table {
      border-collapse: collapse;
      border-spacing: 0;
    }

    th{
      background-color: #448aff;
      color: #fff;
    }

    td,
    th {
      padding: 0;
    }
    table, th, td {
      border: 1px solid #212121;
    }

    table {
      width: 100%;
      display: table;
    }

    table.bordered > thead > tr,
    table.bordered > tbody > tr {
      border-bottom: 1px solid #d0d0d0;
    }

    table.striped > tbody > tr:nth-child(odd) {
      background-color: #f2f2f2;
    }

    table.striped > tbody > tr > td {
      border-radius: 0;
    }

    table.highlight > tbody > tr {
      transition: background-color .25s ease;
    }

    table.highlight > tbody > tr:hover {
      background-color: #f2f2f2;
    }

    table.centered thead tr th, table.centered tbody tr td {
      text-align: center;
    }

    thead {
      border-bottom: 1px solid #212121;
    }

    td, th {
      padding: 15px 5px;
      display: table-cell;
      text-align: left;
      vertical-align: middle;
      border-radius: 2px;
    }
    .center{
      text-align:center
    }
    </style>
  </head>
  <body>
    <table style="text-align:center!important">
    <thead>
    <tr>
      <th>No</th>
      <th>Nama Pemesan</th>
      <th>Nomor Telepon</th>
      <th>Nomor Pemesanan</th>
      <th>Status</th>
    </tr>
    </thead>
    <tbody>
    <?php $i = 1; ?>
    @foreach($pemesanan as $pesanan)
        <tr>
          <td><?php echo $i; $i++; ?></td>
          <td>
              {{$pesanan->nama}}
          </td>
          <td>{{$pesanan->telepon}}</td>
          <td>{{$pesanan->no_pesanan}}</td>
          <td>
          @if($pesanan->status=='pending')
          PENDING
          @else
          @if($pesanan->status=='DITOLAK')
          DITOLAK
          @elseif($pesanan->status=='DITERIMA')
          DITERIMA
          @endif
          @endif
          </td>
        </tr>
    @endforeach
    </tbody>
  </table>
  </body>
</html>
