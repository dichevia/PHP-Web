<form>
    Categories<label>
        <input type="text" name="categories"/>
    </label><br>
    Tags<label>
        <input type="text" name="tags"/>
    </label><br>
    Months<label>
        <input type="text" name="months"/>
    </label><br>
    <input type="submit" value="Generate"/>
</form>

<?php

if (isset($_GET['categories'], $_GET['tags'], $_GET['months'])) {
    $categories = explode(', ', $_GET['categories']);
    $tags = explode(', ', $_GET['tags']);
    $months = explode(', ', $_GET['months']);
}
?>

<h2>categories</h2>
<ul>
    <?php
    foreach ($categories as $category) {
        echo "<li>$category</li>";
    }
    ?>
</ul>
<h2>tags</h2>
<ul>
    <?php
    foreach ($tags as $tag) {
        echo "<li>$tag</li>";
    }
    ?>
</ul>
<h2>months</h2>
<ul>
    <?php
    foreach ($months as $month) {
        echo "<li>$month</li>";
    }
    ?>
</ul>