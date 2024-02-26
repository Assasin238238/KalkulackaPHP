<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulačka</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Kalkulačka</h1>
    <form method="post">
        <label for="num1">První číslo:</label>
        <input type="number" step="any" name="num1" id="num1" required value="<?php echo isset($num1) ? $num1 : ''; ?>"><br><br>

        <label for="operation">Operace:</label>
        <select name="operation" id="operation">
            <option value="add">Sčítání</option>
            <option value="subtract">Odčítání</option>
            <option value="multiply">Násobení</option>
            <option value="divide">Dělení</option>
            <option value="power">Exponenciace</option>
            <option value="sqrt">Druhá odmocnina</option>
        </select><br><br>

        <label for="num2">Druhé číslo:</label>
        <input type="number" step="any" name="num2" id="num2" required value="<?php echo isset($num2) ? $num2 : ''; ?>"><br><br>

        <input type="submit" value="Spočítat">
        <input type="reset" value="Vymazat">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $num1 = isset($_POST["num1"]) ? filter_var($_POST["num1"], FILTER_SANITIZE_NUMBER_FLOAT) : null;
        $num2 = isset($_POST["num2"]) ? filter_var($_POST["num2"], FILTER_SANITIZE_NUMBER_FLOAT) : null;
        $operation = $_POST["operation"];

        switch ($operation) {
            case "add":
                $result = $num1 + $num2;
                break;
            case "subtract":
                $result = $num1 - $num2;
                break;
            case "multiply":
                $result = $num1 * $num2;
                break;
            case "divide":
                if ($num2 != 0) {
                    $result = $num1 / $num2;
                } else {
                    echo "<p class='error'>Dělení nulou není povoleno.</p>";
                }
                break;
            case "power":
                $result = pow($num1, $num2);
                break;
            case "sqrt":
                $result = sqrt($num1);
                break;
            default:
                echo "<p class='error'>Neplatná operace.</p>";
                break;
        }

        if (isset($result)) {
            echo "<p>Výsledek operace: " . number_format($result, 2) . "</p>";
        }
    }
    ?>
</body>
</html>
