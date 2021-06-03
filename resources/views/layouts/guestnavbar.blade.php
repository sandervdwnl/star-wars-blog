<nav id="nav" class="bg-gray-100">
    <div class="container flex justify-between py-4" id="navBar">

        <div class="logo text-2xl md:text-4xl">
            <a href="/" class="text-gray-600"><i class="fas fa-jedi"></i></a>
        </div>

        <ul class="nav-links flex flex-row pl-5 invisible md:visible" id="navLinks">
            <li class="pl-5"><a href="/" class="text-gray-500 font-semibold {{ Request::is('/') ? 'active' : '' }}">Homepage</a></li>
            <li class="pl-5"><a href="/posts" class="text-gray-500 font-semibold {{ Request::is('posts') ? 'active' : '' }}">Blog</a></li>
            @auth
            <li class="pl-5"><a href="/comments" class="text-gray-500 font-semibold {{ Request::is('comments') ? 'active' : '' }}">Comments</a></li>
            <li class="pl-5">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <a href="route('logout')" class="text-gray-500 font-semibold" onclick="event.preventDefault();
                        this.closest('form').submit();">
                        {{ __('Log out') }}
                    </a>
                </form>
            </li>
            @endauth
        </ul>


        <div id="hamburgerIcon" class="absolute right-5 md:invisible">
            <a href="#"><i class="fas fa-bars"></i></a>
        </div>

    </div>
</nav>

<script>
    let navBar = document.getElementById('navBar');
    let hamburgerIcon = document.getElementById('hamburgerIcon');
    let navLinks = document.getElementById('navLinks');

    hamburgerIcon.addEventListener('click', function() {
        navLinks.classList.toggle('invisible');
        navLinks.classList.toggle('flex-row');
        navLinks.classList.toggle('flex-col');
        navLinks.classList.toggle('text-center');
        navBar.classList.toggle('flex-col');
    })

</script>
