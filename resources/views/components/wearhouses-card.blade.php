@props(['wearhouse'])
<div class="card cardi border border-dark" style="width:280px">
    <img class="card-img-top widthrr" src="{{$wearhouse->wearhouse_logo ? asset($wearhouse->wearhouse_logo) : asset('/assets/img/default-wearhouse.png')}}" alt="Card image" style="width:100%">
    <div class="card-body ccenter">
      <h4 class="card-title"> {{$wearhouse->wearhouse_name}}</h4>
      <p class="card-text">{{$wearhouse->title}}</p>
      <a href="/{{$wearhouse->id}}" class="btn btn-light">Open</a>
      @if ($wearhouse->rank <= 2)
      <button  class="btn btn-danger delwearhouse{{$wearhouse->id}}">delete</button>
      @endif
    </div>
</div>
<script>
 $(document).ready(function () {
    let wearhouseid = {!!json_encode($wearhouse->id,JSON_HEX_TAG)!!};
    $(`.delwearhouse${wearhouseid}`).click(()=>{
        Swal.fire({
                        title: 'Delete wearhouse',
                        html: `
                        <form action="/wearhouses/destroy" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-footer margtop15">
                            <input type="text" value="${wearhouseid}" name="wearhouse_id" hidden/>
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
