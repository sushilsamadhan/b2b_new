<div class="header-menu-content bg-light">
<nav class="navbar navbar-expand-md navbar-light bg-light">
  <a class="navbar-brand pb-2" href="{{ route('homepage') }}" title="{{getSystemSetting('type_name')->value}}"><img class="img-fluid header-logo" src="{{ filePath(getSystemSetting('type_logo')->value) }}" alt="{{getSystemSetting('type_name')->value}}"/></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
  <ul class="navbar-nav ml-auto">
      
	  <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		@translate(Courses)
        </a>
        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
		@foreach(categories() as $item)
			@if (($item->is_compitative == '0') && ($item ->is_free_study != '1') && ($item ->is_current_affairs != '1') && ($item ->is_project_works != '1'))
				
			<li class="dropdown-submenu">
				
				<a class="dropdown-item {{($item->child->count() != 0)?'dropdown-toggle':''}}" href="{{route('course.category',$item->slug)}}">{{$item->name}}</a>
				@if($item->child->count() != 0)
					<ul class="dropdown-menu">
						@foreach($item->child as $child)
							<li>
								<a class="dropdown-item" href="{{route('course.category',$child->slug)}}">{{$child->name}}</a>
							</li>
						@endforeach
					</ul>
				@endif
			</li>
			@endif
		@endforeach
        </ul>
      </li>
	  <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		@translate(Competitive)
        </a>
        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
		@foreach(categories() as $item)
		@if ($item->is_compitative != '0')
				
			<li class="dropdown-submenu">
				
				<a class="dropdown-item {{($item->child->count() != 0)?'dropdown-toggle':''}}" href="{{route('course.category',$item->slug)}}">{{$item->name}}</a>
				@if($item->child->count() != 0)
					<ul class="dropdown-menu">
						@foreach($item->child as $child)
							<li>
								<a class="dropdown-item" href="{{route('course.category',$child->slug)}}">{{$child->name}}</a>
							</li>
						@endforeach
					</ul>
				@endif
			</li>
			@endif
		@endforeach
        </ul>
      </li>
	  <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		@translate(Study Material)
        </a>
        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
		@foreach(categories() as $item)
		@if ($item->is_free_study != '0')
				
			<li class="dropdown-submenu">
				
				<a class="dropdown-item {{($item->child->count() != 0)?'dropdown-toggle':''}}" href="{{route('course.category',$item->slug)}}">{{$item->name}}</a>
				@if($item->child->count() != 0)
					<ul class="dropdown-menu">
						@foreach($item->child as $child)
							<li>
								<a class="dropdown-item" href="{{route('course.category',$child->slug)}}">{{$child->name}}</a>
							</li>
						@endforeach
					</ul>
				@endif
			</li>
			@endif
		@endforeach
        </ul>
      </li>
	  <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		@translate(Current Affairs)
        </a>
        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
		@foreach(categories() as $item)
		@if ($item->is_current_affairs != '0')
				
			<li class="dropdown-submenu">
				
				<a class="dropdown-item {{($item->child->count() != 0)?'dropdown-toggle':''}}" href="{{route('course.category',$item->slug)}}">{{$item->name}}</a>
				@if($item->child->count() != 0)
					<ul class="dropdown-menu">
						@foreach($item->child as $child)
							<li>
								<a class="dropdown-item" href="{{route('course.category',$child->slug)}}">{{$child->name}}</a>
							</li>
						@endforeach
					</ul>
				@endif
			</li>
			@endif
		@endforeach
        </ul>
      </li>
	  <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		@translate(Project Works)
        </a>
        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
		@foreach(categories() as $item)
		@if ($item->is_project_works != '0')
				
			<li class="dropdown-submenu">
				
				<a class="dropdown-item dropdown-toggle" href="{{route('course.category',$item->slug)}}">{{$item->name}}</a>
				@if($item->child->count() != 0)
					<ul class="dropdown-menu">
						@foreach($item->child as $child)
							<li>
								<a class="dropdown-item" href="{{route('course.category',$child->slug)}}">{{$child->name}}</a>
							</li>
						@endforeach
					</ul>
				@endif
			</li>
			@endif
		@endforeach
        </ul>
      </li>
    </ul>
	
  </div>
</nav>
</div><!-- end header-menu-content -->


@auth
{{-- bottom responsive menu --}}
<ul class="nav justify-content-center fixed-bottom bg-white btm-fixed-nav d-none">
  <li class="nav-item">
    <div class="notification-item mr-3">
      <a href="{{ route('shopping.cart') }}">
        <button class="notification-btn dropdown-toggle">
          <i class="la la-shopping-cart"></i>
            <span class="quantity cart-quantity">{{ App\Model\Cart::where('user_id',Auth::user()->id)->count() }}</span>
        </button>
      </a>
    </div>
  </li>
  <li class="nav-item">
    <div class="notification-item mr-3">
      <a href="{{ route('student.dashboard') }}">
      <button class="notification-btn dropdown-toggle">
        <i class="la la-bell"></i>
          <span class="quantity">{{ App\NotificationUser::where('user_id',Auth::user()->id)->where('is_read',false)->count() }}</span>
      </button>
    </a>
    </div>
  </li>
  <li class="nav-item">
    <div class="notification-item mr-3">
      <a href="{{ route('my.wishlist') }}">
      <button class="notification-btn dropdown-toggle">
        <i class="la la-heart-o"></i>
          <span class="quantity wishlist-quantity">{{ App\Model\Wishlist::where('user_id',Auth::user()->id)->count() }}</span>
      </button>
    </a>
    </div>
  </li>
</ul>
{{-- bottom responsive menu --}}
@endauth
