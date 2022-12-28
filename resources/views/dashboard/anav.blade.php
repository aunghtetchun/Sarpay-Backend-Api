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
                <a class="menu-item mt-3" href="{{ route('author.home') }}">
                    <span>
                        <i class="feather-home"></i>
                        Dashboard
                    </span>
                </a>
            </li>

            @component('component.nav-spacer')
            @endcomponent

            @component('component.nav-title')
                Books Management
            @endcomponent

            @component('component.nav-item')
                @slot('icon')
                    <i class="feather-plus-circle"></i>
                @endslot
                @slot('name')
                    Add Book
                @endslot
                @slot('link')
                    {{ route('book.create') }}
                @endslot
            @endcomponent

            @component('component.nav-item-count')
                @slot('icon')
                    <i class="feather-list"></i>
                @endslot
                @slot('name')
                    Book List
                @endslot
                @slot('link')
                    {{ route('book.index') }}
                @endslot
                @slot('count')
                    {{ \App\Book::where('user_id', Auth::user()->id)->count() }}
                @endslot
                {{-- \App\Book::count() --}}
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
