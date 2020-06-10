<div class="form-group">
    <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
        <input type="checkbox" name="acl_all" id="acl_all" class="acl" {{ old('acl_all') || array_key_exists('acl.all', $permissions) ? 'checked' : ''}}> Checked All
        <span></span>
    </label>
</div>

<!--begin::Section-->
<div class="kt-section">
    <div class="kt-section__content">
        <table class="table table-striped" id="acl-table" cellspacing="0" width="100%">
            <thead class="text-center">
            <tr>
                <th style="vertical-align: middle">Module Name</th>
                <th width="80">Create</th>
                <th width="80">Update</th>
                <th width="80">View</th>
                <th width="80">Delete</th>
                <th width="80">Miscellaneous</th>
            </tr>
            </thead>
            <tbody>
            <!-- Dashboard -->
            <tr>
                <th scope="row">Dashboard</th>
                <td class="text-center"">&nbsp;</td>
                <td class="text-center"">&nbsp;</td>
                <td class="text-center">
                    <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                        <input type="checkbox" class="acl" value="ok" name="dashboard_show" {{ old('dashboard_show') || array_key_exists('dashboard.show', $permissions) ? 'checked' : ''}}>&nbsp;
                        <span></span>
                    </label>
                </td>
                <td class="text-center"">&nbsp;</td>
                <td class="text-center">&nbsp;</td>
            </tr>
            <!-- User -->
            <tr>
                <th scope="row">User</th>
                <td class="text-center">
                    <div class="kt-checkbox-inline">
                    <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                        <input type="checkbox" class="acl" value="ok" name="user_create" {{ old('user_create') || array_key_exists('user.create', $permissions) ? 'checked' : ''}}>&nbsp;
                        <span></span>
                    </label>
                    </div>
                </td>
                <td class="text-center">
                    <div class="kt-checkbox-inline">
                    <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                        <input type="checkbox" class="acl" value="ok" name="user_edit" {{ old('user_edit') || array_key_exists('user.edit', $permissions) ? 'checked' : ''}}>&nbsp;
                        <span></span>
                    </label>
                    </div>
                </td>
                <td class="text-center">
                    <div class="kt-checkbox-inline">
                    <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                        <input type="checkbox" class="acl" value="ok" name="user_show" {{ old('user_show') || array_key_exists('user.show', $permissions) ? 'checked' : ''}}>&nbsp;
                        <span></span>
                    </label>
                    </div>
                </td>
                <td class="text-center">
                    <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                        <input type="checkbox" class="acl" value="ok" name="user_destroy" {{ old('user_destroy') || array_key_exists('user.destroy', $permissions) ? 'checked' : ''}}>&nbsp;
                        <span></span>
                    </label>
                </td>
                <td class="text-center">
                    <div class="kt-checkbox-inline">
                    <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                        <input type="checkbox" class="acl" value="ok" name="user_status" {{ old('user_status') || array_key_exists('user.status', $permissions) ? 'checked' : ''}}>&nbsp;
                        <span></span>
                    </label>
                    </div>
                </td>
            </tr>

            <!-- Roles -->
            <tr>
                <th scope="row">Roles</th>
                <td class="text-center"">
                    <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                        <input type="checkbox" class="acl" value="ok" name="role_create" {{ old('role_create') || array_key_exists('role.create', $permissions) ? 'checked' : ''}}>&nbsp;
                        <span></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                        <input type="checkbox" class="acl" value="ok" name="role_edit" {{ old('role_edit') || array_key_exists('role.edit', $permissions) ? 'checked' : ''}}>&nbsp;
                        <span></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                        <input type="checkbox" class="acl" value="ok" name="role_show" {{ old('role_show') || array_key_exists('role.show', $permissions) ? 'checked' : ''}}>&nbsp;
                        <span></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                        <input type="checkbox" class="acl" value="ok" name="role_destroy" {{ old('role_destroy') || array_key_exists('role.destroy', $permissions) ? 'checked' : ''}}> &nbsp;
                        <span></span>
                    </label>
                </td>
                <td class="text-center">
                </td>
            </tr>

            <!-- Product -->
            <!-- Products -->
            <tr>
                <th scope="row">Products</th>
                <td class="text-center"">
                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                    <input type="checkbox" class="acl" value="ok" name="product_create" {{ old('product_create') || array_key_exists('product.create', $permissions) ? 'checked' : ''}}>&nbsp;
                    <span></span>
                </label>
                </td>
                <td class="text-center">
                    <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                        <input type="checkbox" class="acl" value="ok" name="product_edit" {{ old('product_edit') || array_key_exists('product.edit', $permissions) ? 'checked' : ''}}>&nbsp;
                        <span></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                        <input type="checkbox" class="acl" value="ok" name="product_show" {{ old('product_show') || array_key_exists('product.show', $permissions) ? 'checked' : ''}}>&nbsp;
                        <span></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                        <input type="checkbox" class="acl" value="ok" name="product_destroy" {{ old('product_destroy') || array_key_exists('product.destroy', $permissions) ? 'checked' : ''}}> &nbsp;
                        <span></span>
                    </label>
                </td>
                <td class="text-center">
                </td>
            </tr>

            <!-- Product -->
            <!-- Product Groups -->
            <tr>
                <th scope="row">Product Groups</th>
                <td class="text-center"">
                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                    <input type="checkbox" class="acl" value="ok" name="product_group_create" {{ old('product_group_create') || array_key_exists('product_group.create', $permissions) ? 'checked' : ''}}>&nbsp;
                    <span></span>
                </label>
                </td>
                <td class="text-center">
                    <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                        <input type="checkbox" class="acl" value="ok" name="product_group_edit" {{ old('product_group_edit') || array_key_exists('product_group.edit', $permissions) ? 'checked' : ''}}>&nbsp;
                        <span></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                        <input type="checkbox" class="acl" value="ok" name="product_group_show" {{ old('product_group_show') || array_key_exists('product_group.show', $permissions) ? 'checked' : ''}}>&nbsp;
                        <span></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                        <input type="checkbox" class="acl" value="ok" name="product_group_destroy" {{ old('product_group_destroy') || array_key_exists('product_group.destroy', $permissions) ? 'checked' : ''}}> &nbsp;
                        <span></span>
                    </label>
                </td>
                <td class="text-center">
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<!--end::Section-->

@push('css')
    <link rel="stylesheet" href="{{ url('themes/eci/plugins/custom/datatables/datatables.bundle.css') }}">
@endpush

@push('scripts')
    <script src="{{ url('themes/eci/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    <script>
        $(function () {
            let table;
            table = $('#acl-table').DataTable({
                aaSorting  : [[0, 'asc']],
                stateSave  : true,
                bPaginate  : false,
                bInfo      : false,
                responsive : true,
                processing : true,
                bFilter    : false,
                fixedHeader: true,
                columns    : [
                    {orderable: true, searchable: true},
                    {orderable: false, searchable: false},
                    {orderable: false, searchable: false},
                    {orderable: false, searchable: false},
                    {orderable: false, searchable: false},
                    {orderable: false, searchable: false},

                ]
            });
        });

        $('#acl_all').on('click', function () {
            var all = $('#acl_all');
            if (all.is(":checked")) {
                $('.acl').prop('checked', true);
            } else {
                $('.acl').prop('checked', false);
            }
        });

    </script>
@endpush
