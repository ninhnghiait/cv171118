<li><a><i class="glyphicon glyphicon-user"></i> Quản lý người dùng <span class="fa fa-chevron-down"></span></a>
  <ul class="nav child_menu">
    <li><a><i class="glyphicon glyphicon-user"></i> Người dùng <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{ route('users_admin.index') }}">Danh sách</a></li>
          <li><a href="{{ route('users_admin.create') }}">Thêm</a></li>
        </ul>
    </li>
    <li><a><i class="glyphicon glyphicon-user"></i> Nhóm người dùng <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{ route('groups_admin.index') }}">Danh sách</a></li>
          <li><a href="{{ route('groups_admin.create') }}">Thêm</a></li>
        </ul>
    </li>
  </ul>
</li>