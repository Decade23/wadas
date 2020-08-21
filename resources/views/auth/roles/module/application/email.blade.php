<!-- Application Email -->
<tr>
    <th scope="row">Application Email</th>
    <td class="text-center">
        <div class="kt-checkbox-inline">
            <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                <input type="checkbox" class="acl" value="ok" name="apl_email_create" {{ old('apl_email_create') || array_key_exists('apl_email.create', $permissions) ? 'checked' : ''}}>&nbsp;
                <span></span>
            </label>
        </div>
    </td>
    <td class="text-center">
        <div class="kt-checkbox-inline">
            <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                <input type="checkbox" class="acl" value="ok" name="apl_email_edit" {{ old('apl_email_edit') || array_key_exists('apl_email.edit', $permissions) ? 'checked' : ''}}>&nbsp;
                <span></span>
            </label>
        </div>
    </td>
    <td class="text-center">
        <div class="kt-checkbox-inline">
            <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                <input type="checkbox" class="acl" value="ok" name="apl_email_show" {{ old('apl_email_show') || array_key_exists('apl_email.show', $permissions) ? 'checked' : ''}}>&nbsp;
                <span></span>
            </label>
        </div>
    </td>
    <td class="text-center">
        <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
            <input type="checkbox" class="acl" value="ok" name="apl_email_destroy" {{ old('apl_email_destroy') || array_key_exists('apl_email.destroy', $permissions) ? 'checked' : ''}}>&nbsp;
            <span></span>
        </label>
    </td>
        <td class="text-center">
    {{--        <div class="kt-checkbox-inline">--}}
    {{--            <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">--}}
    {{--                <input type="checkbox" class="acl" value="ok" name="apl_email_status" {{ old('apl_email_status') || array_key_exists('apl_email.status', $permissions) ? 'checked' : ''}}>&nbsp;--}}
    {{--                <span></span>--}}
    {{--            </label>--}}
    {{--        </div>--}}
        </td>
</tr>
