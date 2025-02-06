@extends('app')

@section('content')
    <div class="container">
        <h2>Manage Users</h2>

        <input type="text" id="search" placeholder="Search users...">

        <table id="user-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
@endsection
