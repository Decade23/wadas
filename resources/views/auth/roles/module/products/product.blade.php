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
