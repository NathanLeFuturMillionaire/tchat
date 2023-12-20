<?php

require_once('back/queries/queries.php');
$database = dbConnection();


# SUBSTRING(chaine, pos)
# SUBSTRING(chaine FROM pos)
# SUBSTRING(chaine, pos, long)
# SUBSTRING(chaine FROM pos FOR long)

# INSTR(chaine, rech)
# POSITION(rech IN chaine)

# INSERT(chaine, pos, long, noucCaract)
# REPLACE(chaine, ancCaract, nouvCaract)

// Set the date to a french format
$frenchFormatDate = $database->prepare("SET lc_time_names = fr_FR");
$frenchFormatDate->execute();

$statement = $database->prepare("SELECT username, DAYNAME(enroll_date) AS dayName, DAY(enroll_date) AS myDay, MONTHNAME(enroll_date) AS monthDate, YEAR(enroll_date) AS myYear FROM users WHERE id = 1");
$statement->execute();
$data = $statement->fetch();

echo $data['username'] . ' s\'est inscrit ' . $data['dayName'] . ' ' . $data['myDay'] . ' ' . $data['monthDate'] . ' ' . $data['myYear'] . ' sur le site !';