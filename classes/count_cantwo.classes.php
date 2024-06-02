<?php
require_once 'dbh.classes.php'; 

class CountCantwo extends Dbh
{
    public function getCandidateCount($candidateName)
    {
        try {
            $dbh = $this->connect(); // Call the connect method from the parent class
            $query = "SELECT COUNT(*) AS pre_count FROM presidential WHERE precandidate = :candidate2";
            $statement = $dbh->prepare($query);
            $statement->bindParam(':candidate2', $candidateName, PDO::PARAM_STR);
            $statement->execute();
            if ($statement) {
                $pretwoCount = $statement->fetch(PDO::FETCH_ASSOC)['pre_count'];
                return $pretwoCount;
            } else {
                return 0; // Return 0 if there are no matching records
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return 0; // Return 0 in case of an error
        }
    }
}

$candidateName = 'candidate2'; // Replace with the actual candidate name you want to count
$countCan = new CountCantwo(); // Create an instance of the CountCan class
$pretwoCount = $countCan->getCandidateCount($candidateName);

?>
