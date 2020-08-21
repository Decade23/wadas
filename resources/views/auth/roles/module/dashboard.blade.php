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
