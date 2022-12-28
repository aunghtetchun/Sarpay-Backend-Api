@auth
    <div class="aside-left bg-white px-3 pb-2 min-vh-100 shadow">
        <ul class="menu" style="list-style-type: none">
            <li class="brand-icon">
                <div class="d-flex justify-content-between">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset(\App\Custom::$info['c-logo']) }}" class="brand-icon-img">
                        <small
                            class="text-primary font-weight-bold h5 mb-0 ml-2">{{ \App\Custom::$info['short_name'] }}</small>
                    </div>
                    <button class="btn btn-light d-block d-lg-none aside-menu-close">
                        <i class="feather-x fa-2x"></i>
                    </button>
                </div>
            </li>
            <li>
                <a class="menu-item mt-3" href="{{ route('admin.home') }}">
                    <span>
                        <i class="feather-home"></i>
                        Dashboard
                    </span>
                </a>
            </li>

{{--            @component('component.nav-item')--}}
{{--                @slot('icon')--}}
{{--                    <i class="feather-file"></i>--}}
{{--                @endslot--}}
{{--                @slot('name')--}}
{{--                    Sample--}}
{{--                @endslot--}}
{{--                @slot('link')--}}
{{--                    {{ route('sample') }}--}}
{{--                @endslot--}}
{{--            @endcomponent--}}

            @component('component.nav-spacer')
            @endcomponent

            @component('component.nav-title')
                Admin Management
            @endcomponent
            @component('component.nav-item-count')
                @slot('icon')
                    <i class="feather-bookmark"></i>
                @endslot
                @slot('name')
                    Group
                @endslot
                @slot('link')
                    {{ route('group.index') }}
                @endslot
                @slot('count')
                    {{ \App\Group::count() }}
                @endslot
            @endcomponent

            @component('component.nav-item-count')
                @slot('icon')
                    <i class="feather-book-open"></i>
                @endslot
                @slot('name')
                    Books
                @endslot
                @slot('link')
                    {{ route('admin.bookList') }}
                @endslot
                @slot('count')
                    {{ \App\Book::count() }}
                @endslot
            @endcomponent

            @component('component.nav-item-count')
                @slot('icon')
                    <i class="fas fa-user-friends"></i>
                @endslot
                @slot('name')
                    Reader
                @endslot
                @slot('link')
                    {{ route('admin.rindex') }}
                @endslot
                @slot('count')
                    {{ \App\Reader::count() }}
                @endslot
            @endcomponent
            @component('component.nav-item-count')
                @slot('icon')
                    <i class="feather-dollar-sign"></i>
                @endslot
                @slot('name')
                    Payment
                @endslot
                @slot('link')
                    {{ route('admin.pmindex') }}
                @endslot
                @slot('count')
                    {{ \App\Payment::count() }}
                @endslot
            @endcomponent

            @component('component.nav-spacer')
            @endcomponent

            @component('component.nav-title')
                Author Management
            @endcomponent

            @component('component.nav-item')
                @slot('icon')
                    <i class="feather-plus-circle"></i>
                @endslot
                @slot('name')
                    Add Author
                @endslot
                @slot('link')
                    {{ route('author.create') }}
                @endslot
            @endcomponent

            @component('component.nav-item-count')
                @slot('icon')
                    <i class="feather-users"></i>
                @endslot
                @slot('name')
                    Author List
                @endslot
                @slot('link')
                    {{ route('author.index') }}
                @endslot
                @slot('count')
                    {{ \App\User::where('role', 'author')->count() }}
                @endslot
            @endcomponent

            @component('component.nav-spacer')
            @endcomponent
            @component('component.nav-title')
                Profile Management
            @endcomponent
            @component('component.nav-item')
                @slot('icon')
                    <i class="feather-user"></i>
                @endslot
                @slot('name')
                    Edit Profile
                @endslot
                @slot('link')
                    {{ route('profile.edit') }}
                @endslot
            @endcomponent




            @component('component.nav-spacer')
            @endcomponent
            <li>
                <a class="menu-item alert-secondary" onclick="logout()" href="#">
                    <span>
                        <i class="fas fa-lock"></i>
                        Logout
                    </span>
                </a>
            </li>
        </ul>
    </div>


@endauth
