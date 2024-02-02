<x-profile :userData="$userData" doctitle="Who {{$userData['username']}}'s Follows">
      <div class="list-group">
      @foreach ($followers as $follower)
  
      <a href="/profile/{{$follower->followingUser->username}}" class="list-group-item list-group-item-action">
          <img class="avatar-tiny" src="{{$follower->followingUser->avatar}}" />
          <strong>{{$follower->followingUser->username}}</strong>
        </a>
          
      @endforeach
  </div>
  </x-profile>