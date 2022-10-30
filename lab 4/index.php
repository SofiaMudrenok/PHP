<h1>Palivo.ua</h1>
<?php
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

if (!isset($_SESSION)) {
    session_start();
}

if (empty($_SESSION['Fuelstations'])) {
    $_SESSION['Fuelstations'] = new FuelstationColection();
    $_SESSION['Fuelstations']->defaultFuelstation();
}

$actionToDo = $_POST['action'];
echo $_SESSION['Fuelstations']->showFuelstations();
if ($actionToDo == 'add') {
    if (Fuelstation::validationData($_POST)) {
        $_SESSION['Fuelstations']->addFuelstation(
            new Fuelstation(5, $_POST)
        );
    }
} elseif ($actionToDo == 'edit') {
    if (Fuelstation::validationData($_POST)) {
        $_SESSION['Fuelstations']->editFuelstation(
            $_POST
        );
    }
} elseif ($actionToDo == 'filter') { echo Show::showFuelstations($_SESSION['Fuelstations']->filter($_POST['owner'], $_POST['fuel']));
} elseif ($actionToDo == 'save') { SaveAndLoad::save($_SESSION['Fuelstations']->fuelstations);
} elseif ($actionToDo == 'load') { SaveAndLoad::load();
}
echo Show::showFuelstations($_SESSION['Fuelstations']->fuestatins)
?>
<br>
<form action='<?= $_SERVER['PHP_SELF'] ?>' method='post' id='filterForm'>
    <label> Owner:
        <input type='text' name='owner'>
    </label><br>
    <label> Fuel quantity:
        <input type='number' name='fuel'>
    </label><br>
    <input type='hidden' name='action' value='filter'>
    <input type='submit' value='Filter'>
</form>
<form action='<?= $_SERVER['PHP_SELF'] ?>' method='post' id='addForm'>
    <h2>ADD</h2>
    <label> code:
        <input type='number' name='code'>
    </label><br>
    <label> address:
        <input type='text' name='address'>
    </label><br>
    <label> owner:
        <input type='text' name='owner'>
    </label><br>
    <label> fuel:
        <input type='number' name='fuel'>
    </label><br>
    <label> price:
        <input type='number' name='price'>
    </label><br>
    <input type='hidden' name='action' value='add'>
    <input type='submit' value='add'>
</form>
<form action='<?= $_SERVER['PHP_SELF'] ?>' method='post' id='editForm'>
    <h2>EDIT</h2>
    <label> code:
        <input type='number' name='code'>
    </label><br>
    <label> address:
        <input type='text' name='address'>
    </label><br>
    <label> owner:
        <input type='text' name='owner'>
    </label><br>
    <label> fuel:
        <input type='number' name='fuel'>
    </label><br>
    <label> price:
        <input type='number' name='price'>
    </label><br>
    <input type='hidden' name='action' value='edit'>
    <input type='submit' value='edit'>
</form>
