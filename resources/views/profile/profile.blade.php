@extends('template')
@section('content')
<div class=" position-relative bg-gray-100 max-height-vh-100 h-100">
    <div class="container-fluid">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>
      </div>
      <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
        <div class="row gx-4">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative pfp">
              <img src="{{$logo ? asset( $logo) : asset('/assets/img/user.png')}}" alt="profile_image" class="w-100 border-radius-lg shadow-sm pfp">
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                {{$user_name}}
              </h5>
            </div>
          </div>
          <div class="col-auto my-auto tkall">
            <div class="go-right">
              <form action="/logout" method="post">
                @csrf
                <input type="submit" class="btn btn-danger" value="Logout">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid padybot">
      <div class="row">
        <div class="col-12 mt-4">
          <div class="card mb-4">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-1">Garages</h6>
            </div>
            <div class="card-body p-3">
              <div class="row">
                @unless(count($garages) == 0)
                    @foreach ( $garages as $garage )
                        @if ($garage->status == 1)
                        <x-profile-card :garage="$garage" />
                        @endif
                    @endforeach
                @else
                <p>No Garages found</p>
                @endunless

                <div class="col-xl-3 col-md-6 mb-xl-0 mb-4 modalshow">
                  <div class="card h-100 card-plain border">
                    <div class="card-body d-flex flex-column justify-content-center text-center">
                      <a >
                        <i class="fa fa-plus text-secondary mb-3"></i>
                        <h5 class=" text-secondary"> New Garage </h5>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer pt-3  ">
      </footer>
    </div>
  </div>
  <script>
    var auname = {!! json_encode(Auth::user(), JSON_HEX_TAG) !!};
    var widthy = 0;
    </script>
  <script>
    $(document).ready(function () {
        $(".main-content").css("max-width","100%");
        $(".navbar").css("max-width","100%");
        function seekga(value) {
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
        seekga(auname.id).then((data)=>{
                $('.lily').empty();
                let garages = JSON.parse(data);
                garages = garages.garages;
                console.log(garages);
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
                        <form action="/garages" method="POST" enctype="multipart/form-data">
                            @csrf
                  <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="">Garage name</span>
                      </div>
                      <input type="text" class="form-control" name="garage_name" style="height: inherit;" required>
                    </div>
                    <div class="input-group margtop15">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="">Garage title</span>
                      </div>
                      <input type="text" class="form-control" name="garage_title" style="height: inherit;">
                    </div>
                    <div class="input-group margtop15">
                      <input type="file" class="form-control" name="logo"  accept=".jpg, .png, .jpeg, .gif">
                    </div>
                  <div class="modal-footer">
                    <input type="submit" class="btn btn-dark margtop25" value="ADD">
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
        $(".pfp").click(()=>{
            Swal.fire({
                        title: 'change profile picture',
                        html: `
                        <form action="/profile" method="POST" enctype="multipart/form-data">
                            @csrf
                    <div class="input-group">
                      <input type="file" class="form-control" name="logo"  accept=".jpg, .png, .jpeg, .gif">
                    </div>
                  <div class="modal-footer">
                    <input type="submit" class="btn btn-dark margtop25" value="Confirm">
                    </div>
                  </form>
                                `,
                        showCancelButton: false,
                        showConfirmButton: false,
                        focusConfirm: false,
                        preConfirm: () => {}
                    })
        })
    });
  </script>
@endsection