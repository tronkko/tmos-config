<?php
# Output test name
echo "Running tests:\n\n";

# Run tests
$tests = array(
    'sanity',
    'section',
    'comment',
    'conversion',
    'multiline',
    'efficiency'
);

$fail = 0;
foreach ($tests as $testname) {

    # Print name of test
    printf ("%-24.24s", ucfirst ($testname));
    flush ();

    # Execute test.  The test is considered success if the script produces
    # the word "OK".
    $dir = __DIR__;
    $output = shell_exec ("php $dir/$testname.php 2>&1");

    # Print result
    if (trim ($output) == "OK") {

        # Test succeeded
        printf ("OK\n");

    } else if (is_null ($output)) {

        # Could not execute test
        printf ("FAIL\n");
        $fail++;

    } else {

        # Test failed with error message
        printf ("ERROR\n");
        echo $output;
        $fail++;

    }

}

echo "\n";
if (!$fail) {
    echo "All tests passed\n";
} else {
    echo "TEST FAILURE\n";
}
