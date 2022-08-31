@props(['wearhouse'])
<div class="col-xl-3 col-md-6 mb-xl-0 mb-4 paddy">
    <div class="card card-blog card-plain">
    <div class="position-relative">
        <a class="d-block shadow-xl border-radius-xl txtalic">
        <img src="{{$wearhouse->wearhouse_logo ? asset( $wearhouse->wearhouse_logo) : asset('/assets/img/default-wearhouse.png')}}" alt="" class="img-fluid shadow border-radius-lg" style="width:  300px;height: 300px;">
        </a>
    </div>
    <div class="card-body px-1 pb-0">
        <p class="text-gradient text-dark mb-2 text-sm">{{$wearhouse->name}}</p>
        <a href="">
        <h5>
            {{$wearhouse->wearhouse_name}}
        </h5>
        </a>
        <p class="mb-4 text-sm">
            {{$wearhouse->title}}
        </p>
        <div class="d-flex align-items-center justify-content-between">
            <a href="/{{$wearhouse->id}}">
                <button type="button" class="btn btn-outline-primary btn-sm mb-0 mato">Open wearhouse</button>
            </a>
            @if ($wearhouse->rank <= 2)
            <button type="button" class="btn btn-danger btn-outline-primary btn-sm mb-0 mato delwearhouse{{$wearhouse->id}}" >Delete wearhouse</button>
            @endif
        </div>
    </div>
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
