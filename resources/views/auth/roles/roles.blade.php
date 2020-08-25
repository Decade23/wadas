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
                @include('auth.roles.module.dashboard')
                @include('auth.roles.module.users')
                @include('auth.roles.module.member')
                @include('auth.roles.module.roles')
                @include('auth.roles.module.products.product')
                @include('auth.roles.module.products.product_group')
                @include('auth.roles.module.sales.orders')
                @include('auth.roles.module.application.email')
                @include('auth.roles.module.config.email')
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
