@extends('layouts.shared')

@section('title', 'Registered Users')

@section('content')
<style>
    .admin-container {
        padding: 20px;
        background: linear-gradient(to right, #f0f0f0, #ffffff);
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .admin-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .admin-header h1 {
        margin: 0;
        color: #333;
        font-size: 24px;
        font-weight: bold;
    }

    .logout-button {
        background-color: #ff6b6b;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .logout-button:hover {
        background-color: #ff5252;
    }

    .search-bar {
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
    }

    .search-bar input {
        width: calc(100% - 50px);
        padding: 10px 15px;
        border-radius: 5px 0 0 5px;
        border: 1px solid #ddd;
        font-size: 16px;
        outline: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .search-bar button {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 0 5px 5px 0;
        cursor: pointer;
        transition: background-color 0.3s ease;
        display: flex;
        align-items: center;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .search-bar button:hover {
        background-color: #0056b3;
    }

    .search-bar button i {
        margin-right: 5px;
    }

    .table-container {
        overflow-x: auto;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        position: relative;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 0;
        border-radius: 10px;
        overflow: hidden;
    }

    table, th, td {
        border: 1px solid #ddd;
    }

    th, td {
        padding: 15px;
        text-align: left;
    }

    th {
        background-color: #007bff;
        color: white;
        position: sticky;
        top: 0;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:hover {
        background-color: #f1f1f1;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .footer {
        text-align: center;
        margin-top: 20px;
        color: #666;
    }

    .highlight {
        background-color: #ffeb3b;
        color: #333;
    }

    @media (max-width: 768px) {
        .admin-header, .search-bar {
            flex-direction: column;
            align-items: flex-start;
        }

        .search-bar {
            width: 100%;
        }

        .search-bar input, .search-bar button {
            width: 100%;
            margin-top: 5px;
        }

        .search-bar button {
            border-radius: 5px;
        }
    }

    /* Additional styling for better visuals */
    .admin-header h1::after {
        content: '';
        display: block;
        width: 50px;
        height: 3px;
        background: #007bff;
        margin-top: 5px;
        border-radius: 3px;
    }

    .logout-button {
        font-weight: bold;
    }

    select {
        padding: 5px 10px;
        border-radius: 5px;
        border: 1px solid #ddd;
        outline: none;
        transition: border-color 0.3s ease;
    }

    select:focus {
        border-color: #007bff;
    }

    select option {
        padding: 10px;
    }

</style>

<div class="admin-container">
    <div class="admin-header">
        <h1>Registered Users</h1>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-button">Logout</button>
        </form>
    </div>

    <div class="search-bar">
        <form method="GET" action="{{ route('admin.index') }}">
            <input type="text" name="search" placeholder="Search by name" value="{{ request('search') }}">
            <button type="submit">
                <i class="fas fa-search"></i> Search
            </button>
        </form>
    </div>
    
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Birthdate</th>
                    <th>Passport</th>
                    <th>Address</th>
                    <th>Reservation Date</th>
                    <th>Time</th>
                    <th>Package</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($registrations as $index => $registration)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $registration->name }}</td>
                    <td>{{ $registration->email }}</td>
                    <td>{{ $registration->phone }}</td>
                    <td>{{ $registration->birthdate }}</td>
                    <td>{{ $registration->passport }}</td>
                    <td>{{ $registration->address }}</td>
                    <td>{{ $registration->reservation_date }}</td>
                    <td>{{ $registration->time }}</td>
                    <td>{{ $registration->package }}</td>
                    <td>{{ $registration->status }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.updateStatus', $registration->id) }}">
                            @csrf
                            <select name="status" onchange="this.form.submit()">
                                <option value="Not Paid" {{ $registration->status == 'Not Paid' ? 'selected' : '' }}>Not Paid</option>
                                <option value="Paid" {{ $registration->status == 'Paid' ? 'selected' : '' }}>Paid</option>
                            </select>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="footer">
    <p>&copy; {{ date('Y') }} HealthNav. All rights reserved.</p>
</div>

<script src="https://kit.fontawesome.com/a076d05399.js"></script>
@endsection
