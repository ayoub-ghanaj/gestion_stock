@props(['data','rank'])
<tr>
    <td>
      <div class="d-flex px-2 py-1">
        <div>
          <img src="{{$data->image ? asset( $data->image) : asset('/assets/img/default-wearhouse.png')}}" class="avatar avatar-sm me-3" alt="{{$data->name}}">
        </div>
        <div class="d-flex flex-column justify-content-center">
          <h6 class="mb-0 text-sm">{{$data->name}}</h6>
          <p class="text-xs text-secondary mb-0">{{$data->email}}</p>
        </div>
      </div>
    </td>
    <td>
      <p class="text-xs font-weight-bold mb-0">{{$data->role}}</p>
      <p class="text-xs text-secondary mb-0">{{$data->title}}</p>
    </td>
    <td class="align-middle text-center text-sm">
        @if($data->rank == 1)
        <span class="badge badge-sm bg-gradient-success">Creator</span>
        @elseif($data->rank <= 2)
        <span class="badge badge-sm bg-gradient-success">Admin</span>
        @else
        <span class="badge badge-sm bg-gradient-success">User</span>
        @endif
    </td>
    <td class="align-middle text-center">
      <span class="text-secondary text-xs font-weight-bold">{{$data->created_at}}</span>
    </td>
    <td class="align-middle">
        @if ($rank < $data->rank )
        <!-- trigger modal-->
        <div class="row">
            <div class="col">
            <button class="btn btn-dark text-secondary font-weight-bold text-m edlist{{$data->id}}">
                Edit
            </button>
            <form action="/wearhouse/lindelete" method="POST" enctype="multipart/form-data" style="display: inline">
                @csrf
                <button type="submit" class="btn btn-dark text-secondary font-weight-bold text-m list{{$data->id}} " id="list" style="cursor: pointer;"> Delete </button>
                <input type="text" name="link_id" hidden value="{{$data->id}}">
            </form>
        </div>
        </div>
        <script>
            $(document).ready(function () {
                let linkk = {!!json_encode($data,JSON_HEX_TAG)!!};
                let rank = {!!json_encode($rank,JSON_HEX_TAG)!!};
                $(`.edlist${linkk.id}`).click(function (e) {
                    Swal.fire({
                        title: 'Edite user',
                        html: `
                        <form action="/wearhouse/linupdate" method="POST" enctype="multipart/form-data">
                                @csrf
                                @php
                                $darank = "`+rank+`";
                                $link_rank = "`+linkk.rank+`";
                                @endphp
                            <div class="input-group margtop15">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="">user name </span>
                                </div>
                                <input type="text" class="form-control" disabled name="name" value="${linkk.name}" style="height: inherit;">
                            </div>
                            <div class="input-group margtop15">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="">user role</span>
                                </div>
                                    <input type="text" class="form-control" name="link_id" hidden value="${linkk.id}">
                                    <input type="text" class="form-control" name="role"   value="${linkk.role}" required style="height: inherit;">
                                </div>
                            <div class="input-group margtop15">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="">user title</span>
                                </div>
                                <input type="text" class="form-control" name="title" value="${linkk.title}" required style="height: inherit;">
                            </div>
                            <div class="input-group margtop15">
                                <select class="form-control" name="rank" style="height: inherit;">
                                    <option value="2" selected>admin</option>
                                    <option value="3" >user</option>
                                </select>
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

                });
            });
        </script>
        @endif
    </td>
  </tr>
