@include('layouts.layout_dashboard_start')

<!-- Main content goes here -->
<div class="dashboardContent">
<div class="container">
<div class="imageBrand">
                <img src="{{ asset('storage/' . $user->image) }}" alt="Profile Picture" class="img-fluid rounded-circle">
            <div class="row">
                <div class="col-md-8">
                            <div class="Userdetailsform">
                            <form action="{{ route('user.update',['user' => $user->id])}}" method="post" enctype="multipart/form-data">
                            @method('put')    
                            @csrf
                                <!-- User details fields -->
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="fname">Name:</label>
                                        <input type="text" id="name" name="name" value="{{ $user->name }}"
                                            class="form-control" required>
                                        @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="lname">Email:</label>
                                        <input type="text" id="email" name="email" value="{{ $user->email }}"
                                            class="form-control" disabled>
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                
                                    <div class="form-group col-md-6">
                                   <label for="role">Role:</label> 
                                   <select id="role" name="role" class="form-control" required>
                                  <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                 <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                 </select>
                                @error('role')
                               <span class="text-danger">{{ $message }}</span>
                               @enderror
                               </div>  
                               <div class="form-group col-md-6">
                                        <label for="image">Image:</label>
                                        <input type="file" id="image" name="image" 
                                            class="form-control">
                                        @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                 </div>
                                    
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <button type="submit" class="btn btn-primary btn-lg">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div> <!-- Close MainContent div -->
    </div>
    @include('layouts.layout_dashboard_end')