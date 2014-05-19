<?php
/*
CodeUp Day 6
Dev: Frank Pigeon
Date: May 13 2014
Description:
Create a new directory in your vagrant-lamp directory named todo_list with a file named todo.php containing the code above. Use git init to initialize a new local repository in that directory and commit your code. Create a new remote repository on GitHub called CLI_Todo_List and add the remote to your local repository so you can push your code.

After each exercise item, commit and push changes to your GitHub repository.

Update the code to allow upper and lowercase inputs from user for all menu items. Test adding, removing, and quitting.

Update the program to start numbering the list with 1 instead of 0. Make sure remove still works as expected.

WEEK 3
1) Open your todo.php file for editing. Commit changes and push to GitHub for each step.

2) Add a (S)ort option to your menu. When it is chosen, it should call a function called sort_menu().

3) When sort menu is opened, show the following options "(A)-Z, (Z)-A, (O)rder entered, (R)everse order entered".

4) When a sort type is selected, order the TODO list accordingly and display the results.
*/

// Create array to hold list of todo items
$items = array();

function sort_menu($array) {
    echo "(A)-Z, (Z)-A, (O)rder entered, (R)everse order entered: ";
    $input = get_input(TRUE); //capture input and UPPERCASE IT

    if ($input == 'A'){
        asort($array);
    }//end of alphabetic
    elseif ($input == 'Z'){
        arsort($array);
    }//end of reverse alphabetic
    elseif ($input == 'O'){
        ksort($array);
    }//end of order entered
    elseif ($input == 'R'){
        krsort($array);
    }//end of reverse order entered
    return $array;
    //display new array
    //print_r($array);
    //list_items($array);
}// end of sort_menu

// List array items formatted for CLI
function list_items($list){
    $result = '';
    foreach ($list as $key => $item) {
        $result .= '[' . ($key + 1) .'] '. $item . PHP_EOL;
    } //end of foreach

    return $result;
} // end of list_items

// Get STDIN, strip whitespace and newlines, 
// and convert to uppercase if $upper is true
function get_input($upper = FALSE) 
{
    $result = trim(fgets(STDIN));
    return $upper ? strtoupper($result) : $result;    
} //end of get_input

// The loop!
do {
    // Iterate through list items
    //$key = $key + 1;
    echo list_items($items); //NEW    

    // Show the menu options
    echo '(N)ew item, (R)emove item, (S)ort, (Q)uit : ';

    // Get the input from user
    // Use trim() to remove whitespace and newlines
    //$input = trim(fgets(STDIN)); //OLD
    $input = get_input(TRUE); //NEW
    //$input = trim(strtoupper(fgets(STDIN));
    // Check for actionable input
    if ($input == 'N') {
        // Ask for entry
        echo 'Enter item: ';
        // Add entry to list array
        $items[] = get_input();
    } elseif ($input == 'R') {
    	//echo 'key is ' . $key . PHP_EOL;
        // Remove which item?
        echo 'Enter item number to remove: ';
        // Get array key
        //$key = trim(fgets(STDIN));
        $key = get_input();
        // Remove from array
        unset($items[$key - 1]);
    }
    elseif ($input == 'S') {
        $items = sort_menu($items);
        // print_r($newsort);
        // echo list_items($items);
    }
	$items = array_values($items);//reset keys to clean up indexes    
// Exit when input is (Q)uit or (q)uit
} while ($input != 'Q');

// Say Goodbye!
echo "Goodbye!\n";

// Exit with 0 errors
exit(0);