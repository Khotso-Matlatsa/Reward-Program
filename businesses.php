<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content=
"width=device-width, initial-scale=1.0">
    <title>Responsive Table</title>
    <style>
        table {
            width: 80%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 35px;
            border: 1px solid #ddd;
        }

        @media screen and (max-width: 600px) {

            table,
            thead,
            tbody,
            th,
            td,
            tr {
                display: block;
            }

            thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr {
                margin-bottom: 20px;
                border: 1px solid #ddd;
            }

            td {
                border: none;
                position: relative;
                padding-left: 50%;
            }

            td:before {
                position: absolute;
                left: 6px;
                content: attr(data-label);
                font-weight: bold;
            }
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Business Types</th>
                <th>Business names</th>
                <th>Business names</th>
                <th>Business names</th>
                <th>Business names</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td data-label="Location">Restaurant</td>
               <td data-label="Maseru Mall"><a href="menu1.php"> The Market</a></td>
                <td data-label="Lower Thetsane"><a href="brands.php">KFC</a></td>
                <td data-label="Ha-Tsolo"><a href="menu1.php">Honchos</a></td>
                <td data-label="Lesia"><a href="brands.php">Galito's</a></td>
            </tr>
            <tr>
                <td data-label="Location">Food stores</td>
               <td data-label="Maseru Mall"><a href="menu1.php"> Game</a></td>
                <td data-label="Lower Thetsane"><a href="brands.php">Checkers</a></td>
                <td data-label="Ha-Tsolo"><a href="menu1.php">SHOPRITE</a></td>
                <td data-label="Lesia"><a href="brands.php">PicknPay</a></td>
            </tr>
            <tr>
                <td data-label="Location">Pharmacy stores</td>
                <td data-label="Maseru Mall"><a href="brands.html">Beautez Pharmacy</a></td>
                <td data-label="Lower Thetsane"><a href="menu1.html">Husteds</a></td>
                <td data-label="Ha-Tsolo"><a href="brands.html">SHOPRITE</a></td>
                <td data-label="Lesia"><a href="menu1.html">PEP</a></td>
            </tr>
            <tr>
                <td data-label="Location">Clothing stores</td>
            	<td data-label="Maseru Mall"><a href="menu1.html"> Jet</a></td>
                <td data-label="Lower Thetsane"><a href="brands.html">Mr Price</a></td>
                <td data-label="Ha-Tsolo"><a href="menu1.html">Legit</a></td>
                <td data-label="Lesia"><a href="brands.html">PEP</a></td>
            </tr>
            <tr>
                <td data-label="Location">Furniture stores</td>
            	<td data-label="Maseru Mall"><a href="menu1.html"> OK Furniture</a></td>
                <td data-label="Lower Thetsane"><a href="brands.html">Prestige</a></td>
                <td data-label="Ha-Tsolo"><a href="menu1.html">Lewis</a></td>
                <td data-label="Lesia"><a href="brands.html">PEP</a></td>
            </tr>			
                
	
        </tbody>
    </table>
</body>

</html>
