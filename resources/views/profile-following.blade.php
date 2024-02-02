<x-profile :userData="$userData" doctitle="{{$userData['username']}}'s Following">>
    <div class="list-group">
      @foreach ($following as $follows)
  
      <a href="/profile/{{$follows->userFollowed->username}}" class="list-group-item list-group-item-action">
        <img class="avatar-tiny" src="{{$follows->userFollowed->avatar}}" />
        <strong>{{$follows->userFollowed->username}}</strong>
      </a>
          
      @endforeach
  </div>
  </x-profile>