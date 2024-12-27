<!DOCTYPE html>
<html>
<head>
    <title>Shopping List Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        h1 {
            color: #007bff;
            text-align: center;
        }

        p {
            font-size: 16px;
            line-height: 1.5;
            margin: 10px 0;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 20px 0;
        }

        li {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin: 10px 0;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .item-description {
            font-weight: bold;
            font-size: 16px;
        }

        .item-details {
            text-align: right;
        }

        .item-quantity {
            font-size: 14px;
            color: #555;
        }

        .item-price {
            font-size: 14px;
            color: #28a745;
            font-weight: bold;
        }

        .total-price {
            font-size: 18px;
            font-weight: bold;
            color: #dc3545;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<h1>Your Shopping List</h1>
<p>Here is your shopping list with quantities and prices:</p>
<ul>
    @foreach ($shoppingList->items as $item)
        <li>
            <span class="item-description">{{ $item->description }}</span>
            <div class="item-details">
                <div class="item-quantity">Quantity: {{ $item->quantity }}</div>
                <div class="item-price">Price: £{{ number_format($item->price, 2) }}</div>
            </div>
        </li>
    @endforeach
</ul>
<p class="total-price">Total Price: £{{ number_format($totalAmount, 2) }}</p>
</body>
</html>
