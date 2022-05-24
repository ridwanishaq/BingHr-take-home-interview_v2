<!-- Add User Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form action="{{ route('store.users') }}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <!-- 1st row -->
                            <div class="mb-3">
                                <input type="text" name="employeeID" class="form-control" placeholder="Employee ID *" required>
                            </div>

                            <!-- 2nd row -->
                            <div class="mb-3 col-md-6">
                                <input type="text" name="first_name" class="form-control" placeholder="First Name *" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <input type="text" name="last_name" class="form-control" placeholder="Last Name *" required>
                                <input type="hidden" name="name" value="">
                            </div>

                            <!-- 3rd row -->
                            <div class="mb-3 col-md-4">
                                <input type="text" name="email" class="form-control" placeholder="Email ID *" required>
                            </div>
                            <div class="mb-3 col-md-4">
                                <input type="text" name="mobile_no" class="form-control" placeholder="Mobile No">
                            </div>
                            <div class="mb-3 col-md-4">
                                <select class="form-control" name="roles">
                                    <option value="">Select Role Type</option>
                                    <option value="Super Admin">Super Admin</option>
                                    <option value="Admin">Admin</option>
                                    <option value="HR Admin">HR Admin</option>
                                    <option value="Employee">Employee</option>
                                </select>
                            </div>

                            <!-- 4th row -->
                            <div class="mb-3 col-md-4">
                                <input type="text" class="form-control" placeholder="Username *" name="username" required>
                            </div>
                            <div class="mb-3 col-md-4">
                                <input type="text" class="form-control" placeholder="Password *" name="password" required>
                            </div>
                            <div class="mb-3 col-md-4">
                                <input type="text" class="form-control" placeholder="Confirm Password *" name="confirm-password">
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
                    <button type="submit" class="btn btn-primary">Add User</button>
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
