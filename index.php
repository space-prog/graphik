<!DOCTYPE html>
<html>
<head>
    <title>Object List</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
    </style>
</head>
<body>
    <?php
    // Initialize $arrName as an array of objects
    $arrName = isset($_POST['array']) ? json_decode($_POST['array'], true) : [];

    // Handle adding a new object to the array
    if (isset($_POST['name']) && isset($_POST['age']) && $_POST['name'] . '' && $_POST['age'] . '') {
        $name = $_POST['name'];
        $age = $_POST['age'];
        $newObject = ['name' => $name, 'age' => $age]; // New object with name and age
        array_push($arrName, $newObject); // Add the object to the array
    }

    // Handle deleting an object from the array
    if (isset($_POST['delete'])) {
        $ind = $_POST['delete']; // Index of the object to delete
        array_splice($arrName, $ind, 1); // Remove the object at the specified index
    }

    // Display the objects in an HTML table
    echo "<table><thead><tr><th>Ім'я</th><th>Кількість років</th><th>Видалення</th></tr></thead><tbody>";
    foreach ($arrName as $index => $obj) {
        echo "<tr>
                <td>{$obj['name']}</td>
                <td>{$obj['age']}</td>
                <td>
                    <form action='index.php' method='post'>
                        <input type='hidden' name='delete' value='$index'>
                        <button type='submit'>Видалити</button>
                    </form>
                </td>
              </tr>";
    }
    echo "</tbody></table>";

    ?>

    <!-- Form to add a new object -->
    <form action="index.php" method="post">
        <input type="text" name="name" placeholder="Name" required>
        <input type="number" name="age" placeholder="Age" required>
        <input type="hidden" name="array" value='<?= json_encode($arrName) ?>'>
        <button type="submit">Add</button>
    </form>
</body>
</html>
