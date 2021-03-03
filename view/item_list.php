<form action="<?=$_SERVER['PHP_SELF']?>" method="get">
    <input type="hidden" name="action" value="viewCategory"/>
    <label for="categories">Category:</label>
    <select name="category" id="categories">
        <option value="" selected disabled hidden>View All Categories</option>
        <option value="-1>">None</option>
        <?php foreach ((array) $toDoCategories as $toDoCategory) :?>
            <option value="<?=$toDoCategory['categoryID']?>"><?=$toDoCategory['categoryName']?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit" class="button">Submit</button>
</form>
<?php  if(empty($toDoItems)) { ?>
    <section class="Border">
        <table>
            <tr>
                <td><div class="NoToDoItems">No to do list items exist yet.</div></td>
            </tr>
        </table>
    </section>
<?php } else{?>
    <section>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="toDoTableForm">
            <input type="hidden" name="action" value="deleteItem"/>
            <table>
                <thead>
                    <th id="title">Title</th>
                    <th id="description">Description</th>
                    <th id="category" colspan="2">Category</th>
                </thead>
                <tbody>
                <?php foreach ($toDoItems as $toDoItem) : ?>
                <tr>
                    <td headers="title"><?=$toDoItem['Title']?></td>
                    <td headers="description"><?=$toDoItem['Description']?></td>
                    <td headers="category"><?=$toDoItem['categoryName'] ?? 'None' ?></td>
                    <td headers="title">
                        <button type="submit" name="deleteToDoItem" class="button" value="<?=$toDoItem['ItemNum']?>">Remove</button>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </form>
    </section>
<?php } ?>

<div>
    <p><a href="<?=$_SERVER['PHP_SELF']."?action=addItem";?>">Click here</a> to add a new item to the list.</p>
    <p><a href="<?=$_SERVER['PHP_SELF']."?action=categoryList";?>">View/Edit categories</a></p>
</div>