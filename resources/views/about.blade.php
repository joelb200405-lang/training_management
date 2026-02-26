<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        form{
            display: grid;
            place-items: left;
            width: 30%;
        }
    </style>
</head>

<body>
    <h2>Product Section</h2>

    <form action="{{ route("InsertData") }}" method="post">
        @csrf
        
        <label for="">Product Name</label>
        <input type="text" name="product_name" id="">

        <br>

        <label for="">Product Quantity</label>
        <input type="number" name="product_quantity" id="">

        <br>

        <label for="">Product Description</label>
        <input type="text" name="product_description" id="">

        <br>

        <button type="submit">Create</button>
    </form>
</body>

</html>