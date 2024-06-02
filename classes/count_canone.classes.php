<?php
require_once 'dbh.classes.php'; 

class CountCan extends Dbh
{
    public function getCandidateCount($candidateName)
    {
        try {
            $dbh = $this->connect(); // Call the connect method from the parent class
            $query = "SELECT COUNT(*) AS pre_count FROM presidential WHERE precandidate = :candidate1";
            $statement = $dbh->prepare($query);
            $statement->bindParam(':candidate1', $candidateName, PDO::PARAM_STR);
            $statement->execute();
            if ($statement) {
                $preCount = $statement->fetch(PDO::FETCH_ASSOC)['pre_count'];
                return $preCount;
            } else {
                return 0; // Return 0 if there are no matching records
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return 0; // Return 0 in case of an error
        }
    }
}

$candidateName = 'candidate1'; // Replace with the actual candidate name you want to count
$countCan = new CountCan(); // Create an instance of the CountCan class
$preCount = $countCan->getCandidateCount($candidateName);

?>
