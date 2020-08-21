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
