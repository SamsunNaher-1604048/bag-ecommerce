<div class="nav-ber mt-5">
    <nav class="nav nav-pills gap-4">
        <a class="nav-design {{ request()->is('user/dashboard') ? 'active' :' ' }}" href="{{route('user.dashboard')}}">Dashboard</a>
        <a class="nav-design {{ request()->is('user/profile/edit') ? 'active' :' ' }}" href="{{route('user.profile.edit')}}">Profile Setting</a>
        <a class="nav-design {{ request()->is('user/orders') ? 'active' : ' ' }}" href="{{route('user.orders')}}">Order</a>
    </nav>
</div>
