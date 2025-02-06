@foreach ($users as $user)
    <tr>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
            <select class="role-select" data-user-id="{{ $user->id }}">
                <option value="commenter" {{ $user->role == 'commenter' ? 'selected' : '' }}>Commenter</option>
                <option value="blogger" {{ $user->role == 'blogger' ? 'selected' : '' }}>Blogger</option>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </td>
    </tr>
@endforeach

