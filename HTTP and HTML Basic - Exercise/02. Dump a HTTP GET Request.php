<form>
    <div>Name:</div>
    <label>
        <input type="text" name="personName"/>
    </label>
    <div>Age:</div>
    <label>
        <input type="number" name="age"/>
    </label>
    <div>Town:</div>
    <label>
        <select name="townId">
            <option value="10">Sofia</option>
            <option value="20">Varna</option>
            <option value="30">Plovdiv</option>
        </select>
    </label>
    <div><input type="submit"/></div>
</form>

<?php

var_dump($_GET);
