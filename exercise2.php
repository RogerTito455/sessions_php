<?php
session_start();
// Inicializar inventario si no existe
if (!isset($_SESSION['inventory'])) {
    $_SESSION['inventory'] = [
        'milk' => 0,
        'softDrink' => 0
    ];
}

// Inicializar trabajador
if (!isset($_SESSION['worker'])) {
    // $_SESSION['worker'] = "";
}

//Guardar nombre trabajador que usuario coloque
if (isset($_POST['worker'])) {
    $_SESSION['worker'] = $_POST['worker'];
}

if (isset($_POST['product'], $_POST['quantity'])) {
    $product = $_POST['product'];
    $quantity = (int) $_POST['quantity'];
    if (isset($_POST['add'])) {
        $_SESSION['inventory'][$product] += $quantity;
    }
    // Eliminar producto
    if (isset($_POST['remove'])) {
        if ($_SESSION['inventory'][$product] < $quantity) {
            echo 'No se puede colocar más de este producto';
        } else {
            $_SESSION['inventory'][$product] -= $quantity;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h1>Supermarket management</h1>
    <form method="post">
        <label for="worker">Worker name</label>
        <input type="text" name="worker" required>
        <br>
        <h2>Choose product:</h2>
        <select name="product">
            <option value="milk">Milk</option>
            <option value="softDrink">Soft Drink</option>
        </select>
        <h2>Product quantitiy</h2>
        <input type="number" name="quantity">
        <br>
        <br>
        <button type="submit" name="add">Add</button>
        <button type="submit" name="remove">Remove</button>
        <button type="reset" name="reset">Reset</button>
    </form>
    <h2>Inventory</h2>
    <?php
    echo 'Worker: ' . $_SESSION['worker'] . '<br>';
    foreach ($_SESSION['inventory'] as $product => $units) {
        echo "Units " . ($product === 'softDrink' ? 'Soft Drink' : ucfirst($product)) . ": " . $units . "<br>";
        //Foreach para poder imprimir todos los productos del array correctamente
    }

    ?>
</body>

</html>