@extends('template')
@section('content')
<div class="container-fluid padybot">
    <div class="row">
      <div class="row mt-4">


        <div class="col">
          <div class="card z-index-2">
            <div class="card-header pb-0">
              <h6 class="font">Cargos Overview </h6>
              <div class="go-right">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-dark" id="add-garage">
                ADD
                </button>
              </div>
            </div>
            <div class="card-body p-3">
                <div class="chart">
                  <div class="scrolling-wrapper">
                <!-- chart -->
                @unless(count($cargos) == 0)
                @foreach ( $cargos as $cargo )
                    @if ($cargo->cargo_status == '1')
                    <x-cargo-card :cargo="$cargo" :rank="$link[0]->rank" />
                    @endif
                @endforeach
                @else
                <p>No Cargos found</p>
                @endunless
                </div>
                <!-- scrollable-->
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
                  <h6 class="font">Transactions</h6>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive crotab">
                <table class="table align-items-center mb-0" cellspacing="0">
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
    @if ($link[0]->rank <= 2)
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>Partners table</h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0 crotab">
              <table class="table align-items-center mb-0" cellspacing="0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Author</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Function</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employed</th>
                    <th class="text-secondary opacity-7">                  <!-- Button trigger modal -->
                      <button type="button" class="btn btn-dark addeffect invite" id="add-user" data-bs-toggle="modal" data-bs-target="#adduserModal">
                      ADD
                      </button>
                    </th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ( $links as $lin )
                    <x-admin-editus :data="$lin" :rank="$link[0]->rank"/>
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif
  </div>
    <script>
        var auname = {!! json_encode(Auth::user(), JSON_HEX_TAG) !!};
        var augara = {!! json_encode($garage, JSON_HEX_TAG) !!};
        var widthy = 0;
    </script>
<script>
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
                for(let i = 0 ; i < garages.length ; i++ ){
                    $('.lily').append(`
                        <li><a class="dropdown-item " href="/${garages[i].id}">${garages[i].garage_name}</a></li>
                    `);
                }
        })
        $(".main-content").css("max-width","100%");
        $(".navbar").css("max-width","100%");
        function usersseek(value) {
        return new Promise((resolve, reject) => {
          $.ajax({
            url: "http://localhost:8000/api/users",
            type: 'GET',
            data: {
              name: value,
              garage: augara.id,
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
    $(document).ready(()=>{

        $("#add-garage").click(()=>{
                    Swal.fire({
                        title: 'ADD Cargo',
                        html: `
                        <form action="/garage/add" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="">cargo name</span>
                            </div>
                            <input type="text" class="form-control" name="cargo_name" required style="height: inherit;">
                          </div>
                          <div class="input-group margtop15">
                            <input type="file" class="form-control" placeholder="logo" name="logo" accept=".jpg, .png, .jpeg, .gif">
                            </div>
                            <div class="input-group margtop15">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="">cargo amount</span>
                                </div>
                                <input type="number" class="form-control" name="cargo_count" required style="height: inherit;">
                              </div>
                            <div class="input-group margtop15">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="">cargo price</span>
                                </div>
                                <input type="number" class="form-control" name="cargo_price" required style="height: inherit;">
                                <input type="text" class="form-control" name="garage_id" value="{{$garage->id}}" hidden required >
                              </div>
                              <div class="modal-footer margtop15">
                                  <button type="submit" class="btn btn-dark">Save</button>
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
    $(".invite").click(()=>{
        Swal.fire({
                        title: 'invite user',
                        html: `
                        <form  id="form-add-user" action="/garage/invite" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="">Role</span>
              </div>
              <select type="text" class="form-control" name="rank" required style="height: inherit;">
                <option value="3" selected >User</option>
                <option value="2" >Admin</option>
              </select>
          </div>
          <div class="input-group margtop15">
            <input id="search-input"  type="text" class="form-control user-search" placeholder="Search username" style="height: inherit;">
            <input id="search-input" hidden type="text" class="form-control user-id" name="user_id" value="" >
            <input id="search-input" hidden type="text" class="form-control " name="garage_id" value="{{$garage->id}}">
            <div class="dropdown-menu usersllist userls goup" aria-labelledby="usersdown">
              <!-- search suggestions-->
              </div>
            </label>
          </div>
          <div class="input-group margtop15">
              <div class="input-group-prepend">
                <span class="input-group-text" id="">role</span>
              </div>
              <input type="text" class="form-control" name="role" value="manager" required style="height: inherit;">
          </div>
          <div class="input-group margtop15">
              <div class="input-group-prepend">
                <span class="input-group-text" id="">title</span>
              </div>
              <input type="text" class="form-control" name="title" value="co-owner" required style="height: inherit;">
          </div>
          <div class="modal-footer">
              <button type="submit" class="btn btn-dark">Save</button>
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

      let chosen1name ='';
      let chosen1id ='';
      $(".addeffect").click(()=>{
        $("#form-add-user").submit(()=>{
            if($(".user-id").val() == ''){
                event.preventDefault();
                swal("Enter a valid user",'select a valid user from the suggestions' , "error");
            }
        })
        $(".user-search").keyup(()=>{
          $(".user-id").val('');
          let inputval = $(".user-search").val();
          usersseek(inputval).then((data)=>{
              $(".usersllist").empty();
              let jsn = JSON.parse(data);
              let names = jsn.users;
            // console.log(names);
            for(let i = 0 ; i<names.length ; i++){
              $(".usersllist").append(`
                <div class="dropdown-item userls user${names[i].id} usertxt "value="${names[i].id}"><div class="row"><div class="col"><a class="avatar avatar-xs rounded-circle"><img src="http://localhost:8000/${names[i].image}"></a><label>${names[i].name}</div></div><label></div>
              `);
              $(`.user${names[i].id}`).click(()=>{
                chosen1id = $(`.user${names[i].id}`).attr('value');
                chosen1name = $(`.user${names[i].id} .row label`).text();
                $(".user-search").val(chosen1name);
                $(".user-id").val(chosen1id);
                console.log($(".user-id").val())
                $(".usersllist").hide();
            })
        }
        let name = $(".user-search").val();
            if(name != ''){
              $(".usersllist").show();
            }else{
              $(".usersllist").hide();
            }
          })
        })
      })
    })
  </script>
@endsection
