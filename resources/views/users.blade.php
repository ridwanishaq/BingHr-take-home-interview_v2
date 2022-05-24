@extends('layouts.app')

@section('content')
    {{-- Side Nav Menu --}}
    @include('layouts.inc.sideNav')


    <!-- Page content wrapper-->
    <div id="page-content-wrapper">
        <!-- Top navigation-->
        @include('layouts.inc.topNav')

        <!-- Page content-->
        <div class="container-fluid">

            <div class="mt-5 mb-3 add-user-btn">
                <div class="btn-box">
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add User</button>
                </div>
            </div>

            @if($errors->any())
                <div class="alert alert-danger">
                    <p><strong>Opps Something went wrong</strong></p>
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success text-white">{{session('success')}}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger text-white">{{session('error')}}</div>
            @endif

            <div class="card">
                <div class="card-header" style="padding:15px;">
                    <div class="row">
                        <div class="col-md-8">
                           <h5 class="">List Users</h5>
                        </div>
                        <div class=" col-md-4">
                            <!-- User list search box -->
                            <div class="form-group has-search">
                              <span class="fa fa-search form-control-feedback"></span>
                              <input type="text" id="searchInput" class="form-control" placeholder="Search...">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table ">
                        <thead style="background-color: #ccd3;">
                            <tr>
                                <th>Name</th>
                                <th style="width:15%;">&nbsp;</th>
                                <th>Create Date</th>
                                <th>Role</th>
                                <th style="width:15%;">Action</th>
                            </tr>
                        </thead>
                        <tbody id="usersListTable">
                            @foreach ($data as $key => $user)

                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        <span class="badge bg-primary">Super Admin</span>
                                    </td>
                                    <td>{{ $user->created_at->format('d M, Y') }}</td>
                                    <td>Super Admin</td>
                                    <td>
                                        <div class="row">
                                            <button class="btn col-md-6 action-btn" type="button" data-bs-toggle="modal" data-bs-target="#editModal{{ $loop->iteration }}"><i class="material-icons">edit</i></button>
                                            <form class="col-md-6" action="/users/{{ $user->id }}" method="post">
                                                @csrf
                                                @method('delete')

                                                <button type="submit" class="btn action-btn">
                                                    <i class="material-icons">delete</i>
                                                </button>
                                            </form>
                                        </div>

                                        <!-- Add User Modal -->
                                        <div class="modal fade" id="editModal{{$loop->iteration}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <form action="/users/{{ $user->id }}/edit" method="post">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Edit User</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <!-- 1st row -->
                                                                    <div class="mb-3">
                                                                        <input type="text" name="employeeID" class="form-control" placeholder="Employee ID *" required value="{{$user->employeeID}}">
                                                                    </div>

                                                                    <!-- 2nd row -->
                                                                    <div class="mb-3 col-md-6">
                                                                        <input type="text" name="first_name" class="form-control" placeholder="First Name *" required value="{{ explode(' ', $user->name)[0] }}">
                                                                    </div>
                                                                    <div class="mb-3 col-md-6">
                                                                        <input type="text" name="last_name" class="form-control" placeholder="Last Name *" required value="{{ explode(' ', $user->name)[1] }}">
                                                                        <input type="hidden" name="name" value="">
                                                                    </div>

                                                                    <!-- 3rd row -->
                                                                    <div class="mb-3 col-md-4">
                                                                        <input type="email" name="email" class="form-control" placeholder="Email ID *" required value="{{$user->email}}">
                                                                    </div>
                                                                    <div class="mb-3 col-md-4">
                                                                        <input type="text" name="mobile_no" class="form-control" placeholder="Mobile No" value="{{$user->mobile_no}}">
                                                                    </div>
                                                                    <div class="mb-3 col-md-4">
                                                                        <select class="form-control" name="roles">
                                                                            <option value=""></option>
                                                                            @if(!empty($roles))
                                                                                @foreach($roles as $role)
                                                                                    <option value="{{$role}}">{{$role}}</option>
                                                                                @endforeach
                                                                            @endif
                                                                        </select>
                                                                    </div>

                                                                    <!-- 4th row -->
                                                                    <div class="mb-3 col-md-4">
                                                                        <input type="text" class="form-control" placeholder="Username *" name="username" required value="{{$user->username}}">
                                                                    </div>
                                                                    <div class="mb-3 col-md-4">
                                                                        <input type="password" class="form-control" placeholder="Password *" name="password" required>
                                                                    </div>
                                                                    <div class="mb-3 col-md-4">
                                                                        <input type="password" class="form-control" placeholder="Confirm Password *" name="confirm-password">
                                                                    </div>

                                                                    <!-- permission table -->
                                                                    <table class="table ">
                                                                        <thead style="background-color: #ccd3;">
                                                                            <tr>
                                                                                <th>Module Permission</th>
                                                                                <th>Read</th>
                                                                                <th>Write</th>
                                                                                <th>Delete</th>
                                                                                <!-- <th style="width:15%;">Action</th> -->
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="usersListTable">
                                                                            <tr>
                                                                                <td>Super Admin</td>
                                                                                <td>
                                                                                    <input type="checkbox" name="" id="" disabled checked>
                                                                                </td>
                                                                                <td>
                                                                                    <input type="checkbox" name="" id="" disabled checked>
                                                                                </td>
                                                                                <td>
                                                                                    <input type="checkbox" name="" id="" disabled checked>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Admin</td>
                                                                                <td>
                                                                                    <input type="checkbox" name="" id="" disabled checked>
                                                                                </td>
                                                                                <td>
                                                                                    <input type="checkbox" name="" id="" disabled>
                                                                                </td>
                                                                                <td>
                                                                                    <input type="checkbox" name="" id="" disabled>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Employee Admin</td>
                                                                                <td>
                                                                                    <input type="checkbox" name="" id="" disabled checked>
                                                                                </td>
                                                                                <td>
                                                                                    <input type="checkbox" name="" id="" disabled>
                                                                                </td>
                                                                                <td>
                                                                                    <input type="checkbox" name="" id="" disabled>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>HR Admin</td>
                                                                                <td>
                                                                                    <input type="checkbox" name="" id="" disabled checked>
                                                                                </td>
                                                                                <td>
                                                                                    <input type="checkbox" name="" id="" disabled checked>
                                                                                </td>
                                                                                <td>
                                                                                    <input type="checkbox" name="" id="" disabled checked>
                                                                                </td>
                                                                            </tr>

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success">Update User</button>
                                                            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cancel</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                    </td>
                                </tr>

                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- Footer -->
        @include('layouts.inc.footer')
        <!-- Footer -->
    </div>


    {{-- Add User Modal --}}
    @include('layouts.inc.add-user-modal')

@endsection

