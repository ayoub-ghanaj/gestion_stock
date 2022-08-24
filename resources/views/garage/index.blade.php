@extends('template')
@section('content')
<div class="container-fluid padybot">
    <div class="row mt-4">


      <div class="col">
        {{-- <div class="card" style="max-width: calc(100% - 61px);"> --}}
        <div class="card z-index-2 " >
          <div class="card-header pb-0 ">
              <h6 class="h-inline font "> GARAGES Overview</h6>
              <div class="go-right">
                       <!-- Button trigger modal -->
                <button type="button" class="btn btn-dark add-garage modalshow" id="add-garage" >
                    ADD
                </button>
            </div>
          </div>

          <div class="card-body p-3">
            <div class="chart">
              <!-- chart -->
              <div class="scrolling-wrapper">
                @unless(count($garages) == 0)
                @foreach ( $garages as $garage )
                    @if ($garage->status == 1)
                    <x-garages-card :garage="$garage" />
                    @endif
                @endforeach
                @else
                <p>No Cargo found</p>
                @endunless
              </div>
              <!-- scrollable-->
            </div>
          </div>
          </div>
        {{-- </div> --}}
      {{-- </div> --}}
    </div>
  </div>
</div>
<script>
    var auname = {!! json_encode(Auth::user(), JSON_HEX_TAG) !!};
    var widthy = 50;
</script>
<script>
  $(document).ready(function() {
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
      $(".main-content").css("max-width","calc(100% - 50px)");
        $(".navbar").css("max-width","100%");
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
      $(".exitswal2").click(()=>{
          $('.swal2-container').trigger('click');
      })
      $(".modalshow").click(()=>{
          Swal.fire({
                      title: 'add garage',
                      html: `
                      <form action="/garages" method="POST" enctype="multipart/form-data" class="forum2">
                          @csrf
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="">Garage name</span>
                    </div>
                    <input type="text" class="form-control" name="garage_name" required style="height: inherit;">
                  </div>
                  <div class="input-group margtop15">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="">Garage title</span>
                    </div>
                    <input type="text" class="form-control" name="garage_title" style="height: inherit;">
                  </div>
                  <div class="input-group margtop15">
                    <input type="file" class="form-control" name="logo"  accept=".jpg, .png, .jpeg, .gif" style="height: inherit;">
                  </div>
                <div class="modal-footer">
                  <input type="submit" class="btn btn-dark margtop25 submiti1" value="ADD">
                  </div>
                </form>
                              `,
                      showCancelButton: false,
                      showConfirmButton: false,
                      focusConfirm: false,
                      preConfirm: () => {

                      }
                      });
                        $(".submiti1").click(function() {
                            $(this).attr('disabled','disabled');
                            $(".forum2").submit();
                        });
                  })
      $(".pfp").click(()=>{
          Swal.fire({
                      title: 'change profile picture',
                      html: `
                      <form action="/profile" method="POST" enctype="multipart/form-data" class="forum1">
                          @csrf
                  <div class="input-group">
                    <input type="file" class="form-control" name="logo"  accept=".jpg, .png, .jpeg, .gif">
                  </div>
                <div class="modal-footer">
                  <input type="submit" class="btn btn-dark margtop25 submiti2" value="Confirm">
                  </div>
                </form>
                              `,
                      showCancelButton: false,
                      showConfirmButton: false,
                      focusConfirm: false,
                      preConfirm: () => {}
                  });
                  $(".submiti2").click(function() {
                            $(this).attr('disabled','disabled');
                            $(".forum1").submit();
                        });
      })
  });
</script>
@endsection
