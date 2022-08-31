@extends('template')
@section('content')
<div class="container-fluid padybot">
    <div class="row mt-4">


      <div class="col">
        {{-- <div class="card" style="max-width: calc(100% - 61px);"> --}}
        <div class="card z-index-2 " >
          <div class="card-header pb-0 ">
              <h6 class="h-inline font "> wearhouses Overview</h6>
              <div class="go-right">
                       <!-- Button trigger modal -->
                <button type="button" class="btn btn-dark add-wearhouse modalshow" id="add-wearhouse" >
                    ADD
                </button>
            </div>
          </div>

          <div class="card-body p-3">
            <div class="chart">
              <!-- chart -->
              <div class="scrolling-wrapper">
                @unless(count($wearhouses) == 0)
                @foreach ( $wearhouses as $wearhouse )
                    @if ($wearhouse->status == 1)
                    <x-wearhouses-card :wearhouse="$wearhouse" />
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
      $(".main-content").css("max-width","calc(100% - 50px)");
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
      $(".exitswal2").click(()=>{
          $('.swal2-container').trigger('click');
      })
      $(".modalshow").click(()=>{
          Swal.fire({
                      title: 'add wearhouse',
                      html: `
                      <form action="/wearhouses" method="POST" enctype="multipart/form-data" class="forum2">
                          @csrf
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="">wearhouse name</span>
                    </div>
                    <input type="text" class="form-control" name="wearhouse_name" required style="height: inherit;">
                  </div>
                  <div class="input-group margtop15">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="">wearhouse title</span>
                    </div>
                    <input type="text" class="form-control" name="wearhouse_title" style="height: inherit;">
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
