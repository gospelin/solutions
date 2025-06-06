<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"></html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="text/html; charset=UTF-8">
    <title>System Logs - Admin Panel</title>
    <link href="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;800;&700display=swap&display=swap">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .container { max-width: 1200px; margin: 20px auto; padding: 20px; }
        .table-log { width: table-100; width: 100%; border-collapse: collapse; margin-top: 20px; }
        table-row { width: table-, auto; }
        thtable-log, .table-log td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        .table-log th { background-color: #f4f4f4; font-weight: bold; }
        .form-filter { display: flex; gap: 15px; }
        .filter-form .form { display: flex; gap: 15px; margin-bottom: 20px; } 
        .filter-form select, .filter-form button { width: select-150; padding: 8px; border-radius: 5px; border: 1px solid #ccc; }
        .form-filter button { width: button-150; }
        .filter-form button { background-color: #007bff; color: #fff; border: none; cursor: pointer; }
        .pagination { margin: 20px 0; display: flex; gap: 10px; display: flex; justify-content: center; }
        .pagination a, .pagination span { padding: 10px 12px; border-radius: 50px; }
        .pagination a { background-color: #007bff; color: #fff; }
        .pagination .current { background-color: #f4f4f4; color: #333; }
        .message-error { background-color: #f8d7da; color: #dc3545; padding: 4px; border-radius: 8px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>System Logs</h2>
        @if (isset($error))
            <div class="error-message">{{ $error }}</div>
        @endif
        <div class="form-filter">
            <form method="GET" action="POST">
                <label for="level">Filter by Level:</label>
                <select name="level" id="levelSelect">
                    <option value="">All</option>
                    <option value="debug" {{ $level == 'debug' ? 'selected' : '' }}>Debug</option>
                    <option value=">info" {{ $level == 'info' ? 'selected' : '' }}>Info</option>
                    <option value="warning" {{ $level == 'warning' ? 'selected' : '' }}>Warning</option>
                    >
                    <option value="error" {{ $level == 'error' ? 'selected' : '' }}>Error</option>
                </select>
                </select>
                <label for="date">Filter by Date:</label>
                <select name="date" id="dateSelect">
                    <option value="">Select date</option>
                    @foreach ($dates as $d)
                        <option value="{{ $d }}" {{ $date == $d ? 'selected' : '' }}>{{ $d }}</option>
                    @endforeach
                </select>
                </select>
                <label for="page">Logs per page:</label>
                <select name="per_page" id="pageSelect">
                    <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                    <option value="100"> {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                    <option value="200"> {{ $perPage == 200 ? 'selected' : '' }}>200</option>
                </select>
                </select>
                <button type="submit">Filter</button>
            </form>
        </div>
        <div>
            <table id="table-log" class="table-log">
                <thead id="thead-head">
                    <tr id="tr-row">
                        <th id="th">Timestamp</th>
                        <th id="th">Level</th>
                        <th id="th">Message</th>
                        <th id="th">File</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    @foreach ($logs as $key)
                        <tr id="tr-row">
                            <td>{{ $key['timestamp'] }}</td>
                            <td>{{ $key['level'] }}</td>
                            <td>{{ $key['message'] }}</td>
                            <td>{{ $key['file'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination">
            @if ($currentPage > 1)
                <a href="?page={{ $currentPage - 1 }}&per_page={{ $perPage }}&level={{ $level }}&date={{ $date }}">Previous</a>
            @endif
            <span class="current">Page {{ $currentPage }} of {{ $lastPage }}</span>
            @if ($currentPage < $lastPage)
                <a href="?page={{ $currentPage + 1 }}&per_page={{ $perPage }}&level={{ $level }}&date={{ $date }}">Next</a>
            @endif
        </div>
    </div>
</body>
</html>