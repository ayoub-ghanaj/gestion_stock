@props(['cargo','rank'])
<div class="card cardi border border-dark margtop15 paddy" style="width:280px ; border: none !important;box-shadow: 0px 0px 2px 0px #0000007d;">
    <img class="card-img-top widthrr" src="{{$cargo->cargo_logo ? asset( $cargo->cargo_logo) : asset('/assets/img/default-wearhouse.png')}}" alt="Card image" style=" width:100%">
    <div class="card-body ccenter">
      <h4 class="card-title">{{$cargo->cargo_name}}</h4>
      <p class="card-text">{{$cargo->cargo_count}}</p>
      <a href="/cargo/{{$cargo->id}}" class="btn btn-light">Open</a>
      @if ($rank <= 2)
      <button  class="btn btn-danger delcargo{{$cargo->id}}">Delete</button>
      @endif
    </div>
</div>
<script>
    $(document).ready(function () {
       let cargoid = {!!json_encode($cargo->id,JSON_HEX_TAG)!!};
       $(`.delcargo${cargoid}`).click(()=>{
           Swal.fire({
                title: 'Delete Cargo',
                html: `
                <form action="/cargo/destroy" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-footer margtop15">
                    <input type="text" value="${cargoid}" name="cargo_id" hidden/>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
                </form>
                        `,
                icon: 'warning',
                showCancelButton: false,
                showConfirmButton: false,
                focusConfirm: false,
                preConfirm: () => {

                }
                });
       });
    });
   </script>
