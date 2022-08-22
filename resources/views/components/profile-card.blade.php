@props(['garage'])
<div class="col-xl-3 col-md-6 mb-xl-0 mb-4 paddy">
    <div class="card card-blog card-plain">
    <div class="position-relative">
        <a class="d-block shadow-xl border-radius-xl txtalic">
        <img src="{{$garage->garage_logo ? asset( $garage->garage_logo) : asset('/assets/img/default-garage.png')}}" alt="" class="img-fluid shadow border-radius-lg" style="width:  300px;height: 300px;">
        </a>
    </div>
    <div class="card-body px-1 pb-0">
        <p class="text-gradient text-dark mb-2 text-sm">{{$garage->name}}</p>
        <a href="">
        <h5>
            {{$garage->garage_name}}
        </h5>
        </a>
        <p class="mb-4 text-sm">
            {{$garage->title}}
        </p>
        <div class="d-flex align-items-center justify-content-between">
            <a href="/{{$garage->id}}">
                <button type="button" class="btn btn-outline-primary btn-sm mb-0 mato">Open Garage</button>
            </a>
            @if ($garage->rank <= 2)
            <button type="button" class="btn btn-danger btn-outline-primary btn-sm mb-0 mato delgarage{{$garage->id}}" >Delete Garage</button>
            @endif
        </div>
    </div>
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
