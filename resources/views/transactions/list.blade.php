@extends('template')
@section('content')

<div class=" position-relative bg-gray-100 max-height-vh-100 h-100">
    <div class="container-fluid padybot">
        <div class="row margtop25">
            <div class="col">
                company
            </div>
            <div class="col">
                title
            </div>
            <div class="col">
                description
            </div>
            <div class="col">
                price
            </div>
            <div class="col">
                user
            </div>
            <div class="col">
                show
            </div>
        </div>
        @foreach ( $bills as $bill )
        <div class="row margtop25">
            <div class="col">
                {{$bill->company_name}}
            </div>
            <div class="col">
                {{$bill->title}}
            </div>
            <div class="col">
                {{$bill->description}}
            </div>
            <div class="col">
                {{$bill->bill_price}}
            </div>
            <div class="col">
                {{$bill->name}}
            </div>
            <div class="col">
                <a href="/transaction/{{$bill->id}}" class=" btn btn-dark"> show </a>
            </div>
        </div>
        @endforeach
    </div>
  </div>

  <script>
    var auname = {!! json_encode(Auth::user(), JSON_HEX_TAG) !!};
    var augara = {!! json_encode($wearhouse, JSON_HEX_TAG) !!};
    var widthy = 0;
    </script>
  <script>
    $(document).ready(()=>{
        var items = {cargos_list : [] };
        $(".main-content").css("max-width","100%");
        $(".navbar").css("max-width","100%");
        $(".lif8f9fa").prepend(`
        <li><a class="dropdown-item texcol" href="/${augara.id}/transactions"> make </a></li>
        `)

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
