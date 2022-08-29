@props(['garage'])
<div class="card cardi border border-dark" style="width:280px">
    <img class="card-img-top widthrr" src="{{$garage->garage_logo ? asset($garage->garage_logo) : asset('/assets/img/default-garage.png')}}" alt="Card image" style="width:100%">
    <div class="card-body ccenter">
      <h4 class="card-title"> {{$garage->garage_name}}</h4>
      <p class="card-text">{{$garage->title}}</p>
      <a href="/{{$garage->id}}" class="btn btn-light">Open</a>
      @if ($garage->rank <= 2)
      <button  class="btn btn-danger delgarage{{$garage->id}}">delete</button>
      @endif
    </div>
</div>
<script>
 $(document).ready(function () {
    let garageid = {!!json_encode($garage->id,JSON_HEX_TAG)!!};
    $(`.delgarage${garageid}`).click(()=>{
        Swal.fire({
                        title: 'Delete Garage',
                        html: `
                        <form action="/garages/destroy" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-footer margtop15">
                            <input type="text" value="${garageid}" name="garage_id" hidden/>
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
