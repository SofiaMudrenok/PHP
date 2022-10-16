<h1>Palivo.ua</h1>
<?php
function getSimpleData() {
    return [
        [
            "code" => 1,
            "address" => "Kapushanska",
            "owner" => "WOG",
            "fuel" => 500,
            "price" => 41
        ],
        [
            "code" => 2,
            "address" => "Minayska",
            "owner" => "WOG",
            "fuel" => 600,
            "price" => 41
        ],
        [
            "code" => 3,
            "address" => "Sobranetska",
            "owner" => "OKKO",
            "fuel" => 550,
            "price" => 40
        ],
        [
            "code" => 4,
            "address" => "Minayska",
            "owner" => "OKKO",
            "fuel" => 400,
            "price" => 40
        ],
        [
            "code" => 5,
            "address" => "Timiryazeva",
            "owner" => "WOG",
            "fuel" => 300,
            "price" => 41
        ],
    ];
}

function getUniqueCode(array $fuelstations, int $proposedCode) {
    if (count($fuelstations) == 0) {
        return $proposedCode;
    }
    $max = $fuelstations[0]['code'];
    foreach ($fuelstations as $fuelstation) {
        if ($fuelstation['code'] > $max) {
            $max = $fuelstation['code'];
        }
    }
    if ($proposedCode > $max) {
        return $proposedCode;
    }
    $max++;
    return $max;
}
function sortByFuelQuantity(int $x, string $owner, $arr) {
    $newArr = [];
    for ($i = 0; $i < count($arr); $i++) {
        if ($owner == $arr[$i]["owner"] && $arr[$i]["fuel"] >= $x) {
            array_push($newArr, $arr[$i]);
        }
    }
    return $newArr;
}

function fillData($factories, $data) {
    return [
        "code" => getUniqueCode($factories, $data['code']),
        "address" => $data["address"],
        "owner" => $data["owner"],
        "fuel" => $data["fuel"],
        "price" => $data["price"]
    ];
}
function validateFactoryData($data):bool {
    if (empty($data["code"])
        || empty($data["address"])
        || empty($data["owner"])
        || empty($data["fuel"])
        || empty($data["price"])) {
        return false;
    }
    return true;
}

session_start();

$fourthPoint = $_GET['fourthPoint'];
if (isset($_SESSION['fuelstation'])) {
    $fuelstation = $_SESSION['fuelstation'];
} else {
    $fuelstation = getSimpleData();
}

if (!empty($_GET["edit"])) {
    if (validateFactoryData($_GET)) {
        for ($i = 0; $i < count($fuelstation); $i++) {
            if ($_GET["edit"] == $fuelstation[$i]["code"]) {
                $fuelstation[$i] = fillData($fuelstation, $_GET);
                break;
            }
        }
    } else {
        //TODO: Error handling
    }
} elseif (array_key_exists('code', $_GET)) {
    if (validateFactoryData($_GET)) {
        $fuelstation[] = fillData($fuelstation, $_GET);
    } else {
        //TODO: Error handling
    }
}


$_SESSION["fuelstation"] = $fuelstation;

echo "<h2>Таблиця всіх АЗС</h2>";
echo "<table border='1px'>";
echo "<tr> <th>Code</th> <th>Address</th> <th>Owner</th> <th>Fuel</th> <th>Price</th> </tr>";
for($i = 0; $i < count($fuelstation); $i++){
    echo "<tr>";
    foreach ($fuelstation[$i] as $key=> $value){
        if ($value != null) {
            echo "<td>$value</td>";
        }
    }
    echo "</tr>";
}
echo "</table>";


$arr = sortByFuelQuantity(500,"WOG",$fuelstation);
echo "<h2>Запит  наявності X літрів пального</h2>";
echo "<span>X = 500</span><br><span>АЗС: WOG</span>";
echo "<table border='1px'>";
echo "<tr> <th>Code</th> <th>Address</th> <th>Owner</th> <th>Fuel</th> <th>Price</th> </tr>";
for ($i = 0; $i < count($arr); $i++) {
    echo "<tr>";
    foreach ($arr[$i] as $key => $value) {
        echo "<td>$value</td>";
    }
    echo "</tr>";
}
echo "</table>";
if(isset($_POST["save"])){
    $file = fopen("fuel.txt", "w");
    fwrite($file, serialize($_SESSION["fuelstation"]));
    fclose($file);
}
elseif(isset($_POST["load"])) {
    $_SESSION['fuelstation'] = unserialize(file_get_contents("fuel.txt"));
}

?>

<form method="get" action="">
    <input type="number" name="edit" placeholder="Pick Code"> <br>
    <input type="number" name="code" placeholder="Code"> <br>
    <input type="text"  name="address" placeholder="Address"> <br>
    <input type="text"  name="owner" placeholder="Owner"> <br>
    <input type="number" name="fuel" placeholder="Fuel "> <br>
    <input type="number" name="price"  placeholder="Price"> <br>
    <input type="submit" name="btn-ok" value="ok">

    <input type="hidden" name="fourthPoint" value="">
</form>
<form action="<?php $_SERVER['PHP_SELF'];?>" method="post" id="save">
    <input type="hidden" name="save" value="save">
    <input type="submit" value='Save to file'>
</form>

<form action="<?php $_SERVER['PHP_SELF'];?>" method="post" id='load'>
    <input type='hidden' name='action' value='load'>
    <input type='submit' value='Upload from file'>
</form>

</div>