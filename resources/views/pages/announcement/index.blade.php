<x-layout>
  <x-nav />
  <div class="container">
    <h2 class="text-center primary-color-text ">{{__('ui.announcementSearch')}}</h2>

    <div class="row">
      <div class="col-12">
        <div class="row">
          @forelse($announcements as $announcement)
          <div class="col-12 col-md-4 my-4">
            <x-card :announcement="$announcement->id" :user="$announcement->user->name" :price="$announcement->price" :description="$announcement->description" :category="$announcement->category->name" :title="$announcement->title" :root="route('announce.View',$announcement->id)" :images="$announcement->images" />
          </div>
          @empty
          <div class="col 12">
            <div class="alert alert-warning py-3 shadow">
              <p class="lead">{{__('ui.announcementEmpty')}}</p>
            </div>
          </div>
          @endforelse
          {{ $announcements->links() }}
        </div>
      </div>
    </div>
  </div>


</x-layout>
<x-footer />