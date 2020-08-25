<!-- Member -->
<tr>
    <th scope="row">Member</th>
    <td class="text-center">
        <div class="kt-checkbox-inline">
            <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                <input type="checkbox" class="acl" value="ok" name="member_create" {{ old('member_create') || array_key_exists('member.create', $permissions) ? 'checked' : ''}}>&nbsp;
                <span></span>
            </label>
        </div>
    </td>
    <td class="text-center">
        <div class="kt-checkbox-inline">
            <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                <input type="checkbox" class="acl" value="ok" name="member_edit" {{ old('member_edit') || array_key_exists('member.edit', $permissions) ? 'checked' : ''}}>&nbsp;
                <span></span>
            </label>
        </div>
    </td>
    <td class="text-center">
        <div class="kt-checkbox-inline">
            <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                <input type="checkbox" class="acl" value="ok" name="member_show" {{ old('member_show') || array_key_exists('member.show', $permissions) ? 'checked' : ''}}>&nbsp;
                <span></span>
            </label>
        </div>
    </td>
    <td class="text-center">
        <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
            <input type="checkbox" class="acl" value="ok" name="member_destroy" {{ old('member_destroy') || array_key_exists('member.destroy', $permissions) ? 'checked' : ''}}>&nbsp;
            <span></span>
        </label>
    </td>
    <td class="text-center">
        <div class="kt-checkbox-inline">
            <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                <input type="checkbox" class="acl" value="ok" name="member_status" {{ old('member_status') || array_key_exists('member.status', $permissions) ? 'checked' : ''}}>&nbsp;
                <span></span>
            </label>
        </div>
    </td>
</tr>
