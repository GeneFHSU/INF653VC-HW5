<h2>Category List</h2>
<?php  if(empty($toDoCategories)) { ?>
    <section class="Border">
        <div class="NoToDoItems">No to do list items exist yet.</div>
    </section>
<?php } else{?>
    <section>
        <form action="<?=$_SERVER['PHP_SELF']."?action=categoryList" ?>" method="post" class="toDoTableForm">
            <input type="hidden" name="action" value="deleteCategory"/>
            <table>
                <thead>
                <th id="name"colspan="2">Name</th>
                </thead>
                <tbody>
                <?php foreach ($toDoCategories as $toDoCategory) : ?>
                    <tr>
                        <td headers="name"><?=$toDoCategory['categoryName']?></td>
                        <td headers="name">
                            <button type="submit" name="deleteCategoryID" class="button" value="<?=$toDoCategory['categoryID']?>">Remove</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </form>
    </section>
<?php } ?>
    <h3>Add Category</h3>
<form action="<?php echo $_SERVER['PHP_SELF']."?action=categoryList"; ?>" method="post">
    <input type="hidden" name="action" value="addCategory"/>
    <div>
        Name:<input name="categoryName" type="text" maxlength="20" required/>
        <button type="submit" class="button">Submit</button>
    </div>
</form>

<div>
    <br/>
<a href="<?php echo $_SERVER['PHP_SELF']; ?>">View To Do List</a>
</div>