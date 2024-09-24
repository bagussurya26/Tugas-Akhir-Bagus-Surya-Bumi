@extends('conquer.conquer')

@section('konten')

<head>
  <style>
    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    td,
    th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even) {
      background-color: #dddddd;
    }

    .button {
      background-color: #000;
      border: none;
      color: white;
      padding: 15px 32px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      cursor: pointer;
    }
  </style>
</head>

<body>

  <div>
    <ul>
      <li>
        <a href="#">Welcome</a>
      </li>
      <li>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="#" onclick="showInfo()">
          <i class="icon-bulb"></a></i>
      </li>
    </ul>
  </div>
  <div id='showinfo'></div>
  @yield('javascript')


  <div>
    <h2>Daftar Kain</h2>
    <a href="#" class="button">Link Button</a>
    <a href="#" class="button">Link Button</a>
    <a href="#" class="button">Link Button</a>
  </div>


  <table>
    <tr>
      <th>Kode Kain</th>
      <th>Jenis Kain</th>
      <th>Warna</th>
      <th>Kategori</th>
      <th>Stok</th>
      <th>Option</th>
      <th>Detail</th>
    </tr>
    <tr>
      <td>CTP6319</td>
      <td>COTT PRINT 40S</td>
      <td>MERAH</td>
      <td>PRINTING</td>
      <td>1200</td>
      <td>
        <a class="btn btn-default" href="#detail_1" data-toggle="modal">Test</a>

        <div class="modal fade" id="detail_1" tabindex="-1" role="basic" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Test</h4>
              </div>
              <div class="modal-body">
                <img src='image/1.png' height='200px' />
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      </td>
      <td>
        <a class='btn btn-xs btn-info' data-toggle='modal' data-target='#myModal' onclick='showProducts(1)'>
          Detail</a>

        <div class="modal fade" id="myModal" tabindex="-1" role="basic" aria-hidden="true">
          <div class="modal-dialog modal-wide">
            <div class="modal-content" id="showproducts">
              <!--loading animated gif can put here-->
            </div>
          </div>
        </div>

      </td>
    </tr>
    <tr>
      <td>CTP6319</td>
      <td>COTT PRINT 40S</td>
      <td>MERAH</td>
      <td>PRINTING</td>
      <td>1200</td>
      <td>
        <a class="btn btn-default" href="#detail_2" data-toggle="modal">Test</a>

        <div class="modal fade" id="detail_2" tabindex="-1" role="basic" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Test</h4>
              </div>
              <div class="modal-body">
                <img src='image/1.png' height='200px' />
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      </td>
    </tr>
    <tr>
      <td>CTP6319</td>
      <td>COTT PRINT 40S</td>
      <td>MERAH</td>
      <td>PRINTING</td>
      <td>1200</td>
      <td>
        <a class="btn btn-default" href="#detail_3" data-toggle="modal">Test</a>

        <div class="modal fade" id="detail_3" tabindex="-1" role="basic" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Test</h4>
              </div>
              <div class="modal-body">
                <img src='image/1.png' height='200px' />
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      </td>
    </tr>
  </table>

</body>
@endsection

@section('javascript')
<script>
  function showProducts(category_id) {
    $.ajax({
      type: 'POST',
      url: '{{route("category.showProducts")}}',
      data: {
        '_token': '<?php echo csrf_token() ?>',
        'category_id': category_id
      },
      success: function(data) {
        $('#showproducts').html(data.msg)
      }
    });
  }

  function showInfo() {
    $.ajax({
      type: 'POST',
      url: '{{ route("products.showInfo") }}',
      data: '_token=<?php echo csrf_token() ?>',
      success: function(data) {
        $('#showinfo').html(data.msg)
      }
    });
  }
</script>
@endsection