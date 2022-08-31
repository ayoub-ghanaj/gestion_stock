@extends('template')
@section('content')

<div class=" position-relative bg-gray-100 max-height-vh-100 h-100">
    <div class="container-fluid padybot">
        <div class="row margtop25">
            <div class="col-2">
                <div class=""> <div class="">company name:</div> </div>
            </div>
            <div class="col">
                <div class="input-group"> <div class="form-control">{{$transaction->company_name}}</div> </div>
            </div>
        </div>
        <div class="row margtop25">
            <div class="col-2">
                <div class=""> <div class="">title:</div> </div>
            </div>
            <div class="col">
                <div class="input-group"> <div class="form-control">{{$transaction->title}}</div> </div>
            </div>
        </div>
        <div class="row margtop25">
            <div class="col-2">
                <div class=""> <div class="">type:</div> </div>
            </div>
            <div class="col">
                <div class="input-group"> <div class="form-control">{{$transaction->type}}</div> </div>
            </div>
        </div>
        <div class="row margtop25">
            <div class="col">
                description :
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="input-group"> <div class="form-control">{{$transaction->description}}</div> </div>
            </div>
        </div>
        <div class="row margtop25">
            <table class="table table-striped">
            <thead>
                <tr class="row">
                    <th class="col">cargo</th>
                    <th class="col">ammount</th>
                    <th class="col">price</th>
                    <th class="col">total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $operations as $operation )
                <tr class="row">
                    <td class="col">{{$operation->cargo_name}}</td>
                    <td class="col">{{$operation->ammount}}</td>
                    <td class="col">{{$operation->cargo_price}}</td>
                    <td class="col">{{$operation->cargo_price * $operation->ammount}}</td>
                </tr>
                @endforeach
                <tr class="row">
                    <td class="col"></td>
                    <td class="col"></td>
                    <td class="col">total :</td>
                    <td class="col">{{$transaction->bill_price}}</td>
                </tr>
            </tbody>
        </div>
        </div>
    </div>
  </div>

  <script>
    var auname = {!! json_encode(Auth::user(), JSON_HEX_TAG) !!};
    var augara = {!! json_encode($wearhouse, JSON_HEX_TAG) !!};
    var widthy = 0;
    </script>
  <script>
    $(document).ready(()=>{

        $(".lif8f9fa").prepend(`
        <li><a class="dropdown-item texcol" href="/${augara.id}/transactions/list"> Show </a></li>
        `)
        $(".lif8f9fa").prepend(`
        <li><a class="dropdown-item texcol" href="/${augara.id}/transactions"> make </a></li>
        `)
        var items = {cargos_list : [] };
        $(".main-content").css("max-width","100%");
        $(".navbar").css("max-width","100%");

        function seek(value) {
        return new Promise((resolve, reject) => {
          $.ajax({
            url: "http://localhost:8000/api/wearhouses",
            type: 'GET',
            data: {
              id: value,
            },
            success: function (data) {
              resolve(data)
            },
            error: function (error) {
              reject(error)
            },
          })
        })
      }
      $(".main-content").css("max-width","calc(100% )");
        $(".navbar").css("max-width","100%");
      seek(auname.id).then((data)=>{
            $('.lily').empty();
            let wearhouses = JSON.parse(data);
            wearhouses = wearhouses.wearhouses;
            for(let i = 0 ; i < wearhouses.length ; i++ ){
                $('.lily').append(`
                    <li><a class="dropdown-item " href="/${wearhouses[i].id}">${wearhouses[i].wearhouse_name}</a></li>
                `);
            }
      })
    })
</script>
@endsection
