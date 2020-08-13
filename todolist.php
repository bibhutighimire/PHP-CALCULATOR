<?php
session_start(); // session_start() is required for us to access any values stored in this user's session.
// Note: we are not including calc-history.php, because we aren't using our "showCalcHistory()" function in this file.
global $title;
$title = 'TO DO LIST';
include 'templates/header.php';
?>

  <h1><?php echo $title; ?></h1>

  <!-- <?php include 'templates/navigation.php'; ?> -->

  <?php
    // $_POST $_GET
    echo '<pre>'; // var_dump is our best friend, it outputs all the info for the variable and/or expression we pass it!
    var_dump( $_POST );
    echo '</pre>';

    // Prepare to store some warnings for the user...
    $error = array();

    // Check if the form fields are all submitted...
    /**
     * isset() Checks to see if a value is declared / defined at all.
     * empty() Checks to see if a value is an empty string, zero, or the array has no elements.
     */
    if ( isset( $_GET['num1'] ) && !empty( $_POST['num1'] ) ) {
      $num1 = (integer) $_POST['num1']; // We can type-cast this to a number using (integer) before the value. It does its best to convert to integer in this case.
    } else {
      $error[] = 'First operand is missing.'; // array_push( $warnings, 'New warning.' )
    }
    

    // Make sure we have values we can use.
    
      // Check if our result is available.
      if ( isset( $result ) ) {
        // If we want to push to an array... it needs to be an array! Let's make sure it is the proper data-type if it isn't already defined.
        if ( !isset( $_SESSION['calc-history'] ) || empty( $_SESSION['calc-history'] ) ) {
          $_SESSION['calc-history'] = array();
        }
        array_push( // Add this result to the 'calc-history' session array.
          $_SESSION['calc-history'],
          "$num1 $operator $num2 = $result"
        );
      }
    }
  ?>

  <h2>PHP Calculator Form</h2>
  <form action="calc.php" method="GET">
    <?php if ( !empty( $error ) ) : ?>
      <ul>
        <?php foreach ( $error as $errorInd ) : ?>
          <li>
            <?php echo $errorInd; ?>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
    <label for="num1">
      First Operand:
      <input type="number" name="num1" id="num1">
    </label>
    
  </form>

<?php include 'templates/footer.php';