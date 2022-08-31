@extends('template')
@section('content')

<div class=" position-relative bg-gray-100 max-height-vh-100 h-100">
    <div class="container-fluid padybot">
        <form action="/{{$wearhouse->id}}/transaction"  enctype="multipart/form-data" method="POST" class="send">
            @csrf
        <div class="row margtop25">
            <div class="col">
                    <div class="input-group">
                        <span class="input-group" id=""> Transaction :</span>
                    </div>
            </div>
          </div>
      <div class="row ">
        <div class="col">
            <div class="input-group">
                <input type="text" class="form-control" name="company_name" style="height: inherit;" placeholder="Company name" required>
            </div>
        </div>
        <div class="col">
            <div class="input-group">
                <input type="text" class="form-control" name="title" style="height: inherit;" placeholder="Title" required>
            </div>
        </div>
      </div>
      <div class="row margtop25">
        <div class="col">
                <div class="input-group">
                    <span class="input-group" id=""> Description :</span>
                </div>
        </div>
      </div>
      <div class="row ">
        <div class="col">
            <div class="input-group">
                <textarea  class="form-control" name="description" style="height: inherit;" placeholder="Description" value="" required> </textarea>
            </div>
        </div>
      </div>
      <div class="row margtop25">
        <div class="col">
                <div class="input-group">
                    <span class="input-group" id=""> Transaction type :</span>
                </div>
        </div>
      </div>
      <div class="row ">
        <div class="col">
            <div class="input-group">
                <select  class="form-control opt_type"  name="opt_type" style="height: inherit;" >
                    <option value="2"> TAKE </option>
                    <option value="1"> ADD </option>
                </select>
            </div>
        </div>
      </div>
      <div class="row margtop25">
        <div class="col">
                <div class="input-group">
                    <span class="input-group" id=""> Cargos :</span>
                </div>
        </div>
      </div>
      <div class="row ">
        <div class="col">
            <div class="input-group">
                <select  class="form-control cargo_list"  style="height: inherit; " >
                <!-- cargos list-->
                </select>
            </div>
        </div>
        <div class="col">
            <div class="input-group">
                <a class=" btn btn-dark addcargo"  style="height: inherit; width: 100%" > ADD </a>
            </div>
        </div>
      </div>

      <div class="cargos">
        {{-- <div class="row margtop25">
            <div class="col">
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id=""> cargo</span>
                    </div>
                    <input type="number" class="form-control"  value="1" min="1" style="height: inherit;" required>
                </div>
            </div>
            <div class="col">
                <div class="input-group">
                    <input type="button" class="form-control btn btn-danger"  value="remove" style="height: inherit;" >
                </div>
            </div>
        </div> --}}
      </div>

    <div class="row margtop25">
        <div class="col">
            <div class="input-group">
                <input type="submit" class="form-control btn btn-dark sub"  value="Confirm"  style="height: inherit;" >
            </div>
        </div>
    </div>
    <input type="text" class="form-control" name="user_id" value="{{$user->id}}"  hidden style="height: inherit;" required>
    <input type="text" class="form-control" name="wearhouse_id" value="{{$wearhouse->id}}" hidden style="height: inherit;" required>
    <input type="text" class="form-control price" name="bill_price" value="{{$wearhouse->id}}" hidden style="height: inherit;" required>
    <input type="text" class="form-control data_jsn" name="ops_list" value="" hidden style="height: inherit;" required>
        </form>
    </div>
  </div>

  <script>
    var auname = {!! json_encode(Auth::user(), JSON_HEX_TAG) !!};
    var widthy = 0;
    var augara = {!! json_encode($wearhouse, JSON_HEX_TAG) !!};
    var cargos = {!! json_encode($cargos, JSON_HEX_TAG) !!};
    </script>
  <script>
    $(document).ready(()=>{
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
      $(".main-content").css("max-width","calc(100% )");
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

        $(".lif8f9fa").prepend(`
        <li><a class="dropdown-item texcol" href="/${augara.id}/transactions/list"> Show </a></li>
        `)
        var items = {cargos_list : [] };
        $(".main-content").css("max-width","100%");
        $(".navbar").css("max-width","100%");
        for(let i = 0 ; i < cargos.length ; i++){
            $(".cargo_list").append(`
            <option class="cargoclss${i}" value="${i}"> ${cargos[i].cargo_name} </option>
            `);
            items.cargos_list.push({ id : cargos[i].id , ammount : 0})
        }
        $(".data_jsn").val(JSON.stringify(items));
        $(".addcargo").click(()=>{
            let id = $(".cargo_list").val();
            if(id != null){
            $(".cargos").append(`
            <div class="cargo${id}">
                <div class="row margtop25">
                    <div class="col">
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id=""> ${cargos[id].cargo_name}</span>
                            </div>
                            <input type="number" class="form-control item${id}"  value="1" min="1" style="height: inherit;" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group">
                            <input type="button" class=" btn btn-danger remove${id}"  value="remove" style="height: inherit;  width: 100%" >
                        </div>
                    </div>
                </div>
            </div>
            `);
            $(`.cargoclss${id}`).remove();

            $(`.remove${id}`).click(()=>{
                $(".cargo_list").append(`
                    <option class="cargoclss${id}" value="${id}"> ${cargos[id].cargo_name} </option>
            `);
            items.cargos_list[id].ammount = 0;
            $(".data_jsn").val(JSON.stringify(items));
            $(`.cargo${id}`).remove();
            })
            if($(".opt_type").val() == "2"){
                let max = cargos[id].cargo_count;
                let counter = 1;
                console.log("items");
                console.log(items.cargos_list[id]);
                items.cargos_list[id].ammount = parseInt(counter);
                $(".data_jsn").val(JSON.stringify(items));
                console.log(items.cargos_list[id]);
                $(`.item${id}`).keyup(()=>{
                            let val = $(`.item${id}`).val();
                            if(parseInt(val) >  parseInt(max) ){
                                $(`.item${id}`).val(max)
                            }else if ( parseInt(val) < 1){
                                $(`.item${id}`).val(1)
                            }else if( `${$(`.item${id}`).val()}`.length == 0){
                                $(`.item${id}`).val(1);
                            }
                            counter = $(`.item${id}`).val(); ;
                            console.log(items.cargos_list[id]);
                            items.cargos_list[id].ammount = parseInt(counter);
                            $(".data_jsn").val(JSON.stringify(items));
                            console.log(items.cargos_list[id]);
                        });
                        $(`.item${id}`).change(()=>{
                            let val = $(`.item${id}`).val();
                            if(parseInt(val) >  parseInt(max) ){
                                $(`.item${id}`).val(max)
                            }else if ( parseInt(val) < 1){
                                $(`.item${id}`).val(1)
                            }else if( `${$(`.item${id}`).val()}`.length == 0){
                                $(`.item${id}`).val(1);
                            }
                            counter = $(`.item${id}`).val(); ;
                            console.log(items.cargos_list[id]);
                            items.cargos_list[id].ammount = parseInt(counter);
                            $(".data_jsn").val(JSON.stringify(items));
                            console.log(items.cargos_list[id]);
                        });
            }
        }
        })
        $(".opt_type").change(()=>{
            if($(".opt_type").val() == "2"){
            for(let i = 0 ; i < cargos.length ; i++){
                let max = cargos[i].cargo_count;
                let counter = 1;
                console.log("items");
                console.log(items.cargos_list[i]);
                let val = $(`.item${i}`).val();
                            if(parseInt(val) >  parseInt(max) ){
                                $(`.item${i}`).val(max)
                            }else if ( parseInt(val) < 1){
                                $(`.item${i}`).val(1)
                            }else if( `${$(`.item${i}`).val()}`.length == 0){
                                $(`.item${i}`).val(1);
                            }
                            counter = $(`.item${i}`).val(); ;
                            console.log(items.cargos_list[i]);
                            if(counter != undefined){
                                items.cargos_list[i].ammount = parseInt(counter);
                                $(".data_jsn").val(JSON.stringify(items));
                            }
                            console.log(items.cargos_list[i]);
                console.log(items.cargos_list[i]);
                $(`.item${i}`).unbind("keyup");
                $(`.item${i}`).unbind("change");
                $(`.item${i}`).keyup(()=>{
                            let val = $(`.item${i}`).val();
                            if(parseInt(val) >  parseInt(max) ){
                                $(`.item${i}`).val(max)
                            }else if ( parseInt(val) < 1){
                                $(`.item${i}`).val(1)
                            }else if( `${$(`.item${i}`).val()}`.length == 0){
                                $(`.item${i}`).val(1);
                            }
                            counter = $(`.item${i}`).val(); ;
                            console.log(items.cargos_list[i]);
                            items.cargos_list[i].ammount = parseInt(counter);
                            $(".data_jsn").val(JSON.stringify(items));
                            console.log(items.cargos_list[i]);
                        });
                        $(`.item${i}`).change(()=>{
                            let val = $(`.item${i}`).val();
                            if(parseInt(val) >  parseInt(max) ){
                                $(`.item${i}`).val(max)
                            }else if ( parseInt(val) < 1){
                                $(`.item${i}`).val(1)
                            }else if( `${$(`.item${i}`).val()}`.length == 0){
                                $(`.item${i}`).val(1);
                            }
                            counter = $(`.item${i}`).val(); ;
                            console.log(items.cargos_list[i]);
                            items.cargos_list[i].ammount = parseInt(counter);
                            $(".data_jsn").val(JSON.stringify(items));
                            console.log(items.cargos_list[i]);
                        });
            }
            }else{
                for(let i = 0 ; i < cargos.length ; i++){
                let max = cargos[i].cargo_count;
                let counter = 1;
                console.log("items");
                console.log(items.cargos_list[i]);
                // items.cargos_list[i].ammount = parseInt(counter);
                console.log(items.cargos_list[i]);
                console.log("tbedel");
                console.log( cargos[i]);
                $(`.item${i}`).unbind("keyup");
                $(`.item${i}`).unbind("change");
                $(`.item${i}`).keyup(()=>{
                            let val = $(`.item${i}`).val();
                            if ( parseInt(val) < 1){
                                $(`.item${i}`).val(1)
                            }else if( `${$(`.item${i}`).val()}`.length == 0){
                                $(`.item${i}`).val(1);
                            }
                            counter = $(`.item${i}`).val(); ;
                            console.log(items.cargos_list[i]);
                            items.cargos_list[i].ammount = parseInt(counter);
                            $(".data_jsn").val(JSON.stringify(items));
                            console.log(items.cargos_list[i]);
                        });
                        $(`.item${i}`).change(()=>{
                            let val = $(`.item${i}`).val();
                            if ( parseInt(val) < 1){
                                $(`.item${i}`).val(1)
                            }else if( `${$(`.item${i}`).val()}`.length == 0){
                                $(`.item${i}`).val(1);
                            }
                            counter = $(`.item${i}`).val(); ;
                            console.log(items.cargos_list[i]);
                            items.cargos_list[i].ammount = parseInt(counter);
                            $(".data_jsn").val(JSON.stringify(items));
                            console.log(items.cargos_list[i]);
                        });
            }
            }
        })
        $(".sub").click(()=>{
            $(".sub").attr("disabled","disabled");
            $(".send").submit();
        })
        $(".send").submit((e)=>{
            e.preventDefault();
            if($(".opt_type").val() == "2"){
            for(let i = 0 ; i < cargos.length ; i++){
                let max = cargos[i].cargo_count;
                let counter = 1;

                let val = $(`.item${i}`).val();
                if(parseInt(val) >  parseInt(max) ){
                    $(`.item${i}`).val(max)
                }else if ( parseInt(val) < 1){
                    $(`.item${i}`).val(1)
                }else if( `${$(`.item${i}`).val()}`.length == 0){
                    $(`.item${i}`).val(1);
                }
                counter = $(`.item${i}`).val(); ;
                console.log(items.cargos_list[i]);
                items.cargos_list[i].ammount = parseInt(counter);
                $(".data_jsn").val(JSON.stringify(items));
                console.log(items.cargos_list[i]);

            }
            }else{
                for(let i = 0 ; i < cargos.length ; i++){
                let max = cargos[i].cargo_count;
                let counter = 1;
                let val = $(`.item${i}`).val();
                if ( parseInt(val) < 1){
                    $(`.item${i}`).val(1)
                }else if( `${$(`.item${i}`).val()}`.length == 0){
                    $(`.item${i}`).val(1);
                }
                counter = $(`.item${i}`).val(); ;
                console.log(items.cargos_list[i]);
                items.cargos_list[i].ammount = parseInt(counter);
                $(".data_jsn").val(JSON.stringify(items));
                console.log(items.cargos_list[i]);
            }
            }
            let price = 0 ;
            for(let y = 0 ; y < items.cargos_list.length ; y++){
                if(items.cargos_list[y].ammount != null && items.cargos_list[y].ammount != NaN && items.cargos_list[y].ammount > 0){
                price += ( items.cargos_list[y].ammount * cargos[y].cargo_price )
                }
            }
            $(".price").val(price)
            $(".sub").removeAttr("disabled");
            e.currentTarget.submit();
        });
    });

  </script>

@endsection

