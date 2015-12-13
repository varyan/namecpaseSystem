<?php

try {
    $dbh->beginTransaction();
    $tmt->execute( array('user', 'user@example.com'));
    $dbh->commit();
    print $dbh->lastInsertId();
} catch(PDOExecption $e) {
    $dbh->rollback();
    print "Error!: " . $e->getMessage() . "</br>";
}