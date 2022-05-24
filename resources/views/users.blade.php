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

            <div class="mt-5 mb-3 add-user-btn">
                <div class="btn-box">
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add User</button>
                </div>
            </div>

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
                                        <button class="btn action-btn">
                                            <i class="material-icons">edit</i>
                                        </button>
                                        <button class="btn action-btn">
                                            <i class="material-icons">delete</i>
                                        </button>
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

