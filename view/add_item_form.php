<h2>Add Item</h2>
<form action="<?=$_SERVER['PHP_SELF'].'?'?>" method="post" class="ft">
    <input type="hidden" name="action" value="addItem"/>
    <table>
            <tr><th><label for="categories">Category</label>:</th>
                <td>
                    <select name="categoryID" id="categories">
                        <option value="" selected disabled hidden>Select a category</option>
                        <?php foreach ((array) $toDoCategories as $toDoCategory) :?>
                            <option value="<?=$toDoCategory['categoryID']?>"><?=$toDoCategory['categoryName']?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>

        <tr><th>Title:</th>
            <td><input type="text" name="title" maxlength="20"
                       title="Please enter a title up to 20 characters long." placeholder="Enter a title..." required></td></tr>
        <tr><th>Description:</th>
            <td><textarea name="description" rows="3" cols="25"  maxlength="50"
                          title="Please enter a brief description up to 50 characters long."
                          placeholder="Enter a brief description..." required></textarea></td></tr>
        <tr><td></td><td><input type="submit" value="Add Item"/></td></tr>
    </table>
</form>
<div>
    <p><a href="<?=$_SERVER['PHP_SELF']?>">View To Do List</a></p>
</div>