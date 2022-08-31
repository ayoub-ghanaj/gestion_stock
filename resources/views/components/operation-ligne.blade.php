@props(['operation'])
<tr>
    <td>
      <div class="d-flex px-2 py-1">
        <div>
          <img src="{{$operation->cargo_logo ? asset( $operation->cargo_logo) : asset('/assets/img/default-wearhouse.png')}}" class="avatar avatar-sm me-3" alt="{{$operation->name}}">
        </div>
        <div class="d-flex flex-column justify-content-center">
          <h6 class="mb-0 text-sm">{{$operation->cargo_name}}</h6>
        </div>
      </div>
    </td>
    <td>
      <div class="avatar-group mt-2">
        <a href="javascript:;" class="avatar avatar-m rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$operation->name}}">
          <img src="{{$operation->image ? asset( $operation->image) : asset('/assets/img/default-wearhouse.png')}}" alt="{{$operation->name}}">
        </a>
      </div>
    </td>
    <td class="align-middle text-center text-sm">
        @if ($operation->type == 'take')
        <span class="text-xs font-weight-bold text-danger"> -{{$operation->ammount}}</span>
        @else
        <span class="text-xs font-weight-bold text-success"> +{{$operation->ammount}}</span>
        @endif
    </td>
  </tr>
