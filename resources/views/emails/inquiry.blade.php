<!DOCTYPE html>
<html>

<head>
    <title>New Inquiry</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #f4f4f4;
            text-align: left;
        }
    </style>
</head>

<body>
    <h2>New Inquiry Received</h2>
    <p>Here are the details of the inquiry:</p>
    <table>
        <tr>
            <th>Name</th>
            <td>{{ $name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $email }}</td>
        </tr>
        <tr>
            <th>Phone</th>
            <td>{{ $phone }}</td>
        </tr>
        <tr>
            <th>Address</th>
            <td>{{ $address }}</td>
        </tr>
        <tr>
            <th>Message</th>
            <td>{{ $user_message }}</td>
        </tr>
    </table>
</body>

</html>