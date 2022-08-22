@extends('template')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="row mt-4">


        <div class="col">
          <div class="card z-index-2">
            <div class="card-header pb-0">
              <h6>Cargo overview</h6>
              <div class="go-right-2">
                <!-- Button trigger modal -->
    <button type="button" class="btn btn-dark big added" id="add-garage" >
      +
    </button>

<!-- Modal -->

       </div>
       <!---->
       <div class="go-left-2">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-dark big minus" id="take-garage" >
        -
        </button>

<!-- Modal -->
            </div>
            <div class="card-body p-3">
              <div class="chart cargo-chart">
                <div class="card cargo-card">
                  <img  src="{{$cargo[0]->cargo_logo ? asset( $cargo[0]->cargo_logo) : asset('/assets/img/default-garage.png')}}"  alt="">
                  <div class="mato margtop25">{{$cargo[0]->cargo_name}}</div>
                  <div class="input-group mato margtop25">
                    <input type="number"  value="{{$cargo[0]->cargo_count}}" min="0" class="form-control mato numberole" name="" required>
                  </div>
                  <div class="mato margtop25 maxis" max="{{$cargo[0]->cargo_count}}" >{{$cargo[0]->cargo_price}}$</div>
                  <div class="btn btn-dark margtop15 updatecount">update</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row my-4">
        <div class="col">
          <div class="card">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-lg-6 col-7">
                  <h6>Cargos</h6>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive crotab">
                <table class="table align-items-center mb-0 ">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Cargo</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Member</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Count</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ( $operations as $operation )
                        <x-operation-ligne :operation="$operation" />
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <script>
    var auname = {!! json_encode(Auth::user(), JSON_HEX_TAG) !!};
    var widthy = 0;
</script>
  <script>

    $(document).ready(function () {
        function seek(value) {
        return new Promise((resolve, reject) => {
          $.ajax({
            url: "http://localhost:8000/api/garages",
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
      seek(auname.id).then((data)=>{
            $('.lily').empty();
            let garages = JSON.parse(data);
            garages = garages.garages;
            for(let i = 0 ; i < garages.length ; i++ ){
                $('.lily').append(`
                    <li><a class="dropdown-item " href="/${garages[i].id}">${garages[i].garage_name}</a></li>
                `);
            }
      })

        $(".main-content").css("max-width","100%");
        $(".navbar").css("max-width","100%");
        let max =$(".maxis").attr('max');
        var counter ;
        $(".numberole").keyup(function (e) {
            let val = $(".numberole").val();
            if ( parseInt(val) < 0){
                $(".numberole").val(0)
            }else if( `${$(".numberole").val()}`.length == 0){
                $(".numberole").val(0);
            }
            counter = val ;
        });
        $(".numberole").change(function (e) {
            let val = $(".numberole").val();
            if ( parseInt(val) < 0){
                $(".numberole").val(0)
            }else if( `${$(".numberole").val()}`.length == 0){
                $(".numberole").val(0);
            }
            counter = val ;
        });

        $(".minus").click(()=>{
            Swal.fire({
                        title: 'take from cargo',
                        html: `
                        <form   action="/operation" method="POST" enctype="multipart/form-data" class="minuscarg">
                        @csrf
                        <form action="">
                        <div class="input-group margtop15">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id=""> Take Amount</span>
                            </div>
                            <input type="number" class="form-control numberoleminus" value="1" name="ammount" style="height: inherit;" >
                            <input type="text"  class="form-control" name="cargo_id" hidden value="{{$cargo[0]->id}}">
                            <input type="text"  class="form-control" name="type" hidden value="take">
                        </div>
                        <div class="modal-footer margtop15">
                            <button type="submit" class="btn btn-dark">Confirm</button>
                            </div>
                        </form>
                                `,
                        showCancelButton: false,
                        showConfirmButton: false,
                        focusConfirm: false,
                        preConfirm: () => {

                        }

                        });
                        $('.minuscarg').submit(function(e){
                            e.preventDefault();
                            let val = $(".numberoleminus").val();
                            if(parseInt(val) >  parseInt(max) ){
                                $(".numberoleminus").val(max)
                            }else if ( parseInt(val) < 1){
                                $(".numberoleminus").val(1)
                            }else if( `${$(".numberoleminus").val()}`.length == 0){
                                $(".numberoleminus").val(1);
                            }
                            counter = val ;
                            e.currentTarget.submit();
                        });
                        $(".numberoleminus").keyup(()=>{
                            let val = $(".numberoleminus").val();
                            if(parseInt(val) >  parseInt(max) ){
                                $(".numberoleminus").val(max)
                            }else if ( parseInt(val) < 1){
                                $(".numberoleminus").val(1)
                            }else if( `${$(".numberoleminus").val()}`.length == 0){
                                $(".numberoleminus").val(1);
                            }
                            counter = val ;
                        });
                        $(".numberoleminus").change(()=>{
                            let val = $(".numberoleminus").val();
                            if(parseInt(val) >  parseInt(max) ){
                                $(".numberoleminus").val(max)
                            }else if ( parseInt(val) < 1){
                                $(".numberoleminus").val(1)
                            }else if( `${$(".numberoleminus").val()}`.length == 0){
                                $(".numberoleminus").val(1);
                            }
                            counter = val ;
                        });

        })
        $(".added").click(()=>{
            Swal.fire({
                        title: 'add to cargo',
                        html: `
                        <form   action="/operation" method="POST" enctype="multipart/form-data">
                        @csrf
                        <form action="">
                        <div class="input-group margtop15">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id=""> ADD Amount</span>
                            </div>
                            <input type="number" class="form-control numberole" value="1" name="ammount"  style="height: inherit;">
                            <input type="text"  class="form-control" name="cargo_id" hidden value="{{$cargo[0]->id}}">
                            <input type="text"  class="form-control" name="type" hidden value="add">
                        </div>
                        <div class="modal-footer margtop15">
                            <button type="submit" class="btn btn-dark">Confirm</button>
                            </div>
                        </form>
                                `,
                        showCancelButton: false,
                        showConfirmButton: false,
                        focusConfirm: false,
                        preConfirm: () => {

                        }
                        });
        })
        $(".updatecount").click(()=>{
            let val = $(".numberole").val();
            if( parseInt(val) > parseInt(max)){
                let added = parseInt(val) - parseInt(max) ;
                Swal.fire({
                            title: 'add to cargo',
                            html: `
                            <form   action="/operation" method="POST" enctype="multipart/form-data">
                            @csrf
                            <form action="">
                            <div class="input-group margtop15">
                                <div class="input-group-prepend">
                                <span class="input-group-text" id=""> ADD Amount</span>
                                </div>
                                <input type="number" class="form-control numberole" value="${added}" name="ammount"  style="height: inherit;">
                                <input type="text"  class="form-control" name="cargo_id" hidden value="{{$cargo[0]->id}}">
                                <input type="text"  class="form-control" name="type" hidden value="add">
                            </div>
                            <div class="modal-footer margtop15">
                                <button type="submit" class="btn btn-dark">Confirm</button>
                                </div>
                            </form>
                                    `,
                            showCancelButton: false,
                            showConfirmButton: false,
                            focusConfirm: false,
                            preConfirm: () => {

                            }
                            });
            }else if ( parseInt(val) == parseInt(max)){
            }else{
                let minus = parseInt(max)  - parseInt(val) ;
                console.log(minus);
            Swal.fire({
                        title: 'take from cargo',
                        html: `
                        <form  action="/operation" method="POST" enctype="multipart/form-data" class="minuscarg2">
                        @csrf
                        <form action="">
                        <div class="input-group margtop15">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id=""> Take Amount</span>
                            </div>
                            <input type="number" class="form-control numberoleminus2" value="${minus}" name="ammount"  style="height: inherit;">
                            <input type="text"  class="form-control" name="cargo_id" hidden value="{{$cargo[0]->id}}">
                            <input type="text"  class="form-control" name="type" hidden value="take">
                        </div>
                        <div class="modal-footer margtop15">
                            <button type="submit" class="btn btn-dark">Confirm</button>
                            </div>
                        </form>
                                `,
                        showCancelButton: false,
                        showConfirmButton: false,
                        focusConfirm: false,
                        preConfirm: () => {

                        }
                        });
                        $('.minuscarg2').submit(function(e){
                            e.preventDefault();
                            let val = $(".numberoleminus").val();
                            if(parseInt(val) >  parseInt(max) ){
                                $(".numberoleminus").val(max)
                            }else if ( parseInt(val) < 1){
                                $(".numberoleminus").val(1)
                            }else if( `${$(".numberoleminus").val()}`.length == 0){
                                $(".numberoleminus").val(1);
                            }
                            counter = val ;
                            e.currentTarget.submit();
                        });
                        $(".numberoleminus2").keyup(()=>{
                            let val = $(".numberoleminus2").val();
                            if(parseInt(val) >  parseInt(max) ){
                                $(".numberoleminus2").val(max)
                            }else if ( parseInt(val) < 1){
                                $(".numberoleminus2").val(1)
                            }else if( `${$(".numberoleminus2").val()}`.length == 0){
                                $(".numberoleminus2").val(1);
                            }
                            counter = val ;
                        });
                        $(".numberoleminus2").change(()=>{
                            let val = $(".numberoleminus2").val();
                            if(parseInt(val) >  parseInt(max) ){
                                $(".numberoleminus2").val(max)
                            }else if ( parseInt(val) < 1){
                                $(".numberoleminus2").val(1)
                            }else if( `${$(".numberoleminus2").val()}`.length == 0){
                                $(".numberoleminus2").val(1);
                            }
                            counter = val ;
                        });
            }
        })
    });
  </script>
@endsection
