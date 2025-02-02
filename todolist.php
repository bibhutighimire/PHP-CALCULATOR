<?php
session_start(); // session_start() is required for us to access any values stored in this user's session.
// Note: we are not including calc-history.php, because we aren't using our "showCalcHistory()" function in this file.
global $title;
$title = 'TO DO LIST';
include 'templates/header.php';
?>

  <h1><?php echo $title; ?></h1>


  <?php
    // $_POST $_GET
    echo '<pre>'; // var_dump is our best friend, it outputs all the info for the variable and/or expression we pass it!
    var_dump(  $_POST );
    echo '</pre>';

    echo '<pre>'; // var_dump is our best friend, it outputs all the info for the variable and/or expression we pass it!
    var_dump(  $_SESSION );
    echo '</pre>';

    // Prepare to store some warnings for the user...
   
    $error = array();
   
    // Check if the form fields are all submitted...
    /**
     * isset() Checks to see if a value is declared / defined at all.
     * empty() Checks to see if a value is an empty string, zero, or the array has no elements.
     */
    if(isset($_POST['reset']))
{ 
session_destroy();
}

    if ( isset( $_POST['todoInput'] ) && !empty( $_POST['todoInput'] ) ) {
        $error[]="";
      $todoInput =  $_POST['todoInput']; 
    } else {
      $error[] = 'To Do input field can not be empty'; 
    }
    
    // Make sure we have values we can use.
    
      // Check if our result is available.
      if ( isset( $todoInput ) ) {
        // If we want to push to an array... it needs to be an array! Let's make sure it is the proper data-type if it isn't already defined.
        if ( !isset( $_SESSION['todoListItemSession'] ) || empty( $_SESSION['todoListItemSession'] ) ) {
          $_SESSION['todoListItemSession'] = array();
        }
        array_push( // Add this result to the 'calc-history' session array.
          $_SESSION['todoListItemSession'],
          "$todoInput"
        );
      }

        // If we want to push to an array... it needs to be an array! Let's make sure it is the proper data-type if it isn't already defined.
        if ( isset( $_POST['completed']) ) {
            // If we want to push to an array... it needs to be an array! Let's make sure it is the proper data-type if it isn't already defined.
            if ( !isset( $_SESSION['historyItemSession'] ) || empty( $_SESSION['historyItemSession'] ) ) {
              $_SESSION['historyItemSession'] = array();
            }
            array_push( // Add this result to the 'calc-history' session array.
              $_SESSION['historyItemSession'],
              "$historyItem"
            );
          }
      
?>
 

  <form action="TODOLIST.php" method="POST">
     <!-- <?php if ( !empty( $error ) ) : ?>
      <ul>
        <?php foreach ( $error as $errorInd ) : ?>
          <li>
            <?php echo $errorInd; ?>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>  -->

    <label for="todoInput">
     Enter your new To Do's:
      <input type="text" name="todoInput" id="todoInput">
    </label>
    <div>
    <button type="submit" name="addToDoList">Add to the TO DO List</button>
    <button type="submit" name="reset" value="Reset" >RESET</button>
        </div>
  </form>
<h2>TO DO LIST</h2>
<?php
if ( isset( $_SESSION['todoListItemSession'] ) && !empty( $_SESSION['todoListItemSession'] ) ) {
    ?>
    <div class="toDoListUL">
     <ul>
        <?php foreach ( $_SESSION['todoListItemSession'] as $historyItem ) : ?>
            <form action="todolist.php" method="POST">
          <li>
            <?php echo $historyItem; ?>
           <button type="submit" name="completed">COMPLETE</button></li>
          </form>
        <?php endforeach; ?>
      </ul>
    </div>
 <?php
  }?>

<h2>COMPLETED TO DO LIST</h2>
<?php
if ( isset( $_SESSION['historyItemSession'] ) && !empty( $_SESSION['historyItemSession'] ) ) {
    ?>
     <ul>
        <?php foreach ( $_SESSION['historyItemSession'] as $historyItem ) : ?>
          <li>
            <?php echo $historyItem; ?>
          </li>
        <?php endforeach; ?>
      </ul>
 <?php
  }?>
      <?php include 'templates/footer.php';