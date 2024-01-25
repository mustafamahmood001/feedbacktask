@include('layouts.layout_dashboard_start')
<!-- Main content goes here -->

<div class="dashboardContent">
    <div class="table-responsive">
  
        <form action="{{ route('user.index') }}" method="GET">
        <div class="input-group mb-3">
  <input type="text" name="search" class="form-control" placeholder="Search" aria-label="Recipient's username" aria-describedby="basic-addon2">
  <button class="btn btn-outline-secondary" type="submit">Search</button>
  </form>

        <table id="dataTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Id @sortablelink('id','↑↓')</th>
                    <th>Name @sortablelink('name','↑↓')</th>
                    <th>Email @sortablelink('email','↑↓')</th>
                    <th>Role @sortablelink('role','↑↓')</th>
                    <th>Image </th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="userAllData">
            @if(count($users) > 0)
            @foreach($users as $user)
            <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
            <td id="userProfileShow"><img src="{{ asset('storage/' . $user->image) }}" alt="Profile Picture" class="img-fluid rounded-circle"></td>
    <td>
    <button class="btn btn-warning" ><a href="{{ route('user.edit', ['user' => $user->id]) }}">Edit</a></button>
    <form action="{{ route('user.destroy', ['user' => $user->id]) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
</form>

</td>
        </tr>
        @endforeach
          @else
          <tr>
            <td>No Data Found</td>
          </tr>
          @endif
            </tbody>
        </table>
        </div>
</div>
    </div>
<div class="pagination-container" id="paginating">
    {{ $users->links('pagination::bootstrap-4') }}
</div>

      

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="{{ asset('js/dashboard.js') }}"></script>

@include('layouts.layout_dashboard_end')