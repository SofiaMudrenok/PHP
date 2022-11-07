<?php
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});
if (!isset($_SESSION)) {
    session_start();
}
if (empty($_SESSION['Students'])) {
    $_SESSION['Students'] = new StudentsCollection();
    $_SESSION['Students']->defaultStud();
}
if ($_POST['action'] == 'edit') {
if (Student::validationData($_POST)) {
        $_SESSION['Students']->edit(
           $_POST
        );
}
}

echo Show::showStud($_SESSION['Students']->students)
?>

<form action='<?= $_SERVER['PHP_SELF'] ?>' method='post' id='addForm'>
    ADD <br>
    <label> name:
        <input type='text' name='name'>
    </label><br>
    <label> course:
        <input type='text' name='course'>
    </label><br>
    <label> specialization:
        <input type='text' name='specialization'>
    </label><br>
    <input type='hidden' name='action' value='add'>
    <input type='submit' value='add'>
</form>
