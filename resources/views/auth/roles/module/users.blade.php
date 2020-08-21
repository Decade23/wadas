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
