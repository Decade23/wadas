<!-- Config Email -->
<tr>
    <th scope="row">Config Email</th>
    <td class="text-center">
        <div class="kt-checkbox-inline">
            <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                <input type="checkbox" class="acl" value="ok" name="config_email_create" {{ old('config_email_create') || array_key_exists('config_email.create', $permissions) ? 'checked' : ''}}>&nbsp;
                <span></span>
            </label>
        </div>
    </td>
    <td class="text-center">
        <div class="kt-checkbox-inline">
            <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                <input type="checkbox" class="acl" value="ok" name="config_email_edit" {{ old('config_email_edit') || array_key_exists('config_email.edit', $permissions) ? 'checked' : ''}}>&nbsp;
                <span></span>
            </label>
        </div>
    </td>
    <td class="text-center">
        <div class="kt-checkbox-inline">
            <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                <input type="checkbox" class="acl" value="ok" name="config_email_show" {{ old('config_email_show') || array_key_exists('config_email.show', $permissions) ? 'checked' : ''}}>&nbsp;
                <span></span>
            </label>
        </div>
    </td>
    <td class="text-center">
        <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
            <input type="checkbox" class="acl" value="ok" name="config_email_destroy" {{ old('config_email_destroy') || array_key_exists('config_email.destroy', $permissions) ? 'checked' : ''}}>&nbsp;
            <span></span>
        </label>
    </td>
    <td class="text-center">
{{--        <div class="kt-checkbox-inline">--}}
{{--            <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">--}}
{{--                <input type="checkbox" class="acl" value="ok" name="config_email_status" {{ old('config_email_status') || array_key_exists('config_email.status', $permissions) ? 'checked' : ''}}>&nbsp;--}}
{{--                <span></span>--}}
{{--            </label>--}}
{{--        </div>--}}
    </td>
</tr>
