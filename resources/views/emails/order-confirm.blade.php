<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Order Confirmation</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      color: #333;
      margin: 0;
      padding: 20px;
    }

    .container {
      background-color: #ffffff;
      border-radius: 8px;
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .header {
      text-align: center;
      padding: 20px 0;
    }

    .header h1 {
      margin: 0;
      font-size: 24px;
      color: #333;
    }

    .order-details {
      margin-top: 20px;
    }

    .order-details h2 {
      font-size: 18px;
      color: #555;
    }

    .order-details table {
      width: 100%;
      border-collapse: collapse;
    }

    .order-details table th,
    .order-details table td {
      padding: 10px;
      border-bottom: 1px solid #ddd;
    }

    .order-details table th {
      text-align: left;
      background-color: #f8f8f8;
    }

    .order-details table td {
      text-align: left;
    }

    .footer {
      margin-top: 20px;
      text-align: center;
      color: #777;
      font-size: 12px;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="header">
      <h1>Order Confirmation</h1>
    </div>

    <div class="order-details">
      <h2>Order Details</h2>
      <table>
        <tr>
          <th>Order ID</th>
          <td>{{ $order->id }}</td>
        </tr>
        <tr>
          <th>User</th>
          <td>{{ $order->user->name }}</td>
        </tr>
        <tr>
          <th>Payment Type</th>
          <td>{{ $order->paymentType->name }}</td>
        </tr>
        <tr>
          <th>Delivery Type</th>
          <td>{{ $order->deliveryType->name }}</td>
        </tr>
        <tr>
          <th>Phone</th>
          <td>{{ $order->phone }}</td>
        </tr>
        <tr>
          <th>City</th>
          <td>{{ $order->city }}</td>
        </tr>
        <tr>
          <th>Main Street</th>
          <td>{{ $order->main_street }}</td>
        </tr>
        <tr>
          <th>House Number</th>
          <td>{{ $order->house_number }}</td>
        </tr>
      </table>
    </div>

    <div class="footer">
      <p>Thank you for your order! If you have any questions, feel free to contact our support team.</p>
    </div>
  </div>
</body>

</html>