<!-- Sales Orders -->
<tr>
    <th scope="row">Sales Orders</th>
    <td class="text-center">
        <div class="kt-checkbox-inline">
            <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                <input type="checkbox" class="acl" value="ok" name="sales_create" {{ old('sales_create') || array_key_exists('sales.create', $permissions) ? 'checked' : ''}}>&nbsp;
                <span></span>
            </label>
        </div>
    </td>
    <td class="text-center">
        <div class="kt-checkbox-inline">
            <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                <input type="checkbox" class="acl" value="ok" name="sales_edit" {{ old('sales_edit') || array_key_exists('sales.edit', $permissions) ? 'checked' : ''}}>&nbsp;
                <span></span>
            </label>
        </div>
    </td>
    <td class="text-center">
        <div class="kt-checkbox-inline">
            <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                <input type="checkbox" class="acl" value="ok" name="sales_show" {{ old('sales_show') || array_key_exists('sales.show', $permissions) ? 'checked' : ''}}>&nbsp;
                <span></span>
            </label>
        </div>
    </td>
    <td class="text-center">
        <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
            <input type="checkbox" class="acl" value="ok" name="sales_destroy" {{ old('sales_destroy') || array_key_exists('sales.destroy', $permissions) ? 'checked' : ''}}>&nbsp;
            <span></span>
        </label>
    </td>
        <td class="text-center">
    {{--        <div class="kt-checkbox-inline">--}}
    {{--            <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">--}}
    {{--                <input type="checkbox" class="acl" value="ok" name="sales_status" {{ old('sales_status') || array_key_exists('sales.status', $permissions) ? 'checked' : ''}}>&nbsp;--}}
    {{--                <span></span>--}}
    {{--            </label>--}}
    {{--        </div>--}}
        </td>
</tr>
