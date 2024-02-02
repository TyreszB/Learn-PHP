<x-layout :doctitle="$doctitle">
    <div class="container py-md-5 container--narrow">
        <h2>
          <img class="avatar-small" src="{{$userData['avatar']}}" /> {{$userData['username']}}
          @auth
          @if (!$userData['currentlyFollowing'] AND auth()->user()->username != $userData['username'])

          <form class="ml-2 d-inline" action="/create-follow/{{$userData['username']}}" method="POST">
            @csrf
            <button class="btn btn-primary btn-sm">Follow <i class="fas fa-user-plus"></i></button>
          </form>
            
          @endif

          @if ($userData['currentlyFollowing'])
          <form class="ml-2 d-inline" action="/remove-follow/{{$userData['username']}}" method="POST">
            @csrf
            <button class="btn btn-danger btn-sm">Stop Following <i class="fas fa-user-times"></i></button>     
          </form>
          @endif
          @if (auth()->user()->username == $userData['username'])
              <a href="/manage-avatar" class="btn btn-secondary btn-sm">Manage Avatar</a>
            @endif
          @endauth
        </h2>
  
        <div class="profile-nav nav nav-tabs pt-2 mb-4">
          <a href="/profile/{{$userData['username']}}" class="profile-nav-link nav-item nav-link {{ Request::segment(3) == "" ? "active" : ""}}">Posts: {{$userData['postCount']}}</a>
          <a href="/profile/{{$userData['username']}}/followers" class="profile-nav-link nav-item nav-link {{ Request::segment(3) == "followers" ? "active" : ""}}">Followers: {{$userData['followerCount']}}</a>
          <a href="/profile/{{$userData['username']}}/following" class="profile-nav-link nav-item nav-link {{ Request::segment(3) == "following" ? "active" : ""}}">Following: {{$userData['followingCount']}}</a>
        </div>

        <div class="profile-slot-content">
            {{$slot}}
        </div>
  
     
      </div>
</x-layout>