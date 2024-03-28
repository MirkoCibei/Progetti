<div>
  <h6 class="primary-color-text ps-3 border-top mb-0 py-2">{{__('ui.notifications')}}</h6>
  <ul class="list-group">
    @if(count($notifications))
    @foreach($notifications as $notification)

    <li class="list-group-item lh-1 p-0 w-100">
      <a href="{{route('notification.index')}}" class="fs-6 p-2 small nav-link primary-color-text dropDownHover w-100 text-start " type="submit">{{$notification->body}}</a>
    </li>
    <li class="list-group-item bg-danger text-center p-0">
      <button wire:click="clearNotificationList({{ $notification->id }})" type="button" class="small fs-6 btn px-5 btn-danger btn-sm">{{__('ui.notificationsDelete')}}</button>
    </li>
    @endforeach



    @else
    <li class="primary-color-text list-group-item ps-3 w-100">
      <p>{{__('ui.notificationsEmpty')}}</p>
    </li>
    @endif
  </ul>


</div>